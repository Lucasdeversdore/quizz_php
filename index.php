<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username'], 'UTF-8');

    header("Location: " . $_SERVER['PHP_SELF']); // reset la page
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d3d3d3; 
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; 
        }

        .header > image {
            width: 60%; 
            height: auto;
            max-width: 600px; 
            margin-bottom: 20px; 
        }

        .formulaier {
            background: #f2f2f2; 
            border-radius: 8px;
            padding: 30px;
            width: 450px;
            text-align: center;
        }

        h1 {
            color: #ff4d4d;
            font-size: 2.4em; 
        }

        label {
            display: block;
            color: #ff4d4d;
        }

        input {
            margin: 20px 0;
            padding: 12px;
            border: 1px solid;
            border-radius: 4px;
        }

        button {
            background-color: #ff4d4d; 
            color: white;
            border: none;
            border-radius: 4px;
            padding: 15px 20px;
            font-size: 1.2em; 
            width: 100%;
        }

        button:hover {
            background-color: #ff4d4d; 
        }

    </style>
</head>
<body>
    <img src="image/quizz.png" alt="Quizz Image" class="header-image"> 

    <div class="formulaier">
        <h1>Bienvenue</h1>
        <form action="gerer_fichier.php?action=upload" method="POST" enctype="multipart/form-data">
            <label for="username">Entrez votre nom d'utilisateur :</label>
            <input type="text" name="username" id="username" required>
            <label for="fileInput">Téléchargez un fichier JSON :</label>
            <input type="file" name="quizFile" id="fileInput" accept=".json" required> <!-- que les fichiers JSon -->
            <button type="submit">Bonne chance</button>
        </form>
    </div>

</body>
</html>
