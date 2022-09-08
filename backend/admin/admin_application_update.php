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
                        alert("Your file size is'. $fileSizeInMb.'kb. Only file sizes less than 6MB are supported.");
                        window.location.href="../../frontend/admin/manage_agent.php";
                        </script>';
                    }

             }
             else{
                echo $fileError;
                echo '<script>
                alert("Sorry there is an error in your file ->'.$fileError.'");
                window.location.href="../../frontend/admin/manage_agent.php";
              </script>';
             }
            }
            else {
                echo '<script>
                alert("Your file of type '.end($fileExt).' . This type of File formate is not supported.");
                window.location.href="../../frontend/admin/manage_agent.php";
                </script>';
            }
           }
    }

    $stmt="UPDATE `applications_by_agents` SET name=?,email=?,phone=?,country_id=?,university_name=?,course_name=?,intake=?,status=? 
    WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);
 
    $doc_name=$_POST["doc_name"];

    // $file_lo="admin/".$fileNameNew;
    mysqli_stmt_bind_param($sql,"ssiisssii",$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['country'],
    $_POST['university_name'],$_POST['course_name'],$_POST['intake'],$_POST['status'],$_POST['application_id']);

    $result=mysqli_stmt_execute($sql);

    if ($result) {
        if ($_POST['status']!=$_POST['old_status']) {
            $stmt="SELECT status_name FROM status_assumptions WHERE status_number=? AND deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['status']);
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
            if ($data22->num_rows>0) {
            
                 $status_row=mysqli_fetch_array($data22);
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);

                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/admin/manage_agent.php";
                       <script>';
            }

            $stmt="SELECT name,email FROM users WHERE id=? AND deleted_at IS NULL LIMIT 1";
            $sql123=mysqli_prepare($conn, $stmt);
    
            mysqli_stmt_bind_param($sql123,'i',$_POST['agent_id123']);
            $result=mysqli_stmt_execute($sql123);
            $data22= mysqli_stmt_get_result($sql123);
            if ($data22->num_rows>0) {
                 $user_row=mysqli_fetch_array($data22);
                 mysqli_stmt_close($sql123);
            }
            else{
                mysqli_stmt_close($sql123);
                  echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/admin/manage_agent.php";
                       <script>';
            }
            

            $emailto=$user_row["email"];
            $name=$user_row["name"];
            // $mail_subject="Application Status Update ".$_POST['application_id']." status updated to ".$status_row['status_name'];
            $mail_subject="Application Status Update #".$_POST['application_id'];

            $mail_message="<div class='conatiner-fluid'><p class='p-0'>The application of the below student which you have submitted has 
            been updated with following Status.</p></div>".
            "<br>".
            "<br>".
            '<div class="conatiner-fluid">
                <div class="row">
                <table class="table table-striped">
                <thead>
                  <tr>
                    <th>CAMS ID</th>
                    <th>Student Name</th>
                    <th>University Name</th>
                    <th>Course Name</th>
                    <th>New Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><p>'.$_POST['application_id'].'</p></td>
                    <td><p>'.$_POST['name'].'</p></td>
                    <td><p>'.$_POST['university_name'].'</p></td>
                    <td><p>'.$_POST['course_name'].'</p></td>
                    <td><p>'.$status_row['status_name'].'</p></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p>You can login to your portal for further action.</p>';
            require("../mailer_code/sendmail.php");
        }
        mysqli_stmt_close($sql);

        $structure = '../../documents/agent/'.$_POST['agent_id123'].'/'.$_POST['application_id'];
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
                $file_lo=$_POST['agent_id123'].'/'.$_POST['application_id']."/".$fileNameNew;
                mysqli_stmt_bind_param($sql,"iss",$_POST['application_id'],$_POST['doc_name'][$index],$file_lo);
                $result=mysqli_stmt_execute($sql);

                if (!$result) {
                    echo "Error";
                    echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                    window.location.href="../../frontend/admin/manage_agent.php";
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
                    // $file_lo=$_POST['agent_id123'].'/'.$_POST['application_id']."/".$fileNameNew;
                    mysqli_stmt_bind_param($sql,"ss",$_POST['doc_name'][$index],$_POST['doc_id'][$index]);
                    $result=mysqli_stmt_execute($sql);
                    if (!$result) {
                       echo "Error";
                       echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/admin/manage_agent.php";
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

                    if (!empty($_POST['document_location'][$index]) ) {
                        unlink("../../documents/agent/".$_POST['document_location'][$index]);
                    }
    
                    $stmt="UPDATE `application_documents` SET document_name=?,document_location=? WHERE id=?";
                    $sql=mysqli_prepare($conn, $stmt);
                
                    //binding the parameters to prepard statement
                    $file_lo=$_POST['agent_id123'].'/'.$_POST['application_id']."/".$fileNameNew;
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
                // $timestamp=date("Y-m-d h:i:sa");
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
                    $timestamp=date("Y-m-d h:i:sa");
                    mysqli_stmt_bind_param($sql,"si",$timestamp,$value);
                    $result=mysqli_stmt_execute($sql);
                    if (!$result) {
                        mysqli_stmt_close($sql);
                       echo "Error";
                       echo '<script>
                       alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                       window.location.href="../../frontend/admin/manage_agent.php";
                       <script>';
                    }
                }
 
                    
            }
            mysqli_stmt_close($sql);
        }

        echo '<script>
        alert("Successfully!! Updated the details.");
window.location.href="../../frontend/admin/manage_agent.php";
</script>';

    } 
    else {

       echo mysqli_error($conn);

        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
        window.location.href="../../frontend/admin/manage_agent.php";
        <script>';
    }
}

?>