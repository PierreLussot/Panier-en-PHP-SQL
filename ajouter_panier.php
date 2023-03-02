 <?php
    include 'connexion_bdd.php';
    //verifier si une session existe
    if (!isset($_SESSION)) {
        //si non demarer la session
        session_start();
    }
    //creer la session
    if (!isset($_SESSION['panier'])) {
        //s'il existe pas une session on créer une et on met un tableau a l'interieur
        $_SESSION['panier'] = [];
    }
    //recuperation de l'id dans le lien 
    if (isset($_GET['id'])) { //si l'id a été envoyé alors :
        $id = $_GET['id'];
        //veririer grace a l'id si le produit existe dans la bdd
        $produit = mysqli_query($con, "SELECT * FROM products WHERE id = $id");
        if (empty(mysqli_fetch_assoc($produit))) {
            //si le produit n'existe pas 
            die("Ce produit n'existe pas !");
        }
        //ajouter le produit dans le panier (tableau)

        if (isset($_SESSION['panier'][$id])) { // si le produit est deja dans le panier

            $_SESSION['panier'][$id]++; //represente la quantité
        } else {
            //si non on ajoute le produit
            $_SESSION['panier'][$id] = 1;
        }

        header("Location:index.php");
    }

    ?>


