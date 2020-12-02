<?php

use app\base\App;
use app\services\renderer\TemplateRenderer;

/* @var $content string */
/* @var $this TemplateRenderer */

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!--"shrink-to-fit=no" - для iOS, max & min scale не позволяют моб.браузеру преобразовать содержимое, "user-scalable=no" - запрещает пользователю менять масштаб сайта-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, shrink-to-fit=no"/>

    <title><?= $this->title ?></title>
    <meta name="description" content="<?= $this->description ?>">

    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/styles/normalize.css">
    <!-- загрузка шрифтов -->
    <link rel="stylesheet" href="/styles/base/fonts.css">
    <!-- стили для хедера, футера и повторяющихся элементов  -->
    <link rel="stylesheet" href="/styles/base/base.css">
    <!-- connect web icon fonts icofont and fontello/ -->
    <link rel="stylesheet" href="/styles/web-fonts/fontello/css/fontello.css">
    <link rel="stylesheet" href="/styles/web-fonts/icofont/icofont.min.css">
    <!--Подключаем css файлы заданные в настройках страницы.-->
    <?php foreach ($this->cssFiles as $css): ?>
        <link rel="stylesheet" href="/styles/<?= $css ?>">
    <?php endforeach; ?>
    <!--бибилиотека jQuery-->
    <script src="/js/jquery/jq.js"></script>
    <!--Подключаем css для вывода стилизованных сервисных сообщений alert, prompt, confirm-->
    <link rel="stylesheet" href="/styles/jquery/jquery-confirm.css">

</head>

<body>

<?php

include VIEWS_DIR . 'blocks-html/base-html/header.php';

// контейнер для формирования контента основного содержимого страницы: отркывающий тег
echo "<div class='center'>";

if (App::get()->auth->getUserID()) {
    include VIEWS_DIR . 'blocks-html/organizer/navigation.php';
}

// Выводим содержание.
echo $content;

// контейнер для формирования контента основного содержимого страницы: закрывающий тег
echo "</div>";

include VIEWS_DIR . 'blocks-html/base-html/footer.php';

?>

<!--Подключаем основные js скрипты.-->
<!--<script src="/js/jquery/jq.js"></script>-->
<script src="/js/base/main.js"></script>
<!--Подключаем js для вывода стилизованных сервисных сообщений alert, prompt, confirm-->
<script src="/js/jquery/jquery-confirm.min.js"></script>
<!--Подключаем js файлы заданные в настройках страницы -->
<?php foreach ($this->jsFiles as $script): ?>
    <script src="/js/<?= $script ?>"></script>
<?php endforeach; ?>

</body>
</html>