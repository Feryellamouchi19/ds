<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajout article</title>
    </head>
    <body>
    <?php
    require_once 'include/database.php';
    include 'include/nav.php'?>
    < method="POST">

    <label class="form-label">nom</label>
        <input type="text"class="form-control" name="nom">


        <label class="form-label">prix_vente</label>
        <input type="text"class="form-control" name="prix_vente" min="0">

        <label class="form-label">taux_tva</label>
        <input type="text"class="form-control" name="taux_tva" min="0">

        <label class="form-label">quantite_stock</label>
        <input type="text"class="form-control" name="quantite_stock" min="0">
        <pre>
            <?php
            $articles=$pdo->query('select*from articles')->fetchAll(pdo::FETCH_ASSOC);

            ?>
        </pre>
        <select name="articles" id="">
            <option value="">choissisez un article</option>
            <?php
            foreach($articles as $article){
                echo"<option value='".$article['id']."'>".$article['nom']."</option>";
                ?>
            }
        </select>
    
    </form>

</head>
<body>
    
</body>
</html>