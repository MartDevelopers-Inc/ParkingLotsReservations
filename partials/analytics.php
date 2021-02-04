<?php
/* Parking Lots */
$query = "SELECT COUNT(*)  FROM `parking_lots`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($parking_lots);
$stmt->fetch();
$stmt->close();

/* Reservation Revenue */
$query = "SELECT SUM(amt)  FROM `payments`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($reservations_revenue);
$stmt->fetch();
$stmt->close();

/* Registered Clients */
$query = "SELECT COUNT(*)  FROM `clients`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($clients);
$stmt->fetch();
$stmt->close();
