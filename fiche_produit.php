<?php
   require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/BD.inc.php');
   require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php');

    if(isset($_GET['id_produit'])) 
    { 
        $résultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); 
    } 
   
    
    if($résultat->num_rows <= 0) 
    { 
        header("location:boutique.php"); 
        exit(); 
    }
    $produit = $résultat->fetch_assoc();
    $contenu .= "<h2>Titre : $produit[titre]</h2><hr><br>";
    $contenu .= "<p>Categorie: $produit[categorie]</p>";
    $contenu .= "<p>Couleur: $produit[couleur]</p>";
    $contenu .= "<p>Taille: $produit[taille]</p>";
    $contenu .= "<img src='$produit[photo]' ='150' height='150'>";
    $contenu .= "<p><i>Descript: $produit[descript]</i></p><br>";
    $contenu .= "<p>Prix : $produit[prix] Fr</p><br>";
    
    if($produit['stock'] > 0)
    {
       
        $contenu .= "<i>Nombre de produit(s) disponible : $produit[stock]</i><br><br>";
        $contenu .= '<form methode="POST" action="panier.php">';
        $contenu .= "<input type='hidden' name = 'id_produit' value= '$produit[id_produit]'> ";
        $contenu .= '<label for = "quatite" >Quantite: </label>';
        $contenu .= '<select id= "quantite" name = "quantite">';
                for($i = 1; $i<= $produit['stock'] && $i <=5 ; $i++)
                    {
                        $contenu .= "<option>$i</options>";
                    }
        $contenu .= '</select>';
        $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
        $contenu .= '</form>';
    }
    else
    {
        $contenu .= 'Rupture de stock !';
    }
    $contenu .= "<br><a href='boutique.php?categorie=" . $produit['categorie'] . "'>
        Retour vers la séléction de " . $produit['categorie'] . "</a>";
        require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php');
            echo $contenu;
        require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/footer.inc.php');
?>