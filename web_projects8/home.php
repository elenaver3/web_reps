<!DOCTYPE html>
<html lang="ru">
<?php require 'info.php' ?>   
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <title><?php echo $title;?></title>
</head>
<body>
    <?php include 'header.html' ?>
    <main>
        <h1>Заявка принята</h1>
        <section class="result">
            <p>
                <?php 
                if (isset($_POST['fio'])) {
                    echo '<p> Здравствуйте,'.$_POST['fio'].'</p>';
                }
                if (isset($_POST['type_request'])) {
                    if ($_POST['type_request'] == 'propose'){
                        echo '<p>Спасибо за ваше предложение:</p>';
                    }
                    else {
                        echo '<p>Мы рассмотрим Вашу жалобу:</p>';
                    }
                }
                if (isset($_POST['request_text'])) {
                    echo '<p>'.$_POST['request_text'].'</p>';
                }     
                if (isset($_POST['file']) & $_POST['file'] != '')
                    echo 'Вы приложили следующий файл: '.$_POST['file'];
                if (isset($_POST['source']))   
                    echo '<a class="button" href="form.php?fio='.$_POST['fio'].'&email='.$_POST['email'].'&source='.$_POST['source'].'"> Заполнить снова</a>';
                else {
                    echo '<a class="button" href="form.php?fio='.$_POST['fio'].'&email='.$_POST['email'].'"> Заполнить снова</a>';
                }
                ?>
            </p>
        </section>
        <section class="image_section" style="margin-bottom: 40px">
            <img <?php echo 'src="images/cat21_'.(date('s') % 2+1).'.jpg"'?> alt="Кот" height="300px">
            <img <?php echo 'src="images/cat22_'.(date('s') % 2+1).'.jpg"'?> alt="Кот2" height="300px">
        </section>
    </main>
    <footer>
        <div class="container">
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