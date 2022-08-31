<div class="container">
    <form action="index.php?pokedeck" method="POST" enctype="multipart/form-data">
        <div>
            <label>Numéro</label>
            <input type="number" class="form-control" name="numero" placeholder="Numéro" >
        </div>
        <div>
            <label>Nom</label>
            <input type="text" class="form-control" name="first_name" placeholder="Pokémon">
        </div>
        <div>
            <label>Type 1</label>
            <input type="text" class="form-control" name="type1" placeholder="Type du pokémon">
        </div>
        <div>
            <label>Type 2</label>
            <input type="text" class="form-control" name="type2" placeholder="Type du pokémon">
        </div>
        <div>
            <label>Image du Pokémon</label><br>
            <input type="file" name="img" id="img" accept="image/png, image/jpeg">
        </div>
        <input type="submit" name="submit1" value="submit" class="btn btn-success">
    </form>
</div>

