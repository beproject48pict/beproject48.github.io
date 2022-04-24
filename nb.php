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
        $bank = $_POST['bank'];
        if($bank == 'hdfc')
        {
            header("location:https://netbanking.hdfcbank.com/netbanking/");
        }
        if($bank == 'boi')
        {
            header("location:https://starconnectcbs.bankofindia.com/BankAwayRetail/(S(ut1qtt55lpirgb45ws4gviny))/web/L001/retail/jsp/user/RetailSignOn.aspx?RequestId=47687909");
        }
        if($bank == 'axis')
        {
            header("location:https://retail.axisbank.co.in/wps/portal/rBanking/axisebanking/AxisRetailLogin/!ut/p/a1/04_Sj9CPykssy0xPLMnMz0vMAfGjzOKNAzxMjIwNjLwsQp0MDBw9PUOd3HwdDQwMjIEKIoEKDHAARwNC-sP1o_ArMYIqwGNFQW6EQaajoiIAVNL82A!!/dl5/d5/L2dBISEvZ0FBIS9nQSEh/");
        }
        if($bank == 'sbi')
        {
            header("location:https://retail.onlinesbi.com/retail/login.htm");
        }
        if($bank == 'icici')
        {
            header("location:https://www.icicibank.com/Personal-Banking/insta-banking/internet-banking/index.page");
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
        $addre= $_GET['addre'];
        $priceb = $_GET['price'];
        $userid = $_SESSION['userid'];
    
        $sqlq = "INSERT INTO `place` (`order_id`, `user_id`,`address`, `paymentm`,`price`,`doo`) VALUES ('$id', '$userid','$addre','nb','$priceb' ,current_timestamp())";
        $result = mysqli_query($conn,$sqlq);

    ?>

    <div class="mb-5" style="background-color:#c9a030;height:50px;">
        <a href="index.php" class="logo" style="text-decoration:none;color:#444;font-size:35px; margin-left:15px;"><i
                class="fas fa-book">Books</i></a>
    </div>

    <div style="margin-left:20px;">
        <form
            action="/project2/nb.php?order_id=<?php echo $id?>&addre=<?php echo $addre ?>&price=<?php echo $priceb ?>"
            method="post">
            <input type="radio" id="hdfc" name="bank" value="hdfc">
            <label for="bank" style="font-size:15px;color:black;margin-top:5px;">HDFC</label><br>
            <input type="radio" id="boi" name="bank" value="boi">
            <label for="bank" style="font-size:15px;color:black;margin-top:5px;">Bank of India</label><br>
            <input type="radio" id="axis" name="bank" value="axis">
            <label for="bank" style="font-size:15px;color:black;margin-top:5px;">Axis Bank</label><br>
            <input type="radio" id="sbi" name="bank" value="sbi">
            <label for="bank" style="font-size:15px;color:black;margin-top:5px;">SBI</label><br>
            <input type="radio" id="icici" name="bank" value="icici">
            <label for="bank" style="font-size:15px;color:black;margin-top:5px;">ICICI</label><br>
            <div style="margin-top:20px;margin-bottom:10px">
                <button type="submit" class="btn" name="placebtn">Continue</button>
            </div>
        </form>
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