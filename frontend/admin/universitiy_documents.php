<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ../login.php");
}
include("../../backend/config.php");
$stmt="SELECT name FROM users WHERE id=(?) AND is_admin=(?) LIMIT 1";
$sql=mysqli_prepare($conn, $stmt);

//binding the parameters to prepard statement

$is_admin=1;

mysqli_stmt_bind_param($sql,"ii",$_SESSION["admin_id"],$is_admin);
$result=mysqli_stmt_execute($sql);

if (!empty($result) && isset($result)){
    $data= mysqli_stmt_get_result($sql);
    $user_name=mysqli_fetch_array($data);
    if (empty($user_name)) {
        # code...
        session_destroy();
        ?>
        <script>
            alert("Sorry something went wrong. Please login again.");
            window.location.href="../login.php";
        </script>
        <?php
       
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./admin_components/header_links.php'); ?>
    <title>Universites</title>

    <style>
        .tags {
            list-style: none;
            margin: 0;
            overflow: hidden;
            padding: 0;
        }

        .tags li {
            float: left;
        }

        .tag {
            background: #eee;
            border-radius: 3px 0 0 3px;
            color: #999;
            display: inline-block;
            height: 26px;
            line-height: 26px;
            padding: 0 20px 0 23px;
            position: relative;
            margin: 0 10px 10px 0;
            text-decoration: none;
            -webkit-transition: color 0.2s;

            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style2 {
            max-width: 100px !important;
            overflow-x: auto;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style2::-webkit-scrollbar {
            display: none;
        }

        .tag::before {
            background: #fff;
            border-radius: 10px;
            box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
            content: '';
            height: 6px;
            left: 10px;
            position: absolute;
            width: 6px;
            top: 10px;
        }

        .tag::after {
            background: #fff;
            border-bottom: 13px solid transparent;
            border-left: 10px solid #eee;
            border-top: 13px solid transparent;
            content: '';
            position: absolute;
            right: 0;
            top: 0;
        }

        .tag:hover {
            background-color: blue;
            color: white;
        }

        .tag:hover::after {
            border-left-color: blue;
        }

        /* .text-overflow{
            max-width: fit-content;
            max-height: 20px;
            overflow: auto;
        } */
    </style>
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
                                <h1 class="h2 mb-0 ls-tight">University Documents</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">
                                    <!-- <a href="#" class="btn d-inline-flex btn-sm btn-neutral border-base mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-pencil"></i>
                                        </span>
                                        <span>Edit</span>
                                    </a> -->
                                    <!-- <a href="./new_university.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>New Application</span>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <!-- <li class="nav-item ">
                                <a href="#" class="nav-link active">Uploaded By You</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="./all_uploaded_by_student.php" class="nav-link font-regular">Uploaded By
                                    Students</a>
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
                    <!-- Card stats -->
                    <div class="row g-6 mb-6">
                        <div class="col-xl-3 col-sm-6 col-12">
                                <div class="card shadow border-0 overflow_style"
                                    style="height: 130px;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">Documents</span>
                                                <?php
                                                    $stmt="SELECT count(id) FROM `universities_documents` WHERE university_id=(?) AND deleted_at IS NULL";
                                                    $sql=mysqli_prepare($conn, $stmt);

                                                    // $is_admin=0;
                                                    mysqli_stmt_bind_param($sql,'i',$_GET['university_id']);
                                        
                                                    $result=mysqli_stmt_execute($sql);
                                                        if ($result){
                                                            $data= mysqli_stmt_get_result($sql);
                                                            $sno=1;
                                                            while ($row = mysqli_fetch_array($data)){
                                                        ?>
                                                    <span class="h3 font-bold mb-0">
                                                        <?php echo $row[0]; ?>
                                                    </span>
                                                    <?php }
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-auto">
                                                <div
                                                    class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                    <i class="bi bi-files"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    </div>

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <!-- <h5 class="mb-0">Universities Document</h5> -->
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable" style="padding: 30px 2px; border: 0px !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-size: 16px;">Sno</th>
                                        <th style="font-size: 16px;">Document Name</th>
                                        <!-- <th style="font-size: 16px;">Download</th> -->
                                        <!-- <th>Comment</th> -->
                                        <th style="font-size: 16px;">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                        $stmt="SELECT universities_documents.id,
                                        universities_documents.document_name,
                                        universities_documents.created_at
                                        FROM `universities_documents` WHERE university_id=(?) AND  universities_documents.deleted_at IS NULL";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$_GET['university_id']);
                            
                                        $result=mysqli_stmt_execute($sql);
                                        echo mysqli_error($conn);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td style="font-size: 14px;">
                                            <?php echo $sno;?>
                                        </td>

                                        <td style="font-size: 14px;">
                                            <?php echo $row["document_name"];?>
                                        </td>
                                        <!-- <td style="font-size: 14px;">
                                           <a class="btn btn-outline-primary p-2" href="../../documents/admin/university/<?php echo $row["document_file"];?>">Download</a>
                                        </td> -->
                                        <td style="font-size: 14px;">
                                            <?php echo $row["created_at"];?>
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

    <script>
        function confirm_delete() {
            var confirm_del = confirm("Are you sure ?");
            if (confirm_del == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

<?php require('./admin_components/scripts.php');?>

</body>

</html>