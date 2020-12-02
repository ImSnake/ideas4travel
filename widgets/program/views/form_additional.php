<?php

use app\helpers\HtmlHelpers;
use app\Models\program\Program;

/** @var $program Program */
/** @var $arrAllFilters array */
/** @var $arrFiltersIds array */

?>

<div id="additional" class="program-form__step hide-element">

    <form action="#" method="post" id="program-form-edit-additional">

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Отметь подходящие к этой программе категории локаций (посещаемые места).</p>
                        <p>Узнай больше о системе поиска туров:
                        <a href="/support/knowledge-base#filters" target="_blank" class="link">
                            <span class="img_search">&nbsp;Поиск&nbsp;по тегам</span></a></p>
                    </div>
                </div>

                <span>Где&nbsp;побываем</span>

            </div>

            <div class="program-form__text">

                <div id="places-tags">

                    <?php foreach ($arrAllFilters[1]['data'] as $item): ?>

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default"><?= $item['name'] ?>
                                    <span class="light-grey"> (0)</span>
                                </div>
                                <div class="down-arr toggle"></div>
                                <div class="up-arr toggle hide-element"></div>
                            </div>

                            <div id='places-<?= $item['id'] ?>' class="checkbox-block">

                                <?php foreach ($item['data'] as $val): ?>

                                        <?php if (in_array($val['id'], $arrFiltersIds)): ?>
                                            <?php $checked = 'checked'; ?>
                                        <?php else: ?>
                                            <?php $checked = ''; ?>
                                        <?php endif; ?>

                                        <div>
                                            <input type="checkbox" id="places-<?= $item['id'] ?>-<?= $val['id'] ?>"
                                                   data-name="places-<?= $item['id'] ?>-<?= $val['id'] ?>"
                                                   value="<?= $val['id'] ?>" <?= $checked ?> name="additional[filter_id][]">
                                            <label for="places-<?= $item['id'] ?>-<?= $val['id'] ?>"
                                                   class="dark-grey"><span><?= $val['name'] ?></span></label>
                                        </div>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title">

                <div class="help hover">
                    <div class="help-pop-up right fade hide-element">
                        <span class="close-pop-up"></span>
                        <p>Отметь виды активностей, прямо или косвенно подходящие к этой программе.</p>
                        <p>Узнай больше о системе поиска туров:
                        <a href="/support/knowledge-base#filters" target="_blank" class="link">
                            <span class="img_search">&nbsp;Поиск&nbsp;по тегам</span></a></p>
                    </div>
                </div>

                <span>Чем&nbsp;займемся</span>

            </div>

            <div class="program-form__text">

                <div id="activities-tags">

                    <?php foreach ($arrAllFilters[2]['data'] as $item): ?>

                        <div class="cover-box">

                            <div class="group fade">
                                <div class="text default"><?= $item['name'] ?>
                                    <span class="light-grey"> (0)</span>
                                </div>
                                <div class="down-arr toggle"></div>
                                <div class="up-arr toggle hide-element"></div>
                            </div>

                            <div id='places-<?= $item['id'] ?>' class="checkbox-block">

                                <?php foreach ($item['data'] as $val): ?>

                                    <?php if (in_array($val['id'], $arrFiltersIds)): ?>
                                        <?php $checked = 'checked'; ?>
                                    <?php else: ?>
                                        <?php $checked = ''; ?>
                                    <?php endif; ?>

                                    <div>
                                        <input type="checkbox" id="places-<?= $item['id'] ?>-<?= $val['id'] ?>"
                                               data-name="places-<?= $item['id'] ?>-<?= $val['id'] ?>"
                                               value="<?= $val['id'] ?>" <?= $checked ?> name="additional[filter_id][]">
                                        <label for="places-<?= $item['id'] ?>-<?= $val['id'] ?>"
                                               class="dark-grey"><span><?= $val['name'] ?></span></label>
                                    </div>

                                <?php endforeach; ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title frame"><span>Условия участия</span></div>

            <div class="program-form__text frame">
                <textarea rows="4" name="additional[conditions]" rows="3"
                          class="text-editor"
                          placeholder="требования организатора к участникам, правила, ограничения и другие особенности программы тура"><?= $program->conditions ?></textarea>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title frame"><span>Особенности региона</span></div>

            <div class="program-form__text frame">
                <textarea name="additional[features_region]" rows="4"
                          class="text-editor"
                          placeholder="безопасность, законы, правила, традиции, условия въезда и ограничения ввоза, типы розеток и другие особенности посещаемого региона"><?= $program->features_region ?></textarea>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title frame"><span>Что взять с собой</span></div>

            <div class="program-form__text frame">
                <textarea name="additional[what_take]" rows="4"
                          class="text-editor"
                          placeholder="гардероб, личные вещи, набор медикаментов, доп. оборудование"><?= $program->what_take ?></textarea>
            </div>

        </div>

        <div class="program-form__field">

            <div class="program-form__title frame"><span>Здоровье</span></div>

            <div class="program-form__text frame">
                <textarea name="additional[health]" rows="4"
                          class="text-editor"
                          placeholder="рекомендации и ограничения по здоровью \ обязательные прививки"><?= $program->health ?></textarea>
            </div>

        </div>

        <!--        <div class="program-form__field">

                    <div class="program-form__title">Вопрос - ответ</div>

                    <div id="answer-questions" class="program-form__text group">
                        <div class="btn-grey-mini">Добавить вопрос</div>
                    </div>

                </div>-->

        <div class="program-form__field">

            <div class="program-form__title frame"><span>Допонительно</span></div>

            <div class="program-form__text frame">
                <textarea name="additional[additional]" rows="4"
                          class="text-editor"
                          placeholder="дополнительная информация от организатора"><?= $program->additional ?></textarea>
            </div>

        </div>

    </form>

</div>