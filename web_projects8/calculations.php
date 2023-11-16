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
<body>
    <?php include 'header.html' ?>
    <script type="text/javascript">
        function powFunction() { 
            var x = document.getElementById("powOne").value; 
            var n = document.getElementById("powTwo").value; 
            var result = x;
            if (n == 0) {
                result = 1;
            }
            else {
                for (var i = 1; i < n; i++) {
                    result *= x;
                }
            }
            document.getElementById("firstResult").innerHTML = result; 
        } 
    </script>
    <main>
        <section>
            <h1 class="main_h1">Расчеты</h1>
        </section>
        <section class="calc">
            <div>
                <input type="text" id="powOne">
                <input type="text" id="powTwo">
                <button type="button" onclick="powFunction()">Выполнить</button>
            </div>
            <div style="result_calc">
                <p id="firstResult"></p>
            </div>
        
        
        
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