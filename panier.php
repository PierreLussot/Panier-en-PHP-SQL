<?php
session_start();
include 'connexion_bdd.php';
//supprimer les produits
//si la variable delete existe
if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    //suppresion
    unset($_SESSION['panier'][$delete]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="panier">
    <a href="index.php" class="link">Boutique</a>
    <section>
        <table>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
            <?php
            $total = 0;
            //recupere les clés du tableau session
            $ids = array_keys($_SESSION['panier']);
            //si il n'y a aucune clé dans le tableau
            if (empty($ids)) {
                echo "Votre panier est vide";
            } else {
                //si oui
                $produits = mysqli_query($con, "SELECT * FROM products WHERE id IN(" . implode(',', $ids) . ")");
                //liste des produits avec une boucle foreach
                foreach ($produits as $produit) {
                    $total  = $total + $produit['price'] * $_SESSION['panier'][$produit['id']];
            ?>
                    <tr>
                        <td><img src="img/<?= $produit['img'] ?>" alt=""> </td>
                        <td><?= $produit['name'] ?></td>
                        <td><?= $produit['price'] ?></td>
                        <td><?= $_SESSION['panier'][$produit['id']]; //quatité
                            ?></td>
                        <td> <a href="panier.php?delete=<?= $produit['id'] ?>"><img src="img/delete.png" alt=""></a> </td>
                    </tr>
            <?php
                }
            }
            ?>


            <tr class="total">

                <th>Total: <?= $total ?> €</th>
            </tr>
        </table>
    </section>
</body>

</html>