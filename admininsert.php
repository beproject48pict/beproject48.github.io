<?php

include 'partials/_dbconnect.php';
$hash = password_hash("12356", PASSWORD_DEFAULT);
$sql = "INSERT INTO `admin` ( `name`, `username`, `passw`, `mobile`) VALUES ( 'sumedh', 'sumedh1', '$hash', '7894561230')";
$result = mysqli_query($conn, $sql);

?>  