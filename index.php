<?php include 'db.php' ?>
<!DOCTYPE html>
<html lang="fr">
    <?php include 'include/head.php'?>
<body>
    <?php include 'include/header.php';
    ?><div class="mb-5"><?php
//AFFICHE LES ELEMENTS 
    if(isset($_GET['champion'])){
        include 'include/champion.php';
    }  
    if(isset($_GET['pokedeck'])){
        include 'include/pokemon.php';
    } 
    if(isset($_GET['crea_pok'])){
        include 'include/pokemon_create.php';
    }
    if(isset($_GET['crea_champ'])){
        include 'include/champion_create.php';
    }
    
    
//CREATE POKEMON

if (isset($_POST['submit1'])){
    $sql ='INSERT INTO `pokemon` (`numero`, `first_name`, `type1`, `type2`, `image`) VALUE (:num1, :name, :type1, :type2, :img)';
    $preparer = $db->prepare($sql);
    $preparer->execute(
    [
        'num1' => $_POST['numero'],
        'name' => $_POST['first_name'],
        'type1' => $_POST['type1'],
        'type2' => $_POST['type2'],
        'img' => 'img/' . $_FILES["img"]["name"]
    ]
    );
    $target_dir = "img/";//lieu où sont enregistré les image 
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérification si le fichier est une image
    if(isset($_POST["submit1"])) {
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
    }

    // vérification si le fichier existe déjà
    if (file_exists($target_file)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
    }

    // Vérification de la taille du fichier
    if ($_FILES["img"]["size"] > 500000) {
    echo "La taille du fichier est trop importante.";
    $uploadOk = 0;
    }

    // Autorisation seulement de certain format de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Seulement les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
    }

    // Vérification si $upload n'est pas à 0 (envoie message d'erreur)
    if ($uploadOk == 0) {
    echo " Le fichier n'a pas été envoyé.";
    // Si tout est ok, alors le fichier est uploadé dans le bon dossier
    } else {
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        echo print_r($target_file);
        echo "Le fichier ". htmlspecialchars( basename( $_FILES["img"]["name"])). " a été envoyé.";
    } else {
        echo " Erreur lors de l'envoi du fichier";
    }
    }
}

//CREATE CHAMPION

if (isset($_POST['submit'])){
    $sql ='INSERT INTO `champion` (`ville`, `champion`, `type`, `badge`, `image`) VALUE (:ville, :champion, :type, :badge, :image1)';
    $preparer = $db->prepare($sql);
    $preparer->execute(
    [
        'ville' => $_POST['ville'],
        'champion' => $_POST['champion'],
        'type' => $_POST['type'],
        'badge' => $_POST['badge'],
        'image1' => 'img/' . $_FILES["image1"]["name"]
    ]
    );
    $target_dir = "img/";//lieu où sont enregistré les image 
    $target_file = $target_dir . basename($_FILES["image1"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérification si le fichier est une image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image1"]["tmp_name"]);
    
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
    }

    // vérification si le fichier existe déjà
    if (file_exists($target_file)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
    }

    // Vérification de la taille du fichier
    if ($_FILES["image1"]["size"] > 500000) {
    echo "La taille du fichier est trop importante.";
    $uploadOk = 0;
    }

    // Autorisation seulement de certain format de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Seulement les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
    }

    // Vérification si $upload n'est pas à 0 (envoie message d'erreur)
    if ($uploadOk == 0) {
    echo " Le fichier n'a pas été envoyé.";
    // Si tout est ok, alors le fichier est uploadé dans le bon dossier
    } else {
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
        echo print_r($target_file);
        echo "Le fichier ". htmlspecialchars( basename( $_FILES["image1"]["name"])). " a été envoyé.";
    } else {
        echo " Erreur lors de l'envoi du fichier";
    }
    }
}


