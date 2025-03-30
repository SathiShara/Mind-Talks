<?php
// Include the database configuration
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["user_name"];
    $age = $_POST["age"];
    $email = $_POST["user_email"];
    $contactNum = $_POST["user_num"];
    $appointmentFor = $_POST["appointment_for"];
    $appointmentDescription = $_POST["appointment_description"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $duration = $_POST["duration"];

    try {
        // Use prepared statements to prevent SQL injection
        $stmt = $pdo->prepare("INSERT INTO patientAppointments (name, age, email, contact_num, appointment_for, appointment_description, date, time, duration) 
                                VALUES (:name, :age, :email, :contactNum, :appointmentFor, :appointmentDescription, :date, :time, :duration)");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':contactNum', $contactNum, PDO::PARAM_STR);
        $stmt->bindParam(':appointmentFor', $appointmentFor, PDO::PARAM_STR);
        $stmt->bindParam(':appointmentDescription', $appointmentDescription, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);

        $stmt->execute();

        echo "Appointment request submitted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the connection in PDO
$pdo = null;
?>
