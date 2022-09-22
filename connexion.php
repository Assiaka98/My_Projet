<?php

    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/BD.inc.php');
    require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/header.inc.php');
?>

<?php

    if(isset($_GET['action']) && $_GET['action']== "deconnexion")
    {
        session_destroy();
    }
    if(internauteEstConnecte())
    {
        header("location:profil.php");
    }

    if($_POST)
    {

        $résultat = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
        if($résultat->num_rows != 0)
        {
            $membre = $résultat->fetch_assoc();
            if($membre['mdp'] == $_POST['mdp'])
            {
                $contenu .= '<div class="validation">mdp connu!</div>';
                foreach($membre as $indice => $element)
                {
                    if($indice != 'mdp')
                        {
                            $_SESSION['membre'][$indice] = $element;
                        }
                }
                header("location:profil.php");
            }
            else
            {
                $contenu .= '<div class="erreur">Mot de passe incorrecte</div>';
                echo $contenu;
            }
        }
        else
        {
            $contenu .= '<div class="erreur">Erreur de pseudo</div>';
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="inc/css/style.css">
    </head>
    <body>

        <form method="POST" action="">
            <p>
                <label for="pseudo">Pseudo</label><br>
                <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="Votre pseudo" title="Carracteres accepte a-zA-Z0-9-_." required="required"><br>
            </p>
            <br>
            <p>
                <label for="mdp">Mot de passe</label><br>
                <input type="password" id="mdp" name="mdp" required="required"><br>
            </p>
            <br>
            <p>
                <input type="submit" value="Se connecter">
            </p>
        </form> 
        <?php  require_once('/home/sakha/Bureau/Xampp/E-Commerce/inclusion/footer.inc.php');?>
    </body>
</html>


