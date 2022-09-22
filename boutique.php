<?php
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/BD.inc.php');
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/fonction.inc.php');
    
     $catego_produit = executeRequete("SELECT DISTINCT categorie from produit");
     
     $contenu .= '<div class="boutique-gauche">';
     $contenu .= "<ul>";
        while($cat = $catego_produit->fetch_assoc())
        {
            $contenu .= "<li><a href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li>";
        }
    $contenu .= "</ul>";
    $contenu .= "</div>";
    //Affichage des produit
    
    $contenu .= '<div class="boutoque-droite">';
    if(isset($_GET['categorie']))
    {
        $donnees = executeRequete("SELECT id_produit, referenc,titre,photo,prix FROM produit WHERE categorie='$_GET[categorie]'");
        while($produit= $donnees->fetch_assoc())
        {
           
            $contenu .= '<div class = "bopitique-produit">';
            $contenu .= "<h2>$produit[titre]</h2>";
            $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
            $contenu .= "<p>$produit[prix]fr</p>";
            $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
            $contenu .= '</div>';
        }
    }
    $contenu .= '</div >';
        require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php');
        echo $contenu;
        require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/footer.inc.php');
?>