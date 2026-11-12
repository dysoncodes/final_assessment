<?php
include "db.php";
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        echo "<script>alert('Please fill in all fields.')</script>";
    } else {
        $sql = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $sql->bind_param("ss", $username, $password);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            // Login successful
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            // Login failed
            echo "<script>alert('Invalid username or password.')</script>";
        }
    }
}

?>

<h2>STUDENT GRADING</h2>

<h3>LOGIN</h3>

<form method="POST">
    <label for="username">Username:</label>
    <input style="width: 200px" type="text" name="username" placeholder="Enter username." required><br><br>
    <label for="password">Password:</label>
    <input style="width: 200px" type="password" name="password" placeholder="Enter password." required><br><br>
    <button type="submit" name="login">Login</button>
</form>