<?php

/** @var $model */

?>

<div class="main__group">

    <div class="organizer__main">

        <div class="organizer__avatar add_avatar">

            <img src="<?= '/images/avatars/middle/' . $model['partner']->avatar ?>" alt="organizer_avatar">

            <div class="avatar__edit fade hide-element">
                <form action="#" method="post" id="form_upload_avatar" class="">
                    <span class="close-pop-up"></span>
                    <div class="info-field__head">фотография профиля</div>

                    <!--  ВЫВОДИТЬ БЛОК ТОЛЬКО ЕСЛИ ЕСТЬ ПОЛЬЗОВАТЕЛЬСКИЙ АВАТАР-->
                    <?php if ($model['partner']->avatar != 'avatar.png'): ?>
                        <div class="avatar__original">
                            <span class="turn-img"></span>
                            <img src="<?= '/images/avatars/original/' . $model['partner']->avatar ?>"
                                 alt="original-avatar">
                        </div>
                    <?php endif; ?>
                    <!--                    <input type="file" name="files" id="partner-avatar" accept=".jpg, .jpeg, .png">-->
                    <!--                    <input type="file" name="files" id="partner-avatar">-->

                    <!-- СТИЛИЗАЦИЯ КНОПКИ INPUT-FILE (настроить input на загрузку вместо текущей кнопки  -->
                    <div class="input-btn-style">
                        <input type="file" accept=".jpg, .jpeg, .png, gif" name="files" id="partner-avatar"
                               class="input-file">
                        <label for="partner-avatar" class="btn btn-tertiary js-labelFile">
                            <i class="icon"></i>
                            <span class="js-fileName">загрузить фото</span>
                            <div id="block_error_upload" class="red"></div>
                        </label>
                    </div>

                    <button type="submit" class="btn-blue upload-img hide-element" id="submit_upload_avatar"><span>Загрузить</span>
                    </button>
                </form>

            </div>

        </div>

        <div class="organizer__registered">

            <span class="info-field__head">дата регистрации</span>
            <span class="info-field__content blue bold"><?= $model['dateInSite'] ?></span>

        </div>

    </div>

    <div class="organizer__contacts">

        <div class="organizer__info-field">

            <span class="info-field__head">Имя профиля</span>

            <div class="important hover">
                <div class="help-pop-up right fade hide-element">
                    <span class="close-pop-up"></span>
                    <p>При необходимости изменить регистрационные данные следуй инструкции в базе знаний:
                        <a class="link" href="/support/knowledge-base#data-change">Изменение данных профиля</a></p>
                </div>
            </div>

            <span class="info-field__content"><?= $model['partner']->name_profile ?></span>

        </div>

        <div class="organizer__info-field">

            <span class="info-field__head">Контактное лицо</span>

            <span class="info-field__content"><?= $model['user']->first_name . ' ' . $model['user']->last_name ?></span>

        </div>

        <div class="organizer__info-field">

            <span class="info-field__head">Email</span>

            <span class="info-field__content"><?= $model['user']->email ?></span>

        </div>

        <div class="organizer__info-field">

            <span class="info-field__head">Телефон</span>

            <span class="info-field__content"><?= $model['user']->phone ?></span>

        </div>

    </div>

</div>
