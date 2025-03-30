<!-- create_appointment.php -->
<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST["full_name"];
    $profession = $_POST["profession"];
    $speciality = $_POST["speciality"];
    $date = $_POST["date"];
    $time_start = $_POST["time_start"];
    $time_end = $_POST["time_end"];

    // Insert new appointment into the database
    createAppointment($full_name, $profession, $speciality, $date, $time_start, $time_end);

    // Redirect to the appointments page
    header("Location: counselor_appointments.php");
    exit();
}
?>