//READ POKEMON
if (isset($_GET['id2'])){
    $sql = 'SELECT * FROM pokemon WHERE id = :id';
    $preparerExemple = $db->prepare($sql);
    $preparerExemple->execute([
        'id' => $_GET['id2'],
    ]);
    $list = $preparerExemple->fetchAll();

    foreach ($list as $value){
    ?>
    <div class="container">
        <div class="row">
            <div class="card col-12 text-center" style="width: 18rem;">
                <div class="row">
                    <div class="card-body col-5">
                        <img src="<?php echo $value['image'];?>" alt="">
                    </div>
                    <div class="card-body col-5">
                        <p class="card-text"><strong>Numéro : </strong><?php echo $value['numero'];?></p>
                        <p class="card-text"><strong>Pokémon : </strong><?php echo $value['first_name'];?></p>
                        <p class="card-text"><strong>Type : </strong><?php echo $value['type1'];?></p>
                        <p class="card-text"><strong>Type : </strong><?php echo $value['type2'];?></p>
                        <p class="card-text"><strong>Id : </strong><?php echo $value['id'];?></p>
                        
                    </div>
                    <div class="col-5">
                      <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger"> <img src="img/corbeille" alt=""></button>  
                    </div>
                    <div class="col-5">
                        <a href="index.php?modif_id1=<?php echo $value['id'];?>" class="btn btn-primary"><img src="img/bouton-modifier" alt=""></a>  
                    </div>
                    
                </div>
                
                
            </div>
        </div>
    </div>
    <!-- POP-UP -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Es tu sur de vouloir supprimer?</h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            
            <form action="" method="POST">
                <input type="hidden" name="id2" value="<?= $_GET['id2'] ?>">
                <input type="submit" class="btn btn-danger" name="sup_1" value="Supprimer">
            </form>
        </div>
        </div>
    </div>
    </div>
    <?php
    };  


//DELETE
    if(isset($_POST['sup_1'])){
        $sql =' DELETE FROM `pokemon` WHERE `id` = :id';
        $prepare = $db->prepare($sql);
        $prepare ->execute([
            'id' => $_POST['id2']
        ]);
    }
}

//READ CHAMPION
if (isset($_GET['id1'])){
    $sql = 'SELECT * FROM champion WHERE id = :id';
    $preparerExemple = $db->prepare($sql);
    $preparerExemple->execute([
        'id' => $_GET['id1'],
    ]);
    $list = $preparerExemple->fetchAll();

    foreach ($list as $value){
    ?>
    <div class="container">
        <div class="row">
            <div class="card col-12 text-center" style="width: 18rem;">
                <div class="row">
                    <div class="card-body col-5">
                        <img src="<?php echo $value['image'];?>" alt="">
                    </div>
                    <div class="card-body col-5">
                        <p class="card-text"><strong>Ville : </strong><?php echo $value['ville'];?></p>
                        <p class="card-text"><strong>Champion : </strong><?php echo $value['champion'];?></p>
                        <p class="card-text"><strong>Type : </strong><?php echo $value['type'];?></p>
                        <p class="card-text"><strong>Badge : </strong><?php echo $value['badge'];?></p>
                        <p class="card-text"><strong>Id : </strong><?php echo $value['id'];?></p>
                    </div>
                    <div class="col-5">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> <img src="img/corbeille" alt=""></button>  
                    </div>
                    <div class="col-5">
                        <a href="index.php?modif_id2=<?php echo $value['id'];?>" class="btn btn-primary"><img src="img/bouton-modifier" alt=""></a>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- POP-UP -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Es tu sur de vouloir supprimer?</h5>
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            
            <form action="" method="POST">
                <input type="hidden" name="id2" value="<?= $_GET['id1'] ?>">
                <input type="submit" class="btn btn-danger" name="sup_2" value="Supprimer">
            </form>
        </div>
        </div>
    </div>
    </div>
    <?php
    }; 
//DELETE
    if(isset($_POST['sup_2'])){
        $sql =' DELETE FROM `pokemon` WHERE `id` = :id';
        $prepare = $db->prepare($sql);
        $prepare ->execute([
            'id' => $_POST['id1']
        ]);
    }
}


