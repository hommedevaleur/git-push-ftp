<?php
require_once "database.php";
//get all city
if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET['q']) and $_GET['q'] == "list") {
    $sql = "SELECT * FROM city";
    $statement = $db->prepare($sql);
    $statement->execute([]);
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}