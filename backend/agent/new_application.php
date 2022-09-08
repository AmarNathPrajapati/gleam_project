<?php



if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["country"]) && isset($_POST["university"])  ) {
    include('../config.php');
    session_start();

    $file_count=count($_FILES['document']['name']);
    for($i=0; $i<$file_count;$i++){
        if (isset($_FILES['document']['name'][$i]) && $_FILES['document']['name'][$i]!=null) {
            $fileName=$_FILES['document']['name'][$i];
            $fileTmpName=$_FILES['document']['tmp_name'][$i];
            $fileSize=$_FILES['document']['size'][$i];
            $fileError=$_FILES['document']['error'][$i];
            $fileType=$_FILES['document']['type'][$i];
            $fileExt=explode('.',$fileName);
            $fileActualExt=strtolower(end($fileExt));
            $allowed=array('pdf','jpg','png','jpeg','docs','docx');
            $fileNameNew= $fileExt[0].uniqid('',true).".".$fileActualExt;
            if (in_array($fileActualExt,$allowed)){
                if ($fileError==0) {
                        if ($fileSize<=6000000) {
                          $all_files=true;
                        }
                        else {
                            // error is due to larger file
                            $fileSizeInMb=$fileSize/1000;
                        
                            echo '<script>
                            alert("Your file size is'. $fileSizeInMb.'KB. Only files less than 6MB are supported.");
                            window.location.href="../../frontend/agent/new_application.php";
                            </script>';
                        }

                }
                else{
                    echo $fileError;
                    echo '<script>
                    alert("Sorry there is an error in your file ->'.$fileError.'");
                    window.location.href="../../frontend/agent/new_application.php";
                </script>';
                }
            }
            else {
                echo '<script>
                    alert("Your file is of type *'.end($fileExt).'* . This type of File formate is not supported.");
                    window.location.href="../../frontend/agent/new_application.php";
                </script>';
            }
        }
           
    }
    
      
    $stmt="INSERT INTO `applications_by_agents` 
    (agent_id,name,email,phone,country_id,university_name,course_name,intake,application_no) VALUES (?,?,?,?,?,?,?,?,?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    mysqli_stmt_bind_param($sql,"issiissss",$_SESSION['agent_id'],$_POST['name'],$_POST['email'],$_POST['phone'],
    $_POST['country'],$_POST['university'],$_POST['course_name'],$_POST['intake'],$application_no);

    $application_no=time();

    $result=mysqli_stmt_execute($sql);
    if ($result) {
        
        mysqli_stmt_close($sql);

        $stmt="SELECT id FROM `applications_by_agents` WHERE application_no=(?) LIMIT 1";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"i",$application_no);
        $result=mysqli_stmt_execute($sql);

        if ($result) {

            $data=mysqli_stmt_get_result($sql);
            $row=mysqli_fetch_array($data);
            $application_id=$row['id'];
            mysqli_stmt_close($sql);

        } 
        else {
            echo mysqli_error($conn);
            mysqli_stmt_close($sql);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
            window.location.href="../../frontend/agent/new_application.php"
            <script>';
        }
        

        $structure = '../../documents/agent/'.$_SESSION['agent_id'].'/'.$application_id;
        if (!is_dir($structure)) {
            mkdir($structure, 0777, true);
        } 

        $doc_name=$_POST['doc_name'];
        
        for ($i=0; $i < $file_count; $i++) { 
            if (isset($_FILES['document']['name'][$i]) && $_FILES['document']['name'][$i]!=null) {
                $fileName=$_FILES['document']['name'][$i];
                $fileTmpName=$_FILES['document']['tmp_name'][$i];
                $fileSize=$_FILES['document']['size'][$i];
                $fileError=$_FILES['document']['error'][$i];
                $fileType=$_FILES['document']['type'][$i];
                $fileExt=explode('.',$fileName);
                $fileActualExt=strtolower(end($fileExt));
                $allowed=array('pdf','jpg','png','jpeg','docs','docx');
                $fileNameNew= $doc_name[$i]."_".time().".".$fileActualExt;

                $fileDestination=$structure."/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $stmt="INSERT INTO `application_documents` (application_id,document_name,document_location) VALUES (?,?,?)";
                $sql=mysqli_prepare($conn, $stmt);

                $file_lo=$_SESSION['agent_id'].'/'.$application_id."/".$fileNameNew;
                mysqli_stmt_bind_param($sql,"iss",$application_id,$doc_name[$i],$file_lo);
            
                $result=mysqli_stmt_execute($sql);
            
                if (!$result) {
                    echo mysqli_error($conn);
                    echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon.")
                    window.location.href="../../frontend/admin/new_document.php";
                    <script>';
                }
            }

        }

        echo '<script>
                        alert("Application Submitted");
                        window.location.href="../../frontend/agent/dashboard.php";
                        </script>';

    } 
    
    else {
        echo mysqli_error($conn);
        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
        window.location.href="../../frontend/agent/new_application.php"
        <script>';
    }

      
    
}
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/agent/new_application.php";
    </script>';   
}

?>