<?php 
include 'config/connect.php';
session_start();

if($_POST['user_type']=="direktur" || $_POST['user_type']=="admin"){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
      $_SESSION['email']        = $row['email'];
      $_SESSION['password']     = $row['password'];
      $_SESSION['first_name']	  = $row['first_name'];
      $_SESSION['last_name']	  = '';
      $_SESSION['user_type']	  = $row['user_type'];
      $_SESSION['id_admin']     = $row['id_admin'];
      $_SESSION['sukses'] = "Welcome to e-learning PT. Southern of Sumatera!";
      setcookie('id_admin', $row['id_admin'], time() + 60*60*24*30, '/');
      header('location:layouts/template.php?page=dashboard');
   }else{
      $_SESSION['gagal'] = "Incorrect email or password!";
      header('location:index.php');
   }

}elseif($_POST['user_type']=="instruktur"){
   
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `instructors` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
      $_SESSION['email']        = $row['email'];
      $_SESSION['password']     = $row['password'];
      $_SESSION['first_name']	  = $row['first_name'];
      $_SESSION['last_name']	  = $row['last_name'];
      $_SESSION['user_type']	  = $row['user_type'];
      $_SESSION['id_instructor']     = $row['id_instructor'];
      $_SESSION['sukses'] = "Welcome to e-learning PT. Southern of Sumatera!";
      setcookie('id_instructor', $row['id_instructor'], time() + 60*60*24*30, '/');
      header('location:layouts/template.php?page=dashboard');
   }else{
      $_SESSION['gagal'] = "Incorrect email or password!";
      header('location:index.php');
   }
   
}else{
   
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
      $_SESSION['email']        = $row['email'];
      $_SESSION['password']     = $row['password'];
      $_SESSION['first_name']	  = $row['first_name'];
      $_SESSION['last_name']	  = $row['last_name'];
      $_SESSION['position']	  = $row['position'];
      $_SESSION['id_users']     = $row['id_users'];
      setcookie('id_users', $row['id_users'], time() + 60*60*24*30, '/');
      header('location:layouts/template_user.php?user=home');
   }else{
      $_SESSION['gagal'] = "Incorrect email or password!";
      header('location:index.php');
   }
}

?>