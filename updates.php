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

    <style>
         .overflow_style2 {
            max-width: 100% !important;
            overflow-x: auto;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style2::-webkit-scrollbar {
            display: none;
        }

        .overflow_style_row{
            max-height:100%;
            overflow-y:auto;

        }
    </style>

</head>

<body>        
  <?php 
                include('./navbar.php');
                include('./backend/config.php');
            ?>
    <div class="container-fluid p-0">

    </div>
    <!-- <header class="foi-header">
        <div class="container">

        </div>
    </header> -->
    <main class="py-6 bg-surface-secondary">
                <div class="container-fluid mt-4">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6 overflow_style_row" >
                        <?php 
                                $stmt="SELECT post_title,post_description,file,file_type FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC";
                                $sql=mysqli_prepare($conn, $stmt);
                                $result=mysqli_stmt_execute($sql);

                                if ($result){
                                        $data= mysqli_stmt_get_result($sql);
                                        $sno=1;
                                        while ($row = mysqli_fetch_array($data)){
                                            ?>
                                            <div class="col-xl-3 col-sm-6 col-12 mb-3">
                                                <div class="card shadow border-0 overflow_style" style="height: 100%; border-radius:12px;">
                                                    <div class="card-body" style="position:relative;">
                                                        <div class="row">
                                                            <div class="col-12 text-center">
                                                               <?php
                                                                    if ($row["file_type"]=="mp4") {
                                                                       ?>
                                                                           <video style="height:200px; width:100%; object-fit:cover;" controls>
                                                                                <source src="./documents/posts/<?php echo $row["file"];?>" type="video/mp4">
                                                                            </video>
                                                                       
                                                                       <?php
                                                                    } else {
                                                                        ?>
                                                                            <img src="./documents/posts/<?php echo $row["file"];?>" style="max-width:100%; height:200px; margin:auto; object-fit:cover;" alt="img">
                                                                        <?php
                                                                    }
                                                                    
                                                               ?>
                                                            </div>
                                                            <div class="col-12 mt-2 text-center">
                                                                <span class="h5 font-bold  d-block mb-2"><?php echo $row["post_title"];?></span>
                                                                <span class="font-semibold text-muted  mb-0">
                                                                    <?php echo $row["post_description"];?>
                                                                </span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php
                                        }
                                }
                        
                        ?>
                    </div>
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
      include('./script.php');
    ?>
</body>

</html>