<!DOCTYPE html>
<html>
<head>
    <title>Simple Login System</title>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color:darkcyan;
            text-align: left;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            background: white;
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
            background-color: darkcyan;
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
            background-color: darkcyan;
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

    // Define an array of allowed credentials
    $allowed_credentials = [
        'registered_username' => 'registered_password'
    ];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $entered_username = $_POST["username"];
        $entered_password = $_POST["password"];

        // Check if the entered credentials are in the allowed list
        if (array_key_exists($entered_username, $allowed_credentials) &&
            $allowed_credentials[$entered_username] == $entered_password) {
            $success = "Login Successful!";
        } else {
            $error = "Invalid username or password. Please try again.";
        }
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