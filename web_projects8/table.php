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
        <h1>Информация из базы данных</h1>
        <h2>Определения</h2>
        <section>
        <?php
            include 'dbconnect.php';
            $definitions = mysqli_query($mysql, "SELECT * FROM `definitions`");
            $photos = mysqli_query($mysql, "SELECT * FROM `images`");
        ?>
            <table class="definition_table">
                <thead>
                    <tr>
                        <th>Термин</th>
                        <th>Определение</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        while ($row = mysqli_fetch_assoc($definitions)) {
                            echo '<tr>'; 
                            echo '<td>'.$row['name'].'</td>'.'<td style="text-align: left;">'.$row['definition'].'</td>';
                            echo '</tr>';
                        }
                        
                    ?>
                </tbody> 
            </table>
        </section>
        <h2>Фото</h2>
        <section class="image_section" style="margin-bottom: 40px">
            <?php

                while ($row = mysqli_fetch_assoc($photos)) {
                    echo '<img '; 
                    echo 'title="'.$row['name'].'" src="images/'.$row['address'];
                    echo '" class="photos">';
                }

            ?>
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