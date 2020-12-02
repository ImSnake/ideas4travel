<?php

use app\services\renderer\TemplateRenderer;

/* @var $errors */
/* @var $this TemplateRenderer */

$this->title = "Организаторам";
$this->description = "Описание страницы Организаторам";

$this->cssFiles = ['partnership/partnership.css'];
//$this->jsFiles = ['partnership/partnership.js'];

?>

<!--<div class="center">-->

<div class="container">

    <section class="partnership">

        <h2 class="block-title">Организаторам</h2>

        <h4>Гидам&nbsp;и&nbsp;трэвел-экспертам</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi asperiores, aspernatur assumenda
            beatae cum delectus doloremque eligendi est et laudantium molestiae nesciunt nostrum quasi quia sequi
            temporibus voluptate voluptates!</p>
        <h4>Туроператорам</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi asperiores, aspernatur assumenda
            beatae cum delectus doloremque eligendi est et laudantium molestiae nesciunt nostrum quasi quia sequi
            temporibus voluptate voluptates!</p>
        <h4>Турагентствам</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi asperiores, aspernatur assumenda
            beatae cum delectus doloremque eligendi est et laudantium molestiae nesciunt nostrum quasi quia sequi
            temporibus voluptate voluptates!</p>

            <div class="btn-blue">
                <a href="/auth/auth-signup">В&nbsp;кабинет&nbsp;организатора</a>
            </div>

        <a href="/offer" class="link">договор-оферта&nbsp;для&nbsp;организатора</a>

    </section>

</div>

<!--</div>-->
