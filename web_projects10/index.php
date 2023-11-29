<!DOCTYPE html>
<html lang="ru">
<?php
    require 'info.php';   

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <title><?php echo $title;?></title>
</head>
<body class="algo">
    <?php include 'header.html' ?>
    <main>
        <h1>Ввод текста</h1>
        <section class="text text_on_enter">
            <form name="elements" method="POST" action="result.php">
            <p class="head">Текст</p>
                <div class="inputs">
                    <textarea cols="40" rows="10" name="data"></textarea>
                </div>
                <p><input type="submit" name="submit" class="button"></p>
            </form>

        </section>
    </main>
    <footer>
        <div class="container">
            <p><?php if (isset($_GET['type'])) {echo 'Тип верстки: '.$_GET['type'];} ?></p>
            <p>
                Почта: e.v.verstova@mail.ru<br>
                Контактный телефон: +7(929)659-32-57<br>
                © Верстова Елена, 2023<br>
                <?php echo 'Сформировано ', date("d.m.Y"), ' в ', date("H:i:s");?>
            </p>
        </div>
    </footer>
</body>
</html>