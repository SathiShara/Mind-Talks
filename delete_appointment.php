<!-- delete_appointment.php -->

<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve appointment ID from the query parameter
    $id = $_GET['id'];

    // Delete the appointment from the database
    $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect back to the counselor appointments page after deletion
    header("Location: counselor_appointments.php");
    exit();
} else {
    echo "Invalid request.";
    exit();
}
?>
