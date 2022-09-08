<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gleam Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/vendors/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="shortcut icon" style="object-fit: cover;" href="./assets/images/favicon.png" type="image/x-icon">
</head>

<body>
    <?php 
                include('./navbar.php')
            ?>
    <div class="container-fluid p-0">

        <header class="foi-header-cnt landing-header-uk"
            style="max-width: 100% !important; overflow-x: hidden; min-height:85vh">
            <div class="container">
                <!-- >#2388C2; -->
                <div class="header-content-cnt" style="margin-top:150px">
                    <div class="row">
                        <div class="col-md-7 order-2 order-sm-1" data-aos="fade-right" data-aos-duration="1000">
                            <h1 style="color:#574240; line-height:4rem;">Your Dream Country is UK?</h1>
                            <h3 style="color:#141313; line-height:4rem;">Get support for your education in UK by
                                India's top Counsellors.
                            </h3>
                            <p class="text-dark"></p>
                            <!-- <button class="btn mb-4" style="background-color:#FF3859;  color: white;">Get Started</button> -->
                            <button class="btn nav-items get_started" data-bs-toggle="modal"
                                data-bs-target="#schedule_meet_">Get Instant Councelling</button>

                        </div>

                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="container-fluid cnt-counselling">
        <div class="container " style=" margin-top:90px;box-shadow: 1px 1px 9px 3px rgba(0,0,0,0.08);">
            <div class="row ">

                <div class="col-8 offset-2">
                    <h3 class="text-center mt-5 mb-5">Everything you need for your UK dream</h3>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-10 offset-1">
                        <div class="row">
                            <div class="col-12 col-md-6 text-start">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-1 pt-1"><img src="./assets/images/Career Counselling Icon.png"
                                                width="25px"></div>
                                        <div class="col-10">
                                            <span class="h_2">Career Assistance</span>
                                            <p class="">India’s best counsellors with you, all the way.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-1 pt-1"><img src="./assets/images/Visa Icon.png" width="25px">
                                        </div>
                                        <div class="col-10">
                                            <span class="h_2">Visa Assistance</span>
                                            <p class="">Our visa counsellors have a 98% success rate.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 text-start">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-1 pt-1"><img src="./assets/images/Education loan Icon.png"
                                                width="25px"></div>
                                        <div class="col-10">
                                            <span class="h_2">Financing Help</span>
                                            <p class="">Loans and scholarships assistance.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-1 pt-1"><img src="./assets/images/Travel assist Icon.png"
                                                width="25px"></div>
                                        <div class="col-10">
                                            <span class="h_2">Travel Assistance</span>
                                            <p class="">Our visa counsellors have a 98% success rate.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center pb-4">
                    <a class="btn nav-items mt-3 get_started" style="color:#ffffff; border-radius: 24px;"
                        data-bs-toggle="modal" data-bs-target="#schedule_meet_">Get Free Counselling</a>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-5 bgcolor-5" style="margin: 100px 0px;">
        <div class="container horizontal-row-part mt-5 ">
            <div class="row">
                <div class="col-12  mt-5">
                    <div class="px-sm-5 text-sm-center" style="color: #242020; align-items: center;">
                        <h2 class="text-sm-center exp_gleam"
                            style="display: inline; align-items: center !important; align-self: center !important;">
                            Start Your Journey With Gleam Education! &nbsp; &nbsp;</h2>

                        <button type="button" class="btn get_started" id="requestbtn"
                            style="color:#ffffff; border-radius:24px;" data-bs-toggle="modal"
                            data-bs-target="#schedule_meet_">
                            &nbsp; Start Now &nbsp;
                        </button>
                    </div>
                    <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title text-center" id="details">Log In</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- form -->
                                <form action="./backend/request_session.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group" style="padding: 1rem; ">
                                            <label for="name_req_session">Name</label>
                                            <input type="text" class="form-control" name="name_req_session" id="name"
                                                placeholder="Your name">
                                        </div>
                                        <div class="form-group" style="padding: 1rem; color: #323B40;">
                                            <label for="email_req_session">Email address</label>
                                            <input type="email" required class="form-control" name="email_req_session"
                                                id="email1" aria-describedby="emailHelp" placeholder="Enter email">
                                            <!-- <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small> -->
                                        </div>

                                        <div class="form-group" style="padding: 1rem;">
                                            <label for="contact_req_session">Contact No.</label>
                                            <input type="text" class="form-control" name="contact_req_session"
                                                id="password2" placeholder="Contact no.">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="message">HOW CAN WE HELP YOU? <sup>*</sup></label>
                                            <textarea name="message" id="message" class="form-control" rows="7"
                                                placeholder="Your message ..."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button class="btn btn-info"><a href="./login.php"
                                                style="text-decoration: none; color: white;">Sign
                                                Up</a></button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="page-about">
        <div class="container" style="overflow: hidden;">

            <section class="foi-page-section pt-0">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0 pr-lg-0 order-2 order-md-1" data-aos="fade-right">
                        <div class="container-fluid">
                            <div class="container cnt-reason-aus">
                                <div class="col-8 offset-2">
                                    <h4>Why study in UK?</h4>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-1 offset-2">
                                        <i class="fa fa-check-circle" style="color:#D11D27"></i>
                                    </div>
                                    <div class="col-7">
                                        <p class="" style="display: inline;"><b>Best academic standards in the world</b></p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-1 offset-2">
                                        <i class="fa fa-check-circle" style="color:#D11D27"></i>
                                    </div>
                                    <div class="col-7">
                                        <p class="" style="display: inline;"><b>Short and Concise courses</b></p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-1 offset-2">
                                        <i class="fa fa-check-circle" style="color:#D11D27"></i>
                                    </div>
                                    <div class="col-7">
                                        <p class="" style="display: inline;"><b>Best Part time job culture</b></p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-1 offset-2">
                                        <i class="fa fa-check-circle" style="color:#D11D27"></i>
                                    </div>
                                    <div class="col-7">
                                        <p class="" style="display: inline;"><b>Well established connectivity with Europe</b></p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-1 offset-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-7 pb-5 pt-2 offset-1">
                                        <!-- <a href="" style="display: inline; text-decoration: none;">Know More</a> -->
                                        <a class="btn brochure" href="./assets/brochure/IPL_2022_Schedule.pdf"
                                            download="australia_brochure">Download Brochure</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-lg-0 d-flex align-items-lg-top align-items-lg-end order-1 order-md-2 sm-cnt-img"
                        data-aos="fade-left">
                        <img src="assets/images/uk.jpg" alt="about" class="img-fluid" width="80%"
                            style=" margin-left:15%; margin-bottom:20px;">
                    </div>
                </div>
            </section>


            <section class="foi-page-section pt-0 mt-0">
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0" style="align-items: center; align-self: center;">
                        <img src="assets/images/about_img_2.png" data-aos="fade-right" alt="about 2"
                            class="w-100 img-fluid pr-md-5" width="437px">
                    </div>

                    <div class="col-md-6 mb-4 mb-md-0 pr-lg-0 order-2 order-md-1" data-aos="fade-left">
                        <div class="container-fluid">
                            <div class="container cnt-reason-aus">
                                <div class="col-md-12 opacity-animation-cnt1">
                                    <h3 class="about-section-two-title">Application requirement

                                        <!-- <span class="font-weight-normal">solution for you and your business.</span> -->
                                    </h3>
                                    <div class="about-section-two-content">
                                        <h4>Applying for undergraduate study</h4>
                                        <p>If you are an International student and completed your 10+2 (CBSE/ ISC/
                                            Intermediate) you
                                            may qualify for a direct undergraduate year 1 entry this course might last
                                            for 3 years.
                                        </p>
                                    </div>
                                    <div class="about-section-two-content">
                                        <h4>Applying for postgraduate study</h4>
                                        <p>You will usually require at least a 55% in your Bachelors however the entry
                                            requirements
                                            will depend on the course you apply for and where you previously studied.
                                        </p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-1 offset-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-7 pb-5 pt-2 offset-1">
                                        <!-- <a href="" style="display: inline; text-decoration: none;">Know More</a> -->
                                        <a class="btn brochure" href="./assets/brochure/IPL_2022_Schedule.pdf"
                                            download="australia_brochure">Download Brochure</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php
        include('./footer.php');
    ?>

    <?php 
      include('./script.php')
    ?>
    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/popper.js/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>