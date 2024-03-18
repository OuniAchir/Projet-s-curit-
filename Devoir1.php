<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
<div id="corps">
    <input id="email" name="email" type="email" value="Anass@aaa.aa">
    <input id="password" name="password" type="password" value="aaa">
    <button type="button" onclick="resetForm()">Reset</button>
    <button type="button" onclick="signInForm()">Inscription</button>
    <button type="button" onclick="logInFrom()">Connexion</button>
</div>
<script>
    function resetForm() {
        document.getElementById('email').value = "";
        document.getElementById('password').value = "";
    }
    function signInForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Traitement de la réponse
                alert(xhr.responseText);
            }
        };
        xhr.send('etat=inscription&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
    }
    function logInFrom(){
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Traitement de la réponse
                alert(xhr.responseText);
            }
        };
        xhr.send('etat=connexion&email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
    }
</script>
</body>
</html>
