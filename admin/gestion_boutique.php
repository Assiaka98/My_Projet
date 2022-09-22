<?php
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/BD.inc.php'); 
    if(!internauteEstConnecteEtEstAdmin())
    {
            header("location:../connexion.php");
            exit();
    }
    if(!empty($_POST))
    {
        $photo_bdd = "";
        if(!empty($_FILES['photo']['name']))
        {
           $nom_photo = $_POST['referenc'] . '_' .$_FILES['photo']['name'];
           $photo_bdd = RACINE_SITE . "photo/$nom_photo";
           $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE ."/photo/$nom_photo";
           copy($_FILES['photo']['tmp_name'],$photo_dossier); 
        }
        foreach($_POST as $indice => $valeur)
        {
            $_POST[$indice] = htmlentities(addslashes($valeur));
        }
        executeRequete("REPLACE INTO produit (referenc, categorie, titre, descript, couleur, taille, public, photo, prix, stock)
        VALUES('$_POST[referenc]', '$_POST[categorie]', '$_POST[titre]', '$_POST[descript]', '$_POST[couleur]', 
        '$_POST[taille]','$_POST[public]', '$photo_bdd','$_POST[prix]' , '$_POST[stock]')");
        $contenu .='<div class= "validation">Le produit a ete ajoute avec successe</div>';
        
    }
    // LIENS VERS LES PRODUITS //
    $contenu .= '<a href="?action=affichage">Affichage des produits</a><br>';
    $contenu .= '<a href="?action=ajout">Ajout d un produit</a><br>';

    //AFFICHAGES DES PRODUITS //
    if(isset($_GET['action']) && $_GET['action']== "affichage")
    {
        $resultat = executeRequete("SELECT * FROM produit");
        $contenu .= '<h2>AFFICHAGES DES PRODUITS</h2>';
        $contenu .= 'Nombre de produit(s) dans la boutique :' .$resultat->num_rows;
        $contenu .= '<table border= "1"><tr>';
        while($colonne = $resultat->fetch_field())
        {
            $contenu .= '<th>' .$colonne->name . '</th>';
        }
        $contenu .='<th>Modification</th>';
        $contenu .='<th>Suprimer</th>';
        $contenu .='</tr>';
        while($ligne = $resultat->fetch_assoc())
        {
            $contenu .= '<tr>';
            foreach($ligne as $indice => $information)
            {
                if($indice == "photo")
                {
                    $contenu .='<td><img src=" . $information ." ="70" height="70"></td>';
                }
                else
                {
                    $contenu .='<td>' . $information . '</td>';
                }
            }
            $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id_produit'] .'"><img src="../inc/img/edit.png"></a></td>';
            $contenu .= '<td><a href="?action=suppression&id_produit=' . $ligne['id_produit'] .'" OnClick="return(confirm(\'En etes vous certain ?\'));"><img 
            src="../inc/img/delet.png"></a></td>';
            $contenu .= '</th>';
        }
        $contenu .= '</table></tr><br>';
    }   

        
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php');
  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>   
    </head>
    <body>
       
       <?php
            echo $contenu;
            if(isset($_GET['action']) && ($_GET['action'] == 'ajout'))
            {
                echo '
                <h1> Formulaire Produits </h1>
                <form method="POST" enctype="multipart/form-data" action="">
                    <label for="referenc">reference</label><br>
                    <input type="text" id="referenc" name="referenc" placeholder="la référence de produit"> <br><br>
                    
                    <label for="categorie">categorie</label><br>
                    <input type="text" id="categorie" name="categorie" placeholder="la categorie de produit"> <br><br>
                    
                    <label for="titre">titre</label><br>
                    <input type="text" id="titre" name="titre" placeholder="le titre du produit">  <br><br>
                    
                    <label for="descript">description</label><br>
                    <textarea name="descript" id="descript" placeholder="la description du produit"></textarea><br><br>
                    
                    <label for="couleur">couleur</label><br>
                    <input type="text" id="couleur" name="couleur" placeholder="la couleur du produit"> <br><br>
    
                    <label for="taille">Taille</label><br>
                    <select name="taille">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select><br><br>
    
                    <label for="public">public</label><br>
                    <input type="radio" name="public" value="H">Homme
                    <input type="radio" name="public" value="F">Femme<br><br>
    
                    <label for="photo">photo</label><br>
                    <input type="file" id="photo" name="photo"><br><br>
    
                    <label for="prix">prix</label><br>
                    <input type="text" id="prix" name="prix" placeholder="le prix du produit"><br><br>
                
                    <label for="stock">stock</label><br>
                    <input type="text" id="stock" name="stock" placeholder="le stock du produit"><br><br>
                    
                    <input type="submit" value="Enregitrment du produit">
                   
                </form>';
            }

       ?>
       
    </body>
</html>
<?php require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/footer.inc.php');?>
