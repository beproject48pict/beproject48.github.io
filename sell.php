<?php
    session_start();
    $isse = false;
   
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
    { 
        $isse = true;
        session_destroy();
        // header("location: loginpage.php");  
    }
    $show_message = false;

    if(isset($_POST['booksubmit']))
    {
        include 'partials/_dbconnect.php';

        $bookname = $_POST['bookname'];
        $authorname = $_POST['authorname'];
        $pubname = $_POST['pubname'];
        $bdesc = $_POST['descrip'];
        $bprice = $_POST['bprice'];
        $pickadd = $_POST['pickadd'];
        $bookimage = $_FILES['bookimage']['name'];
        $bookuserid = $_SESSION['userid'];

        $allowed_extensions = array('png', 'jpg', 'jpeg');
        $filename = $_FILES['bookimage']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($file_extension,$allowed_extensions))
        {
            $show_message = true;
        }
        else
        {
            $query = "INSERT INTO `bookorder` (`bookname`, `authorname`, `publication`,`descrip`, `price`, `paddress`, `bookimage`, `user_id`, `doo`) VALUES ('$bookname', '$authorname', '$pubname', '$bdesc','$bprice', '$pickadd', '$bookimage', '$bookuserid', current_timestamp())";
            $query_run = mysqli_query($conn,$query);

            if($query_run)
            {
                // echo 'image stored succefully';
                move_uploaded_file($_FILES["bookimage"]["tmp_name"],"uploadimg/".$_FILES["bookimage"]["name"]);
            }
            else
            {
              echo 'image not stored';
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
    <title>Sell Books</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php  
        include 'partials/_header.php';
      ?>

    <?php
      if($show_message)
      {
          echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <strong>Only jpg, jpeg, png type files except</strong> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }

      ?>


    <!-- sell section starts -->

    <div class="sell-form-container">
        <form action="/project2/sell.php" method="post" enctype="multipart/form-data">
            <h3>Sell your books easily</h3>
            <span>Book Name</span>
            <input type="text" name="bookname" required class="box" id="">
            <span>Author Name</span>
            <input type="text" name="authorname" required class="box" id="">
            <span>Publication Name</span>
            <input type="text" name="pubname" required class="box" id="">
            <span>Book Description</span>
            <textarea type="text" name="descrip" required class="box" id="" maxlength="100000"></textarea>
            <span>Price</span>
            <input type="text" name="bprice" required class="box" id="">
            <span>Pick up address</span>
            <input type="text" name="pickadd" required class="box" id="">
            <span>Upload your books photo</span>
            <input type="file" name="bookimage" required class="file-upload-input" accept="image/*">

            <?php if(!$isse){  ?>
            <input type="submit" name="booksubmit" value="submit" class="btn">
            <?php } ?>
        </form>
    </div>




    <!-- sell section ends -->
    <!-- footer section -->

    <?php  
        include 'partials/_footer.php';
      ?>


    <!-- footer section ends -->




    <!-- bootstrap javascript -->
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