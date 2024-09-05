<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serviceid = $_POST['serviceID'];

    require_once '../dbh.inc.php';

    $sql1 = "DELETE FROM culinary_experience WHERE ServiceID = $serviceid";
    
    $stmt1 = $pdo->prepare($sql1);
    $stmt1 -> execute();

    $sql2 = "DELETE FROM service WHERE ServiceID = $serviceid";
    
    $stmt2 = $pdo->prepare($sql2);
    $stmt2 -> execute();

    header('Location: ../../admin_services.php?delete=success');
    exit();
}