<?php

include('../config.php');

if ($_FILES["document"]) {

        $file=$_FILES['document'];
        // echo $file;
        // $fromlocation=$_POST["from_location"];
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
                        if(!is_dir($structure)){
                          
                            //Directory does not exist, so lets create it.
                            mkdir($structure, 0777, true);
                            $fileDestination=$structure."/".$fileNameNew;
                            move_uploaded_file($fileTmpName, $fileDestination);

                            $stmt="INSERT INTO `documents` (name,file_location,will_student,country,tags) VALUES (?,?,?,?,?)";
                            $sql=mysqli_prepare($conn, $stmt);
                        
                            //binding the parameters to prepard statement
                            if ($_POST["student"]) {
                                $will_student=1;
                            } else {
                                $will_student=0;
                            }
                            if ($_POST["doc_name"]) {
                                $doc_name=$_POST["doc_name"];
                            } else {
                                $doc_name="Not Available";
                            }
                            $file_lo="admin/".$fileNameNew;
                            mysqli_stmt_bind_param($sql,"ssiis",$doc_name,$file_lo,$will_student,$_POST['country'],$_POST['taginput1']);
                        
                            $result=mysqli_stmt_execute($sql);
                        
                            if ($result) {
                                echo '<script>
                            alert("Successfully!! Uploaded the file.");
                            window.location.href="../../frontend/admin/dashboard.php";
                            </script>';
                            } 
                            else {
                               echo mysqli_error($conn);
                        
                                echo '<script>
                                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                window.location.href="../../frontend/admin/new_document.php"
                                <script>';
                            }
                            
                          

                            
                        }
                        else{
                            $fileDestination=$structure."/".$fileNameNew;

                            move_uploaded_file($fileTmpName, $fileDestination);
                            $stmt="INSERT INTO `documents` (name,file_location,will_student,country,tags) VALUES (?,?,?,?,?)";
                            $sql=mysqli_prepare($conn, $stmt);
                        
                            //binding the parameters to prepard statement
                            if ($_POST["student"]) {
                                $will_student=1;
                            } else {
                                $will_student=0;
                            }
                            if ($_POST["doc_name"]) {
                                $doc_name=$_POST["doc_name"];
                            } else {
                                $doc_name="Not Available";
                            }
                            $file_lo="admin/".$fileNameNew;
                            mysqli_stmt_bind_param($sql,"ssiss",$doc_name,$file_lo,$will_student,$_POST['country'],$_POST['taginput1']);
                        
                            $result=mysqli_stmt_execute($sql);
                        
                            if ($result) {
                                echo '<script>
                                alert("Successfully!! Uploaded the file.");
                                window.location.href="../../frontend/admin/dashboard.php";
                                </script>';
                            } 
                            else {
                               echo mysqli_error($conn);
                        
                                echo '<script>
                                alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                                window.location.href="../../frontend/admin/new_document.php"
                                <script>';
                            }
                            
                            
                        }

                }

                else {
                    // error is due to larger file
                    $fileSizeInMb=$fileSize/1000;
                   
                    echo '<script>
                     alert("Your file size is'. $fileSizeInMb.'kb. Only less than 6MB files are supported.");
                     window.location.href="../../frontend/admin/new_document.php";
                    </script>';
                }

           }
           else{
            echo $fileError;
            echo '<script>
            alert("Sorry there is an error in your file ->'.$fileError.'");
            window.location.href="../../frontend/admin/new_document.php";
           </script>';
           }
       }
       else {
        echo '<script>
        alert("Your file of type *'.end($fileExt).'* . This type of File formate is not supported.");
        window.location.href="../../frontend/admin/new_document.php";
        </script>';
       }
    
}
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/admin/new_document.php";
    </script>';   
}

?>