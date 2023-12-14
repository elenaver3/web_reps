<!DOCTYPE html>
<html lang="ru">
<?php
    date_default_timezone_set('Europe/Moscow');
    $title = "Верстова Е.В. 221-361. Лабораторная 11";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <title><?php echo $title; ?></title>
</head>
<body>
    <header>
        <div id="main_menu" class="nav menu">
            <?php 
                echo '<a href="?html_type=TABLE'; // начало ссылки ТАБЛИЧНАЯ ФОРМА

                if( isset($_GET['content']) ) // если параметр content был передан в скрипт
                    echo '&content='.$_GET['content']; // добавляем в ссылку второй параметр
                echo '"';

                // если в скрипт был передан параметр html_type и параметр равен TABLE 
                if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'TABLE' ) 
                    echo ' class="selected"'; // ссылка выделяется через CSS-класс
                
                echo '>Табличная верстка</a>'; // конец ссылки ТАБЛИЧНАЯ ФОРМА



                echo '<a href="?html_type=DIV'; // начало ссылки БЛОКОВАЯ ФОРМА

                if( isset($_GET['content']) ) // если параметр content был передан в скрипт
                    echo '&content='.$_GET['content']; // добавляем в ссылку второй параметр
                echo '"';

                // если в скрипт был передан параметр html_type и параметр равен DIV 
                if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'DIV' ) 
                    echo ' class="selected"'; // ссылка выделяется через CSS-класс

                echo '>Блочная верстка</a>'; // конец ссылки БЛОКОВАЯ ФОРМА
            ?>
        </div> 
    </header>
    <main>
        <div class="line">
            <div id="product_menu" class="product_menu_class">
                <?php 
                    echo '<a href="/"'; // начало ссылки ВСЯ ТАБЛИЦА УМНОЖНЕНИЯ
                    
                    if( !isset($_GET['content']) ) // если в скрипт НЕ был передан параметр content 
                        echo ' class="selected"'; // ссылка выделяется через CSS-класс

                    echo '>Вся таблица умножения</a><br>'; // конец ссылки

                    for( $i=2; $i<=9; $i++ ) // цикл со счетчиком от 2 до 9 включительно
                    { 
                        echo '<a href="?content='.$i;

                        if (array_key_exists('html_type', $_GET)) {
                            if ($_GET['html_type']== 'TABLE')
                                echo '&html_type=TABLE';
                            else
                                echo '&html_type=DIV';
                        }

                        echo '" ';

                        if( isset($_GET['content']) && $_GET['content']==$i ) 
                            echo ' class="selected"'; // ссылка выделяется через CSS-класс
                        echo '>Таблица умножения на '.$i.'</a><br>'; // конец ссылки 
                    } 
                ?>
            </div> 
            <div class="mult" style="display:block; width:100%">
                
                <?php
                    if (!array_key_exists('html_type', $_GET) || $_GET['html_type']== 'TABLE' ) {
                        echo '<div style="margin: 0 auto; width:1200px;">';
                        outTableForm(); // выводим таблицу умножения в табличной форме
                        echo '</div>';
                    }
                    else {
                        echo '<div style="margin: 0 auto; width:180px; display: flex; flex-direction: row;">';
                        outDivForm(); // выводим таблицу умножения в блочной форме
                        echo '</div>';
                    }
                        
                ?>
                
            </div>
        </div>
        
        <?php
            // функция ВЫВОДИТ ТАБЛИЦУ УМНОЖЕНИЯ В ТАБЛИЧНОЙ ФОРМЕ
            function outTableForm() 
            { 
                // если параметр content не был передан в программу
                if( !isset($_GET['content']) ) 
                { 
                    
                    for($i=2; $i<10; $i++) // цикл со счетчиком от 2 до 9
                    { 
                        
                        echo '<table class="table" border="0" cellspacing="0" cellpadding="0"">';
                        outRow2( $i );
                        echo '</table><div>';
                    } 
                    
                } 
                else 
                { 
                    echo '<table class="table choosed">';
                    outRow2( $_GET['content'] );
                    echo '</table>';
                }
            } 

            // функция ВЫВОДИТ ТАБЛИЦУ УМНОЖЕНИЯ В БЛОЧНОЙ ФОРМЕ
            function outDivForm () 
            { 
                // если параметр content не был передан в программу
                if( !isset($_GET['content']) ) 
                { 
                    for($i=2; $i<10; $i++) // цикл со счетчиком от 2 до 9
                    { 
                        echo '<div class="ttRow">'; // оформляем таблицу в блочной форме
                        outRow( $i ); // вызывем функцию, формирующую содержание
                        // столбца умножения на $i (на 4, если $i==4) 
                        echo '</div>'; 
                    } 
                } 
                else 
                { 
                    echo '<div class="ttSingleRow">'; // оформляем таблицу в блочной форме
                    outRow( $_GET['content'] ); // выводим выбранный в меню столбец
                    echo '</div>'; 
                } 

            } 

            // функция ВЫВОДИТ СТОЛБЕЦ ТАБЛИЦЫ УМНОЖЕНИЯ 
            function outRow ( $n ) 
            { 
                for($i=2; $i<=9; $i++) // цикл со счетчиком от 2 до 9 
                    echo outNumAsLink($n).'x'.outNumAsLink($i).'='.outNumAsLink($i*$n).'<br>'; 
            } 

            function outRow2 ( $n ) 
            { 
                for($i=2; $i<=9; $i++) // цикл со счетчиком от 2 до 9 
                    echo '<tr><td>'.outNumAsLink($n).'x'.outNumAsLink($i).'</td><td>'.outNumAsLink($i*$n).'</td></tr>'; 
            } 

            

            function outNumAsLink($n) {

                $final = '';

                if ($n >= 0 && $n < 10) {
                    $final = '<a href="';
                
                    if (array_key_exists('html_type', $_GET)) {
                        if ($_GET['html_type']== 'TABLE')
                            $final .= '?html_type=TABLE&';
                        else
                            $final .= '?html_type=DIV&';
                        $final .= 'content='.$n.'">'.$n;
                    }
                    else {
                        $final .= '?content='.$n.'">'.$n;
                    }

                    $final .= '</a>';
                }
                else {
                    $final .= $n;
                }
                

                return $final;
            }

        ?>
    </main>
    <footer>
        <?php
            if( !isset($_GET['html_type']) || $_GET['html_type']== 'TABLE' ) {
                $s='Верстка не выбрана. ';
            }
            else {
                if($_GET['html_type']== 'TABLE' ) 
                    $s='Табличная верстка. ';
                else 
                    $s='Блочная верстка. '; 
            }
                
            echo '<br>'.$s.'<br>';

            if( !isset($_GET['content']) ) 
                $s='Таблица умножения полностью. '; 
            else 
                $s='Столбец таблицы умножения на '.$_GET['content']. '. '; 
            echo $s.'<br>';

            echo date("d.m.Y"), ' ', date("H:i:s"); 
        ?>
    </footer>
</body>
</html>