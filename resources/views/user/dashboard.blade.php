@extends('layouts.user_nav')
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
                   <h2 style="text-shadow: 2px 4px 6px black;">SELECT PHASE</h2>
               </div>
           </div>

       </section>
       <section id="mu-service">
           <div class="container">
               <div class="row">
                   <div class="col-lg-12 col-md-12">

                           <div class="mu-service-single">

                       <div class="mu-service-area">
                           @if(config("buttons.phase_one_button")==="enable")
                               <a href="{{Route('user.phase',["1"])}}">
                                   <button class="button">PHASE 1</button>
                               </a>
                               <h2 style="color: black">SEM INITIAL</h2>
                         @endif
                           </div>


                           <div class="mu-service-single">


                           </div>

                           <div class="mu-service-single">
                               @if(config("buttons.phase_two_button")==="enable")
                               <a href="{{Route('user.phase',["2"])}}">
                                   <button class="button">PHASE 2</button>
                               </a>
                               <h2 style="color: black">SEM FINAL</h2>

                               @endif
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
@endsection

