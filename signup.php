<?php
// Database connection aur session include karein
include 'config.php';

// Error reporting on karein taaki galti dikhe
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form se data fetch karein
    // Spelling fixed: mysqli_real_escape_string
    $role     = mysqli_real_escape_string($conn, $_POST['role']);
    $fullname = mysqli_real_escape_string($conn, $_POST['full_name']);
    $mobile   = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Check karein ki passwords match ho rahe hain ya nahi
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // 2. Password ko encrypt karein
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // 3. Check karein ki email pehle se register toh nahi hai
    $checkEmail = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists! Please login.'); window.location='Account.html';</script>";
    } else {
        // 4. Data ko users table mein insert karein
        $sql = "INSERT INTO users (full_name, email, mobile, password, user_role) 
                VALUES ('$fullname', '$email', '$mobile', '$hashed_password', '$role')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Registration Successful! Please Login.'); window.location='Account.html';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>