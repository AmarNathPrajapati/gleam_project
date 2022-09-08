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
    <title>Countries</title>
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
                                <h1 class="h2 mb-0 ls-tight mb-4">Manage Countries</h1>
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
                                    <a type="button" class="btn d-inline-flex btn-sm btn-primary mx-1" 
                                    data-bs-toggle="modal" data-bs-target="#addCountry">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Add Country</span>
                                    </a>
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <!-- <li class="nav-item ">
                                <a href="./dashboard.php" class="nav-link active">Uploaded By You</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link font-regular">Uploaded By Countries</a>
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
                            <h5 class="mb-0">Countries</h5>
                        </div>
                        <div class="table-responsive" style="padding: 30px 18px;">
                            <table class="table table-hover table-nowrap" id="myTable" style="border: 0px solid black !important; padding: 30px 2px;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="font-size: 16px;">Sno</th>
                                        <th style="font-size: 16px;">Countries Name</th>
                                        <th style="font-size: 16px;">Created At</th>
                                        <th style="font-size: 18px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <?php
                                    // echo $_GET['document_id12'];
                                   
                                        $stmt="SELECT id,country_name,created_at FROM `countries` WHERE deleted_at IS NULL";
                                        $sql=mysqli_prepare($conn, $stmt);
                                        // mysqli_stmt_bind_param($sql,'i',$is_admin);
                                        $is_admin=0;
                                        

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
                                            <?php echo $row["country_name"];?>
                                        </td>
                                        <td style="font-size: 18px;">
                                            <?php echo $row["created_at"];?>
                                        </td>
                                        <td style="font-size: 18px; display:flex;">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-outline-primary p-2" style="margin-right:10px;" 
                                            data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'];?>">
                                             Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../../backend/admin/country.php" method="post">
                                                    <div class="modal-body">
                                                        <input type="number" hidden name="country_id" 
                                                        readonly value="<?php echo $row['id'];?>">
                                                        <input type="text" class="form-control" name="country_name" 
                                                        value="<?php echo $row['country_name'];?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                            </div>
                                           

                                            <form action="../../backend/admin/country.php" onsubmit="return confirmForm()" method="post">
                                                <input type="number" hidden name="country_id" value="<?php echo $row['id']?>">
                                                <button type="submit" class="btn btn-outline-danger p-2">Delete</button>
                                            </form>
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
                        <!-- <div class="card-footer border-0 py-5">
                            <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
                        </div> -->
                    </div>
                </div>
            </main>

            <!-- Modal code -->

            <div class="modal fade" id="addCountry" tabindex="-1" aria-labelledby="addCountry" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Country</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../../backend/admin/country.php" method="post">
                        <div class="modal-body">
                            <input class="form-control" placeholder="Enter country name" type="text" required name="new_country_name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary">Add</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function confirmForm(){
        var yes=confirm("Are You Sure ?");
        if (yes==true) {
            return true;
        } else {
            return false;
        }
    }
</script>

 <?php require('./admin_components/scripts.php');?>

</body>

</html>