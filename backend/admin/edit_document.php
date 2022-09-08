<?php

include('../config.php');

if ($_SERVER["REQUEST_METHOD"]=="POST") {

      
       if (empty($_FILES['document']['name'])) {
        //   $file=$_FILES['document'];
         if (empty($_POST['taginput1'])) {
            $stmt="UPDATE `documents` SET name=?,will_student=?,country=? WHERE id=(?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            if ($_POST["will_student_input"]) {
                $will_student=1;
            } 
            else {
                $will_student=0;
            }
         
            $doc_name=$_POST["doc_name"];
    
            // $file_lo="admin/".$fileNameNew;
            mysqli_stmt_bind_param($sql,"siii",$doc_name,$will_student,$_POST['country'],$_POST['doc_id']);
        
            $result=mysqli_stmt_execute($sql);
        
            if ($result) {
                echo '<script>
                alert("Successfully!! Updated the details.");
                window.location.href="../../frontend/admin/dashboard.php";
                </script>';
            } 
            else {
               echo mysqli_error($conn);
        
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                window.location.href="../../frontend/admin/dashboard.php";
                <script>';
            }
         } 
         else {
            $stmt="UPDATE `documents` SET name=?,will_student=?,country=?,tags=? WHERE id=(?)";
            $sql=mysqli_prepare($conn, $stmt);
        
            //binding the parameters to prepard statement
            if ($_POST["will_student_input"]) {
                $will_student=1;
            } 
            else {
                $will_student=0;
            }
         
            $doc_name=$_POST["doc_name"];
    
            // $file_lo="admin/".$fileNameNew;
            mysqli_stmt_bind_param($sql,"siisi",$doc_name,$will_student,$_POST['country'],$_POST['taginput1'],$_POST['doc_id']);
        
            $result=mysqli_stmt_execute($sql);
        
            if ($result) {
                echo '<script>
                alert("Successfully!! Updated the details.");
                window.location.href="../../frontend/admin/dashboard.php";;
                </script>';
            } 
            else {
               echo mysqli_error($conn);
        
                echo '<script>
                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                window.location.href="../../frontend/admin/dashboard.php";
                <script>';
            }
         }
          
       } 

       else {
        $file=$_FILES['document'];
        // echo $file;
         if (empty($_POST['taginput1'])) {
            $fileName=$_FILES['document']['name'];
            $fileTmpName=$_FILES['document']['tmp_name'];
            $fileSize=$_FILES['document']['size'];
            $fileError=$_FILES['document']['error'];
            $fileType=$_FILES['document']['type'];
            $fileExt=explode('.',$fileName);
            $fileActualExt=strtolower(end($fileExt));
            $allowed=array('pdf','jpg','png','jpeg','docs','docx');
            $fileNameNew= $fileExt[0].uniqid('',true).".".$fileActualExt;
            if (in_array($fileActualExt,$allowed)) {
               if ($fileError==0) {
                   if ($fileSize<=6000000) {
    
                       
                                $structure = '../../documents/admin';
                           
                                $fileDestination=$structure."/".$fileNameNew;
    
                                move_uploaded_file($fileTmpName, $fileDestination);
                                $stmt="UPDATE `documents` SET name=?,file_location=?,will_student=?,country=? WHERE id=(?)";
                                $sql=mysqli_prepare($conn, $stmt);
                            
                                //binding the parameters to prepard statement
                                if ($_POST["will_student_input"]) {
                                    $will_student=1;
                                } else {
                                    $will_student=0;
                                }
                             
                                $doc_name=$_POST["doc_name"];
    
                                $file_lo="admin/".$fileNameNew;
                                mysqli_stmt_bind_param($sql,"ssiii",$doc_name,$file_lo,$will_student,$_POST['country'],$_POST['doc_id']);
                            
                                $result=mysqli_stmt_execute($sql);
                            
                                if ($result) {
                                    echo '<script>
                                    alert("Successfully!! Updated the details.");
                                    window.location.href="../../frontend/admin/dashboard.php";
                                    </script>';
                                } 
                                else {
                                   echo mysqli_error($conn);
                            
                                    echo '<script>
                                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                    window.location.href="../../frontend/admin/dashboard.php";
                                    <script>';
                                }
                    }
    
                    else {
                        // error is due to larger file
                        $fileSizeInMb=$fileSize/1000;
                       
                        echo '<script>
                         alert("Your file size is'. $fileSizeInMb.'kb. Only file sizes less than 6MB are supported.");
                         window.location.href="../../frontend/admin/dashboard.php";;
                        </script>';
                    }
    
               }
               else{
                echo $fileError;
                echo '<script>
                alert("Sorry there is an error in your file ->'.$fileError.'");
                window.location.href="../../frontend/admin/dashboard.php";;
               </script>';
               }
            }
            else {
                echo '<script>
                alert("Your file of type *'.end($fileExt).'* . This type of File formate is not supported.");
                window.location.href="../../frontend/admin/dashboard.php";;
                </script>';
            }
         } 
         else {
            $fileName=$_FILES['document']['name'];
            $fileTmpName=$_FILES['document']['tmp_name'];
            $fileSize=$_FILES['document']['size'];
            $fileError=$_FILES['document']['error'];
            $fileType=$_FILES['document']['type'];
            $fileExt=explode('.',$fileName);
            $fileActualExt=strtolower(end($fileExt));
            $allowed=array('pdf','jpg','png','jpeg','docs','docx');
            $fileNameNew= $fileExt[0].uniqid('',true).".".$fileActualExt;
            if (in_array($fileActualExt,$allowed)) {
                if ($fileError==0) {
                    if ($fileSize<=6000000) {

                        
                                    $structure = '../../documents/admin';
                            
                                    $fileDestination=$structure."/".$fileNameNew;

                                    move_uploaded_file($fileTmpName, $fileDestination);
                                    $stmt="UPDATE `documents` SET name=?,file_location=?,will_student=?,country=?,tags=? WHERE id=(?)";
                                    $sql=mysqli_prepare($conn, $stmt);
                                
                                    //binding the parameters to prepard statement
                                    if ($_POST["will_student_input"]) {
                                        $will_student=1;
                                    } else {
                                        $will_student=0;
                                    }
                                
                                    $doc_name=$_POST["doc_name"];

                                    $file_lo="admin/".$fileNameNew;
                                    mysqli_stmt_bind_param($sql,"ssiisi",$doc_name,$file_lo,$will_student,$_POST['country'],$_POST['taginput1'],$_POST['doc_id']);
                                
                                    $result=mysqli_stmt_execute($sql);
                                
                                    if ($result) {
                                        echo '<script>
                                        alert("Successfully!! Updated the details.");
                                        window.location.href="../../frontend/admin/dashboard.php";;
                                        </script>';
                                    } 
                                    else {
                                    echo mysqli_error($conn);
                                
                                        echo '<script>
                                        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                        window.location.href="../../frontend/admin/dashboard.php";;
                                        <script>';
                                    }
                        }

                        else {
                            // error is due to larger file
                            $fileSizeInMb=$fileSize/1000;
                        
                            echo '<script>
                            alert("Your file size is'. $fileSizeInMb.'kb. Only file sizes less than 6MB are supported.");
                            window.location.href="../../frontend/admin/dashboard.php";;
                            </script>';
                        }

                }
                else{
                    echo $fileError;
                    echo '<script>
                    alert("Sorry there is an error in your file ->'.$fileError.'");
                    window.location.href="../../frontend/admin/dashboard.php";;
                    </script>';
                }
            }
            else {
                echo '<script>
                alert("Your file of type *'.end($fileExt).'* . This type of File formate is not supported.");
                window.location.href="../../frontend/admin/dashboard.php";;
                </script>';
            }
         }
         
       }
       
    
}


?>