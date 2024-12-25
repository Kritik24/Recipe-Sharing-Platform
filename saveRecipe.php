<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeName = $_POST['foodName'];
    $ingredients = $_POST['foodDetails'];
    $steps = $_POST['steps'];

    $sql = "INSERT INTO recipe ( Recipe_Name,Ingredients, Steps) VALUES ('$recipeName', '$ingredients', '$steps')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Recipe added successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }
}

$conn->close();
?>