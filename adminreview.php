<?php
session_start();
$isse = false;
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
    { 
        $isse = true;
        session_destroy();
         header("location: adminlogin.php");  
    }

    if(isset($_GET['delete']))
    {
      include 'partials/_dbconnect.php';
        $sno = $_GET['delete'];
        // echo $sno;

        $sql = "DELETE FROM `book review` WHERE `book review`.`review_id` = '$sno'";
        $query_run = mysqli_query($conn,$sql);
    }
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #c9a030; height: 60px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-book">Books</i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="admin.php" style="font-size:20px">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminbook.php" style="font-size:20px">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminreview.php" style="font-size:20px">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminblog.php" style="font-size:20px">Blogs</a>
                    </li>
                </ul>



                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </form>

                <a href="adminlogout.php" class="fas fa-sign-out-alt"
                    style="text-decoration:none;color:black;margin-left:20px;font-size:30px;"></a>

            </div>
        </div>
    </nav>

    <div class="container my-5" >
    <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sr.No.</th>
      <th scope="col">Book_Id</th>
      <th scope="col">User_Id</th>
      <th scope="col">User Name</th>
      <th scope="col">Review</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    
      <?php

        include 'partials/_dbconnect.php';
        $sql = "SELECT * FROM `book review`";
        $result = mysqli_query($conn, $sql);
        $srno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $srd = $row['review_id'];
          // echo $srd;
          $srno = $srno + 1;
          echo '
          <tr>
            <th scope="row">'.$srno.'</th>
            <td>'.$row['book_id'].'</td>
            <td>'.$row['user_id'].'</td>
            <td>'.$row['uname'].'</td>
            <td>'.$row['review'].'</td>
            <td>
            <button class="delete btn btn-danger" id=d'.$row["review_id"].'>Delete</button>
            </td>
            </tr>
            ';
        }
    ?>

  
  </tbody>
</table>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
          element.addEventListener("click", (e)=>{
            console.log("edit",);
            
            sno = e.target.id.substr(1,);
            if(confirm("Do you want to delete record"))
            {
              console.log("yes");
              window.location = `/project2/adminreview.php?delete=${sno}`;
            }
            else{
              console.log("no");
            }
          })
        })


    </script>



</body>

</html>