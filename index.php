<?php
require 'connection.php';
session_start();
if (isset($_SESSION['uid'])){
  header('location: main.php');
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="pictures/icon.jpg" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  <title>Gracenotes</title>
  <style>
    body {
      font-family: 'Kanit', sans-serif;
      line-height: 35px;
    }

    .content {
      border: solid 1px #ccc;
      padding: 40px 25px 40px 25px;
      border-radius: 8px;
    }
  </style>
</head>

<body>
  <!--NavBar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href=".">
        <img src="./pictures/logo.jpg" alt="" width="40" height="40" class="d-inline-block align-center">
            Gracenotes
      </a>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php
          if (isset($_GET['q'])){
        ?>
        <li class="nav-item">
          <a class="nav-link" href=".">ลงชื่อเข้าใช้งาน</a>
        </li>
        <?php
          }
        ?>
        <?php
          if (!isset($_GET['q'])){
        ?>
        <li class="nav-item">
          <a class="nav-link" href=".?q=register">ลงทะเบียนเข้าใช้งาน</a>
        </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </nav>
  <br><br><br>

  <!--Login Form-->
  <?php
    if (!isset($_GET['q'])){
  ?>
  <div class="container">
    <div class="content">
      <h3>ลงชื่อเข้าใช้งาน</h3><br>
      <form action="app.php?func=login" method="POST">
        <label for="user">รหัสนักเรียน</label>
        <input type="text" class="form-control" placeholder="รหัสนักเรียน" name="user" maxlength="10" required>
        <label for="password">รหัสผ่าน</label>
        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" maxlength="15" required><br>
        <div class="text-center"><input type="submit" class="btn btn-primary" value="ลงชื่อเข้าใช้งาน"></div>
      </form>
    </div>
  </div>
  <?php
    }
  ?>

  <!--Register Form-->
  <?php
      if (isset($_GET['q']) && $_GET['q'] == 'register'){
  ?>
  <div class="container">
    <div class="content">
      <h3>ลงทะเบียนเข้าใช้งาน</h3><br>
      <form action="app.php?func=register" method="POST" enctype="multipart/form-data">
        <label for="user">รหัสนักเรียน</label>
        <input type="text" class="form-control" placeholder="รหัสนักเรียน" name="user" required>
        <div class="row g-2">
          <div class="col">
            <label for="fname">ชื่อ</label>
            <input type="text" class="form-control" placeholder="ชื่อ" name="fname" maxlength="30" required>
          </div>
          <div class="col">
            <label for="lname">นามสกุล</label>
            <input type="text" class="form-control" placeholder="นามสกุล" name="lname" maxlength="30" required>
          </div>
        </div>
        <label for="class">ห้องเรียน</label>
        <input type="text" class="form-control" placeholder="ชั้นมัธยมศึกษาปีที่ ตัวอย่าง 6/6" name="class"
          maxlength="5">
        <label for="no">เลขที่</label>
        <input type="text" class="form-control" placeholder="เลขที่" name="no" maxlength="2"
          >
        <label for="dob">วัน/เดือน/ปี เกิด</label>
        <input type="date" class="form-control" name="dob" required>
        <label for="address1">ที่อยู่</label>
        <input type="text" class="form-control" name="address1" placeholder="ที่อยู่ 1" required>
        <input type="text" class="form-control" name="address2" placeholder="ที่อยู่ 2 (ไม่บังคับ)" style="margin-top: 10px;"><br>
        <script type='text/javascript'>
          function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
              var output = document.getElementById('showimg');
              output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
          }
        </script>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript">
          $(document).ready(function () {
            $('#myFile').bind('change', function () {
              if (this.files[0].size > 2 * 1024 * 1024) {
                alert('ขนาดภาพเกิน 2 MB, โปรดใช้ภาพอื่น');
                document.getElementById('myFile').value = '';
                return false;
              }
            });
          });
        </script>
        <p class="text-center"><img id="showimg" src="./pictures/exam.jpg" width="300" height="400" onerror="this.src='./pictures/exam.jpg'"></p>
        <label for="img">รูปถ่ายนักเรียนแนวตั้ง (.jpg & ขนาดน้อยกว่า 2MB)</label><br>
        <input type="file" id="myFile" name="img" id="" accept=".jpg" required onchange="preview_image(event)"><br>
        <label for="pass">รหัสผ่าน</label>
        <input type="password" class="form-control" placeholder="รหัสผ่าน" name="pass" maxlength="15" required>
        <label for="repass">ยืนยันรหัสผ่าน</label>
        <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="repass" maxlength="15" required><br>
        <div class="text-center"><input type="submit" class="btn btn-success" value="ลงทะเบียน"></div>
      </form>
    </div>
  </div>
  <?php
      }
  ?>

  <br><br>
  <script src="./js/bootstrap.bundle.js"></script>
</body>

</html>