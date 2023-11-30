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
        <h1>Результат</h1>
        <section class="text">

            <?php
                if( isset($_POST['data']) && $_POST['data'] ) // если передан текст для анализа
                {
                    echo '<div class="src_text">'.$_POST['data'].'</div>'; // выводим текст
                    test_it( iconv("utf-8", "cp1251",$_POST['data']) ); // анализируем текст
                }
                else // если текста нет или он пустой
                    echo '<div class="src_error">Нет текста для анализа</div>'
            ?>    
            <a href="index.php" class="another">Другой анализ</a>
        </section>
        <?php 
            function test_it( $text )
            {  

                // количество символов в тексте определяется функцией размера текста
                echo 'Количество символов: '.strlen($text).'<br>';

                // определяем ассоциированный массив с цифрами
                $cifra=array( '0'=>true, '1'=>true, '2'=>true, '3'=>true, '4'=>true,
                '5'=>true, '6'=>true, '7'=>true, '8'=>true, '9'=>true );

                // вводим переменные для хранения информации о:
                $cifra_amount = 0; // количество цифр в тексте
                $word_amount = 0; // количество слов в тексте
                $letter_amount = 0;
                $upper_amount = 0;
                $lower_amount = 0;
                $punct_amount = 0;
                $count_words = 0;
                $dictionary = array();

                $word=''; // текущее слово
                $words=array(); // список всех слов


                for($i=0; $i < strlen($text); $i++) // перебираем все символы текста
                {
                    if( array_key_exists($text[$i], $cifra) ) // если встретилась цифра
                        $cifra_amount++; // увеличиваем счетчик цифр

                    // если в тексте встретился пробел или текст закончился
                    if( $text[$i]==' ' || $i==strlen($text) - 1 || ctype_punct($text[$i]))
                    {
                        if (!ctype_punct($text[$i]) && !$text[$i]==' ' && $i==strlen($text) - 1) {
                            $word.=$text[$i];
                        }
                        if( $word != '') // если есть текущее слово
                        {
                            // если текущее слово сохранено в списке слов
                            if( isset($words[$word]) ) {
                                $words[$word]++; // увеличиваем число его повторов
                            }
                            else {
                                $words[$word] = 1; // первый повтор слова
                            }
                                
                                
                        }
                        $word=''; // сбрасываем текущее слово
                        
                    }
                    else // если слово продолжается
                        $word.=$text[$i]; //добавляем в текущее слово новый символ

                    // считаем буквы
                    if (preg_match('/^[\p{Cyrillic}\p{Latin}]/', $text[$i])) {
                        $letter_amount++;

                        if (preg_match('/^\p{Lu}/', $text[$i]))
                            $upper_amount++;  
                        else
                            $lower_amount++;
                    }
                        
                    if (ctype_punct($text[$i]))
                        $punct_amount++;  
            
                }

                foreach ($words as $key => $value) {
                    $count_words += $value;
                }

                echo 'Количество букв: '.$letter_amount.'<br>';

                echo 'Количество заглавных букв: '.$upper_amount.'<br>';
                echo 'Количество строчных букв: '.$lower_amount.'<br>';

                echo 'Количество знаков препинания: '.$punct_amount.'<br>';

                echo 'Количество цифр: '.$cifra_amount.'<br>';
                echo 'Количество слов: '.$count_words.'<br>';

                echo '<br>Вхождение символов: <br><table class="normal_table"><tr>';
                $temp = 0;

                $dictionary = test_symbs($text);
                foreach ($dictionary as $key => $value) {
                    $key = iconv("cp1251", "utf-8", $key); 
                    echo '<td>"'.$key.'": '.$value.'</td>';
                    $temp++;
                    if ($temp == 15) {
                        $temp = 0;
                        echo '</tr><tr>';
                    }
                }
                echo '</tr></table><br>';
                

                echo 'Вхождение слов по алфавиту:<br>';

                $new_words = array();
                foreach ($words as $key => $value) {
                    $key = mb_strtolower($key, 'cp1251');
                    if (isset($new_words[$key]))
                        $new_words[$key] += $value;
                    else
                        $new_words[$key] = $value;
                }

                ksort($new_words);
                
                foreach ($new_words as $key => $value) {
                    $key = iconv("cp1251", "utf-8", $key); 
                    echo $key.': '.$value.'<br>';
                }

        
            } 
            
            function test_symbs( $text )
            {
                $symbs=array(); // массив символов текста
                $l_text=strtolower( $text); // переводим текст в нижний регистр

                // последовательно перебираем все символы текста
                for($i=0; $i<strlen($l_text); $i++)
                {
                    if( isset($symbs[mb_strtolower($l_text[$i], 'cp1251')])) // если символ есть в массиве
                        $symbs[mb_strtolower($l_text[$i], 'cp1251')]++; // увеличиваем счетчик повторов
                    else // иначе
                        $symbs[mb_strtolower($l_text[$i], 'cp1251')]=1; // добавляем символ в массив
                }
                return $symbs; // возвращаем массив с числом вхождений символов в тексте
            }
        ?>
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