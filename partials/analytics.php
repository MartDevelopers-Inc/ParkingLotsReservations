<?php

/* Courses Offered */
$query = "SELECT COUNT(*)  FROM `iCollege_courses`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($courses_offered);
$stmt->fetch();
$stmt->close();

/* Academic Units Available */
$query = "SELECT COUNT(*)  FROM `iCollege_units`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($units);
$stmt->fetch();
$stmt->close();

/* Lecturers */
$query = "SELECT COUNT(*)  FROM `iCollege_lecturers`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($lecs);
$stmt->fetch();
$stmt->close();

/* Students */
$query = "SELECT COUNT(*)  FROM `iCollege_students`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($students);
$stmt->fetch();
$stmt->close();

/* Billed Finances */
$query = "SELECT SUM(amt_billed)  FROM `iCollege_fees_payments`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($billed);
$stmt->fetch();
$stmt->close();

/* Paid Finances */
$query = "SELECT SUM(amt_paid)  FROM `iCollege_fees_payments`  ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($paid);
$stmt->fetch();
$stmt->close();