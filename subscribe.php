<!DOCTYPE html>
<html>
<head>
  <title>Afficher la newsletter</title>
  <style>
    body {
      font-family: sans-serif;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f0f0f0;
    }

    form {
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    table {
      width: 80%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
<p>Vous avez été enregistré</p>
<?php

// Informations de connexion à la base de données
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "newsletters"; 

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Fonction pour afficher le contenu de la table users
function afficherUsers($conn) {
  $sql_tout = "SELECT * FROM users";
  $result_tout = $conn->query($sql_tout);

  if ($result_tout->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Email</th></tr>";
    while($row = $result_tout->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "La base de données est vide.";
  }
}

// Afficher le bouton "Afficher tout" 
echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
echo '  <input type="submit" name="afficher_tout" value="Afficher tout">';
echo '</form>';

// Afficher le tableau et le bouton "Réduire" si le bouton "Afficher tout" est cliqué
if (isset($_POST['afficher_tout'])) {
  afficherUsers($conn);

  // Bouton pour masquer le tableau
  echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
  echo '  <input type="submit" name="reduire" value="Réduire">';
  echo '</form>';
}

$conn->close();

?>

</body>
</html>
