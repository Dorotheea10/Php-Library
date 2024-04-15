<?php

include __DIR__ . "/includes/db.php";

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM libri WHERE id = :id');
$stmt->execute(['id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include __DIR__ . "/includes/initial.php"
?>

<div class="col-10 offset-1">
    <div class="row mt-5 border border-4 py-2 detail-cont">
        <div class="col-4">
            <img src="<?= $row['image'] ?>" alt="" style="height: 50vh;">
        </div>
        <div class="col-8 text-white">
            <h2 class="fw-bold"><?= $row['titolo']?></h2>
            <h4><?= $row['genere'] ?> scritto da <?= $row['autore'] ?> published at <?= $row['anno_pubblicazione'] ?></h4>
            <hr>
            <h5 class="mt-4">Plot</h5>
            <p><?= $row['descrizione'] ?></p>
        </div>
    </div>
</div>

<?php
include __DIR__ . "/includes/end.php";