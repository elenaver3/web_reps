<!DOCTYPE html>
<html lang="ru">
<?php
    require 'info.php';   
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/icon.ico">
    <title><?php echo $title;?></title>
</head>
<body class="algo">
    <?php include 'header.html' ?>
    <main>
        <h1>Вычисления</h1>
        <section class="text">
            <form name="elements" method="GET" action="algorithm.php">
                <div class="inputs">
                    <p class="head">x</p>
                    <p><input type="text" name="x" <?php if (isset($_GET['x'])) {echo 'value='.$_GET['x'];} ?>></p>
                    <p class="head">Количество</p>
                    <p><input type="text" name="encounting" <?php if (isset($_GET['encounting'])) {echo 'value='.$_GET['encounting'];} ?>></p>
                    <p class="head">Шаг</p>
                    <p><input type="text" name="step" <?php if (isset($_GET['step'])) {echo 'value='.$_GET['step'];} ?>></p>
                    <br>
                    <p class="head">Мин. значение функции</p>
                    <p><input type="text" name="min_func" <?php if (isset($_GET['min_func'])) {echo 'value='.$_GET['min_func'];} ?>></p>
                    <br>
                    <p class="head">Макс. значение функции</p>
                    <p><input type="text" name="max_func" <?php if (isset($_GET['max_func'])) {echo 'value='.$_GET['max_func'];} ?>></p>
                </div>
                <p class="head">Верстка</p>
                <div class="radio_block">
                    <p><input type="radio" name="type" value="A" <?php if (isset($_GET['type']) and $_GET['type']=='A') {echo 'checked';} ?> checked>A</p>
                    <p><input type="radio" name="type" value="B" <?php if (isset($_GET['type']) and $_GET['type']=='B') {echo 'checked';} ?>>B</p>
                    <p><input type="radio" name="type" value="C" <?php if (isset($_GET['type']) and $_GET['type']=='C') {echo 'checked';} ?>>C</p>
                    <p><input type="radio" name="type" value="D" <?php if (isset($_GET['type']) and $_GET['type']=='D') {echo 'checked';} ?>>D</p>
                    <p><input type="radio" name="type" value="E" <?php if (isset($_GET['type']) and $_GET['type']=='E') {echo 'checked';} ?>>E</p>
                </div>
                <p><input type="submit" name="submit" class="button" href="algorithm.php"></p>
            </form>
            <?php
                if (isset($_GET['x']) && $_GET['x'] != "") {
                    $x = $_GET['x'];
                }
                else {
                    $x = 0;
                }
                if (isset($_GET['type']) && $_GET['type'] != "") {
                    $type = $_GET['type'];
                }
                else {
                    $type = 'A';
                }
                if (isset($_GET['encounting']) && $_GET['encounting'] != "") {       // количество вычисляемых значений
                    $encounting = $_GET['encounting'];
                }
                else {
                    $encounting = 1;
                }
                if (isset($_GET['step']) && $_GET['step'] != "") {                 // шаг изменения аргумента
                    $step = $_GET['step'];
                }
                else {
                    $step = 1;
                }
                if (isset($_GET['min_func']) && $_GET['min_func'] != "") {
                    $min_func = $_GET['min_func'];
                }
                else {
                    $min_func = "";
                }
                if (isset($_GET['max_func']) && $_GET['max_func'] != "") {
                    $max_func = $_GET['max_func'];
                }
                else {
                    $max_func = "";
                }

                $min = PHP_INT_MAX;
                $max = PHP_INT_MIN;
                $sum = 0;
                $count = 0;
                $full_count = 0;

                if ($type == 'B')
                    echo '<ul>';
                if ($type == 'C')
                    echo '<ol>';
                if ($type == 'D')
                    echo '<table class="normal_table">
                            <thead><tr>
                            <th>Номер</th>
                            <th>Аргумент</th>
                            <th>Значение функции</th>
                            </tr></thead>';

                // цикл с заданным количеством итераций
                for ($i = 0; $i < $encounting; $i++, $x += $step)
                {
                    if ($x <= 10)                           // если аргумент меньше или равен 10
                        $f = 3 * $x * $x + 2;	            // вычисляем функцию
                    else	
                        if ($x > 10 && $x < 20)	            // если аргумент больше 10 и меньше 20
                            $f = 5 * $x + 7;	            // вычисляем функцию
                        else
                        {
                            if ($x >= 20 && 22 - $x != 0)	// если аргумент больше или равен 20
                                $f = $x / (22 - $x);	    // вычисляем функцию
                            else
                                $f = 'error';
                        }



                    if (($f >= $max_func && $max_func != "") || ($min_func != "" && $f < $min_func))	// если вышли за рамки диапазона
                        continue;     

                    if ($f != 'error') {
                        $f = round($f, 3);
                        if ($f > $max)
                            $max = $f;
                        if ($f < $min)
                            $min = $f;
                        $sum = $sum + $f;
                        $count = $count + 1;
                    }    
                    $full_count = $full_count + 1;

                    if ($type == 'A')
                    {
                        echo 'f('.$x.') = '.$f;	    // выводим аргумент и значение функции
                        if ($i < $encounting - 1)   // если это не последняя итерация цикла
                            echo '<br>';	        // выводим знак перевода строки
                    }
                    else
                        if ($type == 'B' || $type == 'C')
                        {
                            echo '<li>f('. $x.') = '.$f.'</li>';
                        }
                        else 
                            if ($type == 'D')
                            {
                                echo '<tr><td>'.$full_count.'</td><td>'.$x.'</td><td>'.$f.'</td></tr>';
                            } 
                            else 
                            {
                                echo '<div class="f_div">f('. $x.') = '.$f.'</div>';
                            }
                }

                if ($type == 'B')
                    echo '</ul>';
                if ($type == 'C')
                    echo '</ol>';
                if ($type == 'D')
                    echo '</table>';
                
                if ($count != 0)
                    $avg = $sum / $count;
                else
                    $avg = 0;        

                echo '<p><br>';
                echo "Минимальное: ".$min.'<br>';
                echo "Максимальное: ".$max.'<br>';
                echo "Среднее арифметическое: ".$avg.'<br>';
                echo "Сумма: ".$sum.'<br>';
                echo '</p>';
            ?>
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