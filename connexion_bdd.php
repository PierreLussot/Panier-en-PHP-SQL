<?php
$con = mysqli_connect("localhost", "root", "root", "panier");


if (!$con) {
    die('Erreur : ' . mysqli_connect_error());
} else {
   // echo "Connexion réussie !";
}
