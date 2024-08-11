<?php
require_once "database.php";
//get all city
if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET['q']) and $_GET['q'] == "list") {
    $sql = "SELECT * FROM domain";
    $statement = $db->prepare($sql);
    $statement->execute([]);
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET['q']) and $_GET['q'] == "domainLawyer" and isset($_GET['lawyerId'])) {
    $sql = "SELECT d.name
    FROM domain d
    INNER JOIN domain_lawyer dl ON dl.domainId=d.id
    INNER JOIN lawyer l ON dl.lawyerId=l.id
    WHERE l.id=".$_GET['lawyerId'];
    $statement = $db->prepare($sql);
    $statement->execute([]);
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}