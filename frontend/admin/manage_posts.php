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
    <title>Posts</title>
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
                                <h1 class="h2 mb-0 ls-tight">Manage Posts</h1>
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
                                    <a href="./new_post.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>New Post</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <!-- <li class="nav-item ">
                                <a href="#" class="nav-link active">Uploaded By Agent</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->
                    <div class="row g-6 mb-6 overflow_style_row" >
                        <?php 
                                $stmt="SELECT id,post_title,post_description,file,file_type,active,created_at FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC";
                                $sql=mysqli_prepare($conn, $stmt);
                                $result=mysqli_stmt_execute($sql);

                                if ($result){
                                        $data= mysqli_stmt_get_result($sql);
                                        $sno=1;
                                        while ($row = mysqli_fetch_array($data)){
                                            ?>
                                            <div class="col-xl-3 col-sm-6 col-12 mb-3">
                                                <div class="card shadow border-0 overflow_style" style="height: 100%;">
                                                    <div class="card-body" style="position:relative;">
                                                        <div class="row">
                                                            <div class="col-12 text-center">
                                                               <?php
                                                                    if ($row["file_type"]=="mp4") {
                                                                       ?>
                                                                           <video width="400" style="height:200px; object-fit:cover;" controls>
                                                                                <source src="../../documents/posts/<?php echo $row["file"];?>" type="video/mp4">
                                                                            </video>
                                                                       
                                                                       <?php
                                                                    } else {
                                                                        ?>
                                                                            <img src="../../documents/posts/<?php echo $row["file"];?>" style="max-width:100%; height:200px; margin:auto; object-fit:cover;"alt="img">
                                                                        <?php
                                                                    }
                                                                    
                                                               ?>
                                                            </div>
                                                            <div class="col-12 mt-4 text-center">
                                                                <span class="h3 font-bold  d-block mb-2"><?php echo $row["post_title"];?></span>
                                                                <span class="h6 font-semibold text-muted  mb-0">
                                                                    <?php echo $row["post_description"];?>
                                                                </span>
                                                               <div class="mt-5">
                                                                    <div  style="float: left;">
                                                                        <?php echo $row["created_at"];?>
                                                                    </div>

                                                                    <div style="float: right;display:flex;">
                                                                        <form action="./edit_post.php" method="get"><input type="number" name="post_id" value="<?php echo $row["id"];?>" hidden> <input type="number" name="active" value="<?php echo $row["active"];?>" hidden> <input type="text" name="file" value="<?php echo $row["file"];?>" hidden> <input type="text" name="post_title" value="<?php echo $row["post_title"];?>" hidden> <input type="text" name="post_description" value="<?php echo $row["post_description"];?>" hidden> <button class="btn btn-neutral text-warning p-2" type="submit" style="margin-right:7px; font-size:12px;"><i class="bi bi-pencil"></i></button></form>
                                                                        <form action="../../backend/admin/remove_post.php" method="post"><input type="number" name="post_id" value="<?php echo $row["id"];?>" hidden> <button class="btn btn-neutral text-danger p-2" style="font-size:12px;"><i class="bi bi-trash"></i></button></form>
                                                                    </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <?php echo $row["active"]==1?"<span class='badge bg-primary'>Active</span>":""?>
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

<?php require('./admin_components/scripts.php'); ?>

   

</body>

</html>