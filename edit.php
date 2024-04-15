<?php
include __DIR__ . "/includes/db.php";


$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'GET'){
  
      $errors = [];

      $stmt = $pdo->prepare('SELECT * FROM libri WHERE id = :id');
      $stmt->execute(['id' => $id]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $titolo = $row['titolo'];
      $autore = $row['autore'];
      $genere = $row['genere'];
      $anno = $row['anno_pubblicazione'];
      $image = $row['image'];
      $descrizione = $row['descrizione'];

      if($errors === []){
                
        $stmt = $pdo->prepare('UPDATE libri SET titolo = :titolo, autore = :autore, genere = :genere, anno_pubblicazione = :anno_pubblicazione, image = :image, descrizione = :descrizione WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'titolo' => $titolo,
            'autore' => $autore,
            'genere' => $genere,
            'anno_pubblicazione' => $anno,
            'image' => $image,
            'descrizione' => $descrizione,
        ]);
      }
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $errors = [];

    $titolo = $_POST['titolo'] ?? $titolo;
    $autore = $_POST['autore'] ?? $autore;
    $genere = $_POST['genere'] ?? $genere;
    $anno = $_POST['anno_pubblicazione'] ?? $anno;
    $image = $_POST['image'] ?? $image;
    $descrizione = $_POST['descrizione'] ?? $descrizione;

    if($errors === []){
        
        $stmt = $pdo->prepare('UPDATE libri SET titolo = :titolo, autore = :autore, genere = :genere, anno_pubblicazione = :anno_pubblicazione, image = :image, descrizione = :descrizione WHERE id = :id');
        $stmt->execute([
            'id' => $id,
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
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="row row-gap-2">
          <div class="col-12">
            <label for="titolo" class="form-label">Title</label>
            <input type="text" value="<?= $titolo?>" name="titolo" class="form-control <?= isset($errors['titolo']) ? 'is-invalid' : ''?>" id="titolo" >
            <?= $errors['titolo'] ?? "" ?>
          </div>

          <div class="col-12">
            <label for="autore" class="form-label">Author</label>
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
              <input type="text" name="image" value="<?= $image?>" class="form-control" id="image" >    
          </div>

          <label for="descrizione" class="form-label mb-0">Plot</label>
          <div class="form-floating">
          <textarea class="form-control pt-2" name="descrizione" id="descrizione" style="height: 100px"><?= $descrizione?></textarea>
          </div>
          
          <div class="col-12 mt-3">
            <button class="btn btn-primary" type="submit">
               Edit book
            </button>
          </div>
        </div>
      </form> 
    </div>
  </div>
</div>

<?php
include __DIR__ . "/includes/end.php";
