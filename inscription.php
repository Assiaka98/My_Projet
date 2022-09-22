<?php

    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/fonction.inc.php');
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php'); 
?>
<?php 

    if($_POST)
    {
        debug($_POST);
        $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
        if(!$verif_caractere && (strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20) ) 
        {
           $contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9 </div>";
            
        }
        else
            {
                $membre = executeRequete("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
                if($membre->num_rows)
                {
                    $contenu .= "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre svp.</div>";
                    echo "$contenu";
                }
                else
                {
                    foreach($_POST as $indice => $valeur)
                    {
                        $_POST[$indice] = htmlEntities(addSlashes($valeur));
                    }
                    executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) 
                    VALUES 
                    ('$_POST[pseudo]','$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', 
                    '$_POST[email]', '$_POST[sexe]', '$_POST[ville]', '$_POST[cp]', '$_POST[adresse]')");
                    $contenu .= 
                    "<div class='validation'>
                        Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vousconnecter</u></a>
                    </div>";
                    echo "$contenu";
                }
            }
        }   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
            <form method="POST" action=""> 
                        <p>
                            <label for="pseudo">Pseudo</label><br>
                            <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="Votre pseudo" title="Carracteres accepte a-zA-Z0-9-_." required="required"><br>
                        </p>
                        <p>
                            <label for="mdp">Mot de passe</label><br>
                            <input type="password" id="mdp" name="mdp" required="required"><br>
                        </p>
                        <p>
                            <label for="nom">Nom</label><br>
                            <input type="text" id="nom" name="nom" placeholder="Votre Nom"><br>
                        </p>
                        <p>
                            <label for="prenom">Prenom</label><br>
                            <input type="text" id="prenom" name="prenom" placeholder="Votre Prenom"><br>
                        </p>
                        <p>
                            <label for="email">E-mail</label><br>
                            <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br>
                        </p>           
                        <p>
                            <label for="sexe">Sexe</label><br>
                            <input name="sexe" value="H" checked="" type="radio">Masculin
                            <input name="sexe" value="F" type="radio">Feminin<br>
                        </p>
                        <p>
                            <label for="ville">Ville</label><br>
                            <input type="text" id="ville" name="ville" placeholder="Votre Ville" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."><br><br>
                        </p>
                        <p>
                            <label for="cp">Code Postal</label><br>
                            <input type="text" id="code" name="cp" placeholder="Votre Code Postal" pattern="[0-9]{5}" title="5 chiffres requis : 0-9"><br>
                        </p>
                        <p>
                            <label for="adresse">Adresse</label><br>
                            <textarea id="adresse" name="adresse" placeholder="votre dresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."></textarea><br><br>
                        </p>             
                        <p>
                            <input type="submit" name="inscription" value="S'inscrire"><br>
                        </p>
            </form> 
        <?php
            
            require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/footer.inc.php'); 
        ?>
        
    </body>
</html>