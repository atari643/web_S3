<?php
session_start();
include '../TD3&TD4/connect.php';
$useridQuery = $pdo->prepare('SELECT id FROM user WHERE name = :nom LIMIT 1');

$useridQuery->execute(['nom' => $_SESSION['name']]);
$userid = $useridQuery->fetchColumn();

$seriesidQuery = $pdo->prepare('SELECT id FROM series WHERE title = :title LIMIT 1');
$seriesidQuery->execute(['title' => $_GET['favorie']]);
$seriesid = $seriesidQuery->fetchColumn();
var_dump($userid);
$sql = "DELETE FROM user_series WHERE user_id = :user_id AND series_id = :series_id";
$query = $pdo->prepare($sql);
$query->execute([
    'user_id' => $userid,
    'series_id' => $seriesid
]);

header('Location: ../TD3&TD4/afficherListeSerie.php');
exit();
?>