<?php 
    include '../../config/connect.php';
    session_start();

    if(isset($_COOKIE['id_instructor'])){
        $id_instructor = $_COOKIE['id_instructor'];
     }else{
        $id_instructor = '';
        header('location:../../index.php');
     }

    //  Add Categories
    if(isset($_POST['publish'])){

        $code = $_POST['code'];
        $code = filter_var($code, FILTER_SANITIZE_STRING);
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $date_added = $_POST['date_added'];
        $date_added = filter_var($date_added, FILTER_SANITIZE_STRING);
     
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnail = filter_var($thumbnail, FILTER_SANITIZE_STRING);
        $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $thumbnail_size = $_FILES['thumbnail']['size'];
        $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_folder = '../../uploaded_thumbnail/'.$rename;

        $verify_category = $conn->prepare("SELECT * FROM `category` WHERE name = ?");
        $verify_category->execute([$name]);

        if($verify_category->rowCount() > 0){
            $_SESSION['fail'] = "Data has been added!";
            header('location:../../layouts/template.php?page=add_categories');
         }else{
            $add_category = $conn->prepare("INSERT INTO `category`(code, name, date_added, thumbnail, id_instructor) VALUES(?,?,?,?,?)");
            $add_category->execute([$code, $name, $date_added, $rename, $id_instructor]);
         
            move_uploaded_file($thumbnail_tmp_name, $thumbnail_folder);

            $_SESSION['success'] = "Data added!";
            header('location:../../layouts/template.php?page=add_categories');
         }
     }

    //  Add Sub Categories
    if(isset($_POST['submit'])){

        $name_sub = $_POST['name_sub'];
        $name_sub = filter_var($name_sub, FILTER_SANITIZE_STRING);
        $id_category = $_POST['id_category'];
        $id_category = filter_var($id_category, FILTER_SANITIZE_STRING);
     
        $add_sub_category = $conn->prepare("INSERT INTO `sub_category`(name_sub, id_category) VALUES(?,?)");
        $add_sub_category->execute([$name_sub, $id_category]);

        $_SESSION['success'] = "Data added!";
        header('location:../../layouts/template.php?page=categories');
     
     }
     
    //  Delete Categories
     if(isset($_POST['delete_category'])){
        $delete_id = $_POST['id_category'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
     
        $verify_category = $conn->prepare("SELECT * FROM `category` WHERE id_category = ? AND id_instructor = ? LIMIT 1");
        $verify_category->execute([$delete_id, $id_instructor]);
     
        if($verify_category->rowCount() > 0){
     
        $delete_category_thumb = $conn->prepare("SELECT * FROM `category` WHERE id_category = ? LIMIT 1");
        $delete_category_thumb->execute([$delete_id]);
        $fetch_thumb = $delete_category_thumb->fetch(PDO::FETCH_ASSOC);
        unlink('../../uploaded_thumbnail/'.$fetch_thumb['thumbnail']);
        $delete_sub_category = $conn->prepare("DELETE FROM `sub_category` WHERE id_category = ?");
        $delete_sub_category->execute([$delete_id]);
        $delete_category = $conn->prepare("DELETE FROM `category` WHERE id_category = ?");
        $delete_category->execute([$delete_id]);
        $_SESSION['flash'] = "Data deleted!";
        header('location:../../layouts/template.php?page=categories');
        
        }else{
            $_SESSION['flash_fail'] = "Data not found!";
            header('location:../../layouts/template.php?page=categories');
        }
     }

     //  Delete Sub Categories
     if(isset($_POST['delete_sub_category'])){
      $delete_id = $_POST['id_sub_category'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_sub_category = $conn->prepare("SELECT * FROM `sub_category` WHERE id_sub_category = ? LIMIT 1");
      $verify_sub_category->execute([$delete_id]);
   
      if($verify_sub_category->rowCount() > 0){
   
      $delete_sub_category = $conn->prepare("DELETE FROM `sub_category` WHERE id_sub_category = ?");
      $delete_sub_category->execute([$delete_id]);
      $_SESSION['flash'] = "Data deleted!";
      header('location:../../layouts/template.php?page=categories');
      
      }else{
          $_SESSION['flash_fail'] = "Data not found!";
          header('location:../../layouts/template.php?page=categories');
      }
   }

   //   Update Categories
   if(isset($_POST['update_category'])){

      $id_category = $_POST['id_category'];
      $id_category = filter_var($id_category, FILTER_SANITIZE_STRING);
      $code = $_POST['code'];
      $code = filter_var($code, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
   
      $update_category = $conn->prepare("UPDATE `category` SET code = ?, name = ? WHERE id_category = ?");
      $update_category->execute([$code, $name, $id_category]);
   
      $old_thumbnail = $_POST['old_thumbnail'];
      $old_thumbnail = filter_var($old_thumbnail, FILTER_SANITIZE_STRING);
      $thumbnail = $_FILES['thumbnail']['name'];
      $thumbnail = filter_var($thumbnail, FILTER_SANITIZE_STRING);
      $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
      $rename = unique_id().'.'.$ext;
      $thumbnail_size = $_FILES['thumbnail']['size'];
      $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
      $thumbnail_folder = '../../uploaded_thumbnail/'.$rename;
   
      if(!empty($thumbnail)){
         if($thumbnail_size > 2000000){
            $_SESSION['img_size'] = "Image size is too large!";
            header('location:../../layouts/template.php?page=categories');
         }else{
            $update_thumbnail = $conn->prepare("UPDATE `category` SET thumbnail = ? WHERE id_category = ?");
            $update_thumbnail->execute([$rename, $id_category]);
            move_uploaded_file($thumbnail_tmp_name, $thumbnail_folder);
            if($old_thumbnail != '' AND $old_thumbnail != $rename){
               unlink('../../uploaded_thumbnail/'.$old_thumbnail);
            }
         }
      } 
   
      $_SESSION['update'] = "Category updated!";
      header('location:../../layouts/template.php?page=categories');
   
   } 
?>