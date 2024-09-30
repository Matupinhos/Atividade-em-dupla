<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "atividade_dupla_matheus";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn -> connect_error){
        die("Falha na conexão : ". $conn -> connect_error);
    }
    if(isset($_POST['create_professor'])){
        $nome_professor = $_POST['nome_professor'];

        $sql = "INSERT INTO professor (nome_professor)
        VALUES ('$nome_professor')";
        if($conn -> query($sql) === TRUE){
            echo "Novo professor adicionado com sucesso!";
        }else{
            echo "Erro:". $sql."<br>".$conn->error;
        }
    }
    if(isset($_POST['create_sala'])){
        $numero_sala = $_POST['numero_sala'];

        $sql = "INSERT INTO aula (numero_sala)
        VALUES ('$numero_sala')";
        if($conn -> query($sql) === TRUE){
            echo "Nova aula adicionada com sucesso!";
        }else{
            echo "Erro:". $sql."<br>".$conn->error;
        }
    }
    if (isset($_POST['update_professor'])){
        $nome_professor = $_POST['nome_professor'];
        $id = $_POST['id'];

        $sql = "UPDATE professor SET nome_professor='$nome_professor' WHERE id = '$id'";
        if($conn -> query($sql) === TRUE){
            echo "Alteração feita com sucesso!";
        }else{
            echo "Erro:". $sql."<br>".$conn->error;
        }
    }
    if (isset($_POST['update_aula'])){
        $numero_sala = $_POST['numero_sala'];
        $id = $_POST['id'];

        $sql = "UPDATE aula SET numero_sala='$numero_sala' WHERE id = '$id'";
        if($conn -> query($sql) === TRUE){
            echo "Alteração feita com sucesso!";
        }else{
            echo "Erro:". $sql."<br>".$conn->error;
        }
    }
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $sql = "DELETE FROM professor WHERE id=$id";
        $sql = "DELETE FROM aula WHERE id=$id";

        if($conn -> query($sql) === TRUE){
            echo "Excluido com sucesso!";
        }else{
            echo "Erro:". $sql."<br>".$conn->error;
        }
    }
    $result = $conn -> query("SELECT * FROM professor");
    $result_aulas = $conn -> query("SELECT * FROM aula")
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD em dupla</title>
</head>
<body>
    <h2>Adicionar Professor</h2>
    <form method="POST" action="">
        Nome do Professor: <input type="text" name="nome_professor" required>
        <button type="submit" name="create_professor">Adicionar</button>
    </form>
    <h2>Adicionar Aula</h2>
    <form method="POST" action="">
        Numero da sala: <input type="number" name="numero_sala" required>
        <button type="submit" name="create_sala">Adicionar</button>
    </form>
    <h2>Ver professores</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome do Professor</th>
        </tr>
        <?php while($row = $result -> fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome_professor']; ?></td>
                <td> 
                    <a href="index.php?delete=<?php echo $row['id'] ?>">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <h2>Ver Aulas</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Numero Sala</th>
        </tr>
        <?php while($row = $result_aulas -> fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['numero_sala']; ?></td>
                <td> 
                    <a href="index.php?delete=<?php echo $row['id'] ?>">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <h2>Atualizar Professor</h2>
    <form method="POST">
        ID do professor <input type="number" name="id" required>
        Mudar Nome do Professor: <input type="text" name="nome_professor" required>
        <button type="submit" name="update_professor">Mudar</button>
    </form>
    <h2>Atualizar Aulas</h2>
    <form method="POST">
        ID da aula <input type="number" name='id'>
        Mudar Nome da Aula: <input type="number" name="numero_sala" required>
        <button type="submit" name="update_aula">Mudar</button>
    </form>
</body>
</html>