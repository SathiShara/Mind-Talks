<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counselor Appointments</title>
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            background-image: url("schedul_bg.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
        }

        body {
            margin: 0; /* Remove default body margin */
            padding-top: 60px; /* Adjusted padding to account for fixed navbar height */
        }

        /* Center the title */
        h1 {
            text-align: center;
            color: black;
            margin-top: 20px; /* Add some margin for better spacing */
        }

        /* Style the container */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            max-width: 600px;
        }

        li {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* Style appointment details */
        p {
            margin: 0;
        }

        /* Style the Edit and Delete links as buttons */
        .action-buttons {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        a {
            display: inline-block;
            padding: 8px 12px; /* Adjusted padding for both buttons */
            text-align: center;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-right: 5px;
            width: 50px; /* Set a fixed width for consistency */
        }

        a.edit-button {
            background-color: #4CAF50; /* Green color */
        }

        a.delete-button {
            background-color: #f44336; /* Red color */
        }

        a:hover {
            background-color: #45a049; /* Darker green color on hover */
        }

        /*  styling for the navigation bar */
        .navbar {
            background-color: rgba(191, 214, 197, 0.7); /* Semi-transparent background */
            padding: 10px;
            display: flex;
            justify-content: space-between; /* Align items horizontally with space in between */
            align-items: center; /* Vertically align items */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100; /* Ensure it's above other content */
        }

        .brand h1 {
            font-size: 2rem;
            text-transform: uppercase;
            color: white;
            margin: 0; /* Remove default margin */
        }

        .brand h1 span {
            color: #51B40C;
        }

        .navbar a {
            color: black;
            text-decoration: none;
            padding: 14px 16px;
            display: inline-block;
            font-weight: bold;
        }

        .navbar a:hover {
            background-color: #8df2a8;
            color: black;
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

    <?php
    include('db.php');

    // Retrieve counselor appointments from the database
    $appointments = getAppointments();
    ?>

    <h1>Manage My Schedule</h1>

    <ul>
        <?php $counter = 1; ?>
        <?php foreach ($appointments as $appointment) : ?>
            <li>
                <p><strong><?php echo "{$counter}. {$appointment['full_name']}"; ?></strong></p>
                <p><strong>Date:</strong> <?php echo $appointment['date']; ?></p>
                <p><strong>Time:</strong> <?php echo "{$appointment['time_start']} - {$appointment['time_end']}"; ?></p>
                <div class="action-buttons">
                    <a class="edit-button" href="edit_appointment_form.php?id=<?php echo $appointment['id']; ?>">Edit</a>
                    <a class="delete-button" href="delete_appointment.php?id=<?php echo $appointment['id']; ?>" onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</a>
                </div>
            </li>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </ul>
</body>

</html>
