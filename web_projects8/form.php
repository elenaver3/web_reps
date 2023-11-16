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
        <h1>Форма заявки</h1>
        <section class="text">
            <h2>Оставить обращение</h2>
            <p>
                Здесь вы можете направить нам запрос по интересующей Вас теме.
            </p>
        </section>
        <section class="request_section">
            
            <form name="request" method="POST" action="home.php">
                <p class="head">ФИО</p>
                <p><input type="text" name="fio" <?php if (isset($_GET['fio'])) {echo 'value='.$_GET['fio'];} ?>></p>
                <p class="head">Email</p>
                <p><input type="text" name="email" placeholder="example@mail.ru" <?php if (isset($_GET['email'])) {echo 'value='.$_GET['email'];} ?>></p>
                <p class="head">Откуда узнали о нас?</p>
                
                <p><input type="radio" name="source" value="Реклама в интернете" <?php if (isset($_GET['source']) and $_GET['source']=='Реклама в интернете') {echo 'checked';} ?>>Реклама в интернете</p>
                <p><input type="radio" name="source" value="Совет друга" <?php if (isset($_GET['source']) and $_GET['source']=='Совет друга') {echo 'checked';} ?>>Совет друга</p>
                <p><input type="radio" name="source" value="Другое" <?php if (isset($_GET['source']) and $_GET['source']=='Другое') {echo 'checked';} ?>>Другое</p>
        
                <p>
                    <select name="type_request" class="text_block" name="type_request">
                        <option disabled selected>Выберите тип обращения</option>
                        <option value="message" name="message">Жалоба</option>
                        <option value="propose" name="propose">Предложение</option>
                    </select>
                </p>
                <textarea cols="30" rows="10" name="request_text"></textarea>
                <p><input type="file" name="file"></p>
                <p><input type="checkbox" name="check1" class="approval">Даю согласие на обработку персональных данных</p>
                <p><input type="submit" name="submit" class="button"></p>
            </form>
        </section>
        <section class="text">
            <h2>Изображения</h2>
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