<?php
session_start();
 
if($_SERVER['REQUEST_METHOD']==="POST"){
    $nome = $_POST['nome'];
    $foto = $_FILES['foto'];
    $pasta = "images/";
    $caminho = $pasta . basename($foto['name']);
 
    setcookie("tema", $_POST["tema"], time() + 1800*2);
 
    try{
        move_uploaded_file($foto['tmp_name'], $caminho);
 
        $_SESSION['nome'] = $nome;
        $_SESSION['caminho'] = $caminho;
 
        header("Location: quiz.php");
        exit;
    }
    catch(Exception $e){
        echo "Erro" . $e;
    }
}
 
$tema = $_COOKIE["tema"] ?? "escuro";
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificação</title>
    <link rel="stylesheet" href="cadastro.css">
 
</head>
<body class="<?php echo $tema;?>">
<div class="auth-card">
    <form action="index.php" method="post" enctype="multipart/form-data">
    <label class="field-label">Nome:</label><br>
    <input type="text" name="nome" placeholder="seu nome" class="text-input" required><br>
 
    <label class="field-label">Avatar:</label><br>
    <input type="file" name="foto" accept="image/*" class="file-input" required><br>
 
    <label class="field-label">Tema:</label><br>
    <input type="radio" name="tema" value="claro">
    <label>Claro</label><br>
    <input type="radio" name="tema" value="escuro">
    <label>Escuro</label>
    <input type="submit" name="enviado" value="Começar quiz!" class="btn-primary">
</form>
</div>
 
</body>
</html>