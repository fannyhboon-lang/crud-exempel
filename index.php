<?php
require_once "config.php";
require_once "functions.php";


  if(isset($_POST["film_skicka"])){
      $namn = $_POST["namn"];
      $beskrivning = $_POST["beskrivning"];
      $datum = $_POST["datum"];
      $kategori = $_POST["kategori"];

      if(addMovie($namn, $beskrivning, $datum, $kategori, $pdo)) {
        $feedbackmessage = [1, "Film sparad!"];
      }
      else {
        $feedbackmessage = [0, "Ett fel har inträffat"];
      }
    }

    if(isset($_POST["uppdatera"])){
      $id = $_POST["id"];
      $namn = $_POST["namn"];
      $beskrivning = $_POST["beskrivning"];
      $datum = $_POST["datum"];
      $kategori = $_POST["kategori"];

    if(updateMovie($id, $namn, $beskrivning, $datum, $kategori, $pdo)) {
        $feedbackmessage = [1, "Film uppdaterad!"];
      }
      else {
        $feedbackmessage = [0, "Ett fel har inträffat"];
      }
    }

if(isset($_POST["delete"])) {

    $id = $_POST["delete"];

    if(deleteMovie($id, $pdo)) {
        $feedbackmessage = [1, "Film borttagen!"];
    } else {
        $feedbackmessage = [0, "Ett fel har inträffat"];
    }
}


    $allMovies = $pdo->query("SELECT * FROM filmer")->fetchAll();

?>

<!doctype html>
<html lang="sv">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Filmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4">Filmer</h1>

 <?php if (isset($feedbackmessage)): ?>
      <div class="alert <?= $feedbackmessage[0] ? 'alert-success' : 'alert-danger' ?>">
        <?= htmlspecialchars($feedbackmessage[1]) ?>
      </div>
    <?php endif; ?>

     <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th>ID</th>
              <th scope="col">Namn</th>
              <th scope="col">Beskrivning</th>
              <th scope="col">Datum</th>
              <th scope="col">Kategori</th>
              <th>Redigera/Ta bort</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allMovies as $i => $rad): ?>
              <tr>
                <th scope="row"><?= $i + 1 ?></th>
                <td><?= $rad["id"] ?></td>
                <td><?= htmlspecialchars($rad["namn"]) ?></td>
                <td><?= htmlspecialchars($rad["beskrivning"]) ?></td>
                <td><?= htmlspecialchars($rad["datum"]) ?></td>
                <td><?= htmlspecialchars($rad["kategori"]) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>

  <div class="row g-4 mb-5">
      <div class="col-lg-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Ny film</h5>
            <form method="post" novalidate>
              <div class="mb-3">
                <label for="namn" class="form-label">Namn</label>
                <input type="text" class="form-control" id="namn" name="namn" required>
              </div>
              <div class="mb-3">
                <label for="beskrivning" class="form-label">Beskrivning</label>
                <input type="text" class="form-control" id="beskrivning" name="beskrivning" required>
              </div>
              <div class="mb-3">
                <label for="datum" class="form-label">Datum</label>
                <input type="date" class="form-control" id="datum" name="datum"
                       min="1" max="<?= date('Y-m-d') ?>" required>
              </div>
               <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
              </div>
 
              <button type="submit" name="film_skicka" value="1" class="btn btn-primary w-100">
                Lägg till film
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
 </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>