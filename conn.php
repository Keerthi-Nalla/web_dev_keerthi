<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name=$_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email= $_POST['email'];
    $confirmPassword= $_POST['confirmPassword'];
    $phone = $_POST['phone']; 
    $bdate = $_POST['bdate']; 
    // Your MySQL database credentials
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "demo";

    // Create a database connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    // Insert user data into the database
    $sql = "INSERT INTO test (username, password,email,confirmPassword,phone,bdate) VALUES ('$username', '$password','$email','$confirmPassword','$phone','$bdate')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>