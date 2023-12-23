<?php 

    include '../../config/connect.php';
    session_start();

    if(isset($_COOKIE['id_instructor'])){
        $id_instructor = $_COOKIE['id_instructor'];
     }

     if(isset($_POST['update_profile'])){

      $select_instructor = $conn->prepare("SELECT * FROM `instructors` WHERE id_instructor = ? LIMIT 1");
      $select_instructor->execute([$id_instructor]);
      $fetch_instructor = $select_instructor->fetch(PDO::FETCH_ASSOC);
      
      $prev_image = $fetch_instructor['photo'];
   
      $first_name = $_POST['first_name'];
      $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
   
     if(!empty($first_name)){
      $update_first_name = $conn->prepare("UPDATE `instructors` SET first_name = ? WHERE id_instructor = ?");
      $update_first_name->execute([$first_name, $id_instructor]);
      $_SESSION['update'] = "First Name Updated!";
      header('location:../../layouts/template.php?page=profile');
     }

      $last_name = $_POST['last_name'];
      $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
   
     if(!empty($last_name)){
      $update_last_name = $conn->prepare("UPDATE `instructors` SET last_name = ? WHERE id_instructor = ?");
      $update_last_name->execute([$last_name, $id_instructor]);
      $_SESSION['update'] = "Last Name Updated!";
      header('location:../../layouts/template.php?page=profile');
     }
   
      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);
   
      if(!empty($email)){
         $select_email = $conn->prepare("SELECT email FROM `instructors` WHERE email = ?");
         $select_email->execute([$email]);
         if($select_email->rowCount() > 0){
            $_SESSION['failed'] = "Email already taken!";
            header('location:../../layouts/template.php?page=profile');
         }else{
            $update_email = $conn->prepare("UPDATE `instructors` SET email = ? WHERE id_instructor = ?");
            $update_email->execute([$email, $id_instructor]);
            $_SESSION['update'] = "Email Updated!";
            header('location:../../layouts/template.php?page=profile');
         }
      }
   
      $photo = $_FILES['photo']['name'];
      $photo = filter_var($photo, FILTER_SANITIZE_STRING);
      $ext = pathinfo($photo, PATHINFO_EXTENSION);
      $rename = unique_id().'.'.$ext;
      $photo_size = $_FILES['photo']['size'];
      $photo_tmp_name = $_FILES['photo']['tmp_name'];
      $photo_folder = '../../uploaded_profile/'.$rename;
   
      if(!empty($photo)){
         if($photo_size > 2000000){
            $_SESSION['failed'] = "Photo size too large!";
            header('location:../../layouts/template.php?page=profile');
         }else{
            $update_photo = $conn->prepare("UPDATE `instructors` SET `photo` = ? WHERE id_instructor = ?");
            $update_photo->execute([$rename, $id_instructor]);
            move_uploaded_file($photo_tmp_name, $photo_folder);
            if($prev_photo != '' AND $prev_photo != $rename){
               unlink('../../uploaded_profile/'.$prev_photo);
            }
            $_SESSION['update'] = "Photo updated!";
            header('location:../../layouts/template.php?page=profile');
         }
      }
   
   }

   if(isset($_POST['update_password'])){

      $select_instructor = $conn->prepare("SELECT * FROM `instructors` WHERE id_instructor = ? LIMIT 1");
      $select_instructor->execute([$id_instructor]);
      $fetch_instructor = $select_instructor->fetch(PDO::FETCH_ASSOC);
      
      $prev_pass = $fetch_instructor['password'];
   
      $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
      $old_pass = sha1($_POST['old_pass']);
      $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
      $new_pass = sha1($_POST['new_pass']);
      $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
      $cpass = sha1($_POST['cpass']);
      $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

      if($old_pass != $empty_pass){
         if($old_pass != $prev_pass){
            $_SESSION['failed'] = "Old password not matched!";
            header('location:../../layouts/template.php?page=profile');
         }elseif($new_pass != $cpass){
            $_SESSION['failed'] = "Confirm password not matched!";
            header('location:../../layouts/template.php?page=profile');
         }else{
            if($new_pass != $empty_pass){
               $update_pass = $conn->prepare("UPDATE `instructors` SET password = ? WHERE id_instructor = ?");
               $update_pass->execute([$cpass, $id_instructor]);
               $_SESSION['update'] = "Password updated!";
               header('location:../../layouts/template.php?page=profile');
            }else{
               $_SESSION['warning'] = "Please enter a new password!";
               header('location:../../layouts/template.php?page=profile');
            }
         }
      }
   
   }

?>