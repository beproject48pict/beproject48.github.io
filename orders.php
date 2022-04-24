<?php
    session_start();
    $isse = false;
   
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    { 
        $isse = true;
        session_destroy();
        // header("location: loginpage.php");  
    }

    if(isset($_GET['delete']))
    {
      include 'partials/_dbconnect.php';
        $sno = $_GET['delete'];
        // echo $sno;

        $sql = "DELETE FROM `place` WHERE `place`.`place_id` = '$sno'";
        $query_run = mysqli_query($conn,$sql);
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrivals</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

     <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
   

</head>
<body class="bg-light">

    <?php  
        include 'partials/_header.php';
      ?>    

<div class="container my-5" style="font-size:15px;" >
<table class="table" id="myTable" >
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">Book</th>
      <th scope="col">Author Name</th>
      <th scope="col">Address</th>
      <th scope="col">Payement Method</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    
      <?php

        include 'partials/_dbconnect.php';
        $sql = "SELECT * FROM `place`";
        $result = mysqli_query($conn, $sql);
        $srno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $useri   = $_SESSION['userid'];
          $srd = $row['place_id'];
          $ord = $row['order_id'];
          // echo $srd;
         
          if($useri == $row['user_id']){

            $sqli = "SELECT * FROM `bookorder` where order_id = '$ord'";
           $query_result = mysqli_query($conn, $sqli);
            $srno = $srno + 1;
            $check = mysqli_fetch_assoc($query_result);
          echo '
          <tr>
            <th scope="row">'.$srno.'</th>
            <td><img src=" uploadimg/'.$check['bookimage'].'" class="card-img-top" alt="Image not available" style="height:255px; width:178px"></td>
            <td>'.$check['authorname'].'</td>
            <td>'.$row['address'].'</td>
            <td>'.$row['paymentm'].'</td>
            <td>'.$row['price'].'</td>
            <td>
            <button class="delete btn btn-danger" id=d'.$row["place_id"].' >Delete</button>
            </td>
            </tr>
            ';
          }
        }
    ?>

  
  </tbody>
</table>

    </div>


    
    <!-- footer section -->

    <?php  
        include 'partials/_footer.php';
      ?>

<!-- footer section ends -->






<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
  $('#myTable').DataTable();
  } );
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- javascript file   -->
<script src="script.js"></script>

<script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
          element.addEventListener("click", (e)=>{
            console.log("edit",);
            
            sno = e.target.id.substr(1,);
            if(confirm("press button"))
            {
              console.log("yes");
              window.location = `/project2/orders.php?delete=${sno}`;
            }
            else{
              console.log("no");
            }
          })
        })


    </script>

</body>
</html>