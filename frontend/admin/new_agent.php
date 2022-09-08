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
    <title>New Agent</title>
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
                                <h1 class="h2 mb-0 ls-tight mb-3">New Agent</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">

                                    <!-- <a href="./new_document.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a> -->
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
                            <form class="px-sm-5" action="../../backend/admin/new_agent.php" method="post" onsubmit="return cofirmdetails()" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="doc_name" class="form-label">Agent Name</label>
                                    <input type="text" placeholder="Agent Name" required class="form-control" name="agent_name"
                                        aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="agent_phone" class="form-label">Agent Phone</label>
                                    <input type="tel" minlength="10" placeholder="Agent Phone Number " required class="form-control" name="agent_phone"
                                        aria-describedby="phoneHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="agent_email" class="form-label">Agent Email</label>
                                    <input type="email" placeholder="Agent Email" required class="form-control" 
                                    name="agent_email"
                                        aria-describedby="emailHelp">
                                </div>
                                
                                
                                <button type="submit" class="btn btn-primary">Create Agent</button>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>

        function cofirmdetails(){
            var are_you_sure=confirm("Are you sure, you want to send invitation to this agent ?")
            if (are_you_sure==true) {
                
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