<!DOCTYPE html>
<html>
<head>
    <title>Simple Login System</title>
<style>
        body {
            font-family: Arial, sans-serif;
            
            text-align: left;
            background-image:url('login1.avif');
            background-size: cover;
            background-position: left;
            background-attachment: fixed;
            
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            background:white;
            padding: 25px;
            border-radius: 7px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        h2 {
            color: black;
            position: relative;
        }
        h2::before, h2::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 35%; 
            height: 10px;
            background-color:lightpink;
        }

        h2::before {
            left: 0;
        }

        h2::after {
            right: 0;
        }
        form ,label {
            display: block;
            margin: 10px 0;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 94.5%;
            padding:10px;
            margin: 5px 0;
            border: 1.9px solid black;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color:lightpink;
            color: #fff;
            padding: 10px 10px;
            border: none;
            border-radius: 3px;
            width:10rem;
            cursor: pointer;
            font-size: 15px;
            margin-top: 30px;
        }
        input[type="submit"]:hover {
            background-color: gray;
        }
        #error-message {
            color: red;
            display: none;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<?php
// Initialize variables for error and success messages
$error = "";
$success = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    // Your MySQL database credentials
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "demo";

   
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT password FROM test WHERE username = ?");
    $stmt->bind_param("s", $entered_username);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();


    if ($stored_password && password_verify($entered_password, $stored_password)) {
        $success = "Login Successful!";
    } else {
        $error = "Invalid username or password. Please try again.";
    }
    $conn->close();
}
?>
<div class="container">
<center><h2>Login</h2></center>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <center><input type="submit" value="Login"></center>
</form>

<?php
    if (!empty($error)) {
        echo '<div style="color: red;">' . $error . '</div>';
    }

    if (!empty($success)) {
        echo '<div style="color: green;">' . $success . '</div>';
    }
?>
</div>
</body>
</html>