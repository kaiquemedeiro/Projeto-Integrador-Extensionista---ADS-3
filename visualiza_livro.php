<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Livros</title>
</head>
<body>
    <center>
        <h1>Livros Cadastrados</h1>
        <table border="4">
            <tr>
                <td>TÍTULO</td>
                <td>AUTOR</td>
                <td>GÊNERO</td>
                <td>ANO</td>
            </tr>
            <?php
                require("conecta.php");

                $dados_select = mysqli_query($conn, "SELECT TITULO, AUTOR, GENERO, ANO_PUBLICACAO FROM livro");

                while($dado = mysqli_fetch_array($dados_select)) {
                    echo '<tr>';
                    echo '<td>'.$dado['TITULO'].'</td>';
                    echo '<td>'.$dado['AUTOR'].'</td>';
                    echo '<td>'.$dado['GENERO'].'</td>';
                    echo '<td>'.$dado['ANO_PUBLICACAO'].'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
        <br />
        <a href="index.html"><input type="button" value="Voltar"></a>
    </center>
</body>
</html>
