<?php
ob_start();
error_reporting(0);
$page = $_GET['page'];
$user = $_GET['user'];

// Dashboard
if ($page=='dashboard'){
	include "dashboard.php";
}
// Categories
elseif ($page=='categories'){
    include "page/categories/categories.php";
}
elseif ($page=='add_categories'){
    include "page/categories/add_categories.php";
}
elseif ($page=='add_sub_categories'){
    include "page/categories/add_sub_categories.php";
}
// Course
elseif ($page=='course'){
    include "page/course/course.php";
}
elseif ($page=='add_course'){
    include "page/course/add_course.php";
}
elseif ($page=='update_course'){
    include "page/course/update_course.php";
}
elseif ($page=='add_question'){
    include "page/course/add_question.php";
}
// Employee
elseif ($page=='employee'){
    include "page/employee/employee.php";
}
// Enrolment
elseif ($page=='enrol_history'){
    include "page/enrol/enrol_history.php";
}
elseif ($page=='enrol_employee'){
    include "page/enrol/enrol_employee.php";
}
// Report
elseif ($page=='report'){
    include "page/report/report.php";
}
elseif ($page=='update_report'){
    include "page/report/update_report.php";
}
// Discuss
elseif ($page=='discuss'){
    include "page/discuss/discuss.php";
}
elseif ($page=='discuss_detail'){
    include "page/discuss/discuss_detail.php";
}
// Manage Account
elseif ($page=='admin_account'){
    include "page/account/admin_account.php";
}
elseif ($page=='instructor_account'){
    include "page/account/instructor_account.php";
}
// Profile
elseif ($page=='profile'){
    include "page/profile/profile.php";
}

// ================ FOR USER ================ //

// Home
elseif ($user=='home'){
	include "home.php";
}
// Categories
elseif ($user=='categories'){
    include "page_user/categories/categories.php";
}
// Course
elseif ($user=='course'){
    include "page_user/course/course.php";
}
elseif ($user=='mycourse'){
    include "page_user/course/mycourse.php";
}
elseif ($user=='discuss'){
    include "page_user/course/discuss.php";
}
elseif ($user=='results'){
    include "page_user/course/results.php";
}
// Lesson
elseif ($user=='lesson'){
    include "page_user/lesson/lesson.php";
}
// Profile
elseif ($user=='profile'){
    include "page_user/profile/profile.php";
}

else{
    include "error_page.php";
}
?>