<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "student_feedback");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $department = mysqli_real_escape_string($conn, $_POST['department']);

    $sql = "INSERT INTO students (name, email, password, department) VALUES ('$name', '$email', '$password', '$department')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
        header("Location: login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST" action="register.php">
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <label>Department:</label>
    <select name="department" required>
        <option value="" disabled selected>Department</option>
        <option value="BCA">BCA</option>
        <option value="MBA">MBA</option>
        <option value="PhD">PhD</option>
    </select><br>
    <input type="submit" value="Register">
    <a href="login.php"><input type="button" value="login"></a>
    <a href="index.php"><input type="button" value="Home"></a>
</form>
