<?php
// Include the database configuration
include 'config.php';

// Check if the action and ID are set in the POST request
if (isset($_POST['action']) && isset($_POST['id'])) {
    $action = $_POST['action'];
    $appointmentId = $_POST['id'];

    try {
        if ($action == 'accept') {
            // Update the appointment status to 'accepted'
            $sql = "UPDATE patientAppointments SET status='accepted' WHERE id=:id";
        } elseif ($action == 'reject') {
            // Delete the appointment if it is rejected
            $sql = "DELETE FROM patientAppointments WHERE id=:id";
        } else {
            echo "Invalid action";
            exit;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $appointmentId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Appointment $action successfully";
        } else {
            echo "Error updating/deleting record";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request";
}
?>
