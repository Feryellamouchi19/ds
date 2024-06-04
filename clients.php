<?php
include 'database.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['client_id'])) {
    echo json_encode(["message" => "Vous devez être connecté pour accéder à cette page"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'create') {
        $login = $_POST['login'];
        $password = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("INSERT INTO clients (login, mot_de_passe, nom, prenom, adresse, telephone, email) VALUES (:login, :mot_de_passe, :nom, :prenom, :adresse, :telephone, :email)");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mot_de_passe', $password);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Client créé avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la création du client"]);
        }
    } elseif ($action == 'update') {
        $client_id = $_POST['client_id'];
        $login = $_POST['login'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE clients SET login = :login, nom = :nom, prenom = :prenom, adresse = :adresse, telephone = :telephone, email = :email WHERE client_id = :client_id");
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':client_id', $client_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Client mis à jour avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la mise à jour du client"]);
        }
    } elseif ($action == 'delete') {
        $client_id = $_POST['client_id'];

        $stmt = $conn->prepare("DELETE FROM clients WHERE client_id = :client_id");
        $stmt->bindParam(':client_id', $client_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Client supprimé avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la suppression du client"]);
        }
    }
} 
?>
