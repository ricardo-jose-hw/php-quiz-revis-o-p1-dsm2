<?php
session_start();
 
$file = file_get_contents('perguntas.json');
$perguntas = json_decode($file, true);
 
$acertos = 0;
 
foreach ($perguntas as $p) {
 
    $numero = $p['numero'];
 
    if (isset($_POST[$numero])) {
 
        $resposta = $_POST[$numero];
 
        if ($resposta == $p['resposta']) {
            $acertos++;
        }
    }
}
$porcentagem = $acertos * 100 / 30;
$tema = $_COOKIE["tema"] ?? "escuro";
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link rel="stylesheet" href="resultados.css">
</head>
<body class="<?php echo $tema;?>">
<div class="resultado-card">
    <h2 class="resultado-titulo">Você acertou <?php echo $porcentagem; ?>%!</h2>
    <a href="quiz.php" class="btn-refazer">Jogar novamente</a>
</div>
</body>
</html>
 