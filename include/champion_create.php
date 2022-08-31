<div class="container">
    <form action="index.php?champion" method="POST" enctype="multipart/form-data">
        <div class="div">
            <label>Ville</label>
            <input type="text" class="form-control" name="ville" placeholder="Ville">
        </div>
        <div>
            <label>Nom</label>
            <input type="text" class="form-control" name="champion" placeholder="Nom">
        </div>
        <div>
            <label>Type</label>
            <input type="text" class="form-control" name="type" placeholder="Type">
        </div>
        <div>
            <label>Badge</label>
            <input type="text" class="form-control" name="badge" placeholder="Badge">
        </div>
        <div>
            <label>Image du Champion</label><br>
            <input type="file" name="image1" id="image1" accept="image/png, image/jpeg">
        </div>
        <input type="submit" name="submit" value="submit" class="btn btn-success">
    </form>
</div>
