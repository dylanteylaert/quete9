<div class="container"> 
    <div class="row">
        <?php
        $sql = 'SELECT * FROM champion';
        $preparerExemple = $db->prepare($sql);
        $preparerExemple->execute();
        $list = $preparerExemple->fetchAll();
        foreach ($list as $value){
        ?>
            <div class="card col-3 pb-5 m-4" style="width: 18rem;">
                <div class="card-body text-center">
                    <img src="<?php echo $value['image'];?>" alt="">
                    <p class="card-text">Ville : <?php echo $value['ville'];?></p>
                    <p class="card-text">Champion : <?php echo $value['champion'];?></p>
                    <p class="card-text">Type : <?php echo $value['type'];?></p>
                    <p class="card-text">Badge : <?php echo $value['badge'];?></p>
                    <a href="index.php?id1=<?php echo $value['id'];?>" class="btn btn-secondary">Champion</a>
                </div>
            </div>
        <?php
        };
        ?> 
    </div>
</div>
<?php

