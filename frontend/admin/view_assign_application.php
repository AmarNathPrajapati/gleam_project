<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ../login.php");
}
include("../../backend/config.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./admin_components/header_links.php'); ?>
    <title>view application list</title>
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
                                <h1 class="h2 mb-0 ls-tight">View Application List</h1>
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
                                    <!-- <a href="./new_application.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Application List</span>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <li class="nav-item ">
                                <!-- <a href="#" class="nav-link active">Uploaded By Agent</a> -->
                            </li>
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
                   

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0"> Assigned Applications</h5>
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable" style="padding: 30px 2px; border: 0px !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-size: 16px;">Sno</th>
                                        <th style="font-size: 16px;">Name</th>
                                        <th style="font-size: 16px;">Email</th>
                                        <th style="font-size: 16px;">Country</th>
                                        <th style="font-size: 16px;">University</th>
                                        <th style="font-size: 16px;">Status</th>
                                        <!-- <th>Comment</th> -->
                                        <th style="font-size: 16px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   
                                        $stmt="SELECT DISTINCT status_assumptions.status_name,
                                        countries.country_name,applications_by_agents.id,
                                        applications_by_agents.name,applications_by_agents.agent_id
                                        ,applications_by_agents.email,
                                        applications_by_agents.country_id,
                                        applications_by_agents.university_name,
                                        applications_by_agents.application_no,
                                        applications_by_agents.status,
                                        applications_by_agents.created_at
                                        FROM `application_assign`
                                        INNER JOIN applications_by_agents ON applications_by_agents.id=application_assign.application_id
                                        INNER JOIN countries ON countries.id=applications_by_agents.country_id
                                        INNER JOIN status_assumptions ON status_assumptions.status_number=applications_by_agents.status
                                        WHERE application_assign.gleam_admin_id=(?) 
                                        AND  application_assign.deleted_at IS NULL 
                                        AND applications_by_agents.deleted_at IS NULL";

                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$_GET['gleam_admin_id']);
                            
                                        $result=mysqli_stmt_execute($sql);
                                        if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while($row=mysqli_fetch_array($data)){

                                    ?>
                                    <tr>
                                        <td style="font-size: 14px;">
                                            <?php echo $sno;?>
                                        </td>

                                        <td style="font-size: 14px;">
                                            <?php echo $row["name"];?>
                                        </td>
                                        <td style="font-size: 14px;">
                                            <?php echo $row["email"];?>
                                        </td>
                                        <td style="font-size: 14px;">
                                            <?php echo $row["country_name"];?>
                                        </td>
                                       
                                        <td style="font-size: 14px;">
                                            <?php echo $row["university_name"];?>
                                        </td>
                                        <td style="font-size: 14px;">
                                            <?php echo $row["status_name"];?>
                                        </td>

                                        <td class="d-flex">
                                            <!-- <a href="#" class="btn btn-sm btn-neutral">View</a> -->
                                            <form action="./view_all_details.php"  style="margin-right: 10px;" method="get">
                                                <input type="number" hidden name="application_id"
                                                    value="<?php echo $row['id'];?>">
                                                    <input type="number" hidden name="agent_id"
                                                    value="<?php echo $row['agent_id'];?>">
                                                    <input type="number" hidden name="country_id"
                                                      value="<?php echo $row['country_id'];?>">
                                                <button type="submit" class="btn btn-neutral text-primary p-2"
                                                    style="font-size: 14px; ">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </form>

                                            <form action="./chat.php" method="get" style="margin-right: 10px;">
                                                <input type="number" hidden name="application_id"
                                                    value="<?php echo $row['id'];?>">
                                                    <!-- <input type="number" hidden name="application_no"
                                                    value="<?php echo $row['application_no'];?>"> -->
                                                    
                                                <button type="submit" class="btn btn-neutral text-primary p-2"
                                                    style="font-size: 14px;">
                                                    <i class="bi bi-chat-dots"></i>
                                                </button>
                                            </form>

                                            <form action="../../backend/admin/remove_assigned_admin.php" 
                                                 onsubmit="return confirmform()" style="margin-right: 10px;" method="POST">
                                                 <input type="text" hidden name="from_location"
                                                    value="manage_applications.php">
                                               
                                                 <input type="number" hidden name="application_id"
                                                    value="<?php echo $row['id'];?>">
                                                    <input type="number" hidden name="gleam_admin_id"
                                                    value="<?php echo $_GET['gleam_admin_id'];?>">
                                                    <input type="number" hidden name="country_id"
                                                      value="<?php echo $row['country_id'];?>">
                                                <button type="submit" class="btn btn-neutral text-primary p-2"
                                                    style="font-size: 14px; ">
                                                   Unassign Application
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
                                else{
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
        function confirmform() {
            var confirm_del = confirm("Are you sure ?");
            if (confirm_del == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

<?php require('./admin_components/scripts.php'); ?>

   

</body>

</html>