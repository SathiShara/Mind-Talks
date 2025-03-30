<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tabStyle.css">

    <title>Counselor Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            color: #333;
            margin: 0; /* Remove default body margin */
            padding-top: 60px; /* Adjusted padding to account for fixed navbar height */
        }

        h1 {
            text-align: center;
            color: #4bc970;
        }

       

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0; /* Adjusted margin for better spacing */
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        p {
            margin: 0;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .btn {
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
        }

        .accept-btn {
            background-color: #4bc970;
            color: #fff;
        }

        .reject-btn {
            background-color: #e74c3c;
            color: #fff;
        }
    </style>
</head>

<body>
    <!--  navigation bar -->
    <div class="navbar">
        <div class="brand">
            <h1><span>M</span>ind<span>T</span>alk</h1>
        </div>
        <a href="index.html">HOME</a>
        <a href="Counselor.html">COUNSELORS</a>
        <a href="ChatApp/index.php">CHAT</a>
    </div>

    <h1>Check My Appointments</h1>

    <ul>
        <?php
        // Include the database configuration
        include 'config.php';

        try {
            // Fetch appointments from the database
            $sql = "SELECT * FROM patientAppointments";
            $stmt = $pdo->query($sql);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<li>';
                echo '<p><strong>Patient Name:</strong> ' . $row['name'] . '</p>';
                echo '<p><strong>Date:</strong> ' . $row['date'] . '</p>';
                echo '<p><strong>Time:</strong> ' . $row['time'] . '</p>';
                echo '<p><strong>Reason:</strong> ' . $row['appointment_description'] . '</p>';

                // Accept and Reject buttons
                echo '<div class="btn-container">';
                echo '<button class="btn accept-btn" onclick="acceptAppointment(' . $row['id'] . ')">Accept</button>';
                echo '<button class="btn reject-btn" onclick="rejectAppointment(' . $row['id'] . ')">Reject</button>';
                echo '</div>';

                echo '</li>';
            }

            // Close the database connection
            $pdo = null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </ul>

    <script>
        // JavaScript functions for handling Accept and Reject actions
        function acceptAppointment(appointmentId) {
            handleAppointment(appointmentId, 'accept');
        }

        function rejectAppointment(appointmentId) {
            handleAppointment(appointmentId, 'reject');
        }

        function handleAppointment(appointmentId, action) {
            // AJAX request to handle acceptance/rejection
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "handleAppointment.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseText);

                        // Check if the action is 'accept' and handle the redirection
                        if (action == 'accept') {
                            window.location.href = 'ChatApp/index.php'; // Adjust the URL if necessary
                        } else {
                            location.reload(); // Refresh the page after handling the request
                        }
                    } else {
                        console.error("Error during the AJAX request. Status code:", xhr.status);
                    }
                }
            };
            xhr.send("action=" + action + "&id=" + appointmentId);
        }
    </script>

</body>

</html>
