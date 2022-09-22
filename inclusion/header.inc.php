<!DOCTYPE html>
<html>
    <head>
        <title>E-Commerce</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inclusion/css/style.css">
    </head>
    <body>
        <header>
            <div class="conteneur">
                <div class="titre">
                    <a href="" title="E-Commerce">E-Commerce</a>
                </div>
                <nav>
                    <?php
                        require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/BD.inc.php');
                        require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/fonction.inc.php');
                       
                        if(internauteEstConnecteEtestAdmin())
                        { 
                            echo '<a href="' . RACINE_SITE . 'admin/gestion_membre.php">Gestion des membres</a>';
                            echo '<a href="' . RACINE_SITE . 'admin/gestion_commande.php">Gestion des commandes</a>';
                            echo '<a href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a>';
                        }

                        if(internauteEstConnecte())
                        {
                            echo '<a href="' . RACINE_SITE . 'profil.php">Votre profil</a>';
                            echo '<a href="' . RACINE_SITE . 'boutique.php">Acces a la boutique</a>';
                            echo '<a href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
                            echo '<a href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se deconnecter</a>';
                            
                        }

                        else
                        {
                           echo '<a href=" '. RACINE_SITE .'incription.php">Inscription</a>';
                           echo '<a href=" '. RACINE_SITE .' connexion.php">Connexion</a>';
                           echo '<a href=" '. RACINE_SITE .'boutique.php">Acesse a la boutique</a>';
                           echo '<a href=" '. RACINE_SITE .' panier.php">Voir votre panier</a>';
                        }
                    ?>
                </nav>
            </div>
        </header>   
    </body>
</html>