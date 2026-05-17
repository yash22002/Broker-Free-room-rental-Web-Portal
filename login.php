<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // User ko find karein
    $sql = "SELECT * FROM users WHERE email = '$email' AND user_role = '$role'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Encrypted password verify karein
        if (password_verify($password, $user['password'])) {
            // Session variables set karein
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['user_name'] = $user['full_name'];

            // Role based redirection
            if ($role === "Owner") {
                header("Location: Owner.php");
            } else {
                header("Location: Tenents.php");
            }
            exit();
        } else {
            echo "<script>alert('Wrong password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found with this role!'); window.history.back();</script>";
    }
}
?>