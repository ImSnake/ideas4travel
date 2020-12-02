<?php

/* @var $content string */

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?= $content ?>

<!-- подключаем библиотеку jQuery -->
<script src="/jquery.js"></script>
<!-- подключаем основные плагины -->
<script src="jquery/jquery.common_plugins.js" async></script>

<script>
    //TODO OPTIMIZE - какое предназначение у этой страницы? подключение библиотеки jquery ссылается на несуществующий файл
  $(document).ready(function () {
    $('#button').on('click', function () {


      $.ajax({
        url: 'https://partner.ideas4travel.loc/ajax',
        type: 'POST',
        dataType: 'html',
        success: function (data) {


            alert(data)
        }
      })

    })
  })

</script>

</body>
</html>
