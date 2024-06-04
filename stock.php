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

    if ($action == 'update_stock') {
        $article_id = $_POST['article_id'];
        $quantite = $_POST['quantite'];

        $stmt = $conn->prepare("UPDATE articles SET quantite = :quantite WHERE article_id = :article_id");
        $stmt->bindParam(':quantite', $quantite);
        $stmt->bindParam(':article_id', $article_id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Stock mis à jour avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la mise à jour du stock"]);
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $stmt = $conn->prepare("SELECT * FROM articles");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($articles);
} else {
    echo json_encode(["message" => "Méthode non autorisée"]);
}
?>
