<?php
include('../includes/DatabaseConnexion.php');

$result = [];
if (isset($_POST['edit_id'])) {
    $id = intval($_POST['edit_id']);
    
    // Validation de l'ID pour être sûr qu'il soit un nombre valide
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $sql = "SELECT * FROM salle WHERE id_salle = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    }
}else{
  header("Refresh:0");
}

if (isset($_POST['modifier'])) {
    $id = intval($_POST['edit_id']);
    // header('location:dashboard.php');
    // exit();
    //   // Validation des données d'entrée
    // $nomSalle = filter_var($_POST['nom_salle'], FILTER_SANITIZE_STRING);
    // $equipement = filter_var($_POST['equipement'], FILTER_SANITIZE_STRING);
    // $etage = filter_var($_POST['etage'], FILTER_VALIDATE_INT);
    // $capacite = filter_var($_POST['capacite'], FILTER_VALIDATE_INT);
    // $nombreChaise = filter_var($_POST['nbr_chaise'], FILTER_VALIDATE_INT);
    // $nombreBureau = filter_var($_POST['nbr_bureau'], FILTER_VALIDATE_INT);
    // $nombreTableau = filter_var($_POST['nbr_tableau'], FILTER_VALIDATE_INT);

    // if (
    //     $nomSalle !== false && $equipement !== false && $etage !== false &&
    //     $capacite !== false && $nombreChaise !== false &&
    //     $nombreBureau !== false && $nombreTableau !== false
    // ) {
    //     // Requête de mise à jour sécurisée
    //     $sql = "UPDATE salle
    //             SET nom_salle = :nom_salle, 
    //                 capacite_salle = :capacite_salle, 
    //                 etage = :etage, 
    //                 equipements = :equipements, 
    //                 nbr_chaise = :nombre_chaise, 
    //                 nbr_bureau = :nombre_bureau, 
    //                 nbr_tableau = :nombre_tableau
    //             WHERE id_salle = :id";

    //     $query = $dbh->prepare($sql);
    //     $query->bindParam(":nom_salle", $nomSalle, PDO::PARAM_STR);
    //     $query->bindParam(":capacite_salle", $capacite, PDO::PARAM_INT);
    //     $query->bindParam(":etage", $etage, PDO::PARAM_INT);
    //     $query->bindParam(":equipements", $equipement, PDO::PARAM_STR);
    //     $query->bindParam(":nombre_chaise", $nombreChaise, PDO::PARAM_INT);
    //     $query->bindParam(":nombre_bureau", $nombreBureau, PDO::PARAM_INT);
    //     $query->bindParam(":nombre_tableau", $nombreTableau, PDO::PARAM_INT);
    //     $query->bindParam(":id", $id, PDO::PARAM_INT);

    //     $query->execute();
    // } else {
    //     // Gestion des erreurs pour les données invalides
    //     echo "Veuillez vérifier les informations saisies.";
    // }
}
?>

<form method="post">
  <div class="card-body">
    <p class="text-uppercase text-sm">Salle Information</p>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Nom Salle</label>
          <input class="form-control" type="text" value="<?= isset($result['nom_salle']) ? htmlspecialchars($result['nom_salle'], ENT_QUOTES) : ''; ?>" name="nom_salle" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Equipement</label>
          <input class="form-control" type="text" value="<?= isset($result['equipements']) ? htmlspecialchars($result['equipements'], ENT_QUOTES) : ''; ?>" name="equipement" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Etage</label>
          <select class="form-select" name="etage" required>
            <option value="0" <?= (isset($result['etage']) && $result['etage'] == 0) ? 'selected' : ''; ?>>Rez de chaussée</option>
            <option value="1" <?= (isset($result['etage']) && $result['etage'] == 1) ? 'selected' : ''; ?>>Etage 1</option>
            <option value="2" <?= (isset($result['etage']) && $result['etage'] == 2) ? 'selected' : ''; ?>>Etage 2</option>
            <option value="3" <?= (isset($result['etage']) && $result['etage'] == 3) ? 'selected' : ''; ?>>Etage 3</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Capacité Élevé</label>
          <input class="form-control" type="number" value="<?= isset($result['capacite_salle']) ? htmlspecialchars($result['capacite_salle'], ENT_QUOTES) : ''; ?>" name="capacite" min="10" max="30" required>
        </div>
      </div>
    </div>
    <hr class="horizontal dark">
    <p class="text-uppercase text-sm">Nombre Equipement </p>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Nombre Chaise</label>
          <input class="form-control" type="number" min="10" max="15" name="nbr_chaise" value="<?= isset($result['nbr_chaise']) ? htmlspecialchars($result['nbr_chaise'], ENT_QUOTES) : ''; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Nombre Bureau</label>
          <input class="form-control" type="number" min="1" max="2" name="nbr_bureau" value="<?= isset($result['nbr_bureau']) ? htmlspecialchars($result['nbr_bureau'], ENT_QUOTES) : ''; ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="example-text-input" class="form-control-label">Nombre Tableau</label>
          <input class="form-control" type="number" min="1" max="2" name="nbr_tableau" value="<?= isset($result['nbr_tableau']) ? htmlspecialchars($result['nbr_tableau'], ENT_QUOTES) : ''; ?>" required>
        </div>
      </div>
    </div>
    <hr class="horizontal dark">
    <div class="row">
      <input class="btn btn-primary" type="submit" value="Modifier" name="modifier">
    </div>
  </div>
</form>

