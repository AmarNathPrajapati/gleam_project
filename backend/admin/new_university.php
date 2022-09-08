<?php



if (isset($_POST["country"]) && isset($_POST["university"])  ) {
    include('../config.php');
    session_start();

    $file_count=count($_POST['doc_name']);
    
      
    $stmt="INSERT INTO `universities` 
    (country_name,university_name,university_no) VALUES (?,?,?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    mysqli_stmt_bind_param($sql,"ssi",
    $_POST['country'],$_POST['university'],$university_no);

    $university_no=time();

    $result=mysqli_stmt_execute($sql);
    if ($result) {
        
        mysqli_stmt_close($sql);

        $stmt="SELECT id FROM `universities` WHERE university_no=(?) LIMIT 1";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"i",$university_no);
        $result=mysqli_stmt_execute($sql);

        if ($result) {

            $data=mysqli_stmt_get_result($sql);
            $row=mysqli_fetch_array($data);
            $university_id=$row['id'];
            mysqli_stmt_close($sql);

        } 
        else {
            echo mysqli_error($conn);
            mysqli_stmt_close($sql);
            echo '<script>
            alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
            window.location.href="../../frontend/admin/universities.php"
            <script>';
        }
        


        $doc_name=$_POST['doc_name'];
        
        for ($i=0; $i < $file_count; $i++) { 
               
                $stmt="INSERT INTO `universities_documents` (document_name,university_id) VALUES (?,?)";
                $sql=mysqli_prepare($conn, $stmt);

                
                mysqli_stmt_bind_param($sql,"si",$doc_name[$i],$university_id);
            
                $result=mysqli_stmt_execute($sql);
            
                if (!$result) {
                    echo mysqli_error($conn);
                    echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon.")
                    window.location.href="../../frontend/admin/universities.php";
                    <script>';
                }
            
        }

        echo '<script>
                        alert("Application Submitted");
                        window.location.href="../../frontend/admin/universities.php";
                        </script>';

    } 
    
    else {
        echo mysqli_error($conn);
        echo '<script>
        alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
        window.location.href="../../frontend/admin/universities.php"
        <script>';
    }

      
    
}
else{
    echo '<script>
    alert("Technical Issue.");
    window.location.href="../../frontend/admin/universities.php";
    </script>';   
}

?>