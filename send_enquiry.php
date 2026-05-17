<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login to send enquiry!'); window.location='Account.html';</script>";
        exit();
    }

    $tenant_id = $_SESSION['user_id'];
    $listing_id = mysqli_real_escape_string($conn, $_POST['listing_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert into enquiries table
    $sql = "INSERT INTO enquiries (listing_id, tenant_id, message) VALUES ('$listing_id', '$tenant_id', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Enquiry Sent Successfully!'); window.history.back();</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>