<?php 
    include '../../config/connect.php';
    session_start();
    
    // submit instruktur
    if(isset($_POST['submit_instructor'])){
        $id_instructor = $_POST['id_instructor'];
        $id_instructor = filter_var($id_instructor, FILTER_SANITIZE_STRING);
        $first_name = $_POST['first_name'];
        $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
        $last_name = $_POST['last_name'];
        $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_instructor = $conn->prepare("SELECT * FROM `instructors` WHERE email = ?");
        $select_instructor->execute([$email]);

        if($select_instructor->rowCount() > 0){
            $_SESSION['registered'] = "Email has been registered!";
            header('location:../../layouts/template.php?page=instructor_account');
        }else{
            $add_instructor = $conn->prepare("INSERT INTO `instructors`(first_name, last_name, email, password) VALUES(?,?,?,?)");
            $add_instructor->execute([$first_name, $last_name, $email, $pass]);
            $_SESSION['success'] = "Data added!";
            header('location:../../layouts/template.php?page=instructor_account');
        }
    
    }

    // submit admin
    if(isset($_POST['submit_admin'])){
        $id_admin = $_POST['id_admin'];
        $id_admin = filter_var($id_admin, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
        $user_type = $_POST['user_type'];
        $user_type = filter_var($user_type, FILTER_SANITIZE_STRING);

        $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
        $select_admin->execute([$email]);

        if($select_admin->rowCount() > 0){
            $_SESSION['registered'] = "Email has been registered!";
            header('location:../../layouts/template.php?page=admin_account');
        }else{
            $add_admin = $conn->prepare("INSERT INTO `admin`(email, password, user_type) VALUES(?,?,?)");
            $add_admin->execute([$email, $pass, $user_type]);
            $_SESSION['success'] = "Data added!";
            header('location:../../layouts/template.php?page=admin_account');
        }
    
    }

    // submit user
    if(isset($_POST['submit_user'])){
        $id_users = $_POST['id_users'];
        $id_users = filter_var($id_users, FILTER_SANITIZE_STRING);
        $first_name = $_POST['first_name'];
        $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
        $last_name = $_POST['last_name'];
        $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
        $position = $_POST['position'];
        $position = filter_var($position, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select_user->execute([$email]);

        if($select_user->rowCount() > 0){
            $_SESSION['registered'] = "Email has been registered!";
            header('location:../../layouts/template.php?page=employee');
        }else{
            $add_user = $conn->prepare("INSERT INTO `users`(first_name, last_name, position, email, password) VALUES(?,?,?,?,?)");
            $add_user->execute([$first_name, $last_name, $position, $email, $pass]);
            $_SESSION['success'] = "Data added!";
            header('location:../../layouts/template.php?page=employee');
        }
    
    }

    // delete instruktur
    if(isset($_POST['delete_instructor'])){

        $delete_id = $_POST['id_instructor'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_instructor = $conn->prepare("SELECT * FROM `instructors` WHERE id_instructor = ? LIMIT 1");
        $verify_instructor->execute([$delete_id]);

        if($verify_instructor->rowCount() > 0){
            
        $delete_instructor = $conn->prepare("DELETE FROM `instructors` WHERE id_instructor = ?");
        $delete_instructor->execute([$delete_id]);
        $_SESSION['flash'] = "Data deleted!";
        header('location:../../layouts/template.php?page=instructor_account');
        
        }else{
            $_SESSION['flash_fail'] = "Data not found!";
            header('location:../../layouts/template.php?page=instructor_account');
        }
    }

    // delete admin
    if(isset($_POST['delete_admin'])){

        $delete_id = $_POST['id_admin'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_admin = $conn->prepare("SELECT * FROM `admin` WHERE id_admin = ? LIMIT 1");
        $verify_admin->execute([$delete_id]);

        if($verify_admin->rowCount() > 0){
            
        $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id_admin = ?");
        $delete_admin->execute([$delete_id]);
        $_SESSION['flash'] = "Data deleted!";
        header('location:../../layouts/template.php?page=admin_account');
        
        }else{
            $_SESSION['flash_fail'] = "Data not found!";
            header('location:../../layouts/template.php?page=admin_account');
        }
    }

    // delete user
    if(isset($_POST['delete_user'])){

        $delete_id = $_POST['id_users'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_user = $conn->prepare("SELECT * FROM `users` WHERE id_users = ? LIMIT 1");
        $verify_user->execute([$delete_id]);

        if($verify_user->rowCount() > 0){
            
        $delete_user = $conn->prepare("DELETE FROM `users` WHERE id_users = ?");
        $delete_user->execute([$delete_id]);
        $_SESSION['flash'] = "Data deleted!";
        header('location:../../layouts/template.php?page=employee');
        
        }else{
            $_SESSION['flash_fail'] = "Data not found!";
            header('location:../../layouts/template.php?page=employee');
        }
    }
?>