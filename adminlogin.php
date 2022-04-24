<?php
    $login = false;
    $showerror = false;
    $showerr = false;

    
   if($_SERVER['REQUEST_METHOD'] =='POST'){

       include 'partials/_dbconnect.php';

       $username = $_POST['username'];
       $passwor = $_POST['pass'];

      
       $sql = "SELECT * FROM `admin` where username='$username'";
       $result = mysqli_query($conn, $sql);
       $num = mysqli_num_rows($result);

       if($num == 1)
       {
           while($checkp = mysqli_fetch_assoc($result)){
               $pa = $checkp['passw'];
               if($passwor == $pa ){
                    $login = true;
                    echo 'Login successfully!!';
                    session_start();
                    $_SESSION['logged'] = true;
                    $_SESSION['user'] = $checkp['name'];
                    $_SESSION['sr'] = $checkp['admin_sr'];
                   
                    header("location: admin.php");
               }
               else{
                   echo 'Password Incorrect!!';
               }
           }
           
       }
       else{
        echo 'Invalid Credentials!!';
       }
     

   }   

   

       
     


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

    <style>
    .login-form-container {
        background-image:url(im-3.jpg);
       
    }
    </style>



</head>

<body>

    <?php  
        /*if($showerror)
        {
            echo'<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            <strong>Incorrect Password!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showerr)
        {
            echo'<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
            <strong>Username not available!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }*/
   ?>



    <div class="login-form-container">
        <form action="/project2/adminlogin.php" method="post">
            <h3>Admin Sign In</h3>
            <span>username</span>
            <input type="text" name="username" class="box" placeholder="enter your username" id="username">
            <span>password</span>
            <input type="password" name="pass" class="box" placeholder="enter your password" id="pass">

            <input type="submit" value="sign in" class="btn">

        </form>

    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>


    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- javascript file   -->
    <script src="script.js"></script>
</body>

</html>