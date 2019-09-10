@extends('layouts.user_nav.')
<?php
session_start();
include('../dbconfig.php');
include ('User_Class.php');
$user= $_SESSION['user'];
if($user=="")
{header('location:../index.php');}
$user_class=new user_ns\User_Class($conn);
$user_data=$user_class->fetch_user($user);
?>

<?php
@$page= $_GET['page'];
if($page=="phase1"||$page=="phase2") {
    if ($page == "phase1") {
        $_SESSION['phase'] = 1;
        include('feedback.php');
    } elseif ($page == "phase2") {
        $_SESSION['phase'] = 2;
        include('feedback.php');
    }
}
else
{

?>

   <?php
   if ($page == "change_password") {
       echo "<br/><br/><br/><br/>";

       include('change_password.php');
   }
   else {
       ?>
       <!-- End menu -->
@section('content')
       <!-- Start Slider -->
       <section id="mu-slider">
           <!-- Start single slider item -->

           <!-- Start single slider item -->
           <div class="mu-slider-single">
               <div class="mu-slider-img">
                   <figure>
                       <img src="{{asset('vendor/student_dashboard/assets/img/gard.jpg')}}" height="20%">
                   </figure>
               </div>
               <div class="mu-slider-content">
                   <h2 style="text-shadow: 2px 4px 6px black; font-size: ">SELECT PHASE</h2>
               </div>
           </div>

       </section>
       <section id="mu-service">
           <div class="container">
               <div class="row">
                   <div class="col-lg-12 col-md-12">
                       <div class="mu-service-area">
                           <div class="mu-service-single">
                               <a href="dashboard.php?page=phase1">
                                   <button class="button">PHASE 1</button>
                               </a>
                               <h2 style="color: black">SEM INITIAL</h2>
                           </div>

                           <div class="mu-service-single">


                           </div>

                           <div class="mu-service-single">
                               <a href="dashboard.php?page=phase2">
                                   <button class="button">PHASE 2</button>
                               </a>
                               <h2 style="color: black">SEM FINAL</h2>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
       <div class="row"><br/><br/><br/>
           <center>
               <h2>WHY FEEDBACK?</h2></center>
       </div><br/>
           <div class="col-md-6" style="background-color: red">
       <pre>
     <h3><b>1. Feedback is always there</b></h3>
      <h6><b>If you ask someone in your organization when feedback occurs,

they will typically mention an employee survey, performance appraisal,

or training evaluation. In actuality, feedback is around us all the time.</b></h6>
    </pre>
               <pre>
     <h3><b>2. Feedback is a tool for continued learning</b></h3>
      <h6><b>Invest time in asking and learning about how others experience working with

your organization.</b></h6>
    </pre>
               <pre>
     <h3><b>3. Feedback is effective listening</b></h3>
      <h6><b>Whether the feedback is done verbally or via a feedback survey,

the person providing the feedback needs to know they have been understood (or received)

and they need to know that their feedback provides some value.</b></h6>
    </pre>
           </div>
           <div class="col-md-6">
               <img src="{{asset('vendor/student_dashboard/assets/img/rawpixel-651333-unsplash.jpg')}}" height="761px" width="100%"/>
           </div>
       </div>
@endsection
       <?php
   }
        }
        ?>