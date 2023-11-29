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
                $dictionary = array();

                $word=''; // текущее слово
                $words=array(); // список всех слов


                for($i=0; $i < strlen($text); $i++) // перебираем все символы текста
                {
                    if( array_key_exists($text[$i], $cifra) ) // если встретилась цифра
                        $cifra_amount++; // увеличиваем счетчик цифр

                    // если в тексте встретился пробел или текст закончился
                    if( $text[$i]==' ' || $i==strlen($text) - 1)
                    {
                        if ($text[$i]==' ') {
                            if( $word ) // если есть текущее слово
                            {
                                // если текущее слово сохранено в списке слов
                                if( isset($words[$word]) )
                                    $words[ $word ]++; // увеличиваем число его повторов
                                else
                                    $words[ $word ] = 1; // первый повтор слова

                                
                            }
                            $word=''; // сбрасываем текущее слово
                        }
                        else {
                            $word.=$text[$i];
                            if( $word ) // если есть текущее слово
                            {
                                // если текущее слово сохранено в списке слов
                                if( isset($words[$word]) )
                                    $words[ $word ]++; // увеличиваем число его повторов
                                else
                                    $words[ $word ] = 1; // первый повтор слова

                                
                            }
                            $word=''; // сбрасываем текущее слово
                        }
                        
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
                      
                    // $symbol = iconv("cp1251", "utf-8", $text[$i]); 

                    // if (ord($symbol) != 32) {
                    //     if (isset($dictionary[$symbol]))
                    //         $dictionary[$symbol]++;
                    //     else
                    //         $dictionary[$symbol] = 1;
                    // }
                }

                echo 'Количество букв: '.$letter_amount.'<br>';

                echo 'Количество заглавных букв: '.$upper_amount.'<br>';
                echo 'Количество строчных букв: '.$lower_amount.'<br>';

                echo 'Количество знаков препинания: '.$punct_amount.'<br>';

                echo 'Количество цифр: '.$cifra_amount.'<br>';
                echo 'Количество слов: '.count($words).'<br>';

                echo '<br>Вхождение символов: <br><table class="normal_table"><tr>';
                $temp = 0;
                $dictionary = test_symbs($text);
                foreach ($dictionary as $key => $value) {
                    $key = iconv("cp1251", "utf-8", $key); 
                    echo '<td>"'.$key.'": '.$value.'</td>';
                    $temp++;
                    if ($temp == 16) {
                        $temp = 0;
                        echo '</tr><tr>';
                    }
                }
                echo '</tr></table><br>';
                

                echo '<br>Вхождение слов по алфавиту:<br>';

                $new_words = array();
                foreach ($words as $key => $value) {
                    $lowered = strtolower($key);
                    if (isset($new_words[$lowered]))
                        $new_words[$lowered]++;
                    else
                        $new_words[$lowered] = 1;
                }

                ksort($new_words);
                
                foreach ($new_words as $key => $value) {
                    $key = iconv("cp1251", "utf-8", $key); 
                    echo $key.': '.$value.'<br>';
                }

                // 1. количество символов в тексте (включая пробелы);  СДЕЛАНО
                // 2. количество букв; СДЕЛАНО
                // 3. количество строчных и заглавных букв по отдельности; СДЕЛАНО
                // 4. количество знаков препинания; СДЕЛАНО
                // 5. количество цифр; СДЕЛАНО
                // 6. количество слов; СДЕЛАНО
                // 7. количество вхождений каждого символа текста (без различия верхнего и нижнего регистров); СДЕЛАНО
                // 8. список всех слов в тексте и количество их вхождений, отсортированный по алфавиту
            } 
            
            function test_symbs( $text )
            {
                $symbs=array(); // массив символов текста
                $l_text=strtolower( $text ); // переводим текст в нижний регистр
                // последовательно перебираем все символы текста
                for($i=0; $i<strlen($l_text); $i++)
                {
                    if( isset($symbs[$l_text[$i]]) ) // если символ есть в массиве
                        $symbs[$l_text[$i]]++; // увеличиваем счетчик повторов
                    else // иначе
                        $symbs[$l_text[$i]]=1; // добавляем символ в массив
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