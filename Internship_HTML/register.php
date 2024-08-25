<?php
$servername = "localhost";
$username = "root";  // Replace with your actual MySQL username
$password = "";  // Replace with your actual MySQL password
$dbname = "mydatabase";              // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$password = $_POST['password'];
$reenter = $_POST['reenter'];

$query = "SELECT * FROM register WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Username already exists, inform the user
    echo "Username '$username' is not available.";
} 
else {
    $sql = "INSERT INTO register (username,email,phonenumber,password) VALUES ('$username','$email','$phonenumber','$password')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>