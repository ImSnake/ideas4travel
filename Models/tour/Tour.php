<?php

namespace app\Models\tour;

use app\base\App;
use app\base\Model;
use app\helpers\ArrayHelpers;
use app\Models\program\PrImg;
use app\Models\program\Program;
use app\services\Db;
use DateTime;
use Exception;

class Tour extends Model
{
    const STATUS_DRAFT = 1;
    const STATUS_IN_MODERATION = 2;
    const STATUS_PUBLISHED = 3;
    const STATUS_PROGRAM_NOT_VALID = 4;
    const STATUS_NEGATIVE_BALANCE = 5;
    const STATUS_UNPUBLISHED = 6;
    const STATUS_FINISHED = 7;
    const STATUS_TIME_UP = 8;
    const STATUS_CANCELLED = 9;
    const STATUS_COMPLETED = 10;
    const STATUS_NAMES = [
        1 => 'Черновик',
        2 => 'На модерации',
        3 => 'Опубликован',
        4 => 'Программа не прошла валидацию',
        5 => 'Отрицательный баланс',
        6 => 'Снят с публикации',
        7 => 'Завершен',
        8 => 'Сроку публикации истек',
        9 => 'Отменен',
        10 => 'Группа набрана'
    ];

    const TOUR_STATUS_PUBLISHED = 1;
    const TOUR_STATUS_IN_MODERATION = 2;
    const TOUR_STATUS_UNPUBLISHED = 3;
    const TOUR_STATUS_FINISHED = 4;
    const TOUR_STATUS_NAMES = [
        1 => 'Опубликованные туры',
        2 => 'На модерации',
        3 => 'Неопубликованные туры',
        4 => 'Завершенные туры'
    ];

    public $id;
    public $partner_id;
    public $program_id;
    public $start_at;
    public $temp_min;
    public $temp_max;
    public $price_compare;
    public $price;
    public $currency;
    public $available;
    public $discount;
    public $discount_at;
    public $booking_until;
    public $prepayment;
    public $pay_until;
    public $payment_extra;
    public $booking_contact;
    public $booking_conditions;
    public $refund;
    public $t_status_admin_id;
    public $t_status_id;
    public $t_season_id;
    public $created_at;
    public $updated_at;

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'partner_id',
        'program_id',
        'start_at',
        'temp_min',
        'temp_max',
        'price_compare',
        'price',
        'currency',
        'available',
        'discount',
        'discount_at',
        'booking_until',
        'prepayment',
        'pay_until',
        'payment_extra',
        'booking_contact',
        'booking_conditions',
        'refund',
        't_status_admin_id',
        't_status_id',
        't_season_id',
        'created_at',
        'updated_at',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    /**
     * Получаем массив туров с данными программы к которой они принадлежат.
     * @return array
     */
    public static function getTourWithProgram()
    {
        $sql = "SELECT t.id tour_id, t.*, p.*, img.img FROM " . Tour::tableName() . " as t 
        LEFT JOIN " . Program::tableName() . " as p ON p.id = t.program_id 
        LEFT JOIN " . PrImg::tableName() . " as img ON p.id = img.program_id 
        WHERE p.status != :p_status and t.partner_id = :partner_id and img.type = 'main' ORDER BY p.name, t.start_at ASC";

        return App::get()->db->queryAll($sql, [':partner_id' => App::get()->auth->getPartner()->id, ':p_status' => Program::STATUS_ARCHIVED]);
    }

    /**
     * Метод принимает массив из среза туров и программ, а возвращает массив в виде
     * [t_status_admin_id][program_id][array tour]
     * @param array $tours
     * @return array
     */
    public static function sortTourWithProgramByStatus(array $tours)
    {
        $toursByStatus = [];

        foreach ($tours as $tour) {
            if (in_array($tour['t_status_admin_id'],
                [
                    self::STATUS_PUBLISHED
                ]
            )) {
                $toursByStatus[self::TOUR_STATUS_PUBLISHED][$tour['program_id']][] = $tour;
            } elseif (in_array($tour['t_status_admin_id'],
                [
                    self::STATUS_IN_MODERATION
                ]
            )) {
                $toursByStatus[self::TOUR_STATUS_IN_MODERATION][$tour['program_id']][] = $tour;
            } elseif (in_array($tour['t_status_admin_id'],
                [
                    self::STATUS_DRAFT,
                    self::STATUS_PROGRAM_NOT_VALID,
                    self::STATUS_NEGATIVE_BALANCE,
                    self::STATUS_UNPUBLISHED
                ]
            )) {
                $toursByStatus[self::TOUR_STATUS_UNPUBLISHED][$tour['program_id']][] = $tour;
            } elseif (in_array($tour['t_status_admin_id'],
                [
                    self::STATUS_TIME_UP,
                    self::STATUS_CANCELLED,
                    self::STATUS_COMPLETED,
                    self::STATUS_FINISHED
                ]
            )) {
                $toursByStatus[self::TOUR_STATUS_FINISHED][$tour['program_id']][] = $tour;
            }
        }

        return $toursByStatus;
    }

