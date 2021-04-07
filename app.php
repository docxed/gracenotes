<?php 
    function node(){
        if ($_GET['func'] == 'register'){
            register();
        }else if ($_GET['func'] == 'login'){
            login();
        }elseif ($_GET['func'] == 'logout') {
            logout();
        }elseif ($_GET['func'] == 'addgrace') {
            addgrace();
        }elseif ($_GET['func'] == 'profile') {
            profile();
        }elseif ($_GET['func'] == 'report') {
            report();
        }elseif ($_GET['func'] == 'checking') {
            checking();
        }elseif ($_GET['func'] == 'delmgrace') {
            delmgrace();
        }elseif ($_GET['func'] == 'socialadd') {
            socialadd();
        }elseif ($_GET['func'] == 'editsocial') {
            editsocial();
        }elseif ($_GET['func'] == 'delsocial') {
            delsocial();
        }elseif ($_GET['func'] == 'delaccount') {
            delaccount();
        }elseif ($_GET['func'] == 'replyadd') {
            replyadd();
        }elseif ($_GET['func'] == 'commentadd') {
            commentadd();
        }elseif ($_GET['func'] == 'delcomment') {
            delcomment();
        }elseif ($_GET['func'] == 'likeadd') {
            likeadd();
        }
        
    }

    function register(){
        require 'connection.php';
        if ($_POST['pass'] != $_POST['repass']){
            echo "<script>";
            echo "alert('ยืนยันรหัสผ่านไม่ตรงกัน, ลองอีกครั้ง');";
            echo "window.location.href='index.php?q=register';";
            echo "</script>";
        }else{
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $class = $_POST['class'];
            $no = $_POST['no'];
            $dob = $_POST['dob'];
            $address = $_POST['address1'].$_POST['address2'];
            $ext = pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
            $new_img_name = 'stu_'.uniqid().'.'.$ext;
            $imgpath = "student/";
            $uploadpath = $imgpath.$new_img_name;
            $success = move_uploaded_file($_FILES['img']['tmp_name'], $uploadpath);
            if ($success==FALSE) {
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
                echo "window.location.href='index.php';";
                echo "</script>";
                exit();
            }
            $proname = $new_img_name;
            $q = "INSERT INTO members (member_user, member_password, member_fname, member_lname, member_class, member_no, member_dob, member_address, member_img) VALUES ('$user', '$pass', '$fname', '$lname', '$class', '$no', '$dob', '$address', '$proname')";
            $resq = mysqli_query($dbcon, $q);
            if ($resq){
                echo "<script>";
                echo "alert('ดำเนินการสำเร็จ');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }else{
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }
    }

    function login(){
        require 'connection.php';
        $user = $_POST['user'];
        $pass = $_POST['password'];

        $q = "SELECT * FROM members WHERE member_user='$user' AND member_password='$pass'";
        $resq = $resq = mysqli_query($dbcon, $q);
        $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
        if (!$rowq) {
            echo "<script>";
            echo "alert('รหัสนักเรียน หรือ รหัสผ่านผิด! โปรดลองอีกครั้ง');";
            echo "window.location.href='index.php';";
            echo "</script>";
          }else{
            session_start();
            $_SESSION['user'] = $rowq['member_user'];
            $_SESSION['uid'] = $rowq['member_id'];
            $_SESSION['level'] = $rowq['member_level'];
            if ($_SESSION['level'] == 'teacher'){
                header('location: main.php?q=admin');
            }else{
                header('location: main.php');
            }
          }
    }

    function logout(){
        require 'connection.php';
        session_start();
        if(session_destroy()){
            echo "<script>";
            echo "alert('ลงชื่อออก');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function addgrace(){
        require 'connection.php';
        $time = $_POST['time'];
        $date = $_POST['date'];
        $detail = $_POST['detail'];
        $agency = $_POST['agency'];
        $uid = $_POST['uid'];
        $ext = pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
        $new_img_name = 'grace_'.uniqid().'.'.$ext;
        $imgpath = "grace/";
        $uploadpath = $imgpath.$new_img_name;
        $success = move_uploaded_file($_FILES['img']['tmp_name'], $uploadpath);
        if ($success==FALSE) {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
            exit();
        }
        $proname = $new_img_name;
        $q = "INSERT INTO grace (grace_time, grace_date, grace_detail, grace_agency, grace_img, member_id) VALUES ('$time', '$date', '$detail', '$agency', '$proname', '$uid')";
        $resq = mysqli_query($dbcon, $q);
            if ($resq){
                echo "<script>";
                echo "alert('ดำเนินการสำเร็จ');";
                echo "window.location.href='main.php?q=grace';";
                echo "</script>";
            }else{
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
    }

    function profile(){
        require 'connection.php';
        $pass = $_POST['pass'];
        $repass = $_POST['repass'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $class = $_POST['class'];
        $no = $_POST['no'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $uid = $_POST['uid'];

        if ($pass != $repass){
            echo "<script>";
            echo "alert('ยืนยันรหัสผ่านไม่ตรงกัน, ลองอีกครั้ง');";
            echo "window.location.href='main.php?q=profile';";
            echo "</script>";
        }else{
            $q = "UPDATE members SET member_password='$pass', member_fname='$fname', member_lname='$lname', member_class='$class', member_no='$no', member_dob='$dob', member_address='$address' WHERE member_id='$uid'";
            $resq = mysqli_query($dbcon, $q);
            if($resq){
                echo "<script>";
                echo "alert('ดำเนินการสำเร็จ');";
                echo "</script>";
                logout();
            }else{
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }
    }

    function report(){
        require 'connection.php';
        $head = $_POST['head'];
        $body = $_POST['body'];
        $uid = $_POST['uid'];
        $q = "INSERT INTO report (report_topic, report_detail, member_id) VALUES ('$head', '$body', '$uid')";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=report';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function checking(){
        require 'connection.php';
        $uid = $_POST['uid'];
        $status = $_POST['status'];
        $q = "UPDATE grace SET grace_check='$status' WHERE grace_id='$uid'";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=mview&g=$uid';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function delmgrace(){
        require 'connection.php';
        $uid = $_GET['g'];
        $q = "DELETE FROM grace WHERE grace_id='$uid'";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=mgrace';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function socialadd(){
        require 'connection.php';
        $uid = $_POST['uid'];
        $img = $_POST['img'];
        $detail = $_POST['detail'];
        $q = "INSERT INTO social (social_detail, social_img, member_id) VALUES ('$detail', '$img', '$uid')";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=msocial';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function editsocial(){
        require 'connection.php';
        $uid = $_POST['uid'];
        $detail = $_POST['detail'];
        $q = "UPDATE social SET social_detail='$detail' WHERE social_id='$uid'";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=msocialedit&g=$uid';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function delsocial(){
        require 'connection.php';
        $uid = $_GET['g'];
        $q = "DELETE FROM social WHERE social_id='$uid'";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=msocial';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function delaccount(){
        require 'connection.php';
        $uid = $_GET['g'];
        $q = "DELETE FROM members WHERE member_id='$uid'";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=maccount';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function replyadd(){
        require 'connection.php';
        $detail = $_POST['detail'];
        $uid = $_POST['uid'];
        $sid = $_POST['sid'];
        $q = "INSERT INTO report_feedback (reply_detail, member_id, report_id) VALUES ('$detail', '$uid', '$sid')";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=reply&g=$sid';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function commentadd(){
        require 'connection.php';
        $detail = $_POST['comment'];
        $uid = $_POST['uid'];
        $sid = $_POST['sid'];
        $q = "INSERT INTO comment (comment_detail, member_id, social_id) VALUES ('$detail', '$uid', '$sid')";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=social&g=$sid';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    function delcomment(){
        require 'connection.php';
        $uid = $_GET['g'];
        $sid = $_GET['s'];
        $q = "DELETE FROM comment WHERE comment_id='$uid'";
        $resq = mysqli_query($dbcon, $q);
        if($resq){
            echo "<script>";
            echo "alert('ดำเนินการสำเร็จ');";
            echo "window.location.href='main.php?q=social&g=$sid';";
            echo "</script>";
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
    function likeadd(){
        require 'connection.php';
        $type = $_GET['type'];
        $uid = $_GET['uid'];
        $sid = $_GET['sid'];
        $q1 = "DELETE FROM `status` WHERE social_id='$sid' AND member_id='$uid'";
        $resq1 = mysqli_query($dbcon, $q1);
        if($resq1){
            $q2 = "INSERT INTO `status` (status_type, member_id, social_id) VALUES ('$type', '$uid', '$sid')";
            $resq2 = mysqli_query($dbcon, $q2);
            if($resq2){
                echo "<script>";
                echo "window.location.href='main.php?q=social&g=$sid';";
                echo "</script>";
            }else{
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }else{
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในขณะนี้');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }

    node();
?>