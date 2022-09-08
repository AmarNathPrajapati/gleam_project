<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include('../config.php');
    session_start();
    $new_document=explode(',', $_POST['new_document']);
    $updated_document=explode(',', $_POST['updated_document']);
    $deleted_document=explode(',', $_POST['deleted_document']);

    $file_count=count($_FILES['document']['name']);

    for($i=0; $i<$file_count;$i++){
            // $file=$_FILES['document'][$i];
            $fileName=$_FILES['document']['name'][$i];
           if (!empty($fileName)) {
            $fileTmpName=$_FILES['document']['tmp_name'][$i];
            $fileSize=$_FILES['document']['size'][$i];
            $fileError=$_FILES['document']['error'][$i];
            $fileType=$_FILES['document']['type'][$i];
            $fileExt=explode('.',$fileName);
            $fileActualExt=strtolower(end($fileExt));
            $allowed=array('pdf','jpg','png','jpeg','docs','docx');
            $fileNameNew= $fileExt[0].uniqid('',true).".".$fileActualExt;
            if (in_array($fileActualExt,$allowed)) {
             if ($fileError==0) {
                    if ($fileSize<=6000000) {
                       $all_files=true;
                    }
                    else {
                        // error is due to larger file
                        $fileSizeInMb=$fileSize/1000;
                    
                        echo '<script>
                        alert("Your file size is'. $fileSizeInMb.'kb. Only file sizes less than 6MB file are supported.");
                        window.location.href="../../frontend/agent/dashboard.php";
                        </script>';
                    }

             }
             else{
                echo $fileError;
                echo '<script>
                alert("Sorry there is an error in your file ->'.$fileError.'");
                window.location.href="../../frontend/agent/dashboard.php";
              </script>';
             }
            }
            else {
                echo '<script>
                alert("Your file of type '.end($fileExt).' . This type of File formate is not supported.");
                window.location.href="../../frontend/agent/dashboard.php";
                </script>';
            }
           }
    }

    $stmt="UPDATE `applications_by_agents` SET name=?,email=?,phone=?,country_id=?,university_name=?,course_name=?,intake=? WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);
 
    $doc_name=$_POST["doc_name"];

    $name123=trim($_POST['name']);
    $email123=trim($_POST['email']);
    $phone123=trim($_POST['phone']);
    $country123=trim($_POST['country']);
    $university_name123=trim($_POST['university_name']);
    $application_id123=trim($_POST['application_id']);
    $course_name123=trim($_POST['course_name']);
    $intake123=trim($_POST['intake']);
    mysqli_stmt_bind_param($sql,"ssiisssi",$name123,$email123,$phone123,$country123,
    $university_name123,$course_name123,$intake123,$application_id123);

    $result=mysqli_stmt_execute($sql);

    if ($result) {
        mysqli_stmt_close($sql);

        $structure = '../../documents/agent/'.$_SESSION['agent_id'].'/'.trim($_POST['application_id']);
        if (!is_dir($structure)) {
            
            mkdir($structure, 0777, true);
        } 

        if (count($new_document)>0 && !empty($new_document[0])){
           foreach ($new_document as $key => $value) {
             $index=array_search($value, $_POST['doc_id']);
            

                $fileName=$_FILES['document']['name'][$index];
                $fileTmpName=$_FILES['document']['tmp_name'][$index];
                $fileSize=$_FILES['document']['size'][$index];
                $fileError=$_FILES['document']['error'][$index];
                $fileType=$_FILES['document']['type'][$index];
                $fileExt=explode('.',$fileName);
                $fileActualExt=strtolower(end($fileExt));
                $allowed=array('pdf','jpg','png','jpeg','docs','docx');
                $fileNameNew= $doc_name[$index]."_".time().".".$fileActualExt;

                $fileDestination=$structure."/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $stmt="INSERT INTO `application_documents` (application_id,document_name,document_location) VALUES (?,?,?)";
                $sql=mysqli_prepare($conn, $stmt);
            
                //binding the parameters to prepard statement
                $file_lo=$_SESSION['agent_id'].'/'.$application_id123."/".$fileNameNew;
                mysqli_stmt_bind_param($sql,"iss",$application_id123,$_POST['doc_name'][$index],$file_lo);
                $result=mysqli_stmt_execute($sql);

                if (!$result) {
                    echo "Error";
                    echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                    window.location.href="../../frontend/agent/dashboard.php";
                    <script>';
                }


           }
           mysqli_stmt_close($sql);
        }

        if (count($updated_document)>0 && !empty($updated_document[0])) {
            foreach ($updated_document as $key => $value) {
                $index=array_search($value, $_POST['doc_id']);
 
                 $fileName=$_FILES['document']['name'][$index];
                if (empty($fileName)) {
                    # code...
                    $stmt="UPDATE `application_documents` SET document_name=? WHERE id=?";
                    $sql=mysqli_prepare($conn, $stmt);
                
                    //binding the parameters to prepard statement
                    // $file_lo=$_SESSION['agent_id'].'/'.$application_id123."/".$fileNameNew;
                    mysqli_stmt_bind_param($sql,"ss",$_POST['doc_name'][$index],$_POST['doc_id'][$index]);
                    $result=mysqli_stmt_execute($sql);
                    if (!$result) {
                       echo "Error";
                       echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/agent/dashboard.php";
                       <script>';
                    }

                } 
                else {
                    $fileTmpName=$_FILES['document']['tmp_name'][$index];
                    $fileSize=$_FILES['document']['size'][$index];
                    $fileError=$_FILES['document']['error'][$index];
                    $fileType=$_FILES['document']['type'][$index];
                    $fileExt=explode('.',$fileName);
                    $fileActualExt=strtolower(end($fileExt));
                    $allowed=array('pdf','jpg','png','jpeg','docs','docx');
                    $fileNameNew= $doc_name[$index]."_".time().".".$fileActualExt;
    
                    $fileDestination=$structure."/".$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    if (!empty(trim($_POST['document_location'][$index])) ) {
                        unlink("../../documents/agent/".trim($_POST['document_location'][$index]));
                    }
    
                    $stmt="UPDATE `application_documents` SET document_name=?,document_location=? WHERE id=?";
                    $sql=mysqli_prepare($conn, $stmt);
                
                    //binding the parameters to prepard statement
                    $file_lo=$_SESSION['agent_id'].'/'.$application_id123."/".$fileNameNew;
                    mysqli_stmt_bind_param($sql,"ssi",$_POST['doc_name'][$index],$file_lo,$_POST['doc_id'][$index]);
                    $result=mysqli_stmt_execute($sql);
                    if (!$result) {
                        echo "Error";
                    }
                }
 
            }
            mysqli_stmt_close($sql);
        }

        if (count($deleted_document)>0 && !empty($deleted_document[0])){
            foreach ($deleted_document as $key => $value) {
              $index=array_search($value, $_POST['doc_id']);
             
                $stmt="SELECT document_location FROM application_documents WHERE id=? LIMIT 1";
                $sql=mysqli_prepare($conn, $stmt);
            
                //binding the parameters to prepard statement
                // $timestamp=date("Y-m-d H:i:s");
                mysqli_stmt_bind_param($sql,"i",$value);
                $result=mysqli_stmt_execute($sql);

                $data=mysqli_stmt_get_result($sql);
                if ($data->num_rows>0) {
                    $row=mysqli_fetch_array($data);
                   
                    
                    unlink("../../documents/agent/".$row['document_location']);
                    mysqli_stmt_close($sql);
                    
                    
                    $stmt="UPDATE `application_documents` SET deleted_at=? WHERE id=?";
                    $sql=mysqli_prepare($conn, $stmt);
                
                    //binding the parameters to prepard statement
                    $timestamp=date("Y-m-d H:i:s");
                    mysqli_stmt_bind_param($sql,"si",$timestamp,$value);
                    $result=mysqli_stmt_execute($sql);
                    if (!$result) {
                        mysqli_stmt_close($sql);
                       echo "Error";
                       echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon.")
                       window.location.href="../../frontend/agent/dashboard.php";
                       <script>';
                    }
                }
 
                    
            }
            mysqli_stmt_close($sql);
        }

        echo '<script>
        alert("Successfully!! Updated the details.");
        window.location.href="../../frontend/agent/dashboard.php";
        </script>';

    } 
    else {

       echo mysqli_error($conn);

        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
        window.location.href="../../frontend/agent/dashboard.php";
        <script>';
    }
}

?>