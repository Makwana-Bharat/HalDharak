<?php
  include_once("./PHP/SessionMgt.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php if(isset($_SESSION['BRAND'])) echo "HalDhar | ".$_SESSION['BRAND'];?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
    td {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="home.php"><span
                        style="font-weight:700;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;color:blueviolet"><img
                            src="assets/images/logo.png" style="width:80px;height:50px" />HalDhar</span></a>

            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0" id="search" value=""
                                placeholder="Search projects" oninput="SearchKhedut()">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="./Avatar.jpg" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">

                                    <?php if(isset($_SESSION['NAME'])) echo $_SESSION['NAME'];?>
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#" onclick="Heading()">
                                <i class="mdi mdi-checkbox-marked me-2 text-primary" id="HeadingIndict"><span
                                        style="font-style:normal; color:rgba(0,0,0,.8);margin-left:10px">Heading
                                    </span></i></a>
                            <a class="dropdown-item" href="#" onclick="SMSStatus()">
                                <i class="mdi mdi-bell-off me-2 text-primary" id="SMSIndict"><span
                                        style="font-style:normal; color:rgba(0,0,0,.8);margin-left:10px">Notify
                                    </span></i></a>
                            <a class="dropdown-item" href="#" onclick="LogOut()">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block" onclick="LogOut()">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="./Avatar.jpg" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span
                                    class="font-weight-bold mb-2"><?php if(isset($_SESSION['NAME'])) echo $_SESSION['NAME'];?></span>
                                <span class="text-secondary text-small">Sheth</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">
                            <span class="menu-title">અનુક્રમણિકા</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item sidebar-actions">
                        <span class="nav-link">
                            <button class="btn btn-block btn-lg btn-gradient-primary mt-4" id="ADDKHEDUT">+ ખેડૂત ઉમેરો
                            </button>
                        </span>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title w-100 d-flex align-items-center">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-home" id="panelIcon"></i>
                            </span>
                            <div class="d-flex" style="width: 60%; cursor: pointer;"><span id="panelName">અનુક્રમણિકા
                                </span><span id="panelKhedut" style="display: none;"> \ ખેડૂત </span><span
                                    id="panelAccount" style="display: none;">\ ખાતાવહી</span>
                                </span></div>
                            <span class="float-end" style="width:40%">
                                <div class="d-flex justify-content-end" style="width: 100%;"><button
                                        class="bg-gradient-success text-white me-2 border rounded-2" id="NewEntry"
                                        style="box-shadow: 2px 2px 5px rgba(0,0,0,.1),inset -2px -2px 3px rgba(0,0,0,.2);padding: 10px; display: none;">
                                        <i class="mdi mdi-plus"></i>
                                        &nbsp; New &nbsp;
                                    </button>
                                    <button class="bg-gradient-primary text-white me-2 border rounded-2" id="Printbtn"
                                        onclick="Print()"
                                        style="box-shadow: 2px 2px 5px rgba(0,0,0,.1),inset -2px -2px 3px rgba(0,0,0,.2);padding: 10px; display: none;">
                                        &nbsp; Print &nbsp;
                                        <i class="mdi mdi-printer"></i>
                                    </button>
                                </div>
                                <form action="" id="FormAddFolder" style="display: none;">
                                    <input type="text" name="" id="MainFolderName"
                                        style="margin: 5px;border: none; height:40px;border-radius:5px;padding-left: 10px;box-shadow: 2px 2px 3px gray,inset -2px -2px 3px rgba(0,0,0,.2);"
                                        placeholder="Folder Name" required>
                                    <button class="bg-gradient-primary text-white me-2 border rounded-2"
                                        style="box-shadow: 2px 2px 5px rgba(0,0,0,.1),inset -2px -2px 3px rgba(0,0,0,.2);padding: 10px;">
                                        <i class="mdi mdi-plus" id="panelIcon"></i>
                                        Add Folder
                                    </button>
                                </form>
                        </h3>
                        <div id="BackUp"
                            class=" btn-gradient-info d-flex justify-content-center align-items-center  rounded-3 position-fixed float-end"
                            style="z-index:100000000;font-size:24px;top:90%;right :10px ;width: 70px; height: 70px;cursor: pointer;">
                            <i class="mdi mdi-google-drive" style="font-size: 30px;"></i>
                        </div>
                    </div>
                    <div class="row" id="Index">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">ખેડૂતમિત્ર</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th> ખેડૂત </th>
                                                    <th> સ્થિતિ </th>
                                                    <th> રકમ </th>
                                                    <th> તારીખ </th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody id="KhedutTable">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--new  Khedut -->
                    <div class="row" style="display: none;" id="ADDFORM">
                        <div class="col-5  grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">ખેડૂત </h4>
                                    <p class="card-description"> નવા ખેડૂતમિત્ર ને ઉમેરો </p>
                                    <form class="forms-sample" id="ADDForm" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="FName">Name</label>
                                            <input type="text" class="form-control" id="FName" placeholder="Name"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="FCity">City</label>
                                            <input type="text" class="form-control" id="FCity" placeholder="Location"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="MNO">Mobile Number</label>
                                            <input type="tel" class="form-control" id="MNO" placeholder="9876543210"
                                                required pattern="[0-9]{10}">
                                        </div>
                                        <button type="submit" id="KhedutAddBtn" class="btn btn-gradient-primary me-2"
                                            name="submitbtn">Add</button>
                                        <button class="btn btn-light" type="reset">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View ખેડૂત -->
                    <div class="row flex-row" style="display: none;" id="ViewKhedut">
                        <div class="col-4  grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <img src="assets/images/faces/face6.jpg"
                                        style="width:150px; border-radius:50%;margin-bottom:20px;" alt="" srcset=""
                                        id="VImage">
                                    <h4 class="card-title" id="VName"></h4>
                                    <p class="card-description" id="VVillage"></p>
                                    <p class="card-description" id="VMNO"></p>
                                    <h4 id="VRupee"></h4>
                                    <div class="d-flex" id="Opbtn">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 flex-wrap d-flex" id="FolderContainer">

                        </div>
                    </div>

                    <!-- ખેડૂત Account -->
                    <div class="row flex-row" style="display: none;" id="ViewKhedutAccount">
                        <div class="col-12 grid-margin">
                            <div class="card" id="invoice">
                                <div class="card-body">
                                    <h3 class="card-title w-100 text-center heading">
                                        <strong><?php if(isset($_SESSION['BRAND'])) echo $_SESSION['BRAND'];?> </strong>
                                    </h3>
                                    <span class="d-flex" id="InvoiceKhedut">
                                        <p class="w-75"><b>ખેડૂત નામ : </b><span id="InvoiceName">રામભાઇ બાબુભાઇ ચૌહાણ
                                            </span></p>
                                        <p class="w-25  d-flex  justify-content-end"><b>ગામ : </b><span
                                                id="InvoiceVillage">ગોરસ</span>
                                        </p>
                                        <p class="w-25  d-flex  justify-content-end"><b>તારીખ : </b><span
                                                id="InvoiceVillage">12/7/2020
                                            </span>
                                        </p>
                                    </span>
                                    <span class="d-flex heading">
                                        <p class="card-description  w-75">જમા</p>
                                        <p class="card-description w-25  d-flex  justify-content-end">ઉધાર</p>
                                    </span>
                                    <div class="d-flex">
                                        <table class="table" style="height:fit-content">
                                            <thead>
                                                <tr>

                                                    <th style="font-weight: bold;">રકમ (₹)</th>
                                                    <th style="font-weight: bold;">તારીખ</th>
                                                    <th
                                                        style="font-weight: bold;width: 30%;border-right: 1px solid gray;text-align:right;">
                                                        વિગત
                                                    </th>
                                                </tr>

                                            </thead>
                                            <tbody id="leftBody">
                                            </tbody>
                                        </table>
                                        <table class="table" style="height:fit-content">
                                            <thead>
                                                <tr>
                                                    <th style=" font-weight: bold;">રકમ (₹)</th>
                                                    <th style="font-weight: bold;">તારીખ</th>
                                                    <th style="font-weight: bold;width: 30%;text-align:right;">વિગત
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="rightBody">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex">
                                        <table class="table" style="height:fit-content">
                                            <thead id="SumRow">
                                                <tr>
                                                    <td id="LeftSum"
                                                        style=" font-weight: bold;border-top: 1px groove gray;border-bottom: 1px groove gray;width:10%">
                                                        0000
                                                    </td>
                                                    <td style="font-weight: bold;"></td>
                                                    <td id="RightSum"
                                                        style="font-weight: bold;border-top: 1px groove gray;border-bottom: 1px groove gray;width:10%">
                                                        0000</td>
                                                    <td style="font-weight: bold;"></td>
                                                </tr>
                                                <tr>
                                                    <td id="GrandLeftSum"
                                                        style=" font-weight: bold;border-top: 1px groove gray;border-bottom: 1px groove gray;width:10%">
                                                        0000
                                                    </td>
                                                    <td style="font-weight: bold;"></td>
                                                    <td id="GrandRightSum"
                                                        style="font-weight: bold;border-top: 1px groove gray;border-bottom: 1px groove gray;width:10%">
                                                        0000</td>
                                                    <td style="font-weight: bold;"></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.all.min.js">
    </script>
    <script src="./assets/js/Main.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
</body>

</html>