<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons-->
    <link href="{{asset('img/miet.png')}}" rel="icon">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">


</head>


<body>

<!--==========================
  Header
============================-->
<header id="header">
    <div class="container-fluid">

        <div id="logo" class="pull-left">
            <img src='{{asset('img/miet.png')}}' height="50px" width="130px">

        </div>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu-active">
                <li class="menu-has-children"><a href="#">LOGIN</a>
                    <ul>
                        <li><a href="{{Route('user.loginPage')}}">STUDENT</a></li>
                        <li><a href="{{Route('principal.loginPage')}}">DIRECTOR</a></li>
                        <li><a href="{{Route('principal.loginPage')}}">PRINCIPAL</a></li>
                        <li><a href="{{Route('hod.loginPage')}}">HOD</a></li>
                        <li><a href="{{Route('faculty.loginPage')}}">FACULTY</a></li>
                        <li><a href="developer">DEVELOPER</a></li>
                    </ul>
                </li>
                <li><a href="#about">HOME</a></li>
                <li><a href="#contact">GUIDE</a></li>
                <li><a href="#services">ABOUT US</a></li>

            </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->

<!--==========================
  Intro Section
============================-->
<section id="intro">
    <div class="intro-container">
        <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

            <ol class="carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <div class="carousel-item active">
                        <div class="carousel-background"><img src='images/dep1.jpg' alt=""></div>
                        <div class="carousel-container">
                            <div class="carousel-content">
                            </div>
                        </div>
                    </div>
                <div class="carousel-item">
                    <div class="carousel-background"><img src='images/dept2.JPG' alt=""></div>
                    <div class="carousel-container">
                        <div class="carousel-content">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-background"><img src='images/dept4.JPG' alt=""></div>
                    <div class="carousel-container">
                        <div class="carousel-content">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-background"><img src='images/dept3.JPG' alt=""></div>
                    <div class="carousel-container">
                        <div class="carousel-content">
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>


    <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>


</section><!-- #intro -->

