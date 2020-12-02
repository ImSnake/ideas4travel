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
    <!-- connect web icon fonts icofont and fontello/ -->
    <link rel="stylesheet" href="/styles/web-fonts/icofont/icofont.min.css">
    <link rel="stylesheet" href="/styles/web-fonts/fontello-c45cd08e/css/fontello.css">

    <link rel="stylesheet" href="/styles/base/base.css">

    <!--Подключаем css файлы заданные в настройках страницы.-->
    <?php foreach ($this->cssFiles as $css): ?>
        <link rel="stylesheet" href="/styles/<?= $css ?>">
    <?php endforeach; ?>

</head>

<body>

<?php

include VIEWS_DIR . 'blocks-html/base-html/header.php';

if (App::get()->auth->getUserID()) {
    include VIEWS_DIR . 'blocks-html/organizer/navigation.php';
}

// Выводим содержание.
echo $content;

include VIEWS_DIR . 'blocks-html/base-html/footer.php';

?>

<!--Подключаем основные js скрипты.-->
<script src="/js/jq.js"></script>
<script src="/js/main.js"></script>

<!--Подключаем js файлы заданные в настройках страницы.-->
<?php foreach ($this->jsFiles as $script): ?>
    <script src="/js/<?= $script ?>"></script>
<?php endforeach; ?>

</body>
</html>