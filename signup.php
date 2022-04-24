<?php
   $showalert = false;
   $showerror1 = false;
   $showerror2 = false;
   if($_SERVER['REQUEST_METHOD'] =='POST'){

       include 'partials/_dbconnect.php';

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $mobile = $_POST['mobno'];
        $email = $_POST['emailid'];
        $passwords = $_POST['passw'];
        $passcon = $_POST['passwc'];
        $address = $_POST['addr'];
        $dob = $_POST['dob'];
        
        $exitssql = " SELECT * FROM `signuptable` where email = '$email'";
        $result = mysqli_query($conn, $exitssql);
        $numrows = mysqli_num_rows($result);
        if($numrows>0)
        {
           $showerror2 = true;
        }
        else
        {
            if($passwords== $passcon){
                $hash = password_hash($passwords, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `signuptable` ( `name`, `surname`, `mobile`, `email`, `pass`, `addre`, `dob`) VALUES ( '$name', '$surname', '$mobile', '$email', '$hash', '$address', '$dob')";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showalert = true;
                }
            }
            else{
                $showerror1 = true;
            }
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    
    <link rel="stylesheet" href="style.css">
    
   
</head>
<body>

    <?php
        if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        <strong>Your Account Created Successfully!!</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showerror1){
            echo '<div class="alert alert-danger alert-dismissible fade show mb-0 " role="alert">
            <strong>Password did not match!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if($showerror2){
            echo '<div class="alert alert-danger alert-dismissible fade show mb-0 " role="alert">
            <strong>Email already in use, please use diffrent email id!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>
    <div class="signup-form-container">
        <form action="/project2/signup.php" method="post">
            <h1>Create a new account</h1>
            <h3>It's Quick and Easy</h3>
            <label for="name"><span>Name</span></label>
            <input type="text" name="name" class="box" placeholder="enter your name" id="name">
            <label for="surname"><span>Surname</span></label>
            <input type="text" name="surname" class="box" placeholder="enter your surname" id="surname">
            <label for="mobno"><span>Mobile No.</span></label>
            <input type="tel" name="mobno" class="box" placeholder="enter your mobile no." id="mobno" pattern="[0-9]{10}">
            <label for="emailid"><span>Email</span></label>
            <input type="email" name="emailid" class="box" placeholder="enter your email" id="emailid">
            <label for="passw"><span>Password</span></label>
            <input type="password" name="passw" class="box" placeholder="enter your password" id="passw">
            <label for="passwc"><span>Confirm Password</span></label>
            <input type="password" name="passwc" class="box" placeholder="Confirm Password" id="passwc">
            <label for="addr"><span>Address</span></label>
            <input type="text" name="addr" class="box" placeholder="enter your address" id="addr">

            <label for="dob"><span>Date of Birth</span></label>
            <input type="date" name="dob" id="dob">

            <input type="submit" value="Register" class="btn">

        </form>
      
    </div>
    
    <!-- bootstrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>



    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- javascript file   -->
<script src="script.js"></script>

</body>
</html>