<?php
    session_start();
    $isse = false;
   
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    { 
        $isse = true;
        session_destroy();
        // header("location: loginpage.php");  
    }
    
    if(isset($_POST['placebtn']))
    {
        $paym = $_POST['pay'];
        $id = $_GET['order_id'];
        $addre= $_GET['addre'];
        $priceb = $_GET['price'];
        if($paym == 'cod' )
        {
            header("location:place.php?order_id=$id&addre=$addre&price=$priceb");
        }
        else{
            header("location:nb.php?order_id=$id&addre=$addre&price=$priceb");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />



    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>

<body class="bg-light">

    <?php  
      
        include 'partials/_dbconnect.php';
        $id = $_GET['order_id'];
        $userid = $_SESSION['userid'];
        $sql = "SELECT * FROM `bookorder` where order_id=$id";
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){;
        $bookimage = $row['bookimage'];
        $bookn = $row['bookname'];
        $author = $row['authorname'];
        $publi = $row['publication'];
        $priceb = $row['price'];
        }
      

        if(isset($_POST['changebtn']))
        {
            $addre = $_POST['addre'];
        }
        else{
            $addre = $_SESSION['addre'];
        }

       
      ?>
        
    

    <div class="mb-5" style="background-color:#c9a030;height:50px;">
        <a href="index.php" class="logo" style="text-decoration:none;color:#444;font-size:35px; margin-left:15px;"><i
                class="fas fa-book">Books</i></a>
    </div>

    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div>
                    <div style="color:#c9a030;height:27px;">
                        <h6 class="" style="font-size:20px;margin-top:20px;">1)Order Summary</h6>
                    </div>
                    <hr>
                    <div class="border rounded">
                        <div class="row bg-white">
                            <?php echo'<div class="col-md-3 pl-0">
                                <img src="uploadimg/'.$bookimage.'" alt="image" class="img-fluid"
                                    style="height: 220px;width:150px;">
                            </div>
                            <div class="col-md-6" style="height: 220px;">

                                <h5 class="pt-2 mt-4" style="font-size:20px;">'.$bookn.'</h5>

                                <h6 class="text-secondary my-2" style="font-size:15px;">'.$author.'</h6>
                                <h6 class="text-secondary my-2" style="font-size:15px;">'.$publi.'</h6>
                                <h5 class="pt-2 my-2" style="font-size:17px"><i class="fas fa-rupee-sign">'.$priceb.'</i></h5>

                            </div>';?>
                            

                        </div>
                    </div>
                    <div style="color:#c9a030;height:27px; margin-top:30px;">
                        <h6 class="" style="font-size:20px;margin-top:20px;">2)Address Details</h6>
                    </div>
                    <hr>
                    <div>
                        <?php
                            echo '<h6 class="my-10 bg-white" style="font-size:17px;">'.$addre.'</h6>';
                         ?>
                        
                        <h6 class="my-10" style="font-size:15px;margin-botton:5px">Do you want to change address?</h6>
                        <form action="/project2/buy.php?order_id=<?php echo $id ?>" method="post">
                            <textarea name="addre" id="" cols="170" rows="10"></textarea>
                            <button type="submit" class="btn" name="changebtn">Change</button>
                        </form>
                    </div>
                    <div style="color:#c9a030;height:27px; margin-top:30px;">
                        <h6 class="" style="font-size:20px;margin-top:25px;">3)Payement Option</h6>  
                     </div>
                     <hr>
                    <div class="" style="margin-top:20px;">
                        <form action="/project2/buy.php?order_id=<?php echo $id?>&addre=<?php echo $addre ?>&price=<?php echo $priceb ?>" method="post">
                            <input type="radio" id="cod" name="pay" value="cod">
                            <label for="pay" style="font-size:15px;color:black;margin-top:5px;">Cash on Delivery</label><br>
                            <input type="radio" id="Wallet" name="pay" value="Wallet" disabled>
                            <label for="pay" style="font-size:15px;color:black;margin-top:5px;">Wallet</label><br>
                            <input type="radio" id="upi" name="pay" value="upi" disabled>
                            <label for="pay" style="font-size:15px;color:black;margin-top:5px;">UPI</label><br>
                            <input type="radio" id="crd" name="pay" value="Credit card/ debit card" disabled>
                            <label for="pay" style="font-size:15px;color:black;margin-top:5px;" >Credit card/Debit card</label><br>
                            <input type="radio" id="nb" name="pay" value="nb">
                            <label for="pay" style="font-size:15px;color:black;margin-top:5px;">Net Banking</label><br>
                            <div style="margin-top:20px;margin-bottom:10px">
                              <button type="submit" class="btn" name="placebtn">Continue</button>
                            </div>
                        </form>
                    </div>
                
                    
                        
                           
                  
                </div>

                
            </div>
            <div class="col-md-4 offset-md-1 border rounded bg-white h-25" style="margin-top:50px;">
                <div class="pt-4">
                    <h6 style="font-size:20px">Price Details</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                           
                            <h6 style="font-size:15px;">Price(1 item)</h6>
                            <h6 style="font-size:15px;">Delivery Charges</h6>
                            <hr>
                            <h6 style="font-size:15px;">Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6 style="font-size:15px;"><i class="fas fa-rupee-sign"></i><?php echo $priceb ?></h6>
                            <h6 class="text-success" style="font-size:15px;">Free</h6>
                            <hr>
                            <h6 style="font-size:15px;"><i class="fas fa-rupee-sign"></i><?php echo $priceb ?></h6>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

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