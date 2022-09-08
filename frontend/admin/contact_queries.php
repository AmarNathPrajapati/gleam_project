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
    <title>Contact Queries</title>
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
                                <h1 class="h2 mb-0 ls-tight mb-4">Contact Queries</h1>
                            </div>
                            <!-- Actions -->
                            <!-- <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
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
                                    </a>
                                </div>
                            </div> -->
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
                            <!-- <h5 class="mb-0">Documents</h5> -->
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable" style="border: 0px solid black !important; padding: 30px 2px;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-size: 16px;">Sno</th>
                                        <th style="font-size: 16px;">Name</th>
                                        <th style="font-size: 16px;">Students Email</th>
                                        <th style="font-size: 16px;">Students Phone</th>
                                        <th style="font-size: 16px;">Query</th>
                                        <th style="font-size: 16px;">Page</th>
                                        <th style="font-size: 16px;">Time</th>
                                        <!-- <th style="font-size: 15px;">Activity Type</th> -->
                                    </tr>
                                </thead>
                                <tbody >
                                    <?php
                                    // echo $_GET['document_id12'];
                                   
                                        $stmt="SELECT contact_us.name AS s_name,contact_us.email AS 
                                        s_email,contact_us.phone as s_phone,contact_us.message AS s_message,
                                           contact_us.created_at AS s_created_at,contact_us.flag FROM contact_us 
                                           WHERE contact_us.deleted_at IS NULL
                                       ";
                                        $sql=mysqli_prepare($conn, $stmt);
                                        // if (!mysqli_stmt_bind_param($sql)) {
                                        //     # code...
                                        //     echo mysqli_error($conn);
                                        // } 
                                        $activity_type=2;
                                        // mysqli_stmt_bind_param($sql,'i',$activity_type);
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
                                            <?php echo $row["s_name"];?>
                                        </td>
                                        <td style="font-size: 18px;">
                                            <?php echo $row["s_email"];?>
                                        </td>
                                        <td style="font-size: 18px;">
                                            <?php echo $row["s_phone"];?>
                                        </td>
                                        <td style="font-size: 18px;">
                                            <?php echo $row["s_message"];?>
                                        </td>
                                        <td style="font-size: 18px;">
                                            <?php echo $row["flag"]==0?"Contact Us":"FAQ";?>
                                        </td>
                                        <td style="font-size: 18px;">
                                            <?php echo $row["s_created_at"];?>
                                        </td>
                                    </tr>
                                    <?php
                                    $sno++;
                                    }
                                    mysqli_stmt_close($sql);
                                    mysqli_close($conn);
                                }
                                else{
                                    echo mysqli_error($conn);
                                }
                                
                                ?>

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

    <?php require('./admin_components/scripts.php');?>

</body>

</html>