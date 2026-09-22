<?php
session_start();
 
$file = file_get_contents('perguntas.json');
$perguntas = json_decode($file, true);
 
$nome = $_SESSION['nome'] ?? '';
$caminho = $_SESSION['caminho'] ?? '';
$tema = $_COOKIE["tema"] ?? "escuro";
 
?>
 
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body class="<?php echo $tema;?>">
<div class="quiz-page">
    <form action="resultado.php" method="post" enctype="multipart/form-data">
    <?php
    echo "<div class='quiz-header'><img src='$caminho' class='quiz-avatar'><h2 class='quiz-username'>$nome</h2></div>";
    foreach($perguntas as $p){
 
        ?>
        <section class="pergunta-card">
            <div class="pergunta-cabecalho">
                <h2 class="pergunta-num"><?php echo $p['numero'];?></h2>
                <h2 class="pergunta-texto"><?php echo $p['pergunta'];?></h2>
            </div>
 
            <div class="opcoes"><?php  foreach($p['opcoes'] as $ops){
                $id = "opcao" . $p['numero'] . "_" . $ops;
                echo "<div class='opcao'>";
                echo "<input type='radio' name=" . $p['numero'] . " value='$ops' id='$id'>";
                echo "<label for='$id'>$ops</label>";
                echo "</div>";
    } ;?></div>
        </section>
    <?php
    
        }
    ?>
    <button type="submit" class="btn-finish">Enviar!</button>
    </form>
</div>
</body>
</html>