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
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("INSERT INTO fournisseurs (nom, adresse, telephone, email) VALUES (:nom, :adresse, :telephone, :email)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Fournisseur créé avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la création du fournisseur"]);
        }
    } elseif ($action == 'update') {
        $fournisseur_id = $_POST['fournisseur_id'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE fournisseurs SET nom = :nom, adresse = :adresse, telephone = :telephone, email = :email WHERE fournisseur_id = :fournisseur_id");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':fournisseur_id', $fournisseur_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Fournisseur mis à jour avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la mise à jour du fournisseur"]);
        }
    } elseif ($action == 'delete') {
        $fournisseur_id = $_POST['fournisseur_id'];

        $stmt = $conn->prepare("DELETE FROM fournisseurs WHERE fournisseur_id = :fournisseur_id");
        $stmt->bindParam(':fournisseur_id', $fournisseur_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Fournisseur supprimé avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la suppression du fournisseur"]);
        }
    }
} 
?>
