<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['uid'])){
  header('location: index.php');
}
$uid = $_SESSION['uid'];
$a = "SELECT * FROM members WHERE member_id='$uid'";
$resa = mysqli_query($dbcon, $a);
$rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

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
    <script src="./js/bootstrap.bundle.js"></script>
</head>

<body>
    <!--NavBar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="main.php">
                <img src="./pictures/logo.jpg" alt="" width="40" height="40" class="d-inline-block align-center">
                Gracenotes
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-end" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if (!isset($_GET['q'])){ echo 'active'; } ?>" href="./main.php"><i
                                class="fas fa-home"></i> หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET['q']) && $_GET['q'] == 'grace'){ echo 'active'; } ?>"
                            href="./main.php?q=grace"><i class="fas fa-address-book"></i>
                            บันทึกความดีกิจกรรมเพื่อสังคมและสาธารณะประโยชน์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET['q']) && $_GET['q'] == 'report'){ echo 'active'; } ?>"
                            href="./main.php?q=report"><i class="fas fa-bug"></i> รายงานปัญหา</a>
                    </li>
                    <?php
                    if ($_SESSION['level'] == 'teacher'){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET['q']) && $_GET['q'] == 'admin'){ echo 'active'; } ?> text-danger"
                            href="./main.php?q=admin"><i class="fas fa-asterisk"></i> Admin Panel</a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown dropstart">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="./student/<?php echo $rowa['member_img']; ?>" alt="" style="border-radius: 8px;"
                                width="30" height="35">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?q=mygrace">บันทึกความดีของฉัน</a></li>
                            <li><a class="dropdown-item" href="?q=profile">การตั้งค่า</a></li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li><a class="dropdown-item">
                                    <?php echo $rowa['member_fname'].' '.$rowa['member_lname']; ?>
                                </a></li>
                            <li><a class="dropdown-item" href="app.php?func=logout"><span
                                        class="text-danger">ออกจากระบบ</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br><br>

    <!--Social-->
    <?php
      if (!isset($_GET['q'])){
    ?>
    <div class="container">
        <h3>ความดี ล่าสุด</h3>
        <br>
        <?php
        $q = "SELECT * FROM social ORDER BY social_id DESC";
        $resq = mysqli_query($dbcon, $q);
        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
        ?>

        <div class="card mx-auto col-sm-12 col-md-6 col-lg-5 my-5">
            <div class="card-body">
                <br>
                <p style="font-size: x-large;">
                    <?php echo $rowq['social_detail']; ?>
                </p>
                <br>
            </div>
            <a href="?q=social&g=<?php echo $rowq['social_id']; ?>">
                <img src="grace/<?php echo $rowq['social_img']; ?>" class="rounded card-img-bottom">
            </a>
        </div>

        <?php
      }
    ?>
        <br>
    </div>
    <?php
      }
    ?>

    <!--SocialView-->
    <?php
      if (isset($_GET['q']) && $_GET['q'] == 'social'){
    ?>
    <div class="container">
        <h3>ความดี ล่าสุด</h3>
        <br>
        <?php
        $id = $_GET['g'];
        $q = "SELECT * FROM social WHERE social_id='$id'";
        $resq = mysqli_query($dbcon, $q);
        $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
        ?>

        <div class="card mx-auto col-sm-12 col-md-6 col-lg-6 my-3">
            <div class="card-body">
                <br>
                <p style="font-size: x-large;">
                    <?php echo $rowq['social_detail']; ?>
                </p>
                <p class="text-end"">
                     วันที่ <?php echo date(" d/m/Y", strtotime($rowq['social_timestamp'])); ?> เวลา
                    <?php echo date(" H:i", strtotime($rowq['social_timestamp'])); ?>
                </p>
            </div>
            <a href="./grace/<?php echo $rowq['social_img']; ?>" target="_blank">
                <img src="grace/<?php echo $rowq['social_img']; ?>" class="rounded card-img-bottom">
            </a>
        </div>
        <?php
        $c1 = "SELECT COUNT(status_id) AS c1 FROM status WHERE social_id='$id' AND status_type='like'";
        $resc1 = mysqli_query($dbcon, $c1);
        $rowc1 = mysqli_fetch_array($resc1, MYSQLI_ASSOC);

        $c2 = "SELECT COUNT(status_id) AS c2 FROM status WHERE social_id='$id' AND status_type='love'";
        $resc2 = mysqli_query($dbcon, $c2);
        $rowc2 = mysqli_fetch_array($resc2, MYSQLI_ASSOC);

        $c3 = "SELECT COUNT(status_id) AS c3 FROM status WHERE social_id='$id' AND status_type='sadu'";
        $resc3 = mysqli_query($dbcon, $c3);
        $rowc3 = mysqli_fetch_array($resc3, MYSQLI_ASSOC);

        $c11 = "SELECT COUNT(status_id) AS c11 FROM status WHERE social_id='$id' AND status_type='like' AND member_id='$uid'";
        $resc11 = mysqli_query($dbcon, $c11);
        $rowc11 = mysqli_fetch_array($resc11, MYSQLI_ASSOC);

        $c22 = "SELECT COUNT(status_id) AS c22 FROM status WHERE social_id='$id' AND status_type='love' AND member_id='$uid'";
        $resc22 = mysqli_query($dbcon, $c22);
        $rowc22 = mysqli_fetch_array($resc22, MYSQLI_ASSOC);

        $c33 = "SELECT COUNT(status_id) AS c33 FROM status WHERE social_id='$id' AND status_type='sadu' AND member_id='$uid'";
        $resc33 = mysqli_query($dbcon, $c33);
        $rowc33 = mysqli_fetch_array($resc33, MYSQLI_ASSOC);
        ?>
        <div class="mx-auto text-center col-sm-12 col-md-6 col-lg-6 my-3">
            <?php
            if ($rowc11['c11'] == 1){
            ?>
            <span class="text-primary"><i class="fas fa-lg fa-thumbs-up m-3"></i>
                <?php echo $rowc1['c1']; ?>
            </span>
            <?php
            }else{
            ?>
            <a href="app.php?func=likeadd&type=like&uid=<?php echo $uid; ?>&sid=<?php echo $id; ?>"
                style="text-decoration: none;">
                <span class="text-dark">
                    <i class="fas fa-lg fa-thumbs-up m-3"></i>
            </a>
            <?php echo $rowc1['c1']; ?>
            </span>
            <?php
            }
            ?>

            <?php
            if ($rowc22['c22'] == 1){
            ?>
            <span class="text-danger"><i class="fas fa-lg fa-heart m-3"></i>
                <?php echo $rowc2['c2']; ?>
            </span>
            <?php
            }else{
            ?>
            <a href="app.php?func=likeadd&type=love&uid=<?php echo $uid; ?>&sid=<?php echo $id; ?>"
                style="text-decoration: none;">
                <span class="text-dark">
                    <i class="fas fa-lg fa-heart m-3"></i>
            </a>
            <?php echo $rowc2['c2']; ?>
            </span>
            <?php
            }
            ?>

            <?php
            if ($rowc33['c33'] == 1){
            ?>
            <span class="text-warning"><i class="fas fa-praying-hands m-3"></i>
                <?php echo $rowc3['c3']; ?>
            </span>
            <?php
            }else{
            ?>
            <a href="app.php?func=likeadd&type=sadu&uid=<?php echo $uid; ?>&sid=<?php echo $id; ?>"
                style="text-decoration: none;">
                <span class="text-dark">
                    <i class="fas fa-praying-hands m-3"></i>
            </a>
            <?php echo $rowc3['c3']; ?>
            </span>
            <?php
            }
            ?>

        </div>

        <div class="text-center">
            <form action="app.php?func=commentadd" method="POST" class="row">
                <div class="col-7 ms-auto">
                    <input type="text" class="form-control" required name="comment" placeholder="เขียนความคิดเห็น">
                </div>
                <input type="hidden" name="sid" value="<?php echo $rowq['social_id']; ?>" id="">
                <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="">
                <div class="col-auto me-auto">
                    <input type="submit" class="btn btn-outline-primary" value="ส่ง">
                </div>
            </form>
        </div>
        <?php
        $a = "SELECT * FROM comment WHERE social_id='$id' ORDER BY comment_id DESC";
        $resa = mysqli_query($dbcon, $a);
        while ($rowq = mysqli_fetch_array($resa, MYSQLI_ASSOC)) {
        ?>
        <div class="content mx-auto my-3 col-lg-7 col-md-12 col-sm-12">
            <div class="d-flex">
                <div>
                    <?php echo $rowq['comment_detail']; ?>
                </div>
                <div class="ms-auto">
                    <?php
                    if ($_SESSION['level'] == 'teacher'){
                    ?>
                    <a href="app.php?func=delcomment&g=<?php echo $rowq['comment_id']; ?>&s=<?php echo $id; ?>"><button
                            class="btn btn-sm btn-outline-danger">ลบ</button></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="text-end text-secondary">
                <?php echo $rowq['comment_timestamp']; ?>
            </div>
            <?php
            $sid = $rowq['member_id'];
            $e = "SELECT member_fname, member_lname FROM members WHERE member_id='$sid'";
            $rese = mysqli_query($dbcon, $e);
            $rowe = mysqli_fetch_array($rese, MYSQLI_ASSOC);
            ?>
            <div class="text-end">
                <?php echo $rowe['member_fname'].' '.$rowe['member_lname']; ?>
            </div>
        </div>
        <?php
      }
    ?>

        <br>
    </div>
    <?php
      }
    ?>

    <!--Grace-->
    <?php
      if (isset($_GET['q']) && $_GET['q'] == 'grace'){
    ?>
    <div class="container">
        <p>
            “ความดี” คือการทำให้เกิดผลดีอย่างมีคุณค่าต่อผู้อื่น ต่อส่วนรวม รวมถึงต่อตนเอง ดังนี้<br>
            &nbsp;&nbsp;&nbsp;&nbsp;● ผลดีต่อผู้อื่น โดยเฉพาะที่ไม่จำกัดพวก เหล่า ศาสนา เชื้อชาติ ฯลฯ<br>
            &nbsp;&nbsp;&nbsp;&nbsp;● ผลดีต่อส่วนรวม รวมถึงต่อหมู่คณะ ต่อองค์กร ต่อชุมชน ต่อสังคม ต่อโลก ฯลฯ<br>
            &nbsp;&nbsp;&nbsp;&nbsp;● ผลดีต่อตนเอง ได้แก่การพัฒนาตนเองอย่างเป็นคุณและสร้างสรรค์ รวมถึงการพัฒนาทางกาย
            ทางอารมณ์ ทางความคิด ทางจิตวิญญาณ ทางสติ ปัญญา ความสามารถ ฯลฯ<br>
            “ความดี” เป็นสิ่งที่มีมาในอดีต มีอยู่ในปัจจุบัน และจะมีต่อไปในอนาคต<br>
            “ความดี” คืออุดมการณ์อันสูงส่ง ของสังคมที่พึงปรารถนา<br>
            “ความดี” คือรากฐานอันแน่นลึก ของสังคมอุดมธรรม<br>
            “ความดี” คือแรงขับเคลื่อนอันทรงพลัง ซึ่งจะช่วยให้สังคมเคลื่อนไปในทิศทางที่พึงประสงค์<br>
            “ความดี” คือสายใยอันนุ่มเหนียว ที่ร้อยโยงผู้คนหลากหลายไปสู่ความสันติ ความเจริญ และความสุข ร่วมกัน
        </p>
        <br>
        <h3>ความดีของฉัน ล่าสุด</h3>
        <div class="mx-auto col-lg-6 col-md-8 col-sm-12">
            <?php
        $q = "SELECT * FROM grace WHERE member_id = '$uid' ORDER BY grace_id DESC";
        $resq = mysqli_query($dbcon, $q);
        $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
        ?>
        <?php
        if ($rowq){
        ?>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div><span
                                class="badge <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'bg-secondary'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'bg-danger'; }else{echo 'bg-success';} ?>">
                                <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'รอการรับรอง'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'ไม่รับรอง'; }else{echo 'รับรองแล้ว';} ?>
                            </span></div>
                        <div class="ms-auto"><i class="fas fa-info-circle" data-bs-container="body"
                                data-bs-toggle="popover" data-bs-placement="bottom"
                                data-bs-content="บันทึกเมื่อ <?php echo $rowq['grace_timestamp']?>"></i></div>
                    </div>
                    <span class="text-secondary">
                        <?php echo $rowq['grace_agency']; ?>
                    </span>
                    <p style="font-size: x-large;">
                        <?php echo $rowq['grace_detail']; ?>
                    </p>
                    <p class="text-end"">
                        เป็นเวลา <?php echo date(" H:i", strtotime($rowq['grace_time'])); ?> ชั่วโมง เมื่อวันที่
                        <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?><br>
                        โดย
                        <?php echo $rowa['member_fname'].' '.$rowa['member_lname'] ?>
                    </p>
                </div>
                <a href="grace/<?php echo $rowq['grace_img']; ?>" target="_blank"><img
                        src="grace/<?php echo $rowq['grace_img']; ?>" class="rounded card-img-bottom"></a>
            </div>
            <?php
        }
        ?>
            <br>
        </div>
        <br><br>
        <div class="text-center fixed-bottom">
            <br>
            <a href="./main.php?q=addgrace"><button class="btn btn-lg btn-success"><i class="fas fa-plus-circle"></i>
                    เพิ่มบันทึกความดี</button></a>
            <br><br>
        </div>
    </div>

    <?php
      }
    ?>

    <!--Add Grace-->
    <?php
      if (isset($_GET['q']) && $_GET['q'] == 'addgrace'){
    ?>
    <div class="container">
        <div class="content">
            <h3>เพิ่มบันทึกความดี</h3><br>
            <form action="./app.php?func=addgrace" method="POST" enctype="multipart/form-data">
                <label for="time">จำนวนเวลาที่ทำความดี</label>
                <input type="time" class="form-control" name="time" required>
                <label for="date">วันที่ทำความดี</label>
                <input type="date" class="form-control" name="date" required>
                <div class="form-floating mt-3">
                    <textarea class="form-control" placeholder="รายละเอียดการทำความดี" name="detail"
                        style="height: 80px" id="floatingTextarea" required></textarea>
                    <label for="floatingTextarea">รายละเอียดการทำความดี</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="floatingInput" name="agency"
                        placeholder="หน่วยงานที่ทำความดี" maxlength="50" required>
                    <label for="floatingInput">หน่วยงานที่ทำความดี</label>
                </div>
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
                <p class="text-center"><img id="showimg" src="./pictures/exam2.png" width="400" height="300"
                        class="img-fluid" onerror="this.src='./pictures/exam.jpg'"></p>
                <label for="img">รูปถ่ายความดีแนวนอน (.jpg & ขนาดน้อยกว่า 2MB)</label><br>
                <input type="file" id="myFile" name="img" id="" accept=".jpg" required
                    onchange="preview_image(event)"><br>
                <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                <p class="text-center"><input type="submit" class="btn btn-primary btn-lg" value="บันทึก"></p>
            </form>
        </div>
    </div>
    <?php
      }
    ?>

    <!--Profile-->
    <?php
      if (isset($_GET['q']) && $_GET['q'] == 'profile'){
    ?>
    <div class="container">
        <p class="text-center">
            <a href="./student/<?php echo $rowa['member_img']; ?>" target="_blank"><img
                    src="./student/<?php echo $rowa['member_img']; ?>" class="img-fluid"
                    style="border-radius: 8px; width: 25%;" alt=""></a>
        </p>
        <div class="content mx-auto col-lg-7 col-md-12 col-sm-12">
            <h3>แก้ไขข้อมูลบัญชีผู้ใช้</h3>
            <form action="app.php?func=profile" method="POST">
                <label for="id">รหัสนักเรียน</label>
                <input type="text" class="form-control" name="id" value="<?php echo $rowa['member_user']; ?>" readonly
                    placeholder="รหัสนักเรียน" maxlength="10" required>
                <div class="row g-2">
                    <div class="col">
                        <label for="fname">ชื่อ</label>
                        <input type="text" class="form-control" name="fname"
                            value="<?php echo $rowa['member_fname']; ?>" placeholder="ชื่อ" maxlength="30" required>
                    </div>
                    <div class="col">
                        <label for="lname">นามสกุล</label>
                        <input type="text" class="form-control" name="lname"
                            value="<?php echo $rowa['member_lname']; ?>" placeholder="นามสกุล" maxlength="30" required>
                    </div>
                </div>
                <label for="class">ห้องเรียน</label>
                <input type="text" class="form-control" name="class" value="<?php echo $rowa['member_class']; ?>"
                    placeholder="ห้องเรียน" maxlength="5">
                <label for="no">เลขที่</label>
                <input type="number" class="form-control" name="no" value="<?php echo $rowa['member_no']; ?>"
                    placeholder="เลขที่" maxlength="2">
                <label for="dob">วัน/เดือน/ปี เกิด</label>
                <input type="date" class="form-control" name="dob" value="<?php echo $rowa['member_dob']; ?>"
                    placeholder="วัน/เดือน/ปี เกิด" required>
                <label for="address">ที่อยู่</label>
                <input type="text" class="form-control" name="address" value="<?php echo $rowa['member_address']; ?>"
                    placeholder="ที่อยู่" required>
                <label for="pass">รหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="pass" value="" placeholder="รหัสผ่านใหม่"
                    maxlength="15" required>
                <label for="repass">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="repass" value="" placeholder="ยืนยันรหัสผ่านใหม่"
                    maxlength="15" required>
                <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                <br>
                <p class="text-center"><input type="submit" class="btn btn-info" value="อัปเดต"></p>
            </form>
        </div>
    </div>
    <br><br>
    <?php
      }
    ?>

    <!--Mygrace-->
    <?php
    if (isset($_GET['q']) && $_GET['q'] == 'mygrace'){
    ?>
    <div class="container">
        <h3>บันทึกความดีของ <span class="text-warning">
                <?php echo $rowa['member_fname'].' '.$rowa['member_lname']; ?>
            </span></h3><br>
        <nav>
            <?php
            $c = "SELECT COUNT(grace_id) AS total FROM grace WHERE member_id='$uid'";
            $resc = mysqli_query($dbcon, $c);
            $rowc = mysqli_fetch_array($resc, MYSQLI_ASSOC);

            $c1 = "SELECT COUNT(grace_id) AS yes FROM grace WHERE member_id='$uid' AND grace_check='ผ่าน'";
            $resc1 = mysqli_query($dbcon, $c1);
            $rowc1 = mysqli_fetch_array($resc1, MYSQLI_ASSOC);

            $c2 = "SELECT COUNT(grace_id) AS no FROM grace WHERE member_id='$uid' AND grace_check='ไม่ผ่าน'";
            $resc2 = mysqli_query($dbcon, $c2);
            $rowc2 = mysqli_fetch_array($resc2, MYSQLI_ASSOC);
        ?>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">ทั้งหมด <span
                        class="badge bg-warning">
                        <?php echo $rowc['total']; ?>
                    </span></button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">รับรอง <span
                        class="badge bg-success">
                        <?php echo $rowc1['yes']; ?>
                    </span></button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">ไม่รับรอง <span
                        class="badge bg-danger">
                        <?php echo $rowc2['no']; ?>
                    </span></button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <div class="row">
                    <?php
                        $q = "SELECT * FROM grace WHERE member_id = '$uid' ORDER BY grace_id DESC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card m-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div><span
                                            class="badge <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'bg-secondary'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'bg-danger'; }else{echo 'bg-success';} ?>">
                                            <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'รอการรับรอง'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'ไม่รับรอง'; }else{echo 'รับรองแล้ว';} ?>
                                        </span></div>
                                    <div class="ms-auto"><i class="fas fa-info-circle" data-bs-container="body"
                                            data-bs-toggle="popover" data-bs-placement="bottom"
                                            data-bs-content="บันทึกเมื่อ <?php echo $rowq['grace_timestamp']?>"></i>
                                    </div>
                                </div>
                                <span class="text-secondary">
                                    <?php echo $rowq['grace_agency']; ?>
                                </span>
                                <p class="text-end"">
                                    วันที่
                                    <?php echo date(" d/m/Y", strtotime($rowq['grace_date'])); ?>
                                </p>
                            </div>
                            <a href="./main.php?q=view&g=<?php echo $rowq['grace_id']; ?>"><img
                                    src="grace/<?php echo $rowq['grace_img']; ?>" class="rounded card-img-bottom"></a>
                        </div>
                    </div>
                    <?php
                        } mysqli_free_result($resq); 
                    ?>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <div class="row">
                    <?php
                        $q = "SELECT * FROM grace WHERE member_id = '$uid' AND grace_check='ผ่าน' ORDER BY grace_id DESC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card m-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div><span
                                            class="badge <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'bg-secondary'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'bg-danger'; }else{echo 'bg-success';} ?>">
                                            <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'รอการรับรอง'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'ไม่รับรอง'; }else{echo 'รับรองแล้ว';} ?>
                                        </span></div>
                                    <div class="ms-auto"><i class="fas fa-info-circle" data-bs-container="body"
                                            data-bs-toggle="popover" data-bs-placement="bottom"
                                            data-bs-content="บันทึกเมื่อ <?php echo $rowq['grace_timestamp']?>"></i>
                                    </div>
                                </div>
                                <span class="text-secondary">
                                    <?php echo $rowq['grace_agency']; ?>
                                </span>
                                <p class="text-end"">
                                    วันที่
                                    <?php echo date(" d/m/Y", strtotime($rowq['grace_date'])); ?>
                                </p>
                            </div>
                            <a href="./main.php?q=view&g=<?php echo $rowq['grace_id']; ?>"><img
                                    src="grace/<?php echo $rowq['grace_img']; ?>" class="rounded card-img-bottom"></a>
                        </div>
                    </div>
                    <?php
                        } mysqli_free_result($resq); 
                    ?>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                <div class="row">
                    <?php
                        $q = "SELECT * FROM grace WHERE member_id = '$uid' AND grace_check='ไม่ผ่าน' ORDER BY grace_id DESC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card m-3">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div><span
                                            class="badge <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'bg-secondary'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'bg-danger'; }else{echo 'bg-success';} ?>">
                                            <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'รอการรับรอง'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'ไม่รับรอง'; }else{echo 'รับรองแล้ว';} ?>
                                        </span></div>
                                    <div class="ms-auto"><i class="fas fa-info-circle" data-bs-container="body"
                                            data-bs-toggle="popover" data-bs-placement="bottom"
                                            data-bs-content="บันทึกเมื่อ <?php echo $rowq['grace_timestamp']?>"></i>
                                    </div>
                                </div>
                                <span class="text-secondary">
                                    <?php echo $rowq['grace_agency']; ?>
                                </span>
                                <p class="text-end"">
                                    วันที่
                                    <?php echo date(" d/m/Y", strtotime($rowq['grace_date'])); ?>
                                </p>
                            </div>
                            <a href="./main.php?q=view&g=<?php echo $rowq['grace_id']; ?>"><img
                                    src="grace/<?php echo $rowq['grace_img']; ?>" class="rounded card-img-bottom"></a>
                        </div>
                    </div>
                    <?php
                        } mysqli_free_result($resq); 
                    ?>
                </div>

            </div>
        </div>
        <?php
        }
        ?>

        <!--View-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'view'){
        ?>
        <div class="container">
            <div class="mx-auto col-lg-6 col-md-8 col-sm-12">
                <?php
            $id = $_GET['g'];
            $q = "SELECT * FROM grace WHERE member_id = '$uid' AND grace_id='$id'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
            ?>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div><span
                                    class="badge <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'bg-secondary'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'bg-danger'; }else{echo 'bg-success';} ?>">
                                    <?php if ($rowq['grace_check'] == 'รอการอนุมัติ'){ echo 'รอการรับรอง'; }else if ($rowq['grace_check'] == 'ไม่ผ่าน'){echo 'ไม่รับรอง'; }else{echo 'รับรองแล้ว';} ?>
                                </span></div>
                            <div class="ms-auto"><i class="fas fa-info-circle" data-bs-container="body"
                                    data-bs-toggle="popover" data-bs-placement="bottom"
                                    data-bs-content="บันทึกเมื่อ <?php echo $rowq['grace_timestamp']?>"></i></div>
                        </div>
                        <span class="text-secondary">
                            <?php echo $rowq['grace_agency']; ?>
                        </span>
                        <p style="font-size: x-large;">
                            <?php echo $rowq['grace_detail']; ?>
                        </p>
                        <p class="text-end"">
                            เป็นเวลา <?php echo date(" H:i", strtotime($rowq['grace_time'])); ?> ชั่วโมง เมื่อวันที่
                            <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?><br>
                            โดย
                            <?php echo $rowa['member_fname'].' '.$rowa['member_lname'] ?>
                        </p>
                    </div>
                    <a href="grace/<?php echo $rowq['grace_img']; ?>" target="_blank"><img
                            src="grace/<?php echo $rowq['grace_img']; ?>" class="rounded card-img-bottom"></a>
                </div>
                <br>
            </div>
            <br><br>


        </div>
        <?php
        }
        ?>

        <!--Report-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'report'){
        ?>
        <div class="container">
            <h3>รายงานปัญหา</h3>
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 mx-auto">
                    <form action="./app.php?func=report" method="POST">
                        <label for="head">หัวข้อ</label>
                        <input type="text" class="form-control" placeholder="หัวข้อ" name="head" maxlength="100"
                            required>
                        <label for="body">รายละเอียด</label>
                        <textarea name="body" class="form-control" placeholder="รายะเอียด" cols="30" rows="2"
                            required></textarea>
                        <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                        <br>
                        <p class="text-center"><input type="submit" class="btn btn-warning" value="ส่งรายงาน"></p>
                    </form>
                </div>
            </div>
            <br>
            <h3>กล่องรายงานปัญหา</h3>
            <?php
                $q = "SELECT * FROM report WHERE member_id = '$uid'";
                $resq = mysqli_query($dbcon, $q);
            ?>
            <div class="content">
                <table class="table">
                    <thead>
                        <tr>
                            <td class="col-lg-10">
                                <p class="text-center">หัวข้อ</p>
                            </td>
                            <td class="col-lg-2">
                                <p class="text-center">สถานะ</p>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                            $rid = $rowq['report_id'];
                            $c = "SELECT COUNT(reply_id) AS total FROM report_feedback WHERE report_id='$rid'";
                            $resc = mysqli_query($dbcon, $c);
                            $rowc = mysqli_fetch_array($resc, MYSQLI_ASSOC);
                        ?>
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <a style="text-decoration: none; color: black;"
                                        href="?q=viewreport&g=<?php echo $rowq['report_id']; ?>">
                                        <?php echo $rowq['report_topic']; ?>
                                    </a>
                                    <div class="ms-auto">
                                        <i class="fas fa-info-circle" data-bs-container="body" data-bs-toggle="popover"
                                            data-bs-placement="bottom"
                                            data-bs-content="ส่งเมื่อ <?php echo $rowq['report_timestamp']?>"></i>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-auto">
                                        <span
                                            class="badge <?php if ($rowc['total'] == 0){echo 'bg-secondary';}else{echo 'bg-info';} ?>">
                                            <?php
                                            if ($rowc['total'] == 0){
                                                echo 'ยังไม่มีการตอบรับ';
                                            }else{
                                                echo 'ตอบรับแล้ว';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            } mysqli_free_result($resq); 
                        ?>
                    </tbody>
                </table>
            </div>
            <br><br>


        </div>
        <?php
        }
        ?>

        <!--Report View-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'viewreport'){
        $id = $_GET['g'];
        $q = "SELECT * FROM report WHERE member_id = '$uid' AND report_id='$id'";
        $resq = mysqli_query($dbcon, $q);
        $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
        ?>
        <div class="container">
            <div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
                <div class="content">
                    <h4>
                        <?php echo $rowq['report_topic']; ?>
                    </h4>
                    <p>
                        <?php echo $rowq['report_detail']; ?>
                    </p>
                    <p class="text-end">ส่งเมื่อ
                        <?php echo $rowq['report_timestamp']; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 my-3">
                <h3>กล่องรายงานตอบกลับ</h3>
            </div>
            <?php
            $d = "SELECT * FROM report_feedback WHERE report_id='$id'";
            $resd = mysqli_query($dbcon, $d);
            while ($rowd = mysqli_fetch_array($resd, MYSQLI_ASSOC)) {
            ?>
            <div class="col-lg-9 col-md-12 col-sm-12 mx-auto">
                <div class="content">
                    <h5>
                        <?php echo $rowd['reply_detail']; ?>
                    </h5>
                    <p>ตอบกลับเมื่อ
                        <?php echo $rowd['reply_timestamp']; ?>
                    </p>
                </div>
            </div>
            <br>
            <?php
            }
            ?>
            <br><br>

        </div>
        <?php
        }
        ?>

        <!--Admin-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'admin' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Mgrace-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'mgrace' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <h3>จัดการบันทึกความดี</h3>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msrgrace">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <?php
            $c = "SELECT COUNT(grace_id) AS total FROM grace";
            $resc = mysqli_query($dbcon, $c);
            $rowc = mysqli_fetch_array($resc, MYSQLI_ASSOC);

            $c1 = "SELECT COUNT(grace_id) AS wait FROM grace WHERE grace_check='รอการอนุมัติ'";
            $resc1 = mysqli_query($dbcon, $c1);
            $rowc1 = mysqli_fetch_array($resc1, MYSQLI_ASSOC);

            $c2 = "SELECT COUNT(grace_id) AS checked FROM grace WHERE grace_check!='รอการอนุมัติ'";
            $resc2 = mysqli_query($dbcon, $c2);
            $rowc2 = mysqli_fetch_array($resc2, MYSQLI_ASSOC);
            ?>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">ความดีทั้งหมด <span class="badge bg-light text-dark">
                            <?php echo $rowc['total']; ?>
                        </span> </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">รอการตรวจ <span class="badge bg-light text-dark">
                            <?php echo $rowc1['wait']; ?>
                        </span> </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                        aria-selected="false">ตรวจแล้ว <span class="badge bg-light text-dark">
                            <?php echo $rowc2['checked']; ?>
                        </span> </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">หมายเลขบันทึก</td>
                                <td class="text-center">ผู้บันทึก</td>
                                <td class="text-center">สถานะตรวจ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $q = "SELECT * FROM grace ORDER BY grace_id DESC";
                    $resq = mysqli_query($dbcon, $q);
                    while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                    ?>

                            <tr>
                                <td class="text-center">
                                    <?php echo $rowq['grace_id']; ?>
                                </td>
                                <?php
                            $id_stu = $rowq['member_id'];
                            $m = "SELECT member_fname, member_lname FROM members WHERE member_id='$id_stu'";
                            $resm = mysqli_query($dbcon, $m);
                            $rowm = mysqli_fetch_array($resm, MYSQLI_ASSOC);
                            ?>
                                <td class="text-center">
                                    <?php echo $rowm['member_fname'].' '.$rowm['member_lname']; ?>
                                </td>
                                <td class="text-center">
                                    <a href="?q=mview&g=<?php echo $rowq['grace_id']; ?>">
                                        <?php
                                if ($rowq['grace_check'] == 'รอการอนุมัติ'){
                                    echo "
                                    <span class='badge bg-secondary'>รอการตรวจ</span>
                                    ";
                                }else{
                                    echo "
                                    <span class='badge bg-success'>ตรวจแล้ว</span>
                                    ";
                                    }
                                    ?>
                                    </a>
                                </td>
                            </tr>

                            <?php
                    }
                    ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">หมายเลขบันทึก</td>
                                <td class="text-center">ผู้บันทึก</td>
                                <td class="text-center">สถานะตรวจ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $q = "SELECT * FROM grace WHERE grace_check='รอการอนุมัติ' ORDER BY grace_id DESC";
                    $resq = mysqli_query($dbcon, $q);
                    while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                    ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $rowq['grace_id']; ?>
                                </td>
                                <?php
                            $id_stu = $rowq['member_id'];
                            $m = "SELECT member_fname, member_lname FROM members WHERE member_id='$id_stu'";
                            $resm = mysqli_query($dbcon, $m);
                            $rowm = mysqli_fetch_array($resm, MYSQLI_ASSOC);
                            ?>
                                <td class="text-center">
                                    <?php echo $rowm['member_fname'].' '.$rowm['member_lname']; ?>
                                </td>
                                <td class="text-center">
                                    <a href="?q=mview&g=<?php echo $rowq['grace_id']; ?>">
                                        <?php
                                if ($rowq['grace_check'] == 'รอการอนุมัติ'){
                                    echo "
                                    <span class='badge bg-secondary'>รอการตรวจ</span>
                                    ";
                                }else{
                                    echo "
                                    <span class='badge bg-success'>ตรวจแล้ว</span>
                                    ";
                                    }
                                    ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                    }
                    ?>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">หมายเลขบันทึก</td>
                                <td class="text-center">ผู้บันทึก</td>
                                <td class="text-center">สถานะตรวจ</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $q = "SELECT * FROM grace WHERE grace_check!='รอการอนุมัติ' ORDER BY grace_id DESC";
                    $resq = mysqli_query($dbcon, $q);
                    while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                    ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $rowq['grace_id']; ?>
                                </td>
                                <?php
                            $id_stu = $rowq['member_id'];
                            $m = "SELECT member_fname, member_lname FROM members WHERE member_id='$id_stu'";
                            $resm = mysqli_query($dbcon, $m);
                            $rowm = mysqli_fetch_array($resm, MYSQLI_ASSOC);
                            ?>
                                <td class="text-center">
                                    <?php echo $rowm['member_fname'].' '.$rowm['member_lname']; ?>
                                </td>
                                <td class="text-center">
                                    <a href="?q=mview&g=<?php echo $rowq['grace_id']; ?>">
                                        <?php
                                if ($rowq['grace_check'] == 'รอการอนุมัติ'){
                                    echo "
                                    <span class='badge bg-secondary'>รอการตรวจ</span>
                                    ";
                                }else{
                                    echo "
                                    <span class='badge bg-success'>ตรวจแล้ว</span>
                                    ";
                                    }
                                    ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                    }
                    ?>
                        </tbody>
                    </table>

                </div>
            </div>


            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Msrgrace-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msrgrace' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msrgrace">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <h3>ผลการค้นหา: <span class="text-primary">
                    <?php echo $_GET['key']; ?>
                </span></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลขบันทึก</td>
                        <td class="text-center">ผู้บันทึก</td>
                        <td class="text-center">สถานะตรวจ</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $key = '%'.$_GET['key'].'%';
            $q = "SELECT * FROM grace
            JOIN members
            USING (member_id)
            WHERE members.member_fname LIKE '$key'
            OR members.member_lname LIKE '$key'
            OR grace_id LIKE '$key'
            ORDER BY grace_id DESC";
            $resq = mysqli_query($dbcon, $q);
            while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
            ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['grace_id']; ?>
                        </td>
                        <?php
                    $id_stu = $rowq['member_id'];
                    $m = "SELECT member_fname, member_lname FROM members WHERE member_id='$id_stu'";
                    $resm = mysqli_query($dbcon, $m);
                    $rowm = mysqli_fetch_array($resm, MYSQLI_ASSOC);
                    ?>
                        <td class="text-center">
                            <?php echo $rowm['member_fname'].' '.$rowm['member_lname']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=mview&g=<?php echo $rowq['grace_id']; ?>">
                                <?php
                        if ($rowq['grace_check'] == 'รอการอนุมัติ'){
                            echo "
                            <span class='badge bg-secondary'>รอการตรวจ</span>
                            ";
                        }else{
                            echo "
                            <span class='badge bg-success'>ตรวจแล้ว</span>
                            ";
                            }
                            ?>
                            </a>
                        </td>
                    </tr>
                    <?php
            }
            ?>
                </tbody>
            </table>

            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Mview-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'mview' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <?php
            $id = $_GET['g'];
            $q = "SELECT * FROM grace WHERE grace_id='$id'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);

            $uid = $rowq['member_id'];

            $a = "SELECT * FROM members WHERE member_id='$uid'";
            $resa = mysqli_query($dbcon, $a);
            $rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC);
            ?>
            <h3 class="text-center">หมายเลขบันทึก
                <span class="text-primary">
                    <?php echo $rowq['grace_id']; ?>
                </span>
            </h3><br>
            <div class="col-lg-5 col-md-12 col-sm-12 mx-auto">
                <a href="./grace/<?php echo $rowq['grace_img']; ?>" target="_blank">
                    <img src="./grace/<?php echo $rowq['grace_img']; ?>" alt="" class="img-fluid rounded">
                </a>
            </div>
            <br>
            <div class="content mx-auto col-lg-8 col-md-12 col-sm-12">
                <div class="text-secondary">
                    <?php echo $rowq['grace_agency']; ?>
                </div>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $rowq['grace_detail']; ?>
                </p>
                <p class="text-end"">
                    เป็นเวลา <?php echo date(" H:i", strtotime($rowq['grace_time'])); ?> ชั่วโมง เมื่อวันที่
                    <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?><br>
                    โดย
                    <a href="?q=mprofile&g=<?php echo $rowa['member_id']; ?>" style="text-decoration: none;">
                        <?php echo $rowa['member_fname'].' '.$rowa['member_lname'] ?>
                    </a>
                </p>
                <div class="text-center text-secondary">บันทึกเมื่อ
                    <?php echo $rowq['grace_timestamp']; ?>
                </div>
                <br>
                <form action="app.php?func=checking" method="POST" class="">
                    <select name="status" id="" class="form-control" required>
                        <option value="ผ่าน" <?php if ($rowq['grace_check']=='ผ่าน' ){ echo 'selected' ; } ?>>ผ่าน
                        </option>
                        <option value="ไม่ผ่าน" <?php if ($rowq['grace_check']=='ไม่ผ่าน' ){ echo 'selected' ; } ?>
                            >ไม่ผ่าน</option>
                        <option value="รอการอนุมัติ" <?php if ($rowq['grace_check']=='รอการอนุมัติ' ){ echo 'selected' ;
                            } ?>>รอการตรวจ</option>
                    </select>
                    <input type="hidden" name="uid" id="" value="<?php echo $rowq['grace_id']; ?>">
                    <p class="text-center my-3"><input type="submit" class="btn btn-info" value="อัปเดต"></p>
                </form>

                <p class="text-end">
                    <a href="app.php?func=delmgrace&g=<?php echo $rowq['grace_id']; ?>"> <button
                            class="btn btn-outline-danger">ลบ</button> </a>
                    <a href="?q=msocialadd&g=<?php echo $rowq['grace_id']; ?>"> <button
                            class="btn btn-success">เผยแพร่</button> </a>
                </p>
            </div>
            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Msocial-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msocialadd' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <?php
            $id = $_GET['g'];
            $q = "SELECT * FROM grace WHERE grace_id='$id'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);

            $sid = $rowq['member_id'];
            $a = "SELECT * FROM members WHERE member_id='$sid'";
            $resa = mysqli_query($dbcon, $a);
            $rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC);
            ?>
            <div class="content col-lg-7 col-md-12 col-sm-12 mx-auto">
                <p class="text-center">
                    <a href="./grace/<?php echo $rowq['grace_img']; ?>" target="_blank">
                        <img src="./grace/<?php echo $rowq['grace_img']; ?>" alt="" class="img-fluid rounded">
                    </a>
                </p>
                <div class="text-secondary">
                    <?php echo $rowq['grace_agency']; ?>
                </div>
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo $rowq['grace_detail']; ?>
                </p>
                <p class="text-end"">
                    เป็นเวลา <?php echo date(" H:i", strtotime($rowq['grace_time'])); ?> ชั่วโมง เมื่อวันที่
                    <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?><br>
                    โดย
                    <a href="?q=mprofile&g=<?php echo $rowa['member_id']; ?>" style="text-decoration: none;">
                        <?php echo $rowa['member_fname'].' '.$rowa['member_lname'] ?>
                    </a>
                </p>
                <form action="app.php?func=socialadd" method="POST">
                    <div class="form-floating">
                        <textarea required name="detail" class="form-control" placeholder="เขียนโพสต์"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">เขียนโพสต์</label>
                    </div>
                    <input type="hidden" name="img" value="<?php echo $rowq['grace_img']; ?>" id="">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="">
                    <br>
                    <p class="text-center"><input type="submit" class="btn btn-primary" value="เผยแพร่"></p>
                </form>
            </div>
            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Msocial-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msocial' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msrsocial">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลขโพสต์</td>
                        <td class="text-center">เวลา</td>
                        <td class="text-center">Edit</td>
                        <td class="text-center">View</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
            $q = "SELECT * FROM social ORDER BY social_id DESC"; 
            $resq = mysqli_query($dbcon, $q);
            while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
            ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['social_id']; ?>
                        </td>
                        <td class="text-center">
                            เผยแพร่เมื่อ
                            <?php echo $rowq['social_timestamp']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=msocialedit&g=<?php echo $rowq['social_id']; ?>">
                                <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="?q=social&g=<?php echo $rowq['social_id']; ?>">
                                <button class="btn btn-info"><i class="fas fa-eye"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php
            }
            ?>
                </tbody>
            </table>

            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Msocialedit-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msocialedit' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <?php
            $id = $_GET['g'];
            $q = "SELECT * FROM social WHERE social_id='$id'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
            ?>
            <h3 class="text-center my-3">หมายเลขโพสต์ <span class="text-primary">
                    <?php echo $rowq['social_id']; ?>
                </span></h3>
            <p class="text-center col-lg-6 col-md-12 col-sm-12 mx-auto">
                <a href="./grace/<?php echo $rowq['social_img']; ?>" target="_blank">
                    <img src="./grace/<?php echo $rowq['social_img']; ?>" alt="" class="img-fluid rounded">
                </a>
            </p>
            <div class="content col-lg-7 col-md-12 col-sm-12 mx-auto">
                <form action="app.php?func=editsocial" method="POST">
                    <div class="form-floating">
                        <textarea required name="detail" class="form-control" placeholder="เขียนโพสต์"
                            id="floatingTextarea2"
                            style="height: 100px"><?php echo $rowq['social_detail']; ?></textarea>
                        <label for="floatingTextarea2">เขียนโพสต์</label>
                    </div>
                    <input type="hidden" name="uid" value="<?php echo $rowq['social_id']; ?>">
                    <p class="text-end my-1">เผยแพร่เมื่อ
                        <?php echo $rowq['social_timestamp']; ?>
                    </p>
                    <p class="text-center"><input type="submit" class="btn btn-info" value="อัปเดต"></p>
                </form>
                <p class="text-end">
                    <a href="app.php?func=delsocial&g=<?php echo $rowq['social_id']; ?>">
                        <button class="btn btn-outline-danger">ลบ</button>
                </p>
                </a>
            </div>

            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Msrsocial-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msrsocial' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msrsocial">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <h3>ผลการค้นหา: <span class="text-primary">
                    <?php echo $_GET['key']; ?>
                </span></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลขโพสต์</td>
                        <td class="text-center">เวลา</td>
                        <td class="text-center">Edit</td>
                        <td class="text-center">View</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $key = '%'.$_GET['key'].'%';
                        $q = "SELECT * FROM social
                        WHERE social_id LIKE '$key'
                        ORDER BY social_id DESC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['social_id']; ?>
                        </td>
                        <td class="text-center">
                            เผยแพร่เมื่อ
                            <?php echo $rowq['social_timestamp']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=msocialedit&g=<?php echo $rowq['social_id']; ?>">
                                <button class="btn btn-secondary"><i class="fas fa-edit"></i></button>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="?q=social&g=<?php echo $rowq['social_id']; ?>">
                                <button class="btn btn-info"><i class="fas fa-eye"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Maccount-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'maccount' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>

            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msraccount">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลขบัญชี</td>
                        <td class="text-center">ชื่อ - นามสกุล</td>
                        <td class="text-center">Option</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $q = "SELECT * FROM members ORDER BY member_id ASC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['member_id']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rowq['member_fname'].' '.$rowq['member_lname']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=account&g=<?php echo $rowq['member_id']; ?>">
                                <button class="btn btn-secondary"><i class="fas fa-eye"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>

        <!--Account-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'account' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <?php
            $id = $_GET['g'];
            $a = "SELECT * FROM members WHERE member_id='$id'";
            $resa = mysqli_query($dbcon, $a);
            $rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC);
            ?>
            <p class="text-center">
                <a href="./student/<?php echo $rowa['member_img']; ?>" target="_blank"><img
                        src="./student/<?php echo $rowa['member_img']; ?>" class="img-fluid"
                        style="border-radius: 8px; width: 25%;" alt=""></a>
            </p>
            <div class="content mx-auto col-lg-7 col-md-12 col-sm-12">
                <h3>ผู้ใช้หมายเลข <span class="text-primary">
                        <?php echo $rowa['member_id']; ?>
                    </span></h3>
                <form action="app.php?func=profile" method="POST">
                    <label for="id">รหัสนักเรียน</label>
                    <input type="text" class="form-control" name="id" value="<?php echo $rowa['member_user']; ?>"
                        placeholder="รหัสนักเรียน" maxlength="10" required>
                    <div class="row g-2">
                        <div class="col">
                            <label for="fname">ชื่อ</label>
                            <input type="text" class="form-control" name="fname"
                                value="<?php echo $rowa['member_fname']; ?>" placeholder="ชื่อ" maxlength="30" required>
                        </div>
                        <div class="col">
                            <label for="lname">นามสกุล</label>
                            <input type="text" class="form-control" name="lname"
                                value="<?php echo $rowa['member_lname']; ?>" placeholder="นามสกุล" maxlength="30"
                                required>
                        </div>
                    </div>
                    <label for="class">ห้องเรียน</label>
                    <input type="text" class="form-control" name="class" value="<?php echo $rowa['member_class']; ?>"
                        placeholder="ห้องเรียน" maxlength="5" required>
                    <label for="no">เลขที่</label>
                    <input type="number" class="form-control" name="no" value="<?php echo $rowa['member_no']; ?>"
                        placeholder="เลขที่" min="1" max="99" required>
                    <label for="dob">วัน/เดือน/ปี เกิด</label>
                    <input type="date" class="form-control" name="dob" value="<?php echo $rowa['member_dob']; ?>"
                        placeholder="วัน/เดือน/ปี เกิด" required>
                    <label for="address">ที่อยู่</label>
                    <input type="text" class="form-control" name="address"
                        value="<?php echo $rowa['member_address']; ?>" placeholder="ที่อยู่" required>
                    <br>
                    <?php
                        if ($_GET['g'] != $uid){
                        ?>
                    <p class="text-center">
                        <?php
                        if ($rowa['member_level'] == "teacher"){
                        ?>
                        <a href="app.php?func=teacheradd&g=<?php echo $rowa['member_id']; ?>&v=student">
                            <input type="button" class="btn btn-outline-info" value="ตั้งเป็นบทบาทนักเรียน">
                        </a>
                        <?php
                        }
                        ?>
                        <?php
                        if ($rowa['member_level'] == "student"){
                        ?>
                        <a href="app.php?func=teacheradd&g=<?php echo $rowa['member_id']; ?>&v=teacher">
                            <input type="button" class="btn btn-outline-primary" value="ตั้งเป็นบทบาทครู">
                        </a>
                        <?php
                        }
                        ?>
                        <a href="app.php?func=delaccount&g=<?php echo $rowa['member_id']; ?>">
                            <input type="button" class="btn btn-outline-danger" value="ลบ">
                        </a>
                    </p>
                    <?php
                        }
                        ?>
                </form>
            </div>
            <br><br>
        </div>
        <?php
        }
        ?>

        <!--Msraccount-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msraccount' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>

            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msraccount">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <h3>ผลการค้นหา: <span class="text-primary">
                    <?php echo $_GET['key']; ?>
                </span></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลขบัญชี</td>
                        <td class="text-center">ชื่อ - นามสกุล</td>
                        <td class="text-center">Option</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $key = '%'.$_GET['key'].'%';
                        $q = "SELECT * FROM members
                        WHERE member_fname LIKE '$key'
                        OR member_lname LIKE '$key'
                        OR member_id LIKE '$key'
                        ORDER BY member_id ASC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['member_id']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rowq['member_fname'].' '.$rowq['member_lname']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=account&g=<?php echo $rowq['member_id']; ?>">
                                <button class="btn btn-secondary"><i class="fas fa-eye"></i></button>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>

        <!--Mreport-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'mreport' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>

            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msrreport">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลกระทู้</td>
                        <td class="text-center">หัวข้อ</td>
                        <td class="text-center">สถานะ</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $q = "SELECT * FROM report ORDER BY report_id DESC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['report_id']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rowq['report_topic']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=reply&g=<?php echo $rowq['report_id']; ?>">
                                <?php
                            $id = $rowq['report_id'];
                            $a = "SELECT COUNT(reply_id) AS feedback FROM report_feedback WHERE report_id='$id'";
                            $resa = mysqli_query($dbcon, $a);
                            $rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC);
                            if ($rowa['feedback'] == 0){
                            ?>
                                <span class="badge bg-secondary">รอการตอบกลับ</span>
                                <?php
                            }else{
                            ?>
                                <span class="badge bg-success">ตอบกลับแล้ว</span>
                                <?php
                            }
                            ?>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>

        <!--Msrreport-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'msrreport' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>

            <br><br>
            <form action="main.php" method="GET" class="row my-3">
                <input type="hidden" name="q" value="msrreport">
                <div class="col-auto">
                    <input type="text" class="form-control" placeholder="ค้นหา" name="key" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <h3>ผลการค้นหา: <span class="text-primary">
                    <?php echo $_GET['key']; ?>
                </span></h3>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-center">หมายเลกระทู้</td>
                        <td class="text-center">หัวข้อ</td>
                        <td class="text-center">สถานะ</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $key = '%'.$_GET['key'].'%';
                        $q = "SELECT * FROM report WHERE report_topic LIKE '$key' ORDER BY report_id DESC";
                        $resq = mysqli_query($dbcon, $q);
                        while ($rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC)) {
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $rowq['report_id']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $rowq['report_topic']; ?>
                        </td>
                        <td class="text-center">
                            <a href="?q=reply&g=<?php echo $rowq['report_id']; ?>">
                                <?php
                            $id = $rowq['report_id'];
                            $a = "SELECT COUNT(reply_id) AS feedback FROM report_feedback WHERE report_id='$id'";
                            $resa = mysqli_query($dbcon, $a);
                            $rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC);
                            if ($rowa['feedback'] == 0){
                            ?>
                                <span class="badge bg-secondary">รอการตอบกลับ</span>
                                <?php
                            }else{
                            ?>
                                <span class="badge bg-success">ตอบกลับแล้ว</span>
                                <?php
                            }
                            ?>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        }
        ?>

        <!--Reply-->
        <?php
        if (isset($_GET['q']) && $_GET['q'] == 'reply' && $_SESSION['level'] == 'teacher'){
        ?>
        <div class="container">
            <a href="?q=mgrace"><button class="btn btn-primary m-1">ตรวจบันทึกความดี</button></a>
            <a href="?q=msocial"><button class="btn btn-success m-1">จัดการโพสต์</button></a>
            <a href="?q=maccount"><button class="btn btn-info m-1">จัดการบัญชีนักเรียน</button></a>
            <a href="?q=mreport"><button class="btn btn-warning m-1">จัดการรายงานปัญหา</button></a>
            <br><br>
            <?php
            $id = $_GET['g'];
            $q = "SELECT * FROM report WHERE report_id='$id'";
            $resq = mysqli_query($dbcon, $q);
            $rowq = mysqli_fetch_array($resq, MYSQLI_ASSOC);
            ?>
            <div class="content">
                <p>หมายเลขกระทู้ <span class="text-primary">
                        <?php echo $rowq['report_id']; ?>
                    </span></p>
                <h3>
                    <?php echo $rowq['report_topic']; ?>
                </h3>
                <p>
                    <?php echo $rowq['report_detail']; ?>
                </p>
                <p class="text-end">ส่งเมื่อ
                    <?php echo $rowq['report_timestamp']; ?>
                </p>
            </div>
            <div class="my-3 mx-auto col-lg-6 col-md-12 col-sm-12">
                <form action="app.php?func=replyadd" method="POST">
                    <label for="detail">ตอบกลับ</label>
                    <input type="text" placeholder="ตอบกลับ" class="form-control" required name="detail" id="">
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>" id="">
                    <input type="hidden" name="sid" value="<?php echo $rowq['report_id']; ?>" id="">
                    <p class="text-center my-3"><input type="submit" class="btn btn-primary" value="ตอบ"></p>
                </form>
            </div>
            <?php
            $a = "SELECT * FROM report_feedback WHERE report_id='$id' ORDER BY reply_id DESC";
            $resa = mysqli_query($dbcon, $a);
            while ($rowa = mysqli_fetch_array($resa, MYSQLI_ASSOC)) {
            ?>
            <div class="content">
                <h3>
                    <?php echo $rowa['reply_detail']; ?>
                </h3>
                <p>ตอบกลับเมื่อ
                    <?php echo $rowa['reply_timestamp']; ?>
                </p>
            </div>
            <br>

            <?php
        }
        ?>
        </div>
        <?php
        }
        ?>

        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
</body>

</html>