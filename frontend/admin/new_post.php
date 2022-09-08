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
    <link rel="stylesheet" href="./css/new_document.css">
    <title>New Post</title>
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
                                <h1 class="h2 mb-0 ls-tight mb-3">New Post</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">

                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">


                    <div class="card shadow border-0 mb-7 p-sm-5">
                        <!-- <div class="card-header">
                            <h5 class="mb-0">Documents</h5>
                        </div> -->

                        <div class="form-box px-sm-5 mb-5">
                            <form class="px-sm-5" action="../../backend/admin/new_post.php"
                            onsubmit="return showloader()" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="doc_name" class="form-label">Post Title</label>
                                    <input type="text" placeholder="Post Title" required class="form-control" id="name" name="post_title">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Post Description</label>
                                    <input type="text" placeholder="Post Description" class="form-control" id="description" name="post_description">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="file">Post File</label>
                                    <input type="file"  accept=".png,.jpg,.jpeg,video/*" required class="form-control" name="document" id="file">
                                    <p class="text-danger">Only .png,.jpg,.jpeg,.mp4 type file formate and less than 5 mb file is supportted.</p>
                                </div>
                                <select class="form-select mb-3" name="active">
                                    
                                    <option  value="0">Unactive</option>
                                    <option  value="1">Active</option>
                                    
                                </select>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>


<?php require('./admin_components/scripts.php');?>

</body>

</html>