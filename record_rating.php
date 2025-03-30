<?php
// Include the database configuration
include('config.php');

// Get the rating from the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the rating input
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

    if ($rating < 1 || $rating > 5) {
        die("Invalid rating value");
    }

    try {
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO rating (rating_value) VALUES (?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $rating);
            if ($stmt->execute()) {
                echo "Rating recorded successfully";
            } else {
                echo "Error executing statement: " . $stmt->error . " SQL: " . $sql;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage();
    }
}

// Close the connection
$conn->close();
?>
