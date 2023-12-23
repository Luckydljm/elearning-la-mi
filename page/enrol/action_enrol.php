<?php 
    include '../../config/connect.php';
    session_start();

    if(isset($_POST['enrol'])){

        $id_users = $_POST['id_users'];
        $id_users = filter_var($id_users, FILTER_SANITIZE_STRING);
        $id_course = $_POST['id_course'];
        $id_course = filter_var($id_course, FILTER_SANITIZE_STRING);
        $created_at = $_POST['created_at'];
        $created_at = filter_var($created_at, FILTER_SANITIZE_STRING);

        $verify_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_course = ? && id_users = ?");
        $verify_enrol->execute([$id_course, $id_users]);

        if($verify_enrol->rowCount() > 0){
            $_SESSION['fail'] = "Data has been added!";
            header('location:../../layouts/template.php?page=enrol_employee');
         }else{
            $add_enrol = $conn->prepare("INSERT INTO `enrol`(id_users, id_course, created_at) VALUES(?,?,?)");
            $add_enrol->execute([$id_users, $id_course, $created_at]);

            $_SESSION['success'] = "Data added!";
            header('location:../../layouts/template.php?page=enrol_history');
         }
     }

    // Delete Enrol
    if(isset($_POST['delete'])){
        $delete_id = $_POST['id_enrol'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    
        $verify_enrol = $conn->prepare("SELECT * FROM `enrol` WHERE id_enrol = ? LIMIT 1");
        $verify_enrol->execute([$delete_id]);
    
        if($verify_enrol->rowCount() > 0){
        $delete_enrol = $conn->prepare("DELETE FROM `enrol` WHERE id_enrol = ?");
        $delete_enrol->execute([$delete_id]);
        $_SESSION['flash'] = "Data deleted!";
        header('location:../../layouts/template.php?page=enrol_history');
        
        }else{
            $_SESSION['flash_fail'] = "Data not found!";
            header('location:../../layouts/template.php?page=enrol_history');
        }
    }
    
?>