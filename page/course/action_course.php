<?php 

    include '../../config/connect.php';
    session_start();

    if(isset($_COOKIE['id_instructor'])){
        $id_instructor = $_COOKIE['id_instructor'];
     }else{
        $id_instructor = '';
        header('location:../../index.php');
     }

     //  Add Course
    if(isset($_POST['submit'])){

        $title = $_POST['title'];
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $short_desc = $_POST['short_desc'];
        $short_desc = filter_var($short_desc, FILTER_SANITIZE_STRING);
        $description = $_POST['description'];
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $outcomes = $_POST['outcomes'];
        $outcomes = filter_var($outcomes, FILTER_SANITIZE_STRING);
        $id_sub_category = $_POST['id_sub_category'];
        $id_sub_category = filter_var($id_sub_category, FILTER_SANITIZE_STRING);
        $requirements = $_POST['requirements'];
        $requirements = filter_var($requirements, FILTER_SANITIZE_STRING);
        $date_added = $_POST['date_added'];
        $date_added = filter_var($date_added, FILTER_SANITIZE_STRING);
     
        $thumbnail = $_FILES['thumbnail']['name'];
        $thumbnail = filter_var($thumbnail, FILTER_SANITIZE_STRING);
        $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $thumbnail_size = $_FILES['thumbnail']['size'];
        $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_folder = '../../uploaded_thumbnail/'.$rename;

        $verify_course = $conn->prepare("SELECT * FROM `course` WHERE title = ?");
        $verify_course->execute([$title]);

        if($verify_course->rowCount() > 0){
            $_SESSION['fail'] = "Data has been added!";
            header('location:../../layouts/template.php?page=add_course');
         }else{
            $add_course = $conn->prepare("INSERT INTO `course`(title, short_desc, description, outcomes, id_sub_category, requirements, date_added, thumbnail, id_instructor) VALUES(?,?,?,?,?,?,?,?,?)");
            $add_course->execute([$title, $short_desc, $description, $outcomes, $id_sub_category, $requirements, $date_added, $rename, $id_instructor]);
         
            move_uploaded_file($thumbnail_tmp_name, $thumbnail_folder);

            $_SESSION['success'] = "Data added!";
            header('location:../../layouts/template.php?page=course');
         }
     }
     
     //  Add Section
    if(isset($_POST['submit_section'])){

      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $id_course = $_POST['id_course'];
      $id_course = filter_var($id_course, FILTER_SANITIZE_STRING);

      $verify_section = $conn->prepare("SELECT * FROM `section` WHERE title = ?");
      $verify_section->execute([$title]);

      if($verify_section->rowCount() > 0){
          $_SESSION['fail'] = "Data has been added!";
          header('location:../../layouts/template.php?page=course');
       }else{
          $add_section = $conn->prepare("INSERT INTO `section`(title, id_course) VALUES(?,?)");
          $add_section->execute([$title, $id_course]);

          $_SESSION['success'] = "Data added!";
          header('location:../../layouts/template.php?page=course');
       }
   }

    //  Add Lesson
    if(isset($_POST['submit_lesson'])){

      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $id_section = $_POST['id_section'];
      $id_section = filter_var($id_section, FILTER_SANITIZE_STRING);
      $id_course = $_POST['id_course'];
      $id_course = filter_var($id_course, FILTER_SANITIZE_STRING);
      $lesson_type = $_POST['lesson_type'];
      $lesson_type = filter_var($lesson_type, FILTER_SANITIZE_STRING);

      if($lesson_type == 'video-url'){
         $video_url = $_POST['video_url'];
         $video_url = filter_var($video_url, FILTER_SANITIZE_STRING);
         $duration = $_POST['duration'];
         $duration = filter_var($duration, FILTER_SANITIZE_STRING);
      }elseif($lesson_type == 'other-txt' || $lesson_type == 'other-pdf' || $lesson_type == 'other-doc' || $lesson_type == 'other-img'){
         $attachment = $_FILES['attachment']['name'];
         $attachment = filter_var($attachment, FILTER_SANITIZE_STRING);
         $ext = pathinfo($attachment, PATHINFO_EXTENSION);
         $rename = unique_id().'.'.$ext;
         $attachment_size = $_FILES['attachment']['size'];
         $attachment_tmp_name = $_FILES['attachment']['tmp_name'];
         $attachment_folder = '../../uploaded_attachment/'.$rename;
         
         $attachment_type = $_POST['attachment_type'];
         $attachment_type = filter_var($attachment_type, FILTER_SANITIZE_STRING);
      }
   
      $summary = $_POST['summary'];
      $summary = filter_var($summary, FILTER_SANITIZE_STRING);
      $date_added = $_POST['date_added'];
      $date_added = filter_var($date_added, FILTER_SANITIZE_STRING);
   
      $verify_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE title = ?");
      $verify_lesson->execute([$title]);

      if($verify_lesson->rowCount() > 0){
         $_SESSION['fail'] = "Data has been added!";
         header('location:../../layouts/template.php?page=course');
       }else{
          $add_lesson = $conn->prepare("INSERT INTO `lesson`(title, id_section, lesson_type, video_url, duration, summary, date_added, attachment, id_course, attachment_type) VALUES(?,?,?,?,?,?,?,?,?,?)");
          $add_lesson->execute([$title, $id_section, $lesson_type, $video_url, $duration, $summary, $date_added, $rename, $id_course, $ext]);
       
          move_uploaded_file($attachment_tmp_name, $attachment_folder);

          $_SESSION['success'] = "Data added!";
          header('location:../../layouts/template.php?page=course');
       }
   }

   //  Add Question
   if(isset($_POST['submit_question'])){

      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $option_a = $_POST['option_a'];
      $option_a = filter_var($option_a, FILTER_SANITIZE_STRING);
      $option_b = $_POST['option_b'];
      $option_b = filter_var($option_b, FILTER_SANITIZE_STRING);
      $option_c = $_POST['option_c'];
      $option_c = filter_var($option_c, FILTER_SANITIZE_STRING);
      $option_d = $_POST['option_d'];
      $option_d = filter_var($option_d, FILTER_SANITIZE_STRING);
      $correct_answers = $_POST['correct_answers'];
      $correct_answers = filter_var($correct_answers, FILTER_SANITIZE_STRING);
      $id_lesson = $_POST['id_lesson'];
      $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);

      $verify_question = $conn->prepare("SELECT * FROM `question` WHERE title = ?");
      $verify_question->execute([$title]);

      if($verify_question->rowCount() > 0){
          $_SESSION['fail'] = "Data has been added!";
          header('location:../../layouts/template.php?page=course');
       }else{
          $add_question = $conn->prepare("INSERT INTO `question`(title, option_a, option_b, option_c, option_d, correct_answers, id_lesson) VALUES(?,?,?,?,?,?,?)");
          $add_question->execute([$title, $option_a, $option_b, $option_c, $option_d, $correct_answers, $id_lesson]);

          $_SESSION['success'] = "Data added!";
          header('location:../../layouts/template.php?page=course');
       }
   }

   // Delete Lesson
   if(isset($_POST['delete_lesson'])){
      $delete_id = $_POST['id_lesson'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_lesson = $conn->prepare("SELECT * FROM `lesson` WHERE id_lesson = ? LIMIT 1");
      $verify_lesson->execute([$delete_id]);
   
      if($verify_lesson->rowCount() > 0){
      $delete_lesson_attach = $conn->prepare("SELECT * FROM `lesson` WHERE id_lesson = ? LIMIT 1");
      $delete_lesson_attach->execute([$delete_id]);
      $fetch_attachment = $delete_lesson_attach->fetch(PDO::FETCH_ASSOC);
      unlink('../../uploaded_attachment/'.$fetch_attachment['attachment']);
      $delete_lesson = $conn->prepare("DELETE FROM `lesson` WHERE id_lesson = ?");
      $delete_lesson->execute([$delete_id]);
      $_SESSION['flash'] = "Data deleted!";
      header('location:../../layouts/template.php?page=course');
      
      }else{
          $_SESSION['flash_fail'] = "Data not found!";
          header('location:../../layouts/template.php?page=course');
      }
   }

   // Delete Question
   if(isset($_POST['delete_question'])){
      $delete_id = $_POST['id_question'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_question = $conn->prepare("SELECT * FROM `question` WHERE id_question = ? LIMIT 1");
      $verify_question->execute([$delete_id]);
   
      if($verify_question->rowCount() > 0){
      $delete_question = $conn->prepare("DELETE FROM `question` WHERE id_question = ?");
      $delete_question->execute([$delete_id]);
      $_SESSION['flash'] = "Data deleted!";
      header('location:../../layouts/template.php?page=course');
      
      }else{
          $_SESSION['flash_fail'] = "Data not found!";
          header('location:../../layouts/template.php?page=course');
      }
   }

    //  Delete Section
    if(isset($_POST['delete_section'])){
      $delete_id = $_POST['id_section'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_section = $conn->prepare("SELECT * FROM `section` WHERE id_section = ? LIMIT 1");
      $verify_section->execute([$delete_id]);
   
      if($verify_section->rowCount() > 0){
   
      $delete_lesson = $conn->prepare("DELETE FROM `lesson` WHERE id_section = ?");
      $delete_lesson->execute([$delete_id]);
      $delete_section = $conn->prepare("DELETE FROM `section` WHERE id_section = ?");
      $delete_section->execute([$delete_id]);
      $_SESSION['flash'] = "Data deleted!";
      header('location:../../layouts/template.php?page=course');
      
      }else{
          $_SESSION['flash_fail'] = "Data not found!";
          header('location:../../layouts/template.php?page=course');
      }
   }

    //  Delete Course
    if(isset($_POST['delete_course'])){
      $delete_id = $_POST['id_course'];
      $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   
      $verify_course = $conn->prepare("SELECT * FROM `course` WHERE id_course = ? LIMIT 1");
      $verify_course->execute([$delete_id]);
   
      if($verify_course->rowCount() > 0){
      $delete_thumbnail = $conn->prepare("SELECT * FROM `course` WHERE id_course = ? LIMIT 1");
      $delete_thumbnail->execute([$delete_id]);
      $fetch_thumbnail = $delete_thumbnail->fetch(PDO::FETCH_ASSOC);
      unlink('../../uploaded_thumbnail/'.$fetch_thumbnail['thumbnail']);
      $delete_lesson = $conn->prepare("DELETE FROM `lesson` WHERE id_course = ?");
      $delete_lesson->execute([$delete_id]);
      $delete_section = $conn->prepare("DELETE FROM `section` WHERE id_course = ?");
      $delete_section->execute([$delete_id]);
      $delete_course = $conn->prepare("DELETE FROM `course` WHERE id_course = ?");
      $delete_course->execute([$delete_id]);
      $_SESSION['flash'] = "Data deleted!";
      header('location:../../layouts/template.php?page=course');
      
      }else{
          $_SESSION['flash_fail'] = "Data not found!";
          header('location:../../layouts/template.php?page=course');
      }
   }

   //   Update Course
   if(isset($_POST['update'])){

      $course_id = $_POST['id_course'];
      $course_id = filter_var($course_id, FILTER_SANITIZE_STRING);
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $short_desc = $_POST['short_desc'];
      $short_desc = filter_var($short_desc, FILTER_SANITIZE_STRING);
      $description = $_POST['description'];
      $description = filter_var($description, FILTER_SANITIZE_STRING);
      $outcomes = $_POST['outcomes'];
      $outcomes = filter_var($outcomes, FILTER_SANITIZE_STRING);
      $id_sub_category = $_POST['id_sub_category'];
      $id_sub_category = filter_var($id_sub_category, FILTER_SANITIZE_STRING);
      $requirements = $_POST['requirements'];
      $requirements = filter_var($requirements, FILTER_SANITIZE_STRING);
      $status = $_POST['status'];
      $status = filter_var($status, FILTER_SANITIZE_STRING);
      $approval = $_POST['approval'];
      $approval = filter_var($approval, FILTER_SANITIZE_STRING);
      $last_modified = $_POST['last_modified'];
      $last_modified = filter_var($last_modified, FILTER_SANITIZE_STRING);
      $start_date = $_POST['start_date'];
      $start_date = filter_var($start_date, FILTER_SANITIZE_STRING);
      $end_date = $_POST['end_date'];
      $end_date = filter_var($end_date, FILTER_SANITIZE_STRING);
   
      $update_course = $conn->prepare("UPDATE `course` SET title = ?, short_desc = ?, description = ?, outcomes = ?, id_sub_category = ?, requirements = ?, last_modified = ? WHERE id_course = ?");
      $update_course->execute([$title, $short_desc, $description, $outcomes, $id_sub_category, $requirements, $last_modified, $course_id]);
   
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
            header('location:../../layouts/template.php?page=course');
         }else{
            $update_thumbnail = $conn->prepare("UPDATE `course` SET thumbnail = ? WHERE id_course = ?");
            $update_thumbnail->execute([$rename, $course_id]);
            move_uploaded_file($thumbnail_tmp_name, $thumbnail_folder);
            if($old_thumbnail != '' AND $old_thumbnail != $rename){
               unlink('../../uploaded_thumbnail/'.$old_thumbnail);
            }
         }
      }
      
      if(!empty($status)){
         $update_status = $conn->prepare("UPDATE `course` SET status = ? WHERE id_course = ?");
         $update_status->execute([$status, $course_id]);
      }

      if(!empty($approval)){
         $update_approval = $conn->prepare("UPDATE `course` SET approval = ? WHERE id_course = ?");
         $update_approval->execute([$approval, $course_id]);
      }

      if(!empty($start_date)){
         $update_start_date = $conn->prepare("UPDATE `course` SET start_date = ? WHERE id_course = ?");
         $update_start_date->execute([$start_date, $course_id]);
      }

      if(!empty($end_date)){
         $update_end_date = $conn->prepare("UPDATE `course` SET end_date = ? WHERE id_course = ?");
         $update_end_date->execute([$end_date, $course_id]);
      }
   
      $_SESSION['update'] = "Course updated!";
      header('location:../../layouts/template.php?page=course');
   
   } 

   // Update Quiz
   if(isset($_POST['update_quiz'])){

      $id_lesson = $_POST['id_lesson'];
      $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $id_section = $_POST['id_section'];
      $id_section = filter_var($id_section, FILTER_SANITIZE_STRING);
      $summary = $_POST['summary'];
      $summary = filter_var($summary, FILTER_SANITIZE_STRING);
      $last_modified = $_POST['last_modified'];
      $last_modified = filter_var($last_modified, FILTER_SANITIZE_STRING);
   
      $update_lesson = $conn->prepare("UPDATE `lesson` SET title = ?, id_section = ?, summary = ?, last_modified = ? WHERE id_lesson = ?");
      $update_lesson->execute([$title, $id_section, $summary, $last_modified, $id_lesson]);
   
      $_SESSION['update'] = "Lesson updated!";
      header('location:../../layouts/template.php?page=course');
   
   } 

   // Update Lesson
   if(isset($_POST['update_lesson'])){

      $id_lesson = $_POST['id_lesson'];
      $id_lesson = filter_var($id_lesson, FILTER_SANITIZE_STRING);
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $id_section = $_POST['id_section'];
      $id_section = filter_var($id_section, FILTER_SANITIZE_STRING);
      $summary = $_POST['summary'];
      $summary = filter_var($summary, FILTER_SANITIZE_STRING);
      $last_modified = $_POST['last_modified'];
      $last_modified = filter_var($last_modified, FILTER_SANITIZE_STRING);
   
      $update_lesson = $conn->prepare("UPDATE `lesson` SET title = ?, id_section = ?, summary = ?, last_modified = ? WHERE id_lesson = ?");
      $update_lesson->execute([$title, $id_section, $summary, $last_modified, $id_lesson]);
   
      $_SESSION['update'] = "Lesson updated!";
      header('location:../../layouts/template.php?page=course');
   
   } 

   // Update Question
   if(isset($_POST['update_question'])){

      $id_question = $_POST['id_question'];
      $id_question = filter_var($id_question, FILTER_SANITIZE_STRING);
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
      $option_a = $_POST['option_a'];
      $option_a = filter_var($option_a, FILTER_SANITIZE_STRING);
      $option_b = $_POST['option_b'];
      $option_b = filter_var($option_b, FILTER_SANITIZE_STRING);
      $option_c = $_POST['option_c'];
      $option_c = filter_var($option_c, FILTER_SANITIZE_STRING);
      $option_d = $_POST['option_d'];
      $option_d = filter_var($option_d, FILTER_SANITIZE_STRING);
      $correct_answers = $_POST['correct_answers'];
      $correct_answers = filter_var($correct_answers, FILTER_SANITIZE_STRING);
   
      $update_question = $conn->prepare("UPDATE `question` SET title = ?, option_a = ?, option_b = ?, option_c = ?, option_d = ?, correct_answers = ? WHERE id_question = ?");
      $update_question->execute([$title, $option_a, $option_b, $option_c, $option_d, $correct_answers, $id_question]);
   
      $_SESSION['update'] = "Question updated!";
      header('location:../../layouts/template.php?page=course');
   
   } 

   // Update Section
   if(isset($_POST['update_section'])){

      $id_section = $_POST['id_section'];
      $id_section = filter_var($id_section, FILTER_SANITIZE_STRING);
      $title = $_POST['title'];
      $title = filter_var($title, FILTER_SANITIZE_STRING);
   
      $update_section = $conn->prepare("UPDATE `section` SET title = ? WHERE id_section = ?");
      $update_section->execute([$title, $id_section]);
   
      $_SESSION['update'] = "Section updated!";
      header('location:../../layouts/template.php?page=course');
   
   } 


?>