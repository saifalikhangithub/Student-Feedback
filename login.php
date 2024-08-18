<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "student_feedback");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['department'] = $row['department'];
            header("Location: dashboard.php");
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that email.";
    }
}
?>

<form method="POST" action="login.php">
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" value="Login">
    <a href="register.php"><input type="button" value="Register"></a>
    <a href="index.php"><input type="button" value="Home"></a>
</form>