<main id="main">

    <!--==========================
      Featured Services Section
    ============================-->

    <!--==========================
     home
    ============================-->
    <section id="about">
        <div class="container">

            <header class="section-header">
                <h3>home</h3>
                <p>
                    <a href="{{Route('important')}}">Click to perform hashing</a>
                    The M.I.E.T society, founded by Er. A.Mohamed Yunus and Alhaj S.M.Hassan Mohamed during the year
                    1984,offers a high quality education in an underdeveloped rural and semi-urban region of
                    Tiruchirapalli, Tamil Nadu. This society runs three educational institutions, M.I.E.T Polytechnic
                    College started in the year 1984, the M.I.E.T Arts and Science College in 1993 and M.I.E.T
                    Engineering College in the year 1998 in a single campus. The society’s members include leading
                    industrialists, educationists and philanthropists.

                    Ever since the inception, the society has grown incredibly and its institutions have made an
                    indelible impression on the lives of students as they passed through the courses in a meritorious
                    manner. Students from the various parts of Tamil Nadu and from various states across the country
                    join in our institutions to build their talent, personality and career. Our colleges based on their
                    excellent educational credentials have even started attracting students from countries outside
                    India. Our academic successes over the years have been established due to ceaseless efforts of the
                    society aided by the faculty of the institutions.

                    The M.I.E.T. Institutions have since its founding concentrated on designing and employing superior
                    standards of teaching to foster effective student learning. We frequently organize co-curricular and
                    extracurricular activities to promote the development of life skills among students community.
                    Prominently, the college has focused on linking Industry, Community, Professional bodies and
                    Technical Institutions with its students to provide them an edge when facing challenging
                    technologies and competition in their academic purists.</p>
            </header>


        </div>
    </section><!-- #about -->

    <!--==========================
      GUIDE Section
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
        <div class="container">

            <div class="section-header">
                <h3>GUIDE</h3>

            </div>

            <div class="row contact-info">

                <div class="col-md-4">
                    <div class="contact-address">
                        <h3>STUDENT</h3>
                        <div style="height:200px; margin-left: 4%;width:320px;border:1px solid darkgray;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                          <pre>
 Student login details ;
 username : EXXXXXXX(Roll Number)
 Password : DD-MM-YYYY (Default)
 Student can change his/her password in their dashboard.
 Studnet has to login with username and password and has to select the
 option Phase I or Phase II (Phase I implies semester starting and Phase II
 implies end of the semester).
 After the selection of phase he/she can select the subject and can submit the feedback
 for each question by select the stars.
 </pre></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-phone">
                        <h3>FACULTY</h3>
                        <div style="height:200px; margin-left: 4%;width:320px;border:1px solid darkgray;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                            <pre>Faculty login details:
  username: EXXXXX (Employee Number)
  password: *******
  Faculty can view the aggregate score of the subjects handled
  for the current semester for phase I and II questionwise.
  Faculty can also view the total count of stars for each question.
                            </pre>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-email">
                        <h3>ADMIN</h3>
                        <div style="height:200px; margin-left: 4%;width:320px;border:1px solid darkgray;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-email" style="margin-left: 50%">
                        <h3 style="margin-left: 70%">PRINCIPAL</h3>
                        <div style="height:200px; margin-left: 4%;width:320px;border:1px solid darkgray;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-email" style="margin-left: 50%">
                        <h3 style="margin-left: 70%">DEVELOPER</h3>
                        <div style="height:200px; margin-left: 4%;width:320px;border:1px solid darkgray;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">

                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>
    <!--==========================
      ABOUT US Section
    ============================-->
    <section id="services">
        <div class="container">

            <header class="section-header wow fadeInUp">
                <h3>about us</h3>

            </header>

            <div class="row">
                The M.I.E.T society, founded by Er. A.Mohamed Yunus and Alhaj S.M.Hassan Mohamed during the year 1984,
                offers a high quality education in an underdeveloped rural and semi-urban region of Tiruchirapalli,
                Tamil Nadu. This society runs three educational institutions, M.I.E.T Polytechnic College started in the
                year 1984, the M.I.E.T Arts and Science College in 1993 and M.I.E.T Engineering College in the year 1998
                in a single campus. The society’s members include leading industrialists, educationists and
                philanthropists. Ever since the inception, the society has grown incredibly and its institutions have
                made an indelible impression on the lives of students as they passed through the courses in a
                meritorious manner. Students from the various parts of Tamil Nadu and from various states across the
                country join in our institutions to build their talent, personality and career. Our colleges based on
                their excellent educational credentials have even started attracting students from countries outside
                India. Our academic successes over the years have been established due to ceaseless efforts of the
                society aided by the faculty of the institutions. The M.I.E.T. Institutions have since its founding
                concentrated on designing and employing superior standards of teaching to foster effective student
                learning. We frequently organize co-curricular and extracurricular activities to promote the development
                of life skills among students community. Prominently, the college has focused on linking Industry,
                Community, Professional bodies and Technical Institutions with its students to provide them an edge when
                facing challenging technologies and competition in their academic purists.
            </div>
        </div>
    </section><!-- #ABOUT US -->

</main>


<!-- JavaScript Libraries -->
<script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('lib/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('lib/easing/easing.min.js')}}"></script>
<script src="{{asset('lib/superfish/hoverIntent.js')}}"></script>
<script src="{{asset('lib/superfish/superfish.min.js')}}"></script>
<script src="{{asset('lib/wow/wow.min.js')}}"></script>
<script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('lib/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
<script src="{{asset('lib/touchSwipe/jquery.touchSwipe.min.js')}}"></script>
<!-- Contact Form JavaScript File -->
<script src="{{asset('contactform/contactform.js')}}"></script>

<!-- Template Main Javascript File -->
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>
