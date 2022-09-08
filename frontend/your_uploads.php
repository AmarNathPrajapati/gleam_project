<?php 
include("../backend/config.php");
session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location: ./login.php");
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./components/header_links.php"); ?>
    
    <link rel="stylesheet" href="./css/your_uploads.css">
    <title>Your Document</title>
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
                                <h1 class="h2 mb-0 ls-tight">Your Applications</h1>
                            </div>
                        </div>
                       
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <a href="./dashboard.php" class="nav-link">Documents List </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link font-regular active">Your Applications</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Your Applications</h5>
                        </div>

                        <div class="table-responsive" style="padding: 10px 10px;">
                            <table class="table table-hover table-nowrap" id="myTable" 
                            style="padding: 30px 20px  !important; border-bottom:none !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" style="font-size: 16px;">Sno</th>
                                        <th scope="col" style="font-size: 16px;">Document Name</th>
                                        <th scope="col" style="font-size: 16px;">Upload By You</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include("../backend/config.php");
                                        $stmt="SELECT students_upload.file,students_upload.student_id,documents.name,documents.id FROM `students_upload` 
                                        INNER JOIN `documents` ON documents.id=students_upload.document_id WHERE students_upload.student_id=(?)";
                                        $sql=mysqli_prepare($conn, $stmt);
                                        mysqli_stmt_bind_param($sql,"i",$_SESSION['student_id']);
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td style="font-size: 18px;">
                                            <?php echo $sno;?>
                                        </td>

                                        <td style="font-size: 18px;">
                                            <?php echo $row["name"];?>
                                        </td>
                                        <td class="d-flex">
                                            <a type="button" class="btn btn-danger p-2" style="margin-right: 10px;"
                                             href="<?php echo "../documents/students/".$row["file"];?>">View</a>
                                             <form class="col-auto" action="./upload_document.php" 
                                            style="max-width: fit-content;" method="get">
                                                <input type="number" name="doc_id" hidden
                                                    value="<?php echo $row['id']?>">
                                                <button type="submit"
                                                 class="btn btn-danger p-2">
                                                    Edit
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                            $sno++;
                                            }
                                            mysqli_stmt_close($sql);
                                            mysqli_close($conn);
                                        }
                                        
                                    ?>

                                    <!-- <tr>
                                    <td>
                                        <img alt="..." src="https://images.unsplash.com/photo-1608976328267-e673d3ec06ce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar-sm rounded-circle me-2">
                                        <a class="text-heading font-semibold" href="#">
                                            Cody Fisher
                                        </a>
                                    </td>
                                    <td>
                                        Apr 10, 2021
                                    </td>
                                    <td>
                                        <img alt="..." src="https://preview.webpixels.io/web/img/other/logos/logo-5.png" class="avatar avatar-xs rounded-circle me-2">
                                        <a class="text-heading font-semibold" href="#">
                                            Webpixels
                                        </a>
                                    </td>
                                    <td>
                                        $1.500
                                    </td>
                                    <td>
                                        <span class="badge badge-lg badge-dot">
                                            <i class="bg-danger"></i>Canceled
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-neutral">View</a>
                                        <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr> -->
                                </tbody>
                            </table>
                        </div>

                        <!-- <div class="card-footer border-0 py-5">
                            <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                            </div> -->
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include("./components/scripts.php"); ?>

</body>

</html>