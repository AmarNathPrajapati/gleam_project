

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <div class="container" style="width: 300px; margin: auto; text-align: center;">
        <form action="./update_password.php" style="text-align: center;" method="post">
            <?php
              include('../config.php');
            if (isset($_POST["email"])) {
                echo '<input hidden type="email" name="email" value="'.$_POST["email"].'">';
            } else {
                echo '<script>
                    alert("Something went wrong. We are facing some technical issue. It will be resolved soon. "'.mysqli_error($conn).')
                    window.location.href="../../frontend/login.php"
                    <script>';
            }
            
            
            ?>
            <h4 style="text-align: center; margin-bottom:20px;">Please enter new password.</h4>
            <input required type="password" style="padding:10px;" name="new_password">
            <button type="submit" style="background-color:blue; color:white; padding:10px; border:0px;">Submit</button>
        </form>
    </div>
    
</body>
</html>