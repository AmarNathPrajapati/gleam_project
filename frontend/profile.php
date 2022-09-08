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
    <title>Profile</title>
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
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight mb-4">Profile</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                   
                    <div class="card shadow border-0 mb-7">
                        

                        <div class="container-fluid p-5 my-5">
                            <?php
                            include("../backend/config.php");
                            $stmt="SELECT name,email,phone,verified FROM `users` WHERE id=(?) LIMIT 1";
                            $sql=mysqli_prepare($conn, $stmt);
                            mysqli_stmt_bind_param($sql,"i",$_SESSION["student_id"]);
                            
                            $result=mysqli_stmt_execute($sql);
                            if($result){
                                    $data= mysqli_stmt_get_result($sql);
                                    $sno=1;
                                    while ($row = mysqli_fetch_array($data)){
                                        $name=$row["name"];
                                        $email=$row["email"];
                                        $phone=$row["phone"];
                                        $verified=$row["verified"];
                                    }
                            }
                            ?>
                           <form action="../backend/students/update_details.php" class="p-4" method="post">

                                <div class="row mb-3" style="padding: 10px;">
                                    <div class="col-auto text-center">
                                        Name:
                                    </div>
                                    <div class="col">
                                        <input type="text" id="username" readonly name="name" 
                                        style="outline: none; background-color: transparent; width: 100%;" 
                                        value="<?php echo $name;?>">
                                    </div>
                                </div>
                                <div class="row mb-3" style="background-color: #EEEEEE; padding: 10px;">
                                    <div class="col-auto text-center">
                                        Email:
                                    </div>
                                    <div class="col">
                                      <input name="email" 
                                      style="background-color: transparent; outline: none; width: 100%;" 
                                      type="email" readonly value="<?php echo $email;?>">
                                    </div>
                                </div>
                                <div class="row mb-3" style="padding: 10px;">
                                    <div class="col-auto text-center">
                                        Phone:
                                    </div>
                                    <div class="col-auto">
                                        <input type="tel" id="userphone" readonly name="phone" style="outline: none; background-color: transparent;" minlength="10" value="<?php echo $phone;?>">
                                    </div>
                                </div>
                                <div class="row mb-5" style="background-color: #EEEEEE; padding: 10px;">
                                    <div class="col-auto text-center">
                                        Account verified:
                                    </div>
                                    <div class="col-auto">
                                        <?php echo $verified==1?"Yes":"No";?>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <button class="btn btn-danger col-auto" style="margin-right: 10px;"  onclick="make_editable()" type="button" id="editbtn">Edit</button>
                                    <a class="btn btn-warning col-auto" href="./enter_mail.php" id="resetbtn">Reset Password</a>
                                    <button class="btn btn-success col-auto" type="submit" id="updatebtn" style="margin-right: 10px;" hidden>Update</button>
                                    <button class="btn btn-danger col-auto" onclick="make_uneditable()" type="button" id="cancelbtn" hidden>Cancel</button>
                                
                                </div>
                           </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function make_editable(){
            document.getElementById('editbtn').setAttribute('hidden','hidden');
            document.getElementById('resetbtn').setAttribute('hidden','hidden');
            document.getElementById('updatebtn').removeAttribute('hidden');
            document.getElementById('cancelbtn').removeAttribute('hidden');
            document.getElementById('username').removeAttribute('readonly');
            document.getElementById('username').style.border="1px solid black";
            document.getElementById('username').style.borderRadius="3px";
            document.getElementById('username').style.width="auto";
            document.getElementById('userphone').style.border="1px solid black";
            document.getElementById('userphone').style.borderRadius="3px";
            document.getElementById('userphone').style.width="auto";
            document.getElementById('userphone').removeAttribute('readonly');
        }
        function make_uneditable(){
            document.getElementById('updatebtn').setAttribute('hidden','hidden');
            document.getElementById('cancelbtn').setAttribute('hidden','hidden');
            document.getElementById('editbtn').removeAttribute('hidden');
            document.getElementById('username').setAttribute('readonly','readonly');
            document.getElementById('username').style.border="0px dashed black";
            document.getElementById('username').style.width="100%";
            document.getElementById('userphone').style.border="0px dashed black";
            document.getElementById('userphone').style.width="100%";
            document.getElementById('userphone').setAttribute('readonly','readonly');
            window.location.reload();
            // document.getElementById('cancelbtn').setAttribute('hidden','hidden');
        }




    </script>

    <?php include("./components/scripts.php"); ?>


</body>

</html>