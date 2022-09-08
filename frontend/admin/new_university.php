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
    <title>New University</title>
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
                                <h1 class="h2 mb-0 ls-tight mb-3">New University</h1>
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
                            <form class="px-sm-5" action="../../backend/admin/new_university.php" onsubmit="return checkform()" method="post"
                              enctype="multipart/form-data">
                                <!-- <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" placeholder="Name" required class="form-control" id="name" name="name"
                                        aria-describedby="nameHelp">
                                </div> -->
                              
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country Name</label>
                                    <br>
                                    <input type="text"  class="form-control my-2" name="country" id="country" placeholder="Country Name">
                                   
                                </div>
                                <div class="mb-3">
                                    <label for="university" class="form-label">Univeristy</label>
                                    <input type="text" placeholder="University" required class="form-control" id="university" 
                                    name="university"
                                        aria-describedby="universityHelp">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="file">Documents</label>
                                    <!-- <p class="text-danger mb-2">Supported file formates- .pdf,.docs,.docx,.png,.jpg,.jpeg, 
                                        Maximum file size- 500kb.</p> -->

                                    <input type="text" placeholder="Document Name" class="form-control my-2"
                                     name="doc_name[]">

                                    <!-- <input type="file" accept=".pdf,.docs,.docx,.png,.jpg,.jpeg"   class="form-control" 
                                    name="document[]"> -->
                                   
                    
                                    <div id="moredocument">
                                        <!-- <input type="file"  accept=".pdf,.docs,.docx,.png,.jpg,.jpeg" required class="form-control my-4" 
                                        name="document[]"> -->
                                    </div>

                                    <button type="button" onclick="add_more()" class="btn btn-success p-2 mt-2">Add More</button>
                                    <button type="button" onclick="delete_input()" class="btn btn-danger p-2 mt-2">Remove</button>
                                </div>
                                <button type="submit" class="btn btn-primary mt-5">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function add_more(){
            // console.log("hell0");
            // var input_new2=document.createElement('input');
            // input_new2.type="file";
            // input_new2.name="document[]";
            // input_new2.accept='.pdf,.docs,.docx,.png,.jpg,.jpeg';
            // input_new2.setAttribute('required','required');
            // input_new2.classList.add('form-control');
            // input_new2.classList.add('my-4');

            var input_new=document.createElement('input');
            input_new.type="text";
            input_new.name="doc_name[]";
            input_new.placeholder="Document Name";
            input_new.setAttribute('required','required');
            input_new.classList.add('form-control');
            input_new.classList.add('my-2');

            document.getElementById('moredocument').append(input_new);
            // document.getElementById('moredocument').append(input_new2);
        }
      
        function delete_input(){
            var list=document.getElementById('moredocument');
            list.removeChild(list.lastElementChild);

        }

        function checkform(){
            var document_name = document.getElementsByName('doc_name[]');
            var document = document.getElementsByName('document[]');
            var key=0;
            document_name.forEach(element => {
                if (element.isEmpty() || document[key].isEmpty()) {
                    alert('Please fill out all fields.');
                    
                    return false;
                } 
                key++;
            });

            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loader").style.visibility = "visible";
            document.querySelector(
                "#loader").style.zIndex = "2";

            return true;
        }
    </script>


<?php require('./admin_components/scripts.php'); ?>

</body>

</html>