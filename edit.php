<? php 

require_once "header.php";
$movideId = $_GET['id'] ?? null;


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

	
$movieData = getMovieById($pdo, $movieId);

?>


  <div class="row g-4 mb-5">
      <div class="col-lg-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Redigera film</h5>
            <form method="post" novalidate>
              <div class="mb-3">
                <label for="namn" class="form-label">Namn</label>
                <input type="text" class="form-control" id="namn" name="namn" value="<? echo isset($movieData ['namn']) ? htmlspecialchars($movieData['datum']) : ''; ?> required>
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
 
              <button type="submit" name="edit-movie" value="1" class="btn btn-primary w-100">
                Uppdatera
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php require_once "footer.php";