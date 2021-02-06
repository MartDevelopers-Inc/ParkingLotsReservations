<?php
include('../config/pdoconfig.php');

/* Client Name */
if (!empty($_POST["Phone"])) {
    $id = $_POST['Phone'];
    $stmt = $DB_con->prepare("SELECT * FROM clients WHERE phone = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['name']); ?>
<?php
    }
}

/* Client Car Regno */
if (!empty($_POST["Name"])) {
    $id = $_POST['Name'];
    $stmt = $DB_con->prepare("SELECT * FROM clients WHERE phone = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['car_regno']); ?>
<?php
    }
}

/* Parking Lot Fee */
if (!empty($_POST["ParkingLotNumber"])) {
    $id = $_POST['ParkingLotNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM parking_lots WHERE code = :id ");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<?php echo htmlentities($row['price_per_slot']); ?>
<?php
    }
}
