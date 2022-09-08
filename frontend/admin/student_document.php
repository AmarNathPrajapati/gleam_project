<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ./login.php");
}
include("../../backend/config.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
<?php require('./admin_components/header_links.php'); ?>
    <title>Student Documents</title>
</head>

<body>
<div id="loader" class="center"></div>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <?php require('./admin_components/side_bar.php'); ?>

        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">Student Files</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <!-- <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-pencil"></i>
                                        </span>
                                        <span>Edit</span>
                                    </a>
                                    <a href="#" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <!-- <li class="nav-item ">
                                <a href="./dashboard.php" class="nav-link active">Uploaded By You</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link font-regular">Uploaded By Students</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="#" class="nav-link font-regular">File requests</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                  

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Documents</h5>
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sno</th>
                                        <th>Doc Name</th>
                                        <th>Students Name</th>
                                        <th>Students Phone</th>
                                        <th>Uploaded At</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <?php
                                   
                                        $stmt="SELECT documents.name as d_name,users.name as s_name,users.phone,students_upload.file,students_upload.student_id, students_upload.created_at FROM `students_upload` 
                                        INNER JOIN `documents` 
                                        ON documents.id=students_upload.document_id
                                        INNER JOIN `users` 
                                        ON users.id=students_upload.student_id 
                                        WHERE students_upload.document_id=(?)";
                                        $sql=mysqli_prepare($conn, $stmt);
                                        if (!mysqli_stmt_bind_param($sql,"i",$_GET["doc_id"])) {
                                            # code...
                                            echo mysqli_error($conn);
                                        } 
                                        
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $sno;?>
                                        </td>

                                        <td>
                                            <?php echo $row["d_name"];?>
                                        </td>
                                        <td>
                                            <?php echo $row["s_name"];?>
                                        </td>
                                        <td>
                                            <?php echo $row["phone"];?>
                                        </td>
                                        <td>
                                            <?php echo $row["created_at"];?>
                                        </td>
                                        <td>
                                        <a type="button" class="btn btn-neutral p-2" style="font-size: 12px;" 
                                           href='<?php echo "../../documents/students/".$row["file"]; 
                                           ?>'>View Document</a>
                                        </td>

                                        
                                    </tr>
                                    <?php
                                    $sno++;
                                    }
                                    mysqli_stmt_close($sql);
                                    mysqli_close($conn);
                                }
                                
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php require('./admin_components/scripts.php');?>

</body>

</html>