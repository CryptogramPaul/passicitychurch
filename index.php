<?php
    require_once 'database/connection.php';
    
    if (isset($_COOKIE['customer_id']) ) {
        if ($_COOKIE['user_type'] == "Client"){
            $id = $_COOKIE['customer_id'];

            $sql_user = $conn->prepare("SELECT CONCAT_WS(' ', a.firstname, a.middlename, a.lastname) as name, a.contact_no, a.email_address
                        FROM customer a
                        WHERE a.customer_id = ?");
            $sql_user->execute([$id]);
            $user = $sql_user->fetch();
        }
       
    }
  
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title> St William Parish Online Church Services`</title>
    <link rel="icon" href="images/passi-logo.png" type="image/x-icon">

    <link rel="icon" href="images/passi-logo.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/css/booking.css">


    <!-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="dist/css/booking.css"> -->

</head>
<style>
.custom-modal-width {
    max-width: 800px;
}

.navbar-nav .dropdown-menu {
    margin-top: 10px;
    /* Adjust the value to prevent overlap */
}

#calendar {
    height: 100vh !important;

}

._card {
    height: 100% !important;
    height: 81vh !important;
    /* Ensure the card takes the full height */
}

._card-body {
    /*max-height: calc(100vh - 150px) !important;
    overflow: auto; */
    /* Adjusting for padding/margin if any */
}

@media (max-width: 768px) {

    .fc-today-button {
        display: none !important;
    }

    .fc-prev-button,
    .fc-next-button {

        font-size: 10px;
    }

    .fc-header-toolbar {
        font-size: 10px;
    }

    .fc-toolbar-title {
        font-size: 30px !important;
        margin: 5px !important;
    }

    .fc-dayGridMonth-button,
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button,
    .fc-listWeek-button {
        font-size: 10px;
    }
}
</style>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <!-- <div class="header_top">
        <div class="container-fluid">
          <div class="contact_nav">
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +01 123455678990
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : demo@gmail.com
              </span>
            </a>
          </div>
        </div>
      </div> -->
            <div class="header_bottom ">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container ">
                        <a class="navbar-brand" href="#">
                            <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                            <img src="images/passi-logo.png" height="70px" width="70px">
                            <span class="">
                                <!-- &nbsp;Saint William Parish -->
                            </span>
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" target_id="#home">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" target_id="#menu_calendar">Calendar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" target_id="#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" target_id="#sacraments">Parish Transactions</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link menu-link" target_id="#contact">Contact Us</a>
                                </li> -->

                                <?php
                                   if (!isset($_COOKIE['customer_id'])) {
                                ?>
                                <li class="nav-item">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#login_modal">Login</button>

                                </li>
                                <?php }else{ ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo $user['name'] ?> <i class="fa fa-user-circle"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#sign_up_modal"
                                                onclick="SignUpModal(`<?php echo $_COOKIE['customer_id']?>`, 1)"
                                                href="#">User Profile</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="offcanvas" href="#offcanvasExample"
                                                role="button" aria-controls="offcanvasExample"
                                                onclick="ShowTransactionCanvas()">Transactions</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="Logout()">Logout</a></li>

                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section overlay section" id="home">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="detail-box text-center">
                            <br>
                            <br>
                            <br>
                            <h1>
                                St William Parish Online Church Services
                            </h1>
                            <!-- <h4>Online Appointment</h4> -->
                            <h4 class="text-white">
                                Set online booking for the services of our church.
                            </h4>
                            <a class="menu-link" target_id="#sacraments">
                                Book Here!
                            </a>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-box">
                            <!-- <img src="images/slider-img.png" alt=""> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>
    <!-- service section -->

    <section class="service_section layout_padding section" id="sacraments">
        <div class="container ">
            <div class="heading_container heading_center">
                <h2> PARISH TRANSACTIONS </h2>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="box ">
                        <div class="detail-box">
                            <h5>
                                BAPTISM
                            </h5>
                            <p>
                                Baptism is a Christian sacrament that symbolizes the admission of a person into the
                                Christian community and their belief in Christ.
                            </p>
                            <br>

                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#<?php echo !isset($_COOKIE['customer_id']) ? 'login_modal':'show_baptism' ?>"
                                <?php if (isset($_COOKIE['customer_id'])) { ?> onclick="ShowBaptismModal(null,null,0)"
                                <?php }?>>
                                Set Schedule
                            </a>
                            <br>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#sacramentrate"
                                onclick="ShowSacramentRate('Baptism')">Rates</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box ">
                        <div class="detail-box">
                            <h5>
                                MARRIAGE
                            </h5>
                            <p>
                                Marriage is a legally or culturally recognized union between two people, also known as
                                spouses, that creates rights and obligations.
                            </p>
                            <br>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#<?php echo !isset($_COOKIE['customer_id']) ? 'login_modal':'show_wedding' ?>"
                                <?php if (isset($_COOKIE['customer_id'])) { ?> onclick="ShowWeddingModal(null,null,0)"
                                <?php }?>>
                                Set Schedule
                            </a>
                            <br>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#sacramentrate"
                                onclick="ShowSacramentRate('Wedding')">Rates</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box">
                        <div class="detail-box">
                            <h5>
                                BURIAL
                            </h5>
                            <p>
                                Burial is the act of placing a deceased person's remains in the ground, a tomb, or the
                                water, or exposing them to the element or animals.
                            </p>
                            <br>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#<?php echo !isset($_COOKIE['customer_id']) ? 'login_modal':'show_burial' ?>"
                                <?php if (isset($_COOKIE['customer_id'])) { ?> onclick="ShowBurialModal(null,null,0)"
                                <?php }?>>
                                Set Schedule
                            </a>
                            <br>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#sacramentrate"
                                onclick="ShowSacramentRate('Burial')">Rates</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box">
                        <div class="detail-box">
                            <h5>
                                INTENTIONS
                            </h5>
                            <p>
                                Mass intentions refer to the particular purpose for which a specific Mass is offered.
                                This may be to honor God or thank him for blessings received.
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                            <br>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#<?php echo !isset($_COOKIE['customer_id']) ? 'login_modal':'show_intentions' ?>"
                                <?php if (isset($_COOKIE['customer_id'])) { ?>
                                onclick="ShowIntentionsModal(null,null,0)" <?php }?>>
                                Set Schedule
                            </a>
                            <br>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#sacramentrate"
                                onclick="ShowSacramentRate('Intentions')">Rates</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="about_section layout_padding-bottom section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="detail-box">
                        <h2>
                            ST. WILLIAM PARISH
                        </h2>
                        <p>
                            Founded in 1584, Passi is now a chartered city in the Province of Iloilo. It is authentic
                            that Passi City had the most colorful people in the island, the Pintados. However, the
                            history of the church could be traced back in the early 1600’s but the present church was
                            initiated in 1821-1837. The architectural style is perhaps undistinguished but it might be
                            referred as Baroque.
                        </p>
                        <a href="https://passicity.gov.ph/st-william-san-guillermo/" target="_blank">
                            Read More
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="img-box">
                        <img src="images/church_3.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  <section class="contact_section layout_padding section" id="contact">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Contact Us
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form id="FormContactUs">
                        <div class="form-floating">
                            <input type="text" class="form-control text-black " required id="contact_name"
                                value="<?php echo !isset($_COOKIE['customer_id']) ? '':$user['name'] ?>" placeholder="Name">
                            <label for="name">Name</label>
                        </div>
                        <div class="form-floating">
                            <input type="number" class="form-control text-black" required id="contact_number"
                                value="<?php echo !isset($_COOKIE['customer_id']) ? '':$user['contact_no'] ?>"
                                placeholder="Phone Number">
                            <label for="contact_no">Phone Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control text-black" required id="email_address"
                                value="<?php echo !isset($_COOKIE['customer_id']) ? '':$user['email_address'] ?>"
                                placeholder="name@example.com">
                            <label for="email_address">Email address</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control text-black" required placeholder="Leave a message here"
                                id="message" style="height: 100px"></textarea>
                            <label for="message">Message</label>
                        </div>
                        <div class="d-flex">
                            <button type="button" onclick="SaveContactUs()">
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="map_container">
                        <div class="map">
                            <div id="googleMap" style="width:100%;height:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="calendar_section calendar_padding" id="menu_calendar">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Calendar
                </h2>
            </div>
            <div class="row">
                <div class="col-12" id="LoadCalendarHere">
                    <section class="content" style="overflow: auto;">
                        <div class="card _card">
                            <div class="card-body _card-body p-2" id="calendar">
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="info_section ">
        <div class="container">
            <h4>
                Get In Touch
            </h4>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="info_items">
                        <div class="row">
                            <div class="col-md-4">
                                <a>
                                    <div class="item ">
                                        <div class="img-box ">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </div>
                                        <p>
                                            Saligumba Street, Passi, Philippines
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <!-- <p>5037 Passi City, Iloilo<br>Tel. No. (033)-331 5432 / 09468487235</p> -->
                            <div class="col-md-4">
                                <a>
                                    <div class="item ">
                                        <div class="img-box ">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <p>
                                            (033)-331 5432 / 09468487235
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a>
                                    <div class="item ">
                                        <div class="img-box">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <p>
                                            passicitychurch@gmail.com
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="social-box">
            <h4>
                Follow Us
            </h4>
            <div class="box">
                <a href="">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                </a>
                <a href="">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            </div>
        </div> -->
    </section>
    <form id="SacramentsForm">
        <div class="modal fade" id="show_burial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable custom-modal-width" id="LoadBurialModal">

            </div>
        </div>
    </form>

    <form id="BaptismForm">
        <div class="modal fade" id="show_baptism" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable custom-modal-width" id="LoadBaptismModal">

            </div>
        </div>
    </form>

    <form id="WeddingForm" enctype="multipart/form-data">
        <div class="modal fade" id="show_wedding" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" id="LoadWeddingModal">

            </div>
        </div>
    </form>

    <form id="IntentionsForm" enctype="multipart/form-data">
        <div class="modal fade" id="show_intentions" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" id="LoadIntentionsModal">

            </div>
        </div>
    </form>

    <!-- Sign Up Modal -->
    <form id="signUpForm">
        <div class="modal fade" id="sign_up_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" id="LoadSignUpModal">
            </div>
        </div>
    </form>

    <div class="modal fade" id="sacramentrate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" id="LoadSacramentRate">
        </div>
    </div>

    <div class="modal fade" id="verification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" id="LoadVerificationCode">
        </div>
    </div>

    <!-- TRANSACTIONS -->

    <div class="offcanvas offcanvas-end w-75" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h3 class="offcanvas-title" id="offcanvasExampleLabel">Transactions</h3>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="TranscationBody">

        </div>
    </div>

    <a id="scroll-to-top" href="#top" title="Scroll to Top">↑</a>
    </div>
    <?php include'login/login.php' ?>
    <?php include'login/verification-modal.php' ?>

    <!-- end info_section -->

    <!-- footer section -->
    <!-- <footer class="footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayDateYear"></span> All Rights Reserved By
                <a href="https://html.design/">Free Html Templates</a>
            </p>
        </div>
    </footer> -->
    <!-- footer section -->

    <!-- <script src="js/jquery-3.4.1.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/fullcalendar/main.js"></script>
    <script src="assets/toasts/toasts.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/login.js"></script>
    <script src="js/custom.js"></script>
    <script src="dashboard/script/dashboard.js"></script> -->

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- <script src="plugins/moment/moment.min.js"></script> -->
    <script src="plugins/fullcalendar/main.js"></script>
    <script src="assets/toasts/toasts.js"></script>
    <script src="js/script.js"></script>
    <script src="js/login.js"></script>
    <script src="js/custom.js"></script>
    <script src="dashboard/script/dashboard.js"></script>
</body>

</html>