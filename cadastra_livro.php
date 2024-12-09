<?php
require("conecta.php");

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$genero = $_POST['genero'];
$ano_publicacao = $_POST['ano_publicacao'];
$descricao = $_POST['descricao'];

$sql = "INSERT INTO livro (titulo, autor, genero, ano_publicacao, descricao) 
        VALUES ('$titulo', '$autor', '$genero', '$ano_publicacao', '$descricao')";

if ($conn->query($sql) === TRUE) {
    echo "<center><h1>Livro cadastrado com sucesso!</h1>";
    echo "<a href='index.html'><input type='button' value='Voltar'></a></center>";
} else {
    echo "<h3>Ocorreu um erro: </h3>: " . $sql . "<br>" . $conn->error;
}
?>
