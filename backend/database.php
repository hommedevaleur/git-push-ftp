<?php
//bd connexion
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=legalize;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die('error : ' . $e->getMessage());
}
?>