<!-- edit_appointment.php -->

<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    // Retrieve form data
    $id = $_GET['id'];
    $full_name = $_POST["full_name"];
    $profession = $_POST["profession"];
    $speciality = $_POST["speciality"];
    $date = $_POST["date"];
    $time_start = $_POST["time_start"];
    $time_end = $_POST["time_end"];

    // Update the appointment in the database
    updateAppointment($id, $full_name, $profession, $speciality, $date, $time_start, $time_end);

    // Redirect to the appointments page
    header("Location: counselor_appointments.php");
    exit();
}
?>
