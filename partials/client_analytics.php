<?php
$phone = $_SESSION['phone'];
/* Parking Lots */
$query = "SELECT COUNT(*)  FROM `parking_lots`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($parking_lots);
$stmt->fetch();
$stmt->close();

/* Reservation Revenue */
$query = "SELECT SUM(amt)  FROM `payments` WHERE client_phone = '$phone'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($reservations_revenue);
$stmt->fetch();
$stmt->close();

/* Reservations */
$query = "SELECT COUNT(*)  FROM `reservations` WHERE client_phone = '$phone'  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($reservations);
$stmt->fetch();
$stmt->close();
