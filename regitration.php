<?php
$servername = "localhost";
$username = "root";
$password = ""
$dbname = "lab_5b"

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $sconn->prepare("INSERT INTO users (matric, name, password, role) Values(?, ?, ?, ?)");
$stmt->bind_param("ssss", $matric, $name, $password, $role);

$matric = $_POST['matric'];
$name = $_POST['name'];
$passowrd = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>