//UPDATE POKEMON
if(isset($_POST['update1'])){
    $sql = 'UPDATE `pokemon`SET `numero`= :numero, `first_name` = :first_name, `type1`= :type1, `type2`= :type2, `image`= :img WHERE id = :id';
    $preparer = $db->prepare($sql);
    $preparer->execute([
        'numero' => $_POST['numero'],
        'first_name' => $_POST['first_name'],
        'type1' => $_POST['type1'],
        'type2' => $_POST['type2'],
        'id' => $_POST['id'],
        'img' => 'img/' . $_FILES["img"]["name"]
    ]);
    $target_dir = "img/";//lieu où sont enregistré les image 
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérification si le fichier est une image
    if(isset($_POST["submit1"])) {
    $check = getimagesize($_FILES["img"]["tmp_name"]);
    
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
    }

    // vérification si le fichier existe déjà
    if (file_exists($target_file)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
    }

    // Vérification de la taille du fichier
    if ($_FILES["img"]["size"] > 500000) {
    echo "La taille du fichier est trop importante.";
    $uploadOk = 0;
    }

    // Autorisation seulement de certain format de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Seulement les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
    }

    // Vérification si $upload n'est pas à 0 (envoie message d'erreur)
    if ($uploadOk == 0) {
    echo " Le fichier n'a pas été envoyé.";
    // Si tout est ok, alors le fichier est uploadé dans le bon dossier
    } else {
    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        echo print_r($target_file);
        echo "Le fichier ". htmlspecialchars( basename( $_FILES["img"]["name"])). " a été envoyé.";
    } else {
        echo " Erreur lors de l'envoi du fichier";
    }
    }
};
if (isset($_GET['modif_id1'])){
    include 'include/update_pokemon.php';
}


//UPDATE champion
if(isset($_POST['update2'])){
    $sql = 'UPDATE `champion` SET `ville`= :ville, `champion` = :champion, `type`= :type, `badge`= :badge, `image`= :image1 WHERE id = :id';
    $preparer = $db->prepare($sql);
    $preparer->execute([
        'ville' => $_POST['ville'],
        'champion' => $_POST['champion'],
        'type' => $_POST['type'],
        'badge' => $_POST['badge'],
        'id' => $_POST['id'],
        'image1' => 'img/' . $_FILES["image1"]["name"]
    ]);
    $target_dir = "img/";//lieu où sont enregistré les image 
    $target_file = $target_dir . basename($_FILES["image1"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérification si le fichier est une image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image1"]["tmp_name"]);
    
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
    }

    // vérification si le fichier existe déjà
    if (file_exists($target_file)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
    }

    // Vérification de la taille du fichier
    if ($_FILES["image1"]["size"] > 500000) {
    echo "La taille du fichier est trop importante.";
    $uploadOk = 0;
    }

    // Autorisation seulement de certain format de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Seulement les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
    }

    // Vérification si $upload n'est pas à 0 (envoie message d'erreur)
    if ($uploadOk == 0) {
    echo " Le fichier n'a pas été envoyé.";
    // Si tout est ok, alors le fichier est uploadé dans le bon dossier
    } else {
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file)) {
        echo print_r($target_file);
        echo "Le fichier ". htmlspecialchars( basename( $_FILES["image1"]["name"])). " a été envoyé.";
    } else {
        echo " Erreur lors de l'envoi du fichier";
    }
    }
};
if (isset($_GET['modif_id2'])){
    include 'include/update_champion.php';  
}


//SEARCH
if (isset($_GET['search'])){

    $sql ='SELECT * FROM `pokemon` WHERE `first_name` LIKE :pokemon';
    $preparer = $db->prepare($sql);
    $preparer->execute([
        'pokemon' => '%' . $_GET['search'] . '%',
    ]);
    $list = $preparer->fetchAll();
    ?>
    
    <div class="container justify-content-center">
        <div class="row">

    <?php
    foreach ($list as $value){
    ?>
        <div class="card col-3 " style="width: 18rem;">
            <div class="card-body text-center">
                <img src="<?php echo $value['image'];?>" alt="">
                <p class="card-text"><strong></strong><?php echo $value['first_name'];?></p>
                <a href="index.php?id2=<?php echo $value['id'];?>" class="btn btn-secondary">fiche du pokemon</a>
            </div>
        </div>
    <?php
    };

    $sql2 ='SELECT * FROM `champion` WHERE `champion` LIKE :pokemon';
    $preparer = $db->prepare($sql2);
    $preparer->execute([
        'pokemon' => '%' . $_GET['search'] . '%',
    ]);
    $list = $preparer->fetchAll();
    foreach ($list as $value){
    ?>
        <div class="card col-3" style="width: 18rem;">
            <div class="card-body text-center">
                <img src="<?php echo $value['image'];?>" alt="">
                <p class="card-text"><strong></strong><?php echo $value['champion'];?></p>
                <a href="index.php?id2=<?php echo $value['id'];?>" class="btn btn-secondary">fiche du champion</a>
            </div>
        </div>
    <?php
    };
    ?>
        </div>
    </div>
    <?php
}?>

</div>
<?php
//FOOTER
include 'include/footer.php'

?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>