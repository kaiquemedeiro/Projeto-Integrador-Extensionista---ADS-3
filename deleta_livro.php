<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'projeto'; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id_livro = intval($_GET['id']);

    $sql = "DELETE FROM livro WHERE id_livro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_livro);

    if ($stmt->execute()) {
        echo "Livro excluído com sucesso!";
        header("Location: visualiza_livro.php");
        exit();
    } else {
        echo "Erro ao excluir o livro: " . $conn->error;
    }
} else {
    echo "ID do livro não informado.";
}
?>
