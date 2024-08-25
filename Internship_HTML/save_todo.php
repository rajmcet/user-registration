<?php
$servername = "localhost";
$username = "root";  // Replace with your actual MySQL username
$password = "";  // Replace with your actual MySQL password
$dbname = "mydatabase";

$servername1 = "localhost";
$username1 = "root";  // Replace with your actual MySQL username
$password1 = "";  // Replace with your actual MySQL password
$dbname1= "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn1 = new mysqli($servername1, $username1, $password1, $dbname1);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['new_username'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "SELECT * FROM register WHERE username = '$username'";
    $result = $conn1->query($query);
    if ($result->num_rows == 1){

        $stmt = $conn->prepare("INSERT INTO crud (username, name, bio, address, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $name, $bio, $address, $email, $password);

        if ($stmt->execute() === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
         $stmt->close();
    }
    else{
        echo"Invalid username";
    }


   
}

$conn->close();
?>
