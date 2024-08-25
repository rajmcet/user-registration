<?php
// Retrieve form data using $_POST superglobal

    // Database connection parameters
    $host = "localhost";  // Replace with your MySQL host
    $user = "root";  // Replace with your MySQL username
    $password_db = "";  // Replace with your MySQL password
    $database = "mydatabase";  // Replace with your MySQL database name


    $host1 = "localhost";  // Replace with your MySQL host
    $user1 = "root";  // Replace with your MySQL username
    $password_db1 = "";  // Replace with your MySQL password
    $database1 = "mydatabase";

    // Establish a connection to MySQL
    $conn = new mysqli($host, $user, $password_db, $database);

    $conn1 = new mysqli($host1, $user1, $password_db1, $database1);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to check if user exists
    // Sanitize user inputs
// No need to escape since it's not directly used in SQL

// Query to check if the username exists

$username = $_POST['username'];
$password = $_POST['password'];

// Query to retrieve hashed password from database
$query = "SELECT password FROM register WHERE username = '$username'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $hashedPasswordFromDB = $user['password'];

    // Verify password
    if (($password===$hashedPasswordFromDB)) {
        // Password is correct, login successful
        
        header("Location: index.php");
        $sql1 = "INSERT INTO login (username,password) VALUES ('$username','$password')";
        if($conn1->query($sql1)===TRUE){
            echo"Login Information is added";
        }
        // Redirect or set session variables
    } else {
        // Password is incorrect
        echo "Login failed. Incorrect password.";
    }
} else {
    // Username not found
    echo "Login failed. Username '$username' not found.";
}


$conn ->close();
?>