<?php
  include('../config.php');
  if (isset($_POST['country_name']) && isset($_POST['country_id'])) {

        $stmt="UPDATE `countries` SET country_name=? WHERE id=(?)";
        $sql=mysqli_prepare($conn, $stmt);
      
        //binding the parameters to prepard statement
        $timestamp=date("Y-m-d h:i:s");
        mysqli_stmt_bind_param($sql,"si",$_POST['country_name'],$_POST['country_id']);
    
    
    
        $result=mysqli_stmt_execute($sql);
        if ($result) {
            mysqli_stmt_close($sql);
            mysqli_close($conn);
            echo "<script>
                        window.location.href='../../frontend/admin/countries.php';
                        </script>";
        } 
        else {
            echo mysqli_error($conn);
            mysqli_stmt_close($sql);
            mysqli_close($conn);
            echo "<script>alert('Sorry!! something went wrong.".mysqli_error($conn)."');
            window.location.href='../../frontend/admin/countries.php';
            </script>";
        }
  } 
  elseif(isset($_POST['new_country_name'])){
        $stmt="INSERT INTO `countries` (country_name) VALUES (?)";
        $sql=mysqli_prepare($conn, $stmt);
    
        //binding the parameters to prepard statement
        mysqli_stmt_bind_param($sql,"s",$_POST['new_country_name']);
    
        $result=mysqli_stmt_execute($sql);
        if ($result) {
          mysqli_stmt_close($sql);
          mysqli_close($conn);
          echo "<script>alert('Succeessfully Added New Country');
          window.location.href='../../frontend/admin/countries.php';
       </script>";
        }
        else{
          mysqli_stmt_close($sql);
          mysqli_close($conn);
          echo "<script>alert('Sorry!! something went wrong.');
           window.location.href='../../frontend/admin/countries.php';
        </script>";
        }
  }
  else {
    
    if (isset($_POST['country_id'])) {
      $stmt="UPDATE `countries` SET deleted_at=? WHERE id=(?)";
    $sql=mysqli_prepare($conn, $stmt);

    //binding the parameters to prepard statement
    $timestamp=date("Y-m-d h:i:s");
    mysqli_stmt_bind_param($sql,"si",$timestamp,$_POST['country_id']);



    $result=mysqli_stmt_execute($sql);
    if ($result) {
        mysqli_stmt_close($sql);
        mysqli_close($conn);
        echo "<script>alert('Successfully removed.');
        window.location.href='../../frontend/admin/countries.php';
                    </script>";
        
    } 
    else {
        echo mysqli_error($conn);
        mysqli_stmt_close($sql);
        mysqli_close($conn);
        echo "<script>alert('Sorry!! something went wrong.".mysqli_error($conn)."');
        window.location.href='../../frontend/admin/countries.php';
        </script>";
    }
    } else {
      echo "<script>alert('Sorry!! something went wrong.');
        window.location.href='../../frontend/admin/countries.php';
        </script>";
    }
    
   
  }
  


?>