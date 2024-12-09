<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'projeto'; // Substituir pelo nome real do banco de dados

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id_livro = intval($_GET['id']);

    // Buscar informações do livro pelo ID
    $sql = "SELECT * FROM livro WHERE id_livro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_livro);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $livro = $result->fetch_assoc();
    } else {
        echo "Livro não encontrado.";
        exit();
    }
} else {
    echo "ID do livro não informado.";
    exit();
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $descricao = $_POST['descricao'];

    // Atualizar informações do livro
    $sql = "UPDATE livro SET titulo = ?, autor = ?, genero = ?, ano_publicacao = ?, descricao = ? WHERE id_livro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $titulo, $autor, $genero, $ano_publicacao, $descricao, $id_livro);

    if ($stmt->execute()) {
        echo "Livro atualizado com sucesso!";
        header("Location: visualiza_livro.php");
        exit();
    } else {
        echo "Erro ao atualizar o livro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <form method="POST">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro['titulo']); ?>" required><br>

        <label for="autor">Autor:</label><br>
        <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($livro['autor']); ?>" required><br>

        <label for="genero">Gênero:</label><br>
        <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($livro['genero']); ?>" required><br>

        <label for="ano_publicacao">Ano de Publicação:</label><br>
        <input type="number" id="ano_publicacao" name="ano_publicacao" value="<?php echo htmlspecialchars($livro['ano_publicacao']); ?>" required><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($livro['descricao']); ?></textarea><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
