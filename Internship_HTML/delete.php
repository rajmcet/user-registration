<?php
$servername = "localhost";
$username = "root";  // Replace with your actual MySQL username
$password = "";  // Replace with your actual MySQL password
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);



// Proceed with delete logic

if(isset($_GET['username']))
{
    $user_id=$_GET['username'];

    $sql="DELETE FROM `crud` WHERE `username`='$user_id'";

    $result=$conn->query($sql);

    if($result==TRUE)
    {
        echo "Records deleted Successfully";
    }
    else
    {
        echo "Errors".$sql."<br>".$sql->error;
    }
}
?>