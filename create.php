<?php
include __DIR__ . "/includes/db.php";

$titolo = $_POST['titolo'] ?? "";
$autore = $_POST['autore'] ?? "";
$genere = $_POST['genere'] ?? "";
$anno = $_POST['anno_pubblicazione'] ?? "";
$image = $_POST['image'] ?? "";
$descrizione = $_POST['descrizione'] ?? "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $errors = [];

        // if($anno < 1000){
        //     $errors['anno_pubblicazione'] = "Anno non valido";
        // }

        if($errors === []){
            $stmt = $pdo->prepare('INSERT INTO libri (titolo, autore, genere, anno_pubblicazione, image, descrizione) VALUES (:titolo, :autore, :genere, :anno_pubblicazione, :image, :descrizione)');
            $stmt->execute([
                'titolo' => $titolo,
                'autore' => $autore,
                'genere' => $genere,
                'anno_pubblicazione' => $anno,
                'image' => $image,
                'descrizione' => $descrizione,
            ]);


            header('Location: /Php-Library/index.php');
            exit();
        }
}
include __DIR__ . "/includes/initial.php";
?>

<div class="row justify-content-center">
    <div class="col-5">
      <form action="" method="post" novalidate>
        <div class="row row-gap-2">
          <div class="col-12">
            <label for="titolo" class="form-label">Title</label>
            <input type="text" value="<?php echo $titolo;?>" name="titolo" class="form-control <?= isset($errors['titolo']) ? 'is-invalid' : ''?>" id="titolo" >
            <?= $errors['titolo'] ?? "" ?>
          </div>

          <div class="col-12">
            <label for="autore" class="form-label">Writer</label>
            <input type="text" value="<?= $autore?>" name="autore" class="form-control <?= isset($errors['autore']) ? 'is-invalid' : ''?>" id="autore" >
            <?= $errors['autore'] ?? "" ?>
          </div>
            
          <div class="col-12">
            <label for="genere" class="form-label">Gender</label>
              <input type="text" name="genere" value="<?= $genere?>" class="form-control <?= isset($errors['genere']) ? 'is-invalid' : "" ?>" id="genere" >
              <?= $errors['genere'] ?? ""?>
          </div>

          <div class="col-12">
            <label for="anno" class="form-label">Year of publication</label>
            <input type="number" name="anno_pubblicazione" value="<?= $anno?>" class="form-control <?= isset($errors['anno_pubblicazione']) ? 'is-invalid' : ''  ?>" id="anno" aria-describedby="validationServer03Feedback" >
            <?= $errors['anno_pubblicazione'] ?? '' ?>
          </div>

          <div class="col-12">
            <label for="image" class="form-label">Cover</label>
              <input type="text" name="image" value="<?= $image?>" class="form-control <?= isset($errors['image']) ? 'is-invalid' : "" ?>" id="image" >
              <?= $errors['image'] ?? ""?>
          </div>
          <label for="descrizione" class="form-label mb-0">Plot</label>
          <div class="form-floating">
            <textarea class="form-control pt-2" placeholder="Piccola trama" name="descrizione" id="floatingTextarea2" style="height: 100px"></textarea>
          </div>

          <div class="col-12 mt-3">
            <button class="btn btn-primary" type="submit">
                Add book
            </button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>

<?php
include __DIR__ . "/includes/end.php";