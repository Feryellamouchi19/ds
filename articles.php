<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>description</th>
                <th>prix_achat</th>
                <th>prix_vente</th>
                <th>taux_tva</th>
                <th>quantite_stock</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'include/database.php';
            $articles=$pdo->query('select* from articles')->fetchall(pdo::FETCH_ASSOC);
            foreach($articles as $article){
                ?>
                <tr>
                    <td><?php echo $article['id']?></td>
                    <td><?php echo $article['nom']?></td>
                    <td><?php echo $article['description']?></td>
                    <td><?php echo $article['prix_achat']?></td>
                    <td><?php echo $article['prix_vente']?></td>
                    <td><?php echo $article['taux_tva']?></td>
                    <td><?php echo $article['quantite_stock']?></td>
                    <td>
                        <a href="modifier _articles.php"?id=<?php echo $article['id']?>class="btn btn-primary">modifier</a>
                        <a href="supprimer_articles.php"?id=<?php echo $article['id']?> onclick="return confirm (voulez vous supprimer cetclass="btn btn-danger">upprimer</a>
                    </td>
                </tr>
            }
        </tbody>
    </table>
</body>
</html>