    /**
     * Получаем список элементов статусов туров.
     * @return array
     */
    public static function getArrStatus()
    {
        $arr = App::get()->db->queryAll("SELECT * FROM _t_status");

        return ArrayHelpers::sortByStatus($arr, false);
    }

    /**
     * Получаем список элементов типов сезонов.
     * @return array
     */
    public static function getArrSeason()
    {
        $arr = App::get()->db->queryAll("SELECT * FROM _t_season");

        return ArrayHelpers::sortByStatus($arr, false);
    }

    /**
     * Получаем данные по конкретному сезону.
     * @return mixed
     */
    public function getSeason()
    {
        return $this->db->queryOne("SELECT * FROM _t_season WHERE id = :id",
            [':id' => $this->t_season_id]);
    }

    /**
     * Получаем список элементов названий обязательных полей для дополнительной стоимости туров.
     * @return array
     */
    public static function getArrExtraCostPreset()
    {
        $arr = App::get()->db->queryAll("SELECT * FROM _t_extra_cost_preset");

        return ArrayHelpers::sortByStatus($arr, false);
    }

    /**
     * Получаем список предустановленной дополнительной стоимости.
     * @return array - Возвращается массив отсортированный по ключу extra_cost_preset_id
     */
    public function getExtraCostPreset()
    {
        if (is_null($this->id)) {
            return [];
        }

        $result = $this->db->queryAll("SELECT * FROM " . ExtraCostPreset::tableName() . " WHERE tour_id = :tour_id",
            ['tour_id' => $this->id]);

        if (!$result) {
            return [];
        }

        $arr = [];

        foreach ($result as $item) {
            $arr[$item['extra_cost_preset_id']] = $item;
        }

        return $arr;
    }

    public static function getExtraCostByType(array $extraCost)
    {
        $newArray['required'] = [];
        $newArray['additional'] = [];

        if (!empty($extraCost)) {
            foreach ($extraCost as $item) {
                if ($item['required'] == 1) {
                    $newArray['required'][] = $item;
                } else {
                    $newArray['additional'][] = $item;
                }
            }
        }

        return $newArray;
    }

    /**
     * Проверяем корректность даты старта на текущий день (сегодняшняя дата + booking_until или 2 дня по умолчанию,
     * если нет booking_until).
     * @return bool - Если корректна, то возвращаем true, иначе - false.
     * @throws Exception
     */
    public function checkExpiredStartAt(): bool
    {
        // Получаем текущую дату в нужном формате.
        $dateStartAt = new DateTime;
        $dateStartAtString = $dateStartAt->format('Y-m-d');

        // Получаем количество дней, до которых возможно бронирование тура (если есть booking_until, иначе 2).
        $booking_until = !empty($this->booking_until) ? $this->booking_until : 2;

        if (strtotime($this->start_at) >= strtotime($dateStartAtString . " + " . $booking_until . " day")) {
            return true;
        }

        return false;
    }

    /**
     * Выполняем логирование опубликованного тура.
     */
    public function publishStartLog()
    {
        // Выполняем логирование опубликованного тура.
        $log = new TourPublishedLog();
        $log->tour_id = $this->id;
        $log->program_id = $this->program_id;
        $log->partner_id = $this->partner_id;
        $log->started_at = date("Y-m-d H:i:s");
        $log->insert();
    }

    /**
     * Выполняем логирование снятого с публикации тура.
     */
    public function publishFinishLog()
    {
        /** @var TourPublishedLog $log */
        $sql = "SELECT * FROM " . TourPublishedLog::tableName() . " WHERE tour_id = :tour_id ORDER BY id DESC";
        $std = $this->db->queryOne($sql, [':tour_id' => $this->id]);
        $log = (new TourPublishedLog())->getOne($std['id']);
        if ($log) {
            $log->finished_at = date("Y-m-d H:i:s");
            $log->save();
        }
    }

    /**
     * Метод проверяет есть ли у программы опубликованные туры в настоящий момент.
     * @param int $program_id
     * @return bool
     */
    public static function isPublished(int $program_id): bool
    {
        /** @var Db $db */
        $db = App::get()->db;

        $sql = "SELECT * FROM " . TourPublishedLog::tableName() . " WHERE program_id = :program_id AND finished_at IS NULL ORDER BY id DESC";
        $std = $db->queryOne($sql, [':program_id' => $program_id]);
        if ($std) {
            return true;
        }

        return false;
    }

    /**
     * Метод проверяет, есть ли у программы опубликованные или снятые с публикации туры.
     * @param int $program_id
     * @return bool
     */
    public static function isUnpublished(int $program_id): bool
    {
        if ((new TourPublishedLog())->getOne(['program_id' => $program_id])) {
            return true;
        }

        return false;
    }
}
