<?php 

    include '../../config/connect.php';
    session_start();

    if(isset($_COOKIE['id_users'])){
        $id_users = $_COOKIE['id_users'];
     }else{
        $id_users = '';
        header('location:../../index.php');
     }

     if(isset($_POST['like_course'])){
            
        $id_course = $_POST['id_course'];
        $id_course = filter_var($id_course, FILTER_SANITIZE_STRING);
            
        $select_course = $conn->prepare("SELECT * FROM `course` WHERE id_course = ? LIMIT 1");
        $select_course->execute([$id_course]);
        $fetch_course = $select_course->fetch(PDO::FETCH_ASSOC);
            
        $id_instructor = $fetch_course['id_instructor'];
            
        $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE id_users = ? AND id_course = ?");
        $select_likes->execute([$id_users, $id_course]);
            
        if($select_likes->rowCount() > 0){
        $remove_likes = $conn->prepare("DELETE FROM `likes` WHERE id_users = ? AND id_course = ?");
        $remove_likes->execute([$id_users, $id_course]);
        header('location:../../layouts/template_user.php?user=mycourse');
        }else{
        $insert_likes = $conn->prepare("INSERT INTO `likes`(id_users, id_instructor, id_course) VALUES(?,?,?)");
        $insert_likes->execute([$id_users, $id_instructor, $id_course]);
        header('location:../../layouts/template_user.php?user=mycourse');
        }
     
     }
?>