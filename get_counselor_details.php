<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Wall</title>
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            background-image: url("bg5.jpg");
            background-repeat: no-repeat;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Transparent navigation bar styles */
        .navbar {
            background-color: #bfd6c5; /* Semi-transparent white background */
            padding: 10px;
            display: flex;
            justify-content: space-between; /* Align items horizontally with space in between */
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

        /* Counselor card styles */
        .counselor-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            width: 300px;
            display: inline-block;
            text-align: center; /* Center the content inside the card */
            position: relative; /* Position for absolute positioning of the button */
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
        }

        .counselor-content {
            margin-bottom: 40px; /* Add margin to the bottom of the content */
        }

        .book-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            position: absolute;
            bottom: 10px; /* Adjust the distance from the bottom */
            left: 50%; /* Center the button horizontally */
            transform: translateX(-50%); /* Adjust for centering */
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
        <a href="get_counselor_details.php">APPOINTMENT</a>
        <a href="index.html#about">ABOUT</a>
        <a href="index.html#contact">CONTACT US</a>
        <a href="ChatApp/index.php">CHAT</a>
        <a href="rating.html">RATE US</a>
    </div>

    <h1 style="text-align:center">Make Your Appointment Today</h1>

    <?php
    // Include the database configuration
    include('config.php');

    // Check if $pdo is defined and not null
    if ($pdo) {
        // Retrieve appointments data from the database
        $sql = "SELECT * FROM appointments";

        // Perform the query
        try {
            $result = $pdo->query($sql);

            if ($result === false) {
                die("Error: " . $pdo->errorInfo()[2]);
            }

            if ($result->rowCount() > 0) {
                // Output data of each row
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='counselor-card'>";
                    echo "<div class='counselor-content'>";
                    echo "<h2>{$row["full_name"]}</h2>";
                    echo "<p>Profession: {$row["profession"]}</p>";
                    echo "<p>Speciality: {$row["speciality"]}</p>";
                    echo "<p>Date: {$row["date"]}</p>";
                    echo "<p>Time: {$row["time_start"]} to {$row["time_end"]}</p>";
                    echo "</div>";
                    echo "<form action='patientAppointments.html' method='post'>";
                    echo "<input type='hidden' name='counselor_id' value='{$row["counselor_id"]}'>";
                    echo "<button type='submit' class='book-button'>Book Now</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "No counselors available.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // $pdo = null;
    } else {
        echo "Error: Database connection not available.";
    }
    ?>
</body>

</html>
