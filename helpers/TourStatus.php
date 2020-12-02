<?php

namespace app\helpers;

use app\Models\program\Program;
use app\Models\tour\Tour;
use app\Models\tour\TourPublishedLog;
use ReflectionException;

class TourStatus
{
    public static function tourPublish(Program $program, Tour $tour, bool $tourValidate)
    {
        if ($tourValidate === true && (
                $program->status == Program::STATUS_COMPLETED ||
                $program->status == Program::STATUS_IN_MODERATION ||
                $program->status == Program::STATUS_REJECTED
            )) {
            $program->status = Program::STATUS_IN_MODERATION;
            $program->status_at = date('Y-m-d H:i:s', time());
            $program->save();

            $tour->t_status_admin_id = Tour::STATUS_IN_MODERATION;
            $tour->save();

            // Модератору отправляется письмо со ссылкой на программу.
            MailHelpers::sendEmailProgramInModeration(EMAIL_MODERATOR, $program);

            return true;
        }

        if ($tourValidate === true && $program->status == Program::STATUS_UNPUBLISHED) {
            $program->status = Program::STATUS_PUBLISHED;
            $program->status_at = date('Y-m-d H:i:s', time());
            $program->save();

            $tour->t_status_admin_id = Tour::STATUS_PUBLISHED;
            $tour->save();

            // Выполняем логирование опубликованного тура.
            $tour->publishStartLog();

            return true;
        }

        if ($tourValidate === true && $program->status == Program::STATUS_PUBLISHED) {
            $tour->t_status_admin_id = Tour::STATUS_PUBLISHED;
            $tour->save();

            // Выполняем логирование опубликованного тура.
            $tour->publishStartLog();

            return true;
        }

        return false;
    }

    /**
     * Метод меняте стутус всех туров у программы со старого на новый.
     * @param Program $program - программа.
     * @param string $newStatus - новый статус.
     * @param string $oldStatus - старый статус.
     * @param bool $all - если true, то oldStatus игнорируются и меняются все туры на newStatus, иначе только указанный.
     * @throws ReflectionException
     */
    public static function changeStatusOfTour(Program $program, string $oldStatus, string $newStatus, bool $all = false)
    {
        // Получаем список туров у программы.
        if ($all) {
            $tours = (new Tour())->getAllWhere(['program_id' => $program->id, 't_status_admin_id' => $oldStatus]);
        } else {
            $tours = (new Tour())->getAllWhere(['program_id' => $program->id, 't_status_admin_id' => $oldStatus]);
        }


        // Если туров нет, то выходим
        if (!$tours) {
            return;
        }

        // Обходим все туры и меняем статус на новый.
        foreach ($tours as $item) {
            /** @var Tour $tour */
            $tour = (new Tour())->getOne($item['id']);
            $tour->t_status_admin_id = $newStatus;
            $tour->save();

            // Выполняем логирование снятого с публикации тура.
            if ($oldStatus == Tour::STATUS_PUBLISHED) {
                $tour->publishFinishLog();
            }

            // Выполняем логирование опубликованного тура.
            if ($newStatus == Tour::STATUS_PUBLISHED) {
                $tour->publishStartLog();
            }

            // Меняем статус программы в зависимости от того, есть ли опубликованные туры или нет.
            if (Tour::isPublished($tour->id)) {
                $program->status = Program::STATUS_PUBLISHED;
            } else {
                // Если программы не в статусе на модерации, то меняем статус на неопубликованный.
                if ($program->status != Program::STATUS_REJECTED) {
                    $program->status = Program::STATUS_UNPUBLISHED;
                }
            }

            $program->save();
        }
    }
}
