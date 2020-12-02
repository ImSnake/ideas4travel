<?php

namespace app\helpers;

use app\Models\Partner;
use app\Models\program\Program;
use app\Models\User;
use app\services\Mailer;

/**
 * Class MailHelpers содерижит шаблоны писем.
 * @package app\helpers
 */
class MailHelpers
{
    /**
     * Письмо отправляется партнеру, если отредактированная Опубликованная программа не прошла валидацию.
     * @param User $user - пользователь, которому принадлежит программа.
     * @param array $errors - массив ошибок.
     * @param Program $program - программа.
     */
    public static function sendEmailToPartnerProgramRejectValidate(User $user, Program $program, array $errors)
    {
        // Получаем строку из ошибок валидации.
        $errorString = "<ul>";
        foreach ($errors as $error) {
            $errorString .= "<li>{$error}</li>";
        }
        $errorString .= "<ul>";

        // Дата редактирования программы.
        $update_at = date('d.m.Y H:m', strtotime($program->update_at));

        // Отправляем письмо партнеру с причиной отклонения.
        $subject = "Программа {$program->name} отклонена";
        $message = "
					<h2>Здравствуйте, {$user->last_name} {$user->first_name}</h2>
					<p>Программа {$program->name}, которую вы отредактировали {$update_at} отклонена по следующей причине:</p>
					{$errorString}
					<p>Все опубликованные туры для этой программы переведены в стутус НА МОДЕРАЦИИ. Для того чтобы возобновить показ туров вам необходимо исправить ошибки и отправить программу на модерацию.</p>
					<p><a href=\"https://" . $_SERVER['HTTP_HOST'] . "/programs/edit/" . $program->id . "\">Исправить программу</a></p>
					";
        Mailer::mail($user->email, $subject, $message);
    }

    public static function sendEmailToPartnerProgramRejectModeration(User $user, Program $program, $message)
    {
        $subject = "Программа {$program->name} отклонена";
        $message = "
					<h2>Здравствуйте, {$user->last_name} {$user->first_name}</h2>
					<p>Программа " . $program->name . ", которую вы отправляли на модерацию отклонена по следующей причине:</p>
					<p>{$message}</p>
					<p>Для того чтобы опубликовать тур вам необходимо исправить ошибки и отправить программу на модерацию.</p>
					<p><a href=\"https://" . $_SERVER['HTTP_HOST'] . "/programs/edit/" . $program->id . "\">Исправить программу</a></p>
					";
        Mailer::mail($user->email, $subject, $message);
    }

    public static function sendEmailProgramInModeration(string $email, Program $program)
    {
        $subject = "Программа отправлена на модерацию";
        $message = "
					<h2>Программа отправлена на модерацию</h2>
					<p>Время отправки на модерацию: {$program->status_at}</p>
					<p>Название программы: {$program->name}</p>
					<p>ID программы: {$program->id}</p>
					<p>Ссылка на программу: https://{$_SERVER['HTTP_HOST']}/moderation/programs/{$program->id}</p>
					<p><a href=\"https://{$_SERVER['HTTP_HOST']}/moderation/programs/{$program->id}\">Исправить программу</a></p>
					";
        Mailer::mail($email, $subject, $message);
    }

    public static function sendEmailPartnerInModeration(string $email, Partner $partner)
    {
        $subject = "Профиль партнера отправлен на модерацию";
        $message = "
					<h2>Профиль партнера отправлен на модерацию</h2>
					<p>Время отправки на модерацию: {$partner->status_at}</p>
					<p>Название партнера: {$partner->name_profile}</p>
					<p>ID партнера: {$partner->id}</p>
					<p>Ссылка на партнера: https://{$_SERVER['HTTP_HOST']}/moderation/partners/{$partner->id}</p>
					<p><a href=\"https://{$_SERVER['HTTP_HOST']}/moderation/partners/{$partner->id}\">Модерировать партнера</a></p>
					";
        Mailer::mail($email, $subject, $message);
    }

    public static function sendEmailToPartnerRejectModeration(User $user, Partner $partner, $message)
    {
        $subject = "Профиль партнера {$partner->name_profile} отклонен";
        $message = "
					<h2>Здравствуйте, {$user->last_name} {$user->first_name}</h2>
					<p>Профиль партнера " . $partner->name_profile . ", который вы отправляли на модерацию отклонен по следующей причине:</p>
					<p>{$message}</p>
					<p>Для того чтобы опубликовать тур вам необходимо исправить ошибки и снова отправить на модерацию.</p>
					<p><a href=\"https://" . $_SERVER['HTTP_HOST'] . "/organizer\">Исправить профиль</a></p>
					";
        Mailer::mail($user->email, $subject, $message);
    }
}
