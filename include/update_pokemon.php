<?php
if (isset($_GET['modif_id1'])){
    $sql = 'SELECT * FROM pokemon WHERE id = :id';
    $preparerExemple = $db->prepare($sql);
    $preparerExemple->execute([
        'id' => $_GET['modif_id1'],
    ]);
    $list = $preparerExemple->fetchAll();

    foreach ($list as $value){  
    ?>
    <form action="index.php?pokedeck" method="post" enctype="multipart/form-data">
            <div>
                <label>Numéro</label>
                <input type="text" class="form-control" name="numero" value="<?php echo $value['numero'] ;?> ">
            </div>
            <div>
                <label>Nom</label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $value['first_name'] ;?> ">
            </div>
            <div>
                <label>Type 1</label>
                <input type="text" class="form-control" name="type1" value="<?php echo $value['type1'] ;?> ">
            </div>
            <div>
                <label>Type 2</label>
                <input type="text" class="form-control" name="type2" value="<?php echo $value['type2'] ;?> ">
            </div>
            <div>
                <label>Image du Pokémon</label><br>
                <img src="<?php echo $value['image'];?>" alt="">
                <input type="file" name="img" id="img" accept="image/png, image/jpeg" value="<?php echo $value['image'] ;?> ">
            </div>
        <input type="submit" name="update1" value="update" class="btn btn-info">
        <input type="hidden" name="id" value="<?php echo $_GET['modif_id1'] ;?>">
    </form>
<?php
    
    };  
}
?>