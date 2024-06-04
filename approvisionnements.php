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
        $fournisseur_id = $_POST['fournisseur_id'];
        $article_id = $_POST['article_id'];
        $quantite = $_POST['quantite'];
        $prix_achat = $_POST['prix_achat'];
        $date_approvisionnement = $_POST['date_approvisionnement'];

        $stmt = $conn->prepare("INSERT INTO approvisionnements (fournisseur_id, article_id, quantite, prix_achat, date_approvisionnement) VALUES (:fournisseur_id, :article_id, :quantite, :prix_achat, :date_approvisionnement)");
        $stmt->bindParam(':fournisseur_id', $fournisseur_id);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':prix_achat', $prix_achat);
        $stmt->bindParam(':date_approvisionnement', $date_approvisionnement);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Approvisionnement créé avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la création de l'approvisionnement"]);
        }
    } elseif ($action == 'update') {
        $approvisionnement_id = $_POST['approvisionnement_id'];
        $fournisseur_id = $_POST['fournisseur_id'];
        $article_id = $_POST['article_id'];
        $quantite = $_POST['quantite'];
        $prix_achat = $_POST['prix_achat'];
        $date_approvisionnement = $_POST['date_approvisionnement'];

        $stmt = $conn->prepare("UPDATE approvisionnements SET fournisseur_id = :fournisseur_id, article_id = :article_id, quantite = :quantite, prix_achat = :prix_achat, date_approvisionnement = :date_approvisionnement WHERE approvisionnement_id = :approvisionnement_id");
        $stmt->bindParam(':fournisseur_id', $fournisseur_id);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':prix_achat', $prix_achat);
        $stmt->bindParam(':date_approvisionnement', $date_approvisionnement);
        $stmt->bindParam(':approvisionnement_id', $approvisionnement_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Approvisionnement mis à jour avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la mise à jour de l'approvisionnement"]);
        }
    } elseif ($action == 'delete') {
        $approvisionnement_id = $_POST['approvisionnement_id'];

        $stmt = $conn->prepare("DELETE FROM approvisionnements WHERE approvisionnement_id = :approvisionnement_id");
        $stmt->bindParam(':approvisionnement_id', $approvisionnement_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Approvisionnement supprimé avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la suppression de l'approvisionnement"]);
        }
    }
} 
?>
