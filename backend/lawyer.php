<?php
require_once "database.php";
//get all lawyer
if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET['q']) and $_GET['q'] == "list") {
    $sql = "SELECT l.id,l.name,l.lastName,l.email,l.phone, c.name as cityName
    FROM lawyer l
    INNER JOIN city c ON c.id=l.cityId";
    $statement = $db->prepare($sql);
    $statement->execute([]);
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}

//get specific lawyer
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_GET['q']) and $_GET['q'] == "search") {
    $datas = json_decode(file_get_contents("php://input"), true);
    $domainId = $datas["domainId"];
    $cityId = $datas["cityId"];

    if ($domainId != "") {
        if ($cityId == "") {
            $sql = "SELECT l.id,l.name,l.lastName,l.email,l.phone,c.name as cityName 
                FROM lawyer l
                INNER JOIN domain_lawyer dl ON dl.lawyerId=l.id
                INNER JOIN domain d ON d.id=dl.domainId
                INNER JOIN city c ON l.cityId=c.id
                WHERE dl.domainId=:domainId";
            $param = [
                "domainId" => $domainId
            ];
        } else if ($cityId != "") {
            $sql = "SELECT l.id,l.name,l.lastName,l.email,l.phone,c.name as cityName  
                FROM lawyer l
                INNER JOIN domain_lawyer dl ON dl.lawyerId=l.id
                INNER JOIN domain d ON d.id=dl.domainId
                INNER JOIN city c ON l.cityId=c.id
                WHERE dl.domainId=:domainId AND l.cityId=:cityId";
            $param = [
                "domainId" => $domainId,
                "cityId" => $cityId
            ];
        }
    } else if ($domainId == "") {
        if ($cityId != "") {
            $sql = "SELECT l.id,l.name,l.lastName,l.email,l.phone,c.name as cityName  
            FROM lawyer l
            INNER JOIN city c ON c.id=l.cityId
            WHERE cityId=:cityId";
            $param = [
                "cityId" => $cityId
            ];
        } else if ($cityId == "") {
            $sql = "SELECT l.id,l.name,l.lastName,l.email,l.phone, c.name as cityName
    FROM lawyer l
    INNER JOIN city c ON c.id=l.cityId";
            $param = [];
        }
    }
    $statement = $db->prepare($sql);
    $statement->execute($param);
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_GET['q']) and $_GET['q'] == "oneUser") {
    $sql = "SELECT l.id,l.name,l.lastName,l.email,l.phone, c.name as cityName
    FROM lawyer l
    INNER JOIN city c ON c.id=l.cityId";
    $statement = $db->prepare($sql);
    $statement->execute([]);
    if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
}