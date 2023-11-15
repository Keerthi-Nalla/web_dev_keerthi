<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword= $_POST['confirmPassword'];
    $email= $_POST['email'];
    $Phone = $_POST['Phone'];
    $bdate = $_POST['bdate']; 
    // Your MySQL database credentials
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "demo";

    // Create a database connection
    $conn = new mysqli ($servername, $db_username, $db_password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Insert user data into the database
    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO test (name, username, $hashed_password, confirmPassword, email, Phone, bdate) VALUES ('$name', '$username', '$hashed_password', '$email', '$confirmPassword', '$Phone', '$bdate')";

    //$sql = "INSERT INTO test (name,username, password,email,confirmPassword,phone,bdate) VALUES ('$name','$username', '$password','$email','$confirmPassword','$phone','$bdate')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: login.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
else
{
    echo "gj";
}
?>