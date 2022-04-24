<?php
    session_start();
    $isse = false;
   
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    { 
        $isse = true;
        session_destroy();
        // header("location: loginpage.php");  
    }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

   
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
  

   

</head>

<body>
    <?php
        include 'partials/_header.php';
        include 'partials/_dbconnect.php';
        $search =  $_GET['search'];
     ?>
     

    <div class="container my-4">
        <h3 style="margin-left: 120px;">Search results for <em>"<?php echo $search ?>"</em></h3>
          
        <div class="row">

            <?php 
            $per_page = 9;
            $start = 0;
            $current_page = 1;

            if(isset($_GET['start'])){
                $start = $_GET['start'];
                if($start<=0)
                {
                    $start = 0;
                    $current_page = 1;
                }
                else{
                    $current_page = $start;
                    $start--;
                    $start = $start*$per_page;
                }
            }
            $search = $_GET['search'];
            $record = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `bookorder` where match(bookname,authorname,publication) against ('$search')"));
            $pagi = ceil($record/$per_page);

           
            $sql = "SELECT * FROM `bookorder` where match(bookname,authorname,publication) against ('$search') limit $start,$per_page ";
            $result = mysqli_query($conn, $sql);


            if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="col-md-4 my-3" >
                <div class="card mx-auto h-100" style="width: 18rem;">
                    <img src="<?php echo "uploadimg/".$row['bookimage']; ?>" class="card-img-top" alt="Image not available" style="height:255px; width:178px">
                    <div class="card-body" >
                        <h3 class="card-title"><?php echo $row['bookname'];?></h3>
                        <h4 class="card-title"><?php echo $row['authorname'];?></h4>
                        <h4 class="card-text"><?php echo $row['publication']; ?></h4>
                        <h4 class="card-title">Rs.<?php echo $row['price']; ?></h4>
                        
                    </div>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
                </div>
            </div> 
            <?php
                }
                }
                else{
                echo ' <div style="margin-left:120px;font-size:30px">No Records Found </div>';
                }
            ?>

        </div>
       
        <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center fs-3 my-3">
        <?php 
            $nextp = $current_page;
            $prev = $current_page;
            $prev--;
            $nextp++;
            ?>
            <?php 
            $class2 = "";
            if($current_page==1) {
                $class2 = "disabled";
            }
            ?>
        <li class="page-item <?php echo $class2?>">
        <a class="page-link text-dark" href="?start=<?php echo $prev?>&search=<?php echo $search?>">Previous</a>
        </li>

        <?php for($i=1;$i<=$pagi;$i++)  { 
            $class="";
            if($current_page==$i)
            {
                $class = "active";
            }  
            ?>
        <li class="page-item <?php echo $class?> " ><a class="page-link text-dark" <?php if($class=="active"){?>style="background-color:#c9a030;" <?php }  ?>   href="?start=<?php echo $i ?>&search=<?php echo $search?>"><?php echo $i ?></a></li>
        <?php } ?>


        <?php 
            $class1 = "";
            if($pagi==$current_page) {
                $class1 = "disabled";
            }
            ?>
        <li class="page-item <?php echo $class1?>">
        <a class="page-link text-dark" href="?start=<?php echo $nextp ?>&search=<?php echo $search?>">Next</a>
        </li>
        </ul>

        </nav>
    </div>



     <?php
        include 'partials/_footer.php';
     ?>
    
</body>