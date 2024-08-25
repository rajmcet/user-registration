<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="dash.css">
</head>
<body>
    <div class="container">
        <h1>Crud Operation</h1>

        <!-- Logout Link -->
        <form action="logout.php">
            <div>
                <button style="margin-left: 20px;" type="submit" value="submit">Logout</button>
            </div>
        </form>

         <form action="index.html">
            <div>
                <button style="margin-left: 20px;" type="submit" value="submit">Calculate CGPA</button>
            </div>
        </form>

        <!-- Form to search for a username -->
        <form method="post" action="">
            <input type="text" id="username" name="username" placeholder="Enter username" required>
            <input type="password" id="user_password" name="user_password" placeholder="Enter password" required>
            <button type="submit" value="submit">Search</button>
        </form>

        <!-- Form to add new to-do item -->
        <form method="post" action="save_todo.php">
            <input type="text" id="new_username" name="new_username" placeholder="Enter username" required>
            <input type="text" id="name" name="name" placeholder="Enter to-do" required>
            <input type="text" id="bio" name="bio" placeholder="Enter bio" required>
            <input type="text" id="address" name="address" placeholder="Enter address" required>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
            <input type="password" id="password" name="password" placeholder="Enter password" required>
            <button type="submit" value="submit">Add</button>
        </form>

        <ul id="item-list">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['user_password'])) {
                $servername = "localhost";
                $db_username = "root";  // Replace with your actual MySQL username
                $db_password = "";  // Replace with your actual MySQL password
                $dbname = "mydatabase";
                $conn = new mysqli($servername, $db_username, $db_password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $username = $conn->real_escape_string($_POST['username']);
                $user_password = $conn->real_escape_string($_POST['user_password']);
                $sql = "SELECT * FROM crud WHERE username='$username' AND password='$user_password'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>";
                        echo "Username: " . htmlspecialchars($row['username']) . "<br>";
                        echo "Name: " . htmlspecialchars($row['name']) . "<br>";
                        echo "Bio: " . htmlspecialchars($row['bio']) . "<br>";
                        echo "Address: " . htmlspecialchars($row['address']) . "<br>";
                        echo "Email: " . htmlspecialchars($row['email']) . "<br>";
                        echo "Password: " . htmlspecialchars($row['password']) . "<br>";
                        echo "<a class='btn btn-info' href='update.php?username=" . urlencode($row['username']) .  "'>Edit</a> ";
                        echo "<a class='btn btn-danger' href='delete.php?username=" . urlencode($row['username']) . "'>Delete</a>";
                        echo "</li>";
                    }
                } else {
                    echo "<li>No items found or incorrect password</li>";
                }

                $conn->close();
            }
            ?>
        </ul>
    </div>
</body>
</html>
