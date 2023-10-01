<?php

$host = "mysql";
$dbname = "my-wonderful-website";
$charset = "utf8";
$port = "3306";

try {
    $pdo = new PDO(
        dsn: "mysql:host=$host;dbname=$dbname;charset=$charset;port=$port",
        username: "root",
        password: "super-secret-password",
    );

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $LastName = $_POST['last_name'];
        $FirstName = $_POST['first_name'];
        $Password1 = $_POST['password1'];
        $Password2 = $_POST['password2'];

        $stmt = $pdo->prepare("INSERT INTO Persons (LastName, FirstName, Password1, Password2) VALUES (?, ?, ?, ?)");
        $stmt->execute([$LastName, $FirstName, $Password1, $Password2]);
	header("Location: done.html");
    	exit();
    }

    /*$persons = $pdo->query("SELECT * FROM Persons");

    echo '<pre>';
    foreach ($persons->fetchAll(PDO::FETCH_ASSOC) as $person) {
        print_r($person);
    }
    echo '</pre>';*/

} catch (PDOException $e) {
    throw new PDOException(
        message: $e->getMessage(),
        code: (int)$e->getCode()
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'insertion</title>
</head>
<body>
	<h1>Welcome!</h1>
	<h2>Vous devez saisir les informations suivantes pour la mise à jour de votre compte</h2>
    <form method="POST">
        <label for="first_name">Prénom:</label>
        <input type="text" id="first_name" name="first_name"><br>

        <label for="last_name">Nom:</label>
        <input type="text" id="last_name" name="last_name"><br>

	<label for="password1">Old password:</label>
        <input type="password" id="password1" name="password1"><br>

	<label for="password2">New password:</label>
        <input type="password" id="password2" name="password2"><br>


        <input type="submit" value="Submit">
    </form>
</body>
</html>

