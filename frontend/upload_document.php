<?php
require('../backend/config.php');
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location: ./login.php");
}

if($_GET["doc_id"]){
            $stmt="SELECT id FROM `students_upload` WHERE student_id=(?) AND document_id=(?)";
            $sql=mysqli_prepare($conn, $stmt);

            //binding the parameters to prepard statement
           
            mysqli_stmt_bind_param($sql,"ii",$_SESSION["student_id"],$_GET["doc_id"]);
            $result=mysqli_stmt_execute($sql);
            $data= mysqli_stmt_get_result($sql);
            // $row=mysqli_fetch_array($data);
            
            if ($data->num_rows>0){
              
                ?>
<script>
    var confirm = confirm('You have already uploaded the document. If you will upload new document then older one will be deleted.');
    if (confirm == false) {
        window.location.href = './dashboard.php';
    } 
</script>
<?php
mysqli_stmt_close($sql);
            }
            mysqli_close($conn);
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/header_links.php"); ?>
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        * {
            margin: 0%;
            padding: 0%;
            box-sizing: border-box;
        }

        body {
            max-width: 100%;
            overflow: hidden;
        }

        .container {
            width: 90%;
            max-width: 500px;
            margin: 7% auto;
            padding: 20px;
            border: 2px solid black;
            position: relative;
        }

        .form1 {
            max-width: 100%;

        }


    </style>
</head>

<body>


    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <?php include("./components/navbar.php"); ?>


        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight mb-4">File Upload</h1>
                            </div>

                        </div>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <!-- <h3 class="text-center mt-3">Upload File</h3> -->
        
          
            <div class="container " style="position: relative !important;">
                <form action="../backend/students/file_upload.php" method="POST" enctype="multipart/form-data">
                    <p class="my-1">At a time you can upload a single file only
                        other wise only the last submitted file will be
                        uploaded.</p>
                    <input type="hidden" name="document_id" value="<?php echo $_GET['doc_id'];?>">
                    <input type="file" accept=".docs,.docx,.pdf,.png,.jpg,.jpeg" style="max-width: 100%;" name="file">
                    <button type="submit" name="submit" class="btn mt-3 mt-sm-0 text-light" style="background-color: #FF3366;">Upload</button>
                    <br>
                    <p class="my-1 text-danger">Only docs, docx, pdf, png, jpeg, jpg type
                        file formate are supported.</p>
                </form>
               
                <!-- original pen: https://codepen.io/roydigerhund/pen/ZQdbeN  -->
                
                 <!-- NO JS ADDED YET -->
            </div>

        </div>
    </div>

    <?php include("./components/scripts.php"); ?>

    <script>
        $(window).load(function () {
            $('#loading').hide();
        });
    </script>

</body>

</html>