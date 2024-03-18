<?php
session_start();
$token = $_SESSION['token'] ?? ''; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 280px; 
            max-width: 100%; 
            margin: 0 auto;
            overflow: hidden;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, input[type="submit"], input[type="reset"] {
            width: calc(100% - 16px); 
            padding: 6px; 
            margin-bottom: 8px; 
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px; 
        }

        input[type="submit"], input[type="reset"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            margin-bottom: 12px; 
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<?php
require('recaptcha/autoload.php');
 if(isset($_POST['ok'])) {
  if(isset($_POST['g-recaptcha-response'])) {
      $recaptcha = new \ReCaptcha\ReCaptcha('6LfXcWwpAAAAAFI-gO7ogMoOB_JMb9DWO8dZPLHT');
      $resp = $recaptcha->verify($_POST['g-recaptcha-response']);
     if ($resp->isSuccess()) {
         var_dump('Captcha Valide');
    } else {
        $errors = $resp->getErrorCodes();
        echo htmlentities('Captcha Invalide');
    }
    } else {
        echo htmlentities('Captcha non rempli');
    }
 }
?>

<body>
    <form method="POST" action="traitement.php" onsubmit="return validateForm()" style="background-image: url('logo10.PNG'); background-size: cover; background-position: center; padding: 50px; border-radius: 30px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); width: 300px;">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Entrez votre nom..." required>

        <label for="prénom">Prénom :</label>
        <input type="text" id="prénom" name="prenom" placeholder="Entrez votre prénom..." required>

        <label for="date_naissance">Date de naissance :</label>
        <input type="date" id="date_naissance" name="date_naissance" required>

        <label for="pseudo">Pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo..." required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="Entrez votre email..." required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Tapez votre mot de passe..." required>

        <label for="confirme">Confirmer le mot de passe :</label>
        <input type="password" id="confirme" name="confirme"placeholder="Re tapez votre mot de passe..." required>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <div class="g-recaptcha" data-sitekey="6LfXcWwpAAAAAAV0L_t6xfEGsEwL7Zo90Rv-mj9G"></div>
        <br/>

        <input type="hidden" name="token" id="token" value="<?php echo $token;?>"/>

        <input type="submit" value="S'inscrire" name="ok">
        <input type="reset" value="Réinitialiser" name="reset">
    </form>

</body>
</html>
