<?php
$sever = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$con = mysqli_connect($sever, $username, $password, $dbname);
if (!$con) {
    echo "not connected";
}



$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";

$result = mysqli_query($con, $sql);
if ($result) {
    echo "data submited";
} else {
    echo "query faild....!";
}



?>