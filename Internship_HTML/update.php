<?php


$servername = "localhost";
$username = "root";  // Replace with your actual MySQL username
$password = "";  // Replace with your actual MySQL password
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and validate CSRF token from the query string
//$csrf_token = isset($_GET['csrf_token']) ? htmlspecialchars($_GET['csrf_token']) : '';
//echo 'Session Token: ' . htmlspecialchars($_SESSION['csrf_token']) . '<br>';
//echo 'GET Token: ' . $csrf_token . '<br>';
//$token = $csrf_token;

//if ($token !== $_SESSION['csrf_token']) {
  //  die('Invalid CSRF token');
//}

// Proceed with the update logic

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Fetch the existing record
    $stmt = $conn->prepare("SELECT * FROM crud WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $bio = $row['bio'];
        $address = $row['address'];
        $email = $row['email'];
    } else {
        header("Location: index.php");
        exit();
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate CSRF token in POST request
   

    if ($password) {
        $stmt = $conn->prepare("UPDATE crud SET name=?, bio=?, address=?, email=?, password=? WHERE username=?");
        $stmt->bind_param("ssssss", $name, $bio, $address, $email, $password, $username);
    } else {
        $stmt = $conn->prepare("UPDATE crud SET name=?, bio=?, address=?, email=? WHERE username=?");
        $stmt->bind_param("sssss", $name, $bio, $address, $email, $username);
    }

    if ($stmt->execute() === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update To-Do</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="container">
        <h1>Update To-Do</h1>
        <form method="post" action="update.php">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <input type="text" id="bio" name="bio" value="<?php echo htmlspecialchars($bio); ?>" required>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="password" id="password" name="password" placeholder="Enter new password if you want to change">
            <button type="submit" value="submit">Update</button>
        </form>
    </div>
</body>
</html>
