<div class="container"> 
    <div class="row">
        <?php
        $sql = 'SELECT * FROM pokemon';
        $preparerExemple = $db->prepare($sql);
        $preparerExemple->execute();
        
        $list = $preparerExemple->fetchAll();
        foreach ($list as $value){
        ?>
            <div class="card col-3 pb-5 m-4" style="width: 18rem;">
                <div class="card-body text-center">
                    <img src="<?php echo $value['image'];?>" alt="" width="50%" height="50%">
                    <p class="card-text"><strong>Numéro : </strong><?php echo $value['numero'];?></p>
                    <p class="card-text"><strong>Nom : </strong><?php echo $value['first_name'];?></p>
                    <p class="card-text"><strong>Type : </strong><?php echo $value['type1'];?> <?php echo $value['type2'];?></p>
                    <a href="index.php?id2=<?php echo $value['id'];?>" class="btn btn-secondary">fiche du pokemon</a>
                    <a href=""></a>
                </div>
            </div>
        <?php
        };
        ?> 
    </div>
</div>