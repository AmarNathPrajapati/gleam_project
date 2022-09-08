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
  <link rel="shortcut icon"
  style="object-fit: cover;" href="./assets/images/favicon.png" type="image/x-icon">
</head>

<body style="max-width: 100%; overflow-x: hidden;">
  <?php
           include('./navbar.php');
			   include('./backend/config.php');
  ?>
  <div>
    <header class="foi-header landing-header index_image_header"
      style="position: relative; max-width: 100% !important; overflow: hidden; ">
      <div class="container" style="overflow: hidden ;">

        <!-- >#2388C2; -->
        <div class="header-content" style="margin-top:150px">
          <div class="row">
            <div class="col-md-7  pl-5 " data-aos="fade-rights" data-aos-duration="1000">
              <h1 style="color:#574240">Want to Study Abroad?</h1>
              <h3 style="color:#141313;">Connect with India`s leading Abroad education advisors</h3>
             <button class="btn nav-items get_started  ml-sm-0 mt-2" style="border-radius:6px;" data-bs-toggle="modal"
                data-bs-target="#schedule_meet_">Get Started</button>
            </div>
            <div class="col-md-5 " data-aos="fade-ups" data-aos-duration="900" id="person-image">
              <!-- <img src="assets/images/brainstorm-meeting-min-removebg-preview.png" alt="app" width="300px" class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;"> -->
            </div>
          </div>
        </div>
        <div class="container img1" style="z-index: -1;">
          <img src="assets/images/brainstorm-meeting-min-removebg-preview.png" alt="app" width="500px" class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;">
        </div>
        <div class="container img2">
          <img src="assets/images/bg_block_1.png" alt="app" width="80px" class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;">

        </div>
        <div class="container img3">
          <img src="assets/images/bg_block_2.png" alt="app" width="140px" class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;">

        </div>
        <div class="container img4">
          <img src="assets/images/bg_block_3.png" alt="app"  class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;">

        </div>
        <div class="container img5">
          <img src="assets/images/bg_block_4.png" alt="app"  class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;">

        </div>
        <div class="container img6">
          <img src="assets/images/bg_block_5.png" alt="app" width="420px" class="img-fluid" style="padding-bottom: 35px; margin-left: 14px;">

        </div>
      </div>
    </header>
  </div>




  <div id="stat container">
    <div class="container-fluid" id="counter">

      <div class="container numIncrease" style="padding-top:100px;">
        <!-- <h2 class="text-center" style="margin-bottom: -30px;">Why Choose Us ?</h2> -->
        <div class="row my-5 text-center justify-content-center stats" data-aos="fade-up">

          <div class="col-6 col-md-2 p-4 text-center justify-content-center ">
            <div class="" id="icon" style="display:grid;place-items:center;  width:100px; border-radius:50%;   box-shadow: 1px 1px 9px 3px rgba(0,0,0,0.07); margin:auto; aspect-ratio:1 !important; background-image: url('./assets/images/Icon\ 2.png'); background-position: 53% 46%; background-size: 101%;" >&nbsp;</div>
            <div class="py-2"><br><span class="counter" style="font: 400 40px Aileron;" data-target="1000"></span><span
              style=" font: 600 40px Aileron;
                     ">+</span> <br> <br><span><b>Happy Students</b></span>
            </div>
          </div>
          <div class="col-6 col-md-2  text-center justify-content-center p-4">
            <div class=" py-2">
              <div class="" id="icon" style="display:grid;place-items:center; width:100px; border-radius:50%;   box-shadow: 1px 1px 9px 3px rgba(0,0,0,0.07); margin:auto; aspect-ratio:1 !important; background-image: url('./assets/images/Icon\ 5.png'); background-position: 50% 48%; background-size: 80%;" >&nbsp;</div><br>
              <span class="counter" style="font: 400 40px Aileron;" data-target="50"></span><span style=" font: 600 40px Aileron;
                     ">+</span>
              <br><br><span><b>Foreign Institutes</b></span>
            </div>
          </div>
          <div class="col-6 col-md-2 p-4 text-center justify-content-center">
            <div class="" id="icon" style="display:grid;place-items:center; width:100px; border-radius:50%;   box-shadow: 1px 1px 9px 3px rgba(0,0,0,0.07); margin:auto; aspect-ratio:1 !important; background-image: url('./assets/images/Icon1.png');  background-size: 100%;" >&nbsp;</div>
            <div class="py-2"><br>
              <span class="counter" style="font: 400 40px Aileron;" data-target="5"></span> <span style=" font: 600 40px Aileron;
                     "></span><br><br> <span><b>Countries</b></span>
            </div>
          </div>
          <div class="col-6 col-md-2 p-4 text-center justify-content-center">
            <div class="" id="icon" style="display:grid;place-items:center; width:100px; border-radius:50%;   box-shadow: 1px 1px 9px 3px rgba(0,0,0,0.07); margin:auto; aspect-ratio:1 !important; background-image: url('./assets/images/Icon\ 3.png'); background-position: 47% 44%; background-size: 100%;" >&nbsp;</div>
            <div class="py-2"><br>
              <span class="counter" style="font: 400 40px Aileron;" data-target="18"></span><span style=" font: 600 40px Aileron;
                     ">+</span> <br><br> <span><b>Year Experience</b></span>
            </div>
          </div>
          <div class="col-6 col-md-2  text-center justify-content-center p-4 pt-3">
            <div class="" id="icon" style="display:grid;place-items:center; width:100px; border-radius:50%;   box-shadow: 1px 1px 9px 3px rgba(0,0,0,0.07); margin:auto; aspect-ratio:1 !important; background-image: url('./assets/images/Icon\ 4.png'); background-position: 50% 44.9%; background-size: 100%;" >&nbsp;</div>
            <div class=" py-2 ">
<br>
              <span style="font: 400 40px Aileron;">4.9</span><span style=" font: 600 40px Aileron;
                     "></span>
              <br><br><span><b>Rating on Google</b></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="py-5 mb-5 bgcolor-2">
    <div class="container">
      <h1 class="text-center">Choose the country, you want to study</h1>
      <p class="text-muted mb-5 text-center"> </p>
      <div class="row" data-aos="fade-up">
        <div class="col-lg-4 mb-4">
          <div class="card pricing-card border-warning ">
            <div class="card-body">
              <h3 class="mb-1">UK</h3>
              <!-- <h3 class="mb-1 text-warning">Free</h3>
                            <p class="payment-period">Per month</p> -->
              <p class="mb-4 overflow_style" style="height: 11rem;">The UK has some world celebrated vacation
                destinations from the Buckingham Palace to the London Eye, from the Transporters bridge to the Big Ben
                it has one the best tourist attraction in the world. 3 of British Universities are on the list of
                world`s top ten Universities.</p>
              <a href="./study-in-uk.php" class="btn btn-outline-warning btn-rounded " >Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card pricing-card border-primary ">
            <div class="card-body">
              <h3>USA</h3>
              <!-- <h3 class="text-primary">$23.00</h3>
                            <p class="payment-period">Per month</p> -->
              <p class="mb-4 overflow_style" style="height: 11rem;">Higher education in the United States includes a
                variety of institutions of higher education. Strong research and funding have helped make the
                Institutions among the most prestigious globally,
                making them attractive to students across the world at UG, PG and research level and also to professors.
              </p>
              <a href="./study-in-usa.php" class="btn btn-outline-primary btn-rounded">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card pricing-card border-danger ">
            <div class="card-body">
              <h3>Canada</h3>
              <!-- <h3 class="text-danger">$40.00</h3>
                            <p class="payment-period">Per month</p> -->
              <p class="mb-4 overflow_style" style="height: 11rem; ">Canada is a diverse and huge nation.
                Topographically, you ought to know this, yet it sits in over the USA, making it perfect for exploring a
                little further. Canada itself is brimming with well-known vacation spots.</p>
              <a href="./study-in-canada.php" class="btn  btn-rounded btn-outline-danger">Get Started</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center" data-aos="fade-up">
        <div class="col-lg-4 mb-4">
          <div class="card pricing-card border-info ">
            <div class="card-body">
              <h3>Australia</h3>
              <!-- <h3 class="text-info">$23.00</h3> -->
              <!-- <p class="payment-period">Per month</p> -->
              <p class="mb-4 overflow_style" style="height: 10rem;">Australia is a nation, and landmass, encompassed by
                the Indian and Pacific seas. Its significant urban communities – Sydney, Brisbane, Melbourne, Perth,
                Adelaide – are waterfront, however its capital, Canberra, is inland and nicknamed the "Bramble Capital."
              </p>
              <a href="./study-in-australia.php" class="btn btn-outline-info btn-rounded">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card pricing-card border-success ">
            <div class="card-body">
              <h3>Malta</h3>
              <!-- <h3 class="text-primary">$23.00</h3>
                              <p class="payment-period">Per month</p> -->
              <p class="mb-4 overflow_style" style="height: 10rem;">Malta is one of the three Baltic countries and a
                member of the European Union. It is recognized as the second greenest country in the worlds, has a multi
                ethnic society (more than 150 ethnics live here).</p>
              <a href="./study-in-malta.php" class="btn btn-outline-success btn-rounded">Get Started</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 mb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0" style="align-items: center; align-self: center;">
          <img src="assets/images/Home Page bulb replace.png" alt="special offers" class="img-fluid" width="420px">
        </div>
        <div class="col-md-6" data-aos="fade-up" data-aos-duration="700">
          <h2 class="section-title">Get everything you need for your eduacation</h2>
          <h4 class="mb-4 mt-4">Our services includes</h4>
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="media landing-feature">
                <div class="col-2 srvs-icon">
                <img src="./assets/images/Career Counselling Icon.png" width="40px">
                </div>
                <div class="col-10">
                <div class="media-body">
                  <h5>Career Counselling</h5>
                  <p>Our trained & experienced team of counselors help students to identify their goals & spirations and accordingly suggest a college & course that perfectly fit in to their career goals. </p>
                </div>
              </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="media landing-feature">
                <div class="col-2 srvs-icon">
                  <img src="./assets/images/Admission Process Icon.png" width="40px">
                  </div>
                  <div class="col-10">
                  <div class="media-body">
                    <h5>Admission Assistance</h5>
                    <p>We ensure that the admission process is hassle-free and we give special attention to each student's application and make sure that their chances to get admitted to a foreign university. </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="media landing-feature">
                <div class="col-2 srvs-icon">
                  <img src="./assets/images/Education loan Icon.png" width="40px">
                  </div>
                  <div class="col-10">
                  <div class="media-body">
                    <h5>Scholarhip Assistance</h5>
                    <p>Our team of experts helps students to obtain scholarships and grants, so that their overseas educational objectives take off without any obstacle.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="media landing-feature">
                <div class="col-2 srvs-icon">
                  <img src="./assets/images/Visa Icon.png" width="40px">
                  </div>
                  <div class="col-10">
                  <div class="media-body">
                    <h5>Visa Assistance</h5>
                    <p> We assist students in the visa process like, filling up applications, making the parents understand the financial outlay and assisting in education loans and also assist students for mock interviews for the visa interviews.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3 text-center">
              <a class="btn nav-items" style="background-color:#F54C72;  color: white; border-radius: 24px;"  href="./features.php">Explore More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-5 pb-5 bgcolor-5">
    <div class="container horizontal-row-part mt-5 ">
      <div class="row">
        <div class="col-12  mt-5">
          <div class="px-sm-5 text-sm-center pl-4 " style="color: #000000; align-items: center;">
            <h2 class="text-sm-center exp_gleam" style="display: inline; align-items: center !important; align-self: center !important;">
              Experience Gleam through a Free Session! &nbsp; &nbsp;</h2>

            <button type="button" class="btn" id="requestbtn" style="background-color: #F54C72; color: white; border-radius:24px;"
              data-bs-toggle="modal" data-bs-target="#schedule_meet_" style="display: grid; place-items: center;">
              Request Session
            </button>
          </div>
          </div>
      </div>
    </div>
  </section>



  <section class="">
    <div class="container videos-box mt-5 px-2 py-1 p-sm-5 ">
      <h1 class="text-center mb-5" style=" padding:10px 4px;   margin: auto;  color: rgb(29, 26, 26); border-radius:24px;">
      <b>Gleam Wall Of Love</b></h1>
      <div class="row mt-4 align-items-center">
        <div class="col-12 col-lg-6">
          <div class="card mb-3 card1 p-3" style="overflow: hidden;" data-aos="fade-up">
            <div class="row g-0">
              <div class="col-md-4 p-4">
                <img src="https://lh3.googleusercontent.com/a-/AOh14GihLSrmjkvENTD7na5RcQ8z85gBnvpDohWS4pgd6Q=s128-c0x00000000-cc-rp-mo" class="img-fluid rounded-circle" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <!-- <h5 class="card-title">Card title</h5> -->
                  <p class="card-text overflow_style" style="max-height: 150px;">My friend recommended me to this consultancy. I am very grateful to the amazing service provided by them. They're highly professional, polite and dedicated to the work. I Thank each and every individual from the consultancy for their guidance, sharing authentic information always and responding to all my queries. They have a great knowledge on abroad studies. They are very patient and always supported me throughout my process. Lastly, Thank you Gleam for making my Student Visa process to UK smooth & successful and without any problems and lastly I recommend this consultancy to each and every student who has a dream of studying abroad.</p>

                  <span class="card-text" style="margin-right: 10px;"><small>Aman Sayed</small></span>
                <!--  <button class="btn rounded-circle play-btn btns1" data-bs-toggle="modal"
                    data-bs-target="#exampleModalv1"
                    src="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                      class="bi bi-play-fill" viewBox="0 0 16 16">
                      <path
                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                    </svg>
                  </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModalv1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                  <iframe class="embed-responsive-item" src="" id="video"
                    allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>




        <div class="col-12 col-lg-6">
          <div class="card mb-3 card2 p-3" style="overflow: hidden;" data-aos="fade-up">
            <div class="row g-0">
              <div class="col-md-4 p-4">
                <img src="https://lh3.googleusercontent.com/a/AATXAJy21WkR7ijuTRGECaxjRT-YRGZrn8jHtkCmiR04=s128-c0x00000000-cc-rp-mo" class="img-fluid rounded-circle" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <!-- <h5 class="card-title">Card title</h5> -->
                  <p class="card-text overflow_style" style="max-height: 150px;">I had great experience with all team members of gleam.They are supportive, experts in their work. They will respond you and clear all doubts. I’m really thankful to them for their support especially Imran sir and Ali sir they helped me a lot and I would recommend this consultancy to everyone who wants to study abroad.</p>

                  <span class="card-text" style="margin-right: 10px;"><small>Madiha Zaffer</small></span>
                <!--  <button class="btn rounded-circle play-btn btns2" data-bs-toggle="modal"
                  data-bs-target="#exampleModalv2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                      class="bi bi-play-fill" viewBox="0 0 16 16">
                      <path
                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                    </svg>
                  </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModalv2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                </button>
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                  <iframe class="embed-responsive-item" src="" id="video2"
                    allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-3">
        <div class="col-12 col-lg-6">
          <div class="card mb-3 card3 p-3" style="overflow: hidden;" data-aos="fade-up">
            <div class="row g-0">
              <div class="col-md-4 p-4">
                <img src="https://lh3.googleusercontent.com/a-/AOh14GgafBlghnUyye0NzqDxN14remcpQXaj5yn0sa3Q=s128-c0x00000000-cc-rp-mo" class="img-fluid rounded-circle" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <!-- <h5 class="card-title">Card title</h5> -->
                  <p class="card-text overflow_style" style="max-height: 150px;">It was a wonderful experience with Gleam Education Service from selecting University to getting Visa. The entire process was hassle free and well organized. My sincere gratitude to the entire team of Gleam for making my dream come true with their efforts.The entire staff is very friendly and accessible highly recommend to everyone who is reading this if you are planning to study abroad then visit Gleam Education Service the way they guide would definitely help and encourage you. This is not a review I'm sharing but my satisfaction and happiness as well.</p>

                  <span class="card-text" style="margin-right: 10px;"><small>Muzammil Ahmed</small></span>
                 <!-- <button class="btn rounded-circle play-btn btns3" data-bs-toggle="modal"
                  data-bs-target="#exampleModalv3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                      class="bi bi-play-fill" viewBox="0 0 16 16">
                      <path
                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                    </svg>
                  </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModalv3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
              </button>
              <!-- 16:9 aspect ratio -->
              <div class="ratio ratio-16x9">
                <iframe class="embed-responsive-item" src="" id="video3"
                allowscriptaccess="always" allow="autoplay"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="col-12 col-lg-6">
          <div class="card mb-3 card4 p-3" style="overflow: hidden;" data-aos="fade-up">
            <div class="row g-0">
              <div class="col-md-4 p-4">
                <img src="https://lh3.googleusercontent.com/a-/AOh14Gg3bbKmSGCVizv6Uo7fbNT0LHdNPK3OGSeVkS2sJA=s128-c0x00000000-cc-rp-mo" class="img-fluid rounded-circle" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <!-- <h5 class="card-title">Card title</h5> -->
                  <p class="card-text overflow_style" style="max-height: 150px;">I applied to Teesside University in Middlesbrough for my MSc in project management January 2022 intake from Gleam Education Services. If anyone of you are trying to fly to the UK or any other country then this will be the best consultancy for you because in our Hyderabad many consultancies are doing as sub agents work which means your profile will then come to the Gleam Education Services only. So, why don't you come directly rather than coming through sub agents & I'm sure you'll get good support from them. Thank you Ali sir, Imran sir & Roseleen ma'am you all worked really hard for our CAS letters.</p>

                  <span class="card-text" style="margin-right: 10px;"><small>Mohammad Bilal</small></span>
                <!--  <button class="btn rounded-circle play-btn btns4" data-bs-toggle="modal"
                  data-bs-target="#exampleModalv4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white"
                      class="bi bi-play-fill" viewBox="0 0 16 16">
                      <path
                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                    </svg>
                  </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="exampleModalv4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
              </button>
              <!-- 16:9 aspect ratio -->
              <div class="ratio ratio-16x9">
                <iframe class="embed-responsive-item" src="" id="video4"
                  allowscriptaccess="always" allow="autoplay"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="mt-2 text-center">
        <a href="testimonials.php" class="text" style="text-decoration: none;">View More</a>
      </div>
    </div>
  </section>

<section class="modal">
  <?php
          $stmt="SELECT post_title,post_description,file,file_type,created_at FROM posts WHERE deleted_at IS NULL AND active=? ORDER BY created_at DESC LIMIT 1";
          $sql=mysqli_prepare($conn, $stmt);
          $active=1;
          mysqli_stmt_bind_param($sql,"i",$active);

          $result=mysqli_stmt_execute($sql);

          if ($result){
                  $data= mysqli_stmt_get_result($sql);
                  $sno=1;
                  while ($row = mysqli_fetch_array($data)){
                      ?>
            <!--          <div class="modal fade bg-transparent p-0"  id="exampleModal55" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                            <div class="modal-dialog modal-dialog-centered bg-transparent p-0">
                              <div class="modal-content bg-transparent border-0 p-0" style="max-width:100%; margin:auto;">
                                <div class="modal-header">
                                  <h5 class="modal-title"></h5>
                                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-0" style="max-width: 100%;" >
                                  <div class="container-fluid p-0">
                                    <div class="row g-6 mb-6 p-0" >
                                    <div class="col-12 mb-3 p-0">
                          <div class="card shadow border-0">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-12 text-center">
                                          <?php
                                              if ($row["file_type"]=="mp4") {
                                                    // $img_path="./documents/posts/".$row["file"];
                                                    // $image_info = getimagesize($img_path);
                                                    // echo "Heloo";
                                                    // print_r($image_info);

                                                  ?>
                                                      <video style="height:auto; width:90%; margin:auto; object-fit:cover;" controls>
                                                          <source src="./documents/posts/<?php //echo $row["file"];?>" type="video/mp4">
                                                      </video>

                                                  <?php
                                              } else {
                                                  $img_path="./documents/posts/".$row["file"];
                                                  $image_info = getimagesize($img_path);

                                                  ?>
                                                      <img src="./documents/posts/<?php //echo $row["file"];?>"
                                                      style="max-width:100%; width:350px; height:auto; margin:auto; object-fit:cover;" alt="img">
                                                  <?php
                                              }

                                          ?>
                                      </div>
                                      <div class="col-12 mt-4 text-center">
                                          <span class="h3 font-bold  d-block mb-2"><?php //echo $row["post_title"];?></span>
                                          <span class="h6 font-semibold text-muted  mb-0">
                                              <?php //echo $row["post_description"];?>
                                          </span>
                                      </div>

                                  </div>
                              </div>
                          </div>
                      </div>
                                    </div>
                                </div>
                              </div>
                            
                            </div>
                        </div>-->



                      <?php
                  }
          }

  ?>
</section>
  <?php
      include('./footer.php')
  ?>
  <script src="assets/vendors/jquery/jquery.min.js"></script>
  <script src="assets/vendors/popper.js/popper.min.js"></script>
  <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

  <script>

    $(document).ready(function () {
      // Gets the video src from the data-src on each button
      var $videoSrc;
      $('.btns1').click(function () {
        // $videoSrc = $(this).data("src");
        $videoSrc = 'https://www.youtube.com/embed/V5he1JXiQbg';
      });
      console.log($videoSrc);
      // when the modal is opened autoplay it
      $('#exampleModalv1').on('shown.bs.modal', function (e) {
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
      })
      // stop playing the youtube video when I close the modal
      $('#exampleModalv1').on('hide.bs.modal', function (e) {
        // a poor man's stop video
        $("#video").attr('src', $videoSrc);
      })
      // document ready
      var $videoSrc2;
      $('.btns2').click(function () {
        $videoSrc2 = 'https://www.youtube.com/embed/V5he1JXiQbg';
      });
      console.log($videoSrc2);
      $('#exampleModalv2').on('shown.bs.modal', function (e) {
        $("#video2").attr('src', $videoSrc2 + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
      })
      $('#exampleModalv2').on('hide.bs.modal', function (e) {
        $("#video2").attr('src', $videoSrc2);
      })
      //video3
      var $videoSrc3;
      $('.btns3').click(function () {
        $videoSrc3 = 'https://www.youtube.com/embed/V5he1JXiQbg';
      });
      console.log($videoSrc3);
      $('#exampleModalv3').on('shown.bs.modal', function (e) {
        $("#video3").attr('src', $videoSrc3 + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
      })
      $('#exampleModalv3').on('hide.bs.modal', function (e) {
        $("#video3").attr('src', $videoSrc3);
      })
      //video4
      var $videoSrc4;
      $('.btns4').click(function () {
        $videoSrc4 = 'https://www.youtube.com/embed/V5he1JXiQbg';
      });
      console.log($videoSrc4);
      $('#exampleModalv4').on('shown.bs.modal', function (e) {
        $("#video4").attr('src', $videoSrc4 + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
      })
      $('#exampleModalv4').on('hide.bs.modal', function (e) {
        $("#video4").attr('src', $videoSrc4);
      })
    });
  </script>

<?php

    if(!isset($_SESSION["home_page_visited"])){
      $_SESSION["home_page_visited"]=1;
    }
    else{
      $_SESSION["home_page_visited"]=1;
    }

    if($_SESSION["home_page_visited"]==1){
      ?>
      <script>
        $('#exampleModal55').modal('show');
       </script>
      <?php
    }
  ?>

  <script>
      // To stop the video when popup closes.
          $('#exampleModal55').modal({
              show: false
          }).on('hidden.bs.modal', function(){

              $(this).find('video')[0].pause();
          });

  </script>
  <!-- <script>
      $(document).ready(function () {
      var $videoSrc3;
      $('.btns3').click(function () {
        $videoSrc3 = 'https://www.youtube.com/embed/V5he1JXiQbg';
      });
      console.log($videoSrc3);
      $('#exampleModalv2').on('shown.bs.modal', function (e) {
        $("#video").attr('src', $videoSrc3 + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
      })
      $('#exampleModalv2').on('hide.bs.modal', function (e) {
        $("#video").attr('src', $videoSrc3);
      })
    });
  </script> -->

  <!-- <script>
      $(document).ready(function () {
    var $videoSrc4;
    $('.btns4').click(function () {
      $videoSrc4 = 'https://www.youtube.com/embed/V5he1JXiQbg';
    });
    console.log($videoSrc4);
    $('#exampleModalv2').on('shown.bs.modal', function (e) {
      $("#video").attr('src', $videoSrc4 + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
    })
    $('#exampleModalv2').on('hide.bs.modal', function (e) {
      $("#video").attr('src', $videoSrc4);
    })
  });
</script> -->



  <script>
    const counters = document.querySelectorAll('.counter');
    const speed = 5; // The lower the slower

    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;

        // Lower inc to slow and higher to slow
        const inc = target / speed;

        // console.log(inc);
        // console.log(count);

        // Check if target is reached
        if (count < target) {
          // Add inc to count and output in counter
          var temp = Math.floor(count + inc);
          counter.innerText = temp;
          // Call function every ms
          setTimeout(updateCount, 400);
        } else {
          counter.innerText = target;
        }
      };

      updateCount();
    });

  </script>


  <?php
      include('./script.php');
    ?>

</body>

</html>
