<!-- includes/db.php -->
<?php
include('config.php');

function createAppointment($full_name, $profession, $speciality, $date, $time_start, $time_end)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO appointments (full_name, profession, speciality, date, time_start, time_end) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $profession, $speciality, $date, $time_start, $time_end]);
}

function updateAppointment($id, $full_name, $profession, $speciality, $date, $time_start, $time_end)
{
    global $pdo;

    $stmt = $pdo->prepare("UPDATE appointments SET full_name=?, profession=?, speciality=?, date=?, time_start=?, time_end=? WHERE id=?");
    $stmt->execute([$full_name, $profession, $speciality, $date, $time_start, $time_end, $id]);
}

function getAppointments()
{
    global $pdo;

    $stmt = $pdo->query("SELECT * FROM appointments");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
