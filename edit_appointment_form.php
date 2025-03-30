<!-- edit_appointment_form.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tabStyle.css">
    <style>
        html { 
            background-image: url("schedul_bg.jpg");
            background-repeat: no-repeat;
            background-size: 100%;


        }
        body{    
            margin: 0; /* Remove default body margin */
            padding-top: 60px; /* Adjusted padding to account for fixed navbar height */
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin-top: 50px; 
        }

    </style>
    
</head>

<body>
<div class="navbar">
        <div class="brand">
            <h1><span>M</span>ind<span>T</span>alk</h1>
        </div>
        <a href="index.html">HOME</a>
        <a href="Counselor.html">COUNSELORS</a>
        <a href="ChatApp/index.php">CHAT</a>
    </div>

    <?php
    include('db.php');

    // Retrieve the appointment details based on the ID from the query parameter
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $appointment = $pdo->query("SELECT * FROM appointments WHERE id = $id")->fetch(PDO::FETCH_ASSOC);

        if (!$appointment) {
            echo "Appointment not found.";
            exit();
        }
    } else {
        echo "Appointment ID not provided.";
        exit();
    }
    ?>

    <form action="edit_appointment.php?id=<?php echo $id; ?>" method="post">
        <!-- Populate the form with the current appointment details -->
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $appointment['full_name']; ?>" required>

        <label for="profession">Profession:</label>
        <input type="text" name="profession" value="<?php echo $appointment['profession']; ?>" required>

        <label for="speciality">Speciality:</label>
        <input type="text" name="speciality" value="<?php echo $appointment['speciality']; ?>" required>

        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $appointment['date']; ?>" required>

        <label for="time_start">Start Time:</label>
        <input type="time" name="time_start" value="<?php echo $appointment['time_start']; ?>" required>

        <label for="time_end">End Time:</label>
        <input type="time" name="time_end" value="<?php echo $appointment['time_end']; ?>" required>

        <button type="submit">Update Appointment</button>
    </form>
</body>

</html>
