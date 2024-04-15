<?php

include __DIR__ . "/includes/db.php";

$id = $_GET['id'] ?? '';
$stmt = $pdo->prepare("DELETE FROM libri WHERE id = ?");
$stmt->execute([$id]);

header("Location: /Php-Library/index.php");