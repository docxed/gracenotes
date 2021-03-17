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
        <br><br>
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
        <div class="content mx-auto" style="width: 60%;">
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
                    placeholder="ห้องเรียน" maxlength="5" required>
                <label for="no">เลขที่</label>
                <input type="number" class="form-control" name="no" value="<?php echo $rowa['member_no']; ?>"
                    placeholder="เลขที่" min="1" max="99" required>
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
                        class="badge bg-warning"><?php echo $rowc['total']; ?></span></button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">รับรอง <span
                        class="badge bg-success"><?php echo $rowc1['yes']; ?></span></button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">ไม่รับรอง <span
                        class="badge bg-danger"><?php echo $rowc2['no']; ?></span></button>
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
                                    <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?>
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
                                    <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?>
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
                                    <?php echo date("d/m/Y", strtotime($rowq['grace_date'])); ?>
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

        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
</body>

</html>