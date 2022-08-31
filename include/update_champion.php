<?php
if (isset($_GET['modif_id2'])){
    $sql = 'SELECT * FROM champion WHERE id = :id';
    $preparerExemple = $db->prepare($sql);
    $preparerExemple->execute([
        'id' => $_GET['modif_id2'],
    ]);
    $list = $preparerExemple->fetchAll();

    foreach ($list as $value){  
    ?>
    <form action="index.php?champion" method="post" enctype="multipart/form-data">
            <div>
                <label>Ville</label>
                <input type="text" class="form-control" name="ville" value="<?php echo $value['ville'] ;?> ">
            </div>
            <div>
                <label>Champion</label>
                <input type="text" class="form-control" name="champion" value="<?php echo $value['champion'] ;?> ">
            </div>
            <div>
                <label>Type</label>
                <input type="text" class="form-control" name="type" value="<?php echo $value['type'] ;?> ">
            </div>
            <div>
                <label>Badge</label>
                <input type="text" class="form-control" name="badge" value="<?php echo $value['badge'] ;?> ">
            </div>
            <div>
                <label>Image du Champion</label><br>
                <img src="<?php echo $value['image'];?>" alt="">
                <input type="file" name="image1" id="image1" accept="image/png, image/jpeg" value="<?php echo $value['image'] ;?> ">
            </div>
        <input type="submit" name="update2" value="update" class="btn btn-info">
        <input type="hidden" name="id" value="<?php echo $_GET['modif_id2'] ;?>">
    </form>
<?php
    };  
}
?>