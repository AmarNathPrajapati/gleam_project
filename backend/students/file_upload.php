<?php
    include("../config.php");
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST["submit"])) {
            
            $file=$_FILES['file'];
            $fromlocation="../../frontend/dashboard.php";
            $fileName=$_FILES['file']['name'];
            $fileTmpName=$_FILES['file']['tmp_name'];
            $fileSize=$_FILES['file']['size'];
            $fileError=$_FILES['file']['error'];
            $fileType=$_FILES['file']['type'];
            $fileExt=explode('.',$fileName);
            $fileActualExt=strtolower(end($fileExt));
            $allowed=array('docs','docx','pdf','jpg','png','jpeg');
            if (in_array($fileActualExt,$allowed)) {
                if ($fileError==0) {
                    if ($fileSize<=6000000) {

                        $stmt="SELECT file FROM `students_upload` WHERE student_id=(?) AND document_id=(?) LIMIT 1";
                        $sql=mysqli_prepare($conn, $stmt);
            
                        //binding the parameters to prepard statement
                       
                        mysqli_stmt_bind_param($sql,"ii",$_SESSION["student_id"],$_POST['document_id']);
                        $result=mysqli_stmt_execute($sql);
                        $data= mysqli_stmt_get_result($sql);
                        
                        if ($data->num_rows>0){
                            $row=mysqli_fetch_array($data);
                            $file_loc123 = '../../documents/students/'.$row["file"];
                            unlink($file_loc123);

                            mysqli_stmt_close($sql);

                            $fileNameNew= $fileExt[0].uniqid('',true).".".$fileActualExt;
                            $structure = '../../documents/students/'.$_SESSION["student_id"];
                           
                            
                                $fileDestination=$structure."/".$fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);
    
                                $stmt="UPDATE  `students_upload` SET file=? WHERE document_id=(?) AND student_id=(?)";
                                $sql=mysqli_prepare($conn, $stmt);
    
                                //binding the parameters to prepard statement
                                $l1234=$_SESSION['student_id']."/".$fileNameNew;
                                mysqli_stmt_bind_param($sql,"sii",$l1234,$_POST['document_id'],$_SESSION['student_id']);
    
                                $result=mysqli_stmt_execute($sql);
                                if ($result) {
                                    mysqli_stmt_close($sql);
                                    echo '<script>
                                    alert("Successfully!! Uploaded the file.");
                                    window.location.href="'.$fromlocation.'";
                                    </script>';
                                } 
                                else {
                                    echo mysqli_error($conn);
                                    mysqli_stmt_close($sql);
                                    mysqli_close($conn);
                                    echo '<script>
                                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                    window.location.href="'.$fromlocation.'";
                                    <script>';
                                }
                            
                        }
                        else{
                            $fileNameNew= $fileExt[0].uniqid('',true).".".$fileActualExt;
                            $structure = '../../documents/students/'.$_SESSION["student_id"];
                            if(!is_dir($structure)){
                           
                                //Directory does not exist, so lets create it.
                                mkdir($structure, 0777, true);
                                $fileDestination=$structure."/".$fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);
    
                                $stmt="INSERT INTO `students_upload` 
                                (document_id,student_id,file) VALUES (?,?,?)";
                                $sql=mysqli_prepare($conn, $stmt);
    
                                //binding the parameters to prepard statement
                                // $file_lo=$_SESSION["student_id"]."/".$fileNameNew;
                                $file_lo=$_SESSION['student_id']."/".$fileNameNew;
                                mysqli_stmt_bind_param($sql,"iis",$_POST['document_id'],$_SESSION['student_id'],$file_lo);
    
                                $result=mysqli_stmt_execute($sql);
                                if ($result) {
                                    mysqli_stmt_close($sql);
                                   
                                    $stmt="INSERT INTO `activity` (document_id,student_id,activity_type) VALUES (?,?,?)";
                                    $sql=mysqli_prepare($conn, $stmt);
                        
                                    //binding the parameters to prepard statement
                                    mysqli_stmt_bind_param($sql,"iii",$_POST["document_id"],$_SESSION["student_id"],$activity_type);
                                    $activity_type=2;
                                    $result=mysqli_stmt_execute($sql);
                                    
                                    if ($result) {
                                        mysqli_stmt_close($sql);
                                        mysqli_close($conn);
                                        echo '<script>
                                        alert("Successfully!! Uploaded the file.");
                                        window.location.href="'.$fromlocation.'";
                                        </script>';
                                    } 
                                    else {
                                        echo mysqli_error($conn);
                                        echo '<script>
                                        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                        window.location.href="../../frontend/login.php"
                                        <script>';
                                        mysqli_stmt_close($sql);
                                        mysqli_close($conn);
                                    }
                                } 
                                else {
                                   echo mysqli_error($conn);
    
                                    echo '<script>
                                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                      window.location.href="../../frontend/login.php"
                                    <script>';
                                    mysqli_stmt_close($sql);
                                    mysqli_close($conn);
                                } 
                            }
                            else{
                               
                                $fileDestination=$structure."/".$fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);
    
                                $stmt="INSERT INTO `students_upload` (document_id,student_id,file) VALUES (?,?,?)";
                                $sql=mysqli_prepare($conn, $stmt);
    
                                //binding the parameters to prepard statement
                                $file_lo=$_SESSION['student_id']."/".$fileNameNew;
                                mysqli_stmt_bind_param($sql,"iis",$_POST['document_id'],$_SESSION['student_id'],$file_lo);
    
                                $result=mysqli_stmt_execute($sql);
                                if ($result) {
                                    mysqli_stmt_close($sql);
                                  
    
                                    $stmt="INSERT INTO `activity` (document_id,student_id,activity_type) VALUES (?,?,?)";
                                    $sql=mysqli_prepare($conn, $stmt);
                        
                                    //binding the parameters to prepard statement
                                    mysqli_stmt_bind_param($sql,"iii",$_POST["document_id"],$_SESSION["student_id"],$activity_type);
                                    $activity_type=2;
                                    $result=mysqli_stmt_execute($sql);
                                    
                                    if ($result) {
                                        mysqli_stmt_close($sql);
                                        mysqli_close($conn);
                                        echo '<script>
                                        alert("Successfully!! Uploaded the file.");
                                        window.location.href="'.$fromlocation.'";
                                        </script>';
                                    } 
                                    else {
    
                                        echo mysqli_error($conn);
                                        mysqli_stmt_close($sql);
                                        mysqli_close($conn);
                                        echo '<script>
                                        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                        window.location.href="../../frontend/login.php"
                                        <script>';
                                    }
                                   
                                } 
                                else {
                                    echo mysqli_error($conn);
                                    mysqli_stmt_close($sql);
                                    mysqli_close($conn);
                                    echo '<script>
                                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                     window.location.href="../../frontend/login.php"
                                    <script>';
                                }
                            }
                        }
                        
                    }
                    else {
                        // error is due to larger file
                        $fileSizeInMb=$fileSize/1000;
                    
                        echo '<script>
                        alert("Your file size is'. $fileSizeInMb.'kb. Only less than 6MB files are supported.");
                        window.location.href="'.$fromlocation.'";
                        </script>';
                       
                        mysqli_close($conn);
                    }
                }
                else{
                    mysqli_close($conn);
                    echo $fileError;
                    echo '<script>
                    alert("Sorry there is an error in your file ->'.$fileError.'");
                    window.location.href="'.$fromlocation.'";
                    </script>';
                }
            }
            else {
                mysqli_close($conn);
                echo '<script>
                alert("Your file of type *'.end($fileExt).'* . This type of File formate is not supported.");
                window.location.href="'.$fromlocation.'";
                </script>';
            }
        }

        else{
            mysqli_close($conn);
            echo "There is a problem in '.$fromlocation.' near form which we are submiting by modal generated through upload po button...";
            echo '<script>
            alert("Sorry Something went wrong");
            window.location.href="'.$fromlocation.'";
            </script>';
        }
    }
?>