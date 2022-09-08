<?php
     // session has started in navbar.php
?>

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
    <link rel="shortcut icon" style="object-fit: cover;" href="./assets/images/favicon.png" type="image/x-icon">
</head>

<body>
    <?php 
                include('./navbar.php')
            ?>
<div class="container-fluid p-0">

    </div>
    <header class="foi-header">
        <div class="container">
           
        </div>
    </header>
    <section class="py-5 mb-5">
        <div class="container">
            <h2 class="text-center pt-5 pb-5 mt-5">Download Documents for countries</h2>
        <?php
            include("./backend/config.php");
         

            $stmt="SELECT id,country_name FROM `countries` WHERE deleted_at is NULL";
            $sql=mysqli_prepare($conn, $stmt);

            $result=mysqli_stmt_execute($sql);
            if ($result){
                    $data= mysqli_stmt_get_result($sql);
                    $sno=1;
                    while ($row = mysqli_fetch_array($data)){

        ?>

                <div class="row " id="<?php echo 'card'.$row['id']; ?>">
                    <div class="col-12 mb-2">
                        <div class="card pricing-card" style="border-top: 5px solid #F42022;" >
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 text-center">
                                    <h3 class="mb-5">Documents for <?php echo ucfirst($row['country_name']); ?></h3>
                                    </div>

                                    <div class="col-12  offset-sm-3 col-sm-3 text-center">
                                    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)  {
                                               ?>
                                                <a href="./frontend/dashboard.php" class="btn btn-rounded btn-danger get_started" 
                                                    style=" color: white; "  style="display: grid; place-items: center;">
                                                    Download
                                                </a> 
                                               <?php
                                    }
                                    else{
                                        ?>
                                        <button type="button" class="btn btn-rounded btn-danger get_started" 
                                            style=" color: white; " data-bs-toggle="modal"
                                                    data-bs-target="#popup" style="display: grid; place-items: center;">
                                                    Download
                                        </button> 
                                        <?php
                                    }  ?>                                 
                                    </div>
                                </div>
                               
                               
                            </div>
                        </div>
                    </div>
                </div>

        <?php
                $sno++;
                }
                mysqli_stmt_close($sql);
                mysqli_close($conn);
             }
            
        ?>

            <!-- <div class="row">
                <div class="col-12 mb-2">
                    <div class="card pricing-card border-primary ">
                        <div class="card-body">
                            <h3 class="mb-5">Documents for USA</h3>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_1</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-primary btn-rounded">Download</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_2</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-primary btn-rounded">Download</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_3</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-primary btn-rounded">Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="card pricing-card border-danger ">
                        <div class="card-body">
                            <h3 class="mb-5">Documents for Canada</h3>
                            
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_1</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-danger btn-rounded">Download</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_2</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-danger btn-rounded">Download</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_3</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-danger btn-rounded">Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="card pricing-card border-info ">
                        <div class="card-body">
                            <h3 class="mb-5">Documents for Australia</h3>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_1</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-info btn-rounded">Download</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_4</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-info btn-rounded">Download</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_4</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-info btn-rounded">Download</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <div class="card pricing-card border-success ">
                        <div class="card-body">
                            <h3 class="mb-5">Documents for Malta</h3>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_1</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-success btn-rounded">Download</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_5</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-success btn-rounded">Download</button>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <h5>Document_5</h5>
                                </div>
                                <div class="col-12 col-sm-3 mb-3 mb-sm-2">
                                    <button class="btn btn-success btn-rounded">Download</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </section>


    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
              <div class="modal-content" >
               
                <div class="modal-header border-bottom-0 d-flex justify-content-center mb-5">
                  <h5 class="modal-title text-center" id="popup"
                    style="" >Login Required</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
        
                </div>
                <!-- form -->
                <div class="d-grid place-items-center">
                <h6  style="margin:auto;">You need to login to download the document</h6>
                </div>
                  <div class="modal-body">
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                      <button class="btn get_started btn-rounded"><a href="./frontend/login.php"
                          style="text-decoration: none; color: white;">LogIn</a></button>
        
                    </div>
                  </div>
              </div>
            </div>
          </div>
    
    <?php
        include('footer.php');
    ?>

    <script src="assets/vendors/jquery/jquery.min.js"></script>
    <script src="assets/vendors/popper.js/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<?php 
      include('./script.php')
?>
</body>

</html>