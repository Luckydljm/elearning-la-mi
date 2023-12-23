<?php 

    include '../../config/connect.php';
    session_start();

    if(isset($_COOKIE['id_instructor'])){
        $id_instructor = $_COOKIE['id_instructor'];
     }else{
        $id_instructor = '';
        header('location:../../index.php');
     }

   //   Update Results
   if(isset($_POST['update'])){

      $results_id = $_POST['id_results'];
      $results_id = filter_var($results_id, FILTER_SANITIZE_STRING);
      $answers = $_POST['answers'];
      $answers = filter_var($answers, FILTER_SANITIZE_STRING);
      $results = $_POST['results'];
      $results = filter_var($results, FILTER_SANITIZE_STRING);
      $notes = $_POST['notes'];
      $notes = filter_var($notes, FILTER_SANITIZE_STRING);
   
      $update_results = $conn->prepare("UPDATE `results` SET answers = ? WHERE id_results = ?");
      $update_results->execute([$answers, $results_id]);
      
      if(!empty($results)){
         $update_results = $conn->prepare("UPDATE `results` SET results = ? WHERE id_results = ?");
         $update_results->execute([$results, $results_id]);
      }

      if(!empty($notes)){
         $update_notes = $conn->prepare("UPDATE `results` SET notes = ? WHERE id_results = ?");
         $update_notes->execute([$notes, $results_id]);
      }
   
      $_SESSION['update'] = "results updated!";
      header('location:../../layouts/template.php?page=report');
   
   } 
?>