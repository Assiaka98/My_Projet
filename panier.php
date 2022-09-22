<?php

    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/BD.inc.php');
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php');
    // AJOUT PANIER
    if(isset($_POST['ajout_panier']))
    {
        $resutat= executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
        $produit = $resutat->fetch_assoc();
        ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'],$_POST['quantite'],$produit['prix']);
    }
  

    echo $contenu;
    echo "<table border='1' style='border-collapse: collapse; margin: 15px' cellpadding='7'>";
    echo "<tr><td colspan='5' style='text-align: center;'>Panier</td></tr>";
    echo "<tr>
                <th>Titre</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Actions</th>
            </tr>";
       if(empty($_SESSION['panier']['id_produit'])) // panier vide
        {
            echo "<tr><td colspan='5' style='text-align: center;'>Votre panier est vide</td></tr>";
        }
        else
        {
            for($i = 0; $i <count($_SESSION['panier']['id_produit']); $i++) 
            {
                echo "<tr>";
                echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
                echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
                echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
                echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
                echo "<td>" . $_SESSION['panier'][''][$i] . "</td>";
                echo "</tr>";
            }
            echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . montantTotal() . " franc</td></tr>";
            if(internauteEstConnecte()) 
            {
                echo '<form method="post" action="">';
                    echo '<tr>
                            <td colspan="5">
                            <input type="submit" name="payer" value="Valider et déclarer le paiement">
                        </td>
                    </tr>';
            echo '</form>';   
        }
        else
        {
            echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php"><strong>inscrire</strong></a> ou vous <a href="connexion.php"><strong>connecter</strong></a> afin de pouvoir payer</td></tr>';
        }
        echo "<tr>
                        <td colspan='5' style='text-align: center;' >
                            <a href='?action=vider'>Vider mon panier</a>
                        </td>
                    </tr>";
        }
        
        echo "</table><br>";
        echo "<i>Payer a la livraison</i><br>";

    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/footer.inc.php');
?>
