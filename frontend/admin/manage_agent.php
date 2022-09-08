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
    <title>Manage Agents</title>

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
                                <h1 class="h2 mb-0 ls-tight"> Agents</h1>
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
                                    <a href="./new_agent.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Add New Agent</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <!-- <li class="nav-item ">
                                <a href="#" class="nav-link active">Agent Details</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="./all_uploaded_by_student.php" class="nav-link font-regular">Uploaded By Students</a>
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
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total
                                                Agents</span>
                                            <?php
                        
                                                    $stmt="SELECT count(id) FROM `users` WHERE is_admin=(?) AND deleted_at IS NULL";
                                                    $sql=mysqli_prepare($conn, $stmt);

                                                    $is_admin=2;
                                                    mysqli_stmt_bind_param($sql,'i',$is_admin);
                                        
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
                                            <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 overflow_style" style="height: 130px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Blocked Agents</span>
                                            <?php
                        
                                                    $stmt="SELECT count(id) FROM `users` WHERE user_block=(?) AND is_admin=(?) AND deleted_at IS NULL";
                                                    $sql=mysqli_prepare($conn, $stmt);

                                                    mysqli_stmt_bind_param($sql,'ii',$user_block,$is_admin);
                                                    $is_admin=2;
                                                    $user_block=1;
                                        
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
                                            <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                                <i class="bi bi-people"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                    </div>

                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Agents</h5>
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable"
                                style="padding: 30px 2px; border: 0px solid black !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-size: 16px;">Sno</th>
                                        <th style="font-size: 16px;">Name</th>
                                        <th style="font-size: 16px;">Phone</th>
                                        <th style="font-size: 16px;">Email</th>
                                        <th style="font-size: 16px;">Verified</th>
                                        <th style="font-size: 16px;">Created At</th>
                                        <th style="font-size: 16px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="border: 0px solid black !important;">
                                    <?php
                                   
                                        $stmt="SELECT users.id,users.name,users.phone,users.email,users.verified,users.user_block,users.created_at
                                        FROM `users` WHERE users.deleted_at IS NULL AND users.is_admin=(?)";
                                        $sql=mysqli_prepare($conn, $stmt);

                                        mysqli_stmt_bind_param($sql,'i',$is_admin);
                                        $is_admin=2;
                            
                                        $result=mysqli_stmt_execute($sql);
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
                                            <?php echo $row["name"];?>
                                        </td>
                                        <td style="font-size: 14px;">
                                            <?php echo $row["phone"];?>
                                        </td>
                                        <td style="font-size: 14px; min-width: fit-content;">
                                            <?php echo $row["email"];?>
                                        </td>
                                        <td class="overflow_style2 p-1" style="font-size: 14px;">
                                            <?php echo $row["verified"]==1?'Verified':'Not Verified';?>
                                        </td>
                                        <td class="overflow_style2" style="font-size: 14px;">
                                            <?php echo $row["created_at"];?>
                                        </td>

                                        <td class="d-flex p-1">

                                            <!-- <a type="button" class="btn btn-neutral p-2" style="font-size: 14px; margin-right:10px;" 
                                                href='<?php echo "../../documents/".$row["file_location"]; ?>'>View</a> -->

                                            <form action="./view_application_list.php" method="get">
                                                <input type="number" hidden name="agent_id"
                                                    value="<?php echo $row['id'];?>">
                                                <button type="submit" class="btn btn-neutral text-danger-hover p-2"
                                                    style="font-size: 14px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                      </svg>
                                                      <br>
                                                     <span style="font-size: 9px;">Applications</span>
                                                </button>
                                            </form>

                                            <form action="../../backend/admin/delete_agent.php"
                                                onsubmit="return confirm_delete()" method="post">
                                                <input type="number" hidden name="agent_id"
                                                    value="<?php echo $row['id'];?>">
                                                <input type="text" hidden name="agent_email"
                                                    value="<?php echo $row['email'];?>">
                                                <input type="text" hidden name="agent_name"
                                                    value="<?php echo $row['name'];?>">
                                                <input type="number" hidden name="user_block"
                                                    value="<?php echo $row['user_block'];?>">
                                                <button type="submit" class="btn btn-neutral text-danger-hover p-2"
                                                    style="font-size: 14px; margin-left: 10px;">
                                                    <!-- <i class="bi bi-trash"></i> -->
                                                    <?php echo $row['user_block']==1?'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield" viewBox="0 0 16 16">
  <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
</svg>':'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-slash" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M1.093 3.093c-.465 4.275.885 7.46 2.513 9.589a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.32 11.32 0 0 0 1.733-1.525l-.745-.745a10.27 10.27 0 0 1-1.578 1.392c-.346.244-.652.42-.893.533-.12.057-.218.095-.293.118a.55.55 0 0 1-.101.025.615.615 0 0 1-.1-.025 2.348 2.348 0 0 1-.294-.118 6.141 6.141 0 0 1-.893-.533 10.725 10.725 0 0 1-2.287-2.233C3.053 10.228 1.879 7.594 2.06 4.06l-.967-.967zM3.98 1.98l-.852-.852A58.935 58.935 0 0 1 5.072.559C6.157.266 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.483 3.626-.332 6.491-1.551 8.616l-.77-.77c1.042-1.915 1.72-4.469 1.29-7.702a.48.48 0 0 0-.33-.39c-.65-.213-1.75-.56-2.836-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524a49.7 49.7 0 0 0-1.357.39zm9.666 12.374-13-13 .708-.708 13 13-.707.707z"/>
                                                      </svg>';?>
                                                    <br>
                                                   <span style="font-size: 9px;"><?php echo $row['user_block']==1?"Activate":"Deactivate";?></span>
                                                </button>
                                            </form>

                                            <form action="../../backend/admin/delete_agent.php"
                                                onsubmit="return confirm_delete()" method="post">
                                                <input type="number" hidden name="agent_id"
                                                    value="<?php echo $row['id'];?>">
                                                <input type="text" hidden name="agent_email"
                                                    value="<?php echo $row['email'];?>">
                                                <input type="text" hidden name="agent_name"
                                                    value="<?php echo $row['name'];?>">
                                                <input type="number" hidden name="delete_user"
                                                    value="delete">
                                                <button type="submit" class="btn btn-neutral text-danger-hover p-2"
                                                    style="font-size: 14px; margin-left: 10px;">
                                                    <i class="bi bi-trash"></i>
                                                    <br>
                                                    <span style="font-size: 9px;">Remove</span>
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
                                    mysqli_error($conn);
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


    <?php require('./admin_components/scripts.php'); ?>

    <script>
         
        function confirm_delete() {
            var confirm_del = confirm("Are you sure ?");
            if (confirm_del == true) {
                document.querySelector(
                    "body").style.visibility = "hidden";
                document.querySelector(
                    "#loader").style.visibility = "visible";
                document.querySelector(
                    "#loader").style.zIndex = "2";
                return true;

            } else {
                return false;
            }
        }
    </script>


<?php require('./admin_components/scripts.php');?>

</body>

</html>