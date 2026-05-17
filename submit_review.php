<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Login as Tenant to give a review!'); window.location='Account.html';</script>";
        exit();
    }
    $uid = $_SESSION['user_id'];
    $lid = mysqli_real_escape_string($conn, $_POST['listing_id']);
    $rat = mysqli_real_escape_string($conn, $_POST['rating']);
    $com = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "INSERT INTO reviews (listing_id, user_id, rating, comment) VALUES ('$lid', '$uid', '$rat', '$com')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Review Submitted!'); window.history.back();</script>";
    }
}
?>