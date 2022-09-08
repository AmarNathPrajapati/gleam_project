<?php
 include('../config.php');
 session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    { 
        if ($_GET["doc_id"]) {
            $stmt="INSERT INTO `activity` (document_id,student_id,activity_type) VALUES (?,?,?)";
            $sql=mysqli_prepare($conn, $stmt);

            //binding the parameters to prepard statement
            mysqli_stmt_bind_param($sql,"iii",$_GET["doc_id"],$_SESSION["student_id"],$activity_type);
            $activity_type=1;
            $result=mysqli_stmt_execute($sql);
            
            if ($result) {
                mysqli_stmt_close($sql);
                mysqli_close($conn);
              header("location: ../../documents/".$_GET["doc_location"]);
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
            # code...
            mysqli_close($conn);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
            window.location.href="../../frontend/login.php"
            <script>';
        }
    }
    mysqli_close($conn);


?>