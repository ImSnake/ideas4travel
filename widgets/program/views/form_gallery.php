<?php

use app\helpers\HtmlHelpers;
use app\Models\program\PrImg;
use app\Models\program\Program;

/** @var $program Program */
/** @var $mainImg PrImg */
/** @var $mapImg PrImg */
/** @var $allImg array */
/** @var $arrVideos array */

?>

<div id="gallery" class="program-form__step hide-element">

    <!--    <form action="#" method="post">-->

    <div class="program-form__field">

        <div class="program-form__title">

            <span>Заглавное&nbsp;фото&nbsp;<span class="red">*</span></span>

        </div>

        <div class="program-form__text">

            <div class="program-form__image-result" id="program_photos">
                <?php if ($mainImg): ?>
                    <div class="image-result__delete">
                        <span class="turn-img"></span>
                        <span class="delete-clone"></span>
                        <img src="../../images/tours/<?= $mainImg->partner_id ?>/<?= $mainImg->program_id ?>/middle/<?= $mainImg->img ?>"
                             alt="img-mini-main" >
                    </div>
                <?php else: ?>
                    <img src="../../images/tours/default/mini/tour_default.jpg" style="opacity:0.75" alt="img-mini-template">
                <?php endif; ?>
            </div>

            <form action="#" method="post" id="form_upload_main_photo" class="group">
                <div class="input-btn-style group">
                    <input type="file" accept=".jpg, .jpeg, .png" id="main-image" name="files"
                           class="input-file">
                    <label for="main-image" class="btn btn-tertiary js-labelFile">
                        <i class="icon"></i>
                        <span class="js-fileName">добавить картинку</span>
                        <div id="block_error_upload_main_photo" class="red"></div>
                    </label>
                </div>

                <button type="submit" class="btn-blue upload-img hide-element" id="submit_upload_main_photo">
                    <span>Загрузить</span>
                </button>

            </form>

        </div>

    </div>

    <div class="program-form__field">

        <div class="program-form__title">
            <span>Карта&nbsp;маршрута</span>
        </div>

        <div class="program-form__text">

            <div class="program-form__image-result" id="program_photos_map">
                <?php if ($mapImg): ?>
                    <div class="image-result__delete">
                        <span class="turn-img"></span>
                        <span class="delete-clone"></span>
                        <img src="../../images/tours/<?= $mapImg->partner_id ?>/<?= $mapImg->program_id ?>/middle/<?= $mapImg->img ?>"
                             alt="img-mini-map"></div>
                <?php else: ?>
                    <img src="../../images/tours/default/mini/map_default.png">
                <?php endif; ?>
            </div>

            <form action="#" method="post" id="form_upload_map_photo" class="group">
                <div class="input-btn-style">
                    <input type="file" accept=".jpg, .jpeg, .png" id="map-img" name="files"
                           class="input-file">
                    <label for="map-img" class="btn btn-tertiary js-labelFile">
                        <i class="icon"></i>
                        <span class="js-fileName">добавить картинку</span>
                        <div id="block_error_upload_map_photo" class="red"></div>
                    </label>
                </div>

                <button type="submit" class="btn-blue upload-img hide-element" id="submit_upload_map_photo">
                    <span>Загрузить</span>
                </button>

            </form>

        </div>

    </div>

    <div class="program-form__field">

        <div class="program-form__title">
            <div class="help hover">
                <div class="help-pop-up right fade hide-element">
                    <span class="close-pop-up"></span>
                    <p>Добавь к программе фотографии с прошлых поездок</p>
                    <p>минимум&nbsp;-&nbsp;<span class="blue bolder">9</span>
                        максимум&nbsp;-&nbsp;<span
                                class="blue bolder">28</span> <!--фото (желательно альбомной ориентации).--></p>
                    <p>Больше информации в базе знаний:
                        <a href="/support/knowledge-base#gallery" target="_blank" class="link">
                            <i class="icon-camera"></i>Галерея</a></p>
                </div>
            </div>
            <span>Фото-архив&nbsp;<span class="red">*</span></span>
        </div>

        <div id='img-archive-block' class="program-form__text">

            <div id="program_photos_archive" class="program-form__image-result" data-img-qty="<?= count($allImg) ?>">
                <?php foreach ($allImg as $value): ?>
                    <div class="image-result__delete">
                        <span class="turn-img"></span>
                        <span class="delete-clone"></span>
                        <img src="../../images/tours/<?= $value['partner_id'] ?>/<?= $value['program_id'] ?>/mini/<?= $value['img'] ?>"
                             alt="img-mini-gallery" data-img-name="<?= $value['img'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>

            <form action="#" method="post" id="form_upload_archive_photo" class="group">

                <div class="input-btn-style group">
                    <input type="file" accept=".jpg, .jpeg, .png" id="gallery-img-1" name="files[]" multiple
                           class="input-file">
                    <label for="gallery-img-1" class="btn btn-tertiary js-labelFile">
                        <i class="icon"></i>
                        <span class="js-fileName">добавить картинку</span>
                        <span id="block_error_upload_archive_photo" class="red"></span>
                    </label>
                </div>

                <button type="submit" class="btn-blue upload-img hide-element" id="submit_upload_archive_photo">
                    <span>Загрузить</span>
                </button>

                <div id="preloader">
                   <!-- <div class="preloader"></div>-->
                </div>

                <div id="img-archive-counter">
                    <div><span class="blue"></span>из<span class="grey"></span>фото</div>
                </div>

            </form>

        </div>

    </div>

    <div class="program-form__field">

        <div class="program-form__title">
            <div class="help hover">
                <div class="help-pop-up right fade hide-element">
                    <span class="close-pop-up"></span>
                    <p>Добавь видео-ролики об этом путешествии, размещенные на сайте <span class="link">youtube.com</span>
                    </p>
                    <p>О том, как получить ссылку на видео читай в базе знаний:</p>
                    <a href="/support/knowledge-base#gallery" target="_blank" class="link"><i class="icon-videocam-3"></i>&nbsp;Добавить видео</a>
                </div>
            </div>
            <span>Видео-архив</span>
        </div>

        <div class="program-form__text">

            <form action="#" method="post" id="program-form-edit-gallery">
                <?php if (empty($arrVideos)): ?>
                    <div class="video-box">
                        <input type="url" placeholder="ссылка на видео с youtube" name="gallery[video][1][url]" value="">
                        <input type="hidden" name="gallery[video][1][video]" value="">
                        <div class="ytPlay"></div>
                    </div>
                <?php else: ?>
                    <?php for ($i = 0; $i < count($arrVideos); $i++): ?>
                        <div class="video-box">
                            <input type="url" placeholder="ссылка на видео с youtube" name="gallery[video][<?= $i + 1 ?>][url]"
                                   value="<?= $arrVideos[$i]['url'] ?>">
                            <input type="hidden" name="gallery[video][<?= $i + 1 ?>][video]" value="<?= $arrVideos[$i]['video'] ?>">
                            <div class="ytPlay"></div>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>

            </form>

            <div id="add-video" class="input-btn-style">
                <div class="btn btn-tertiary">
                    <span>добавить&nbsp;еще&nbsp;видео</span>
                </div>
            </div>

            <div id='video-box-template' class="hide-element">
                <input type="url" placeholder="ссылка на видео с youtube" name="gallery[video][1][url]" value="">
                <input type="hidden" name="gallery[video][1][video]" value="">
                <div class="ytPlay"></div>
            </div>

        </div>

    </div>

</div>