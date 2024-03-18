<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('background.PNG');
            background-size: contain;
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
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #message-container {
            margin-bottom: 16px;
            text-align: center;
        }

        #message-container p {
            color: #ff3131; 
        }
        #notification {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 999;
            display: none;
        }

        #notification.error {
            background-color: #ff0000;
        }

        #notification button {
            background-color: #333;
            color: white;
            border: none;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
  
</head>
<body>

<form method="POST" action="traitement_connexion.php" onsubmit="return validateLoginForm()" style="background-image: url('logo8.PNG'); background-size: cover; background-position: center; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px;">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" placeholder="Entrez votre email..." required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe..." required>

    <input type="hidden" name="token" id="token" value="<?php echo $token;?>"/>

    <input type="submit" value="Se connecter" name="ok">
    <input type="submit" value="Ajouter un compte" name="inscrire" onclick="removeValidation()">
    <input type="reset" value="Réinitialiser" name="reset">
</form>

<script>
    function validateLoginForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        if (email.trim() === '' || password.trim() === '') {
            afficherNotification("Les deux champs sont obligatoires pour se connecter", 'error');
            return false;
        }
        return true;
    }

    function removeValidation() {
        document.getElementById("email").removeAttribute("required");
        document.getElementById("password").removeAttribute("required");
    }
</script>

</body>
</html>