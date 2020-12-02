<?php

namespace app\Models\program;

use app\base\App;
use app\base\Model;
use app\helpers\ArrayHelpers;

class Program extends Model
{
    public $id;
    public $partner_id;
    public $name;
    public $status;
    public $start;
    public $finish;
    public $finish_checkbox;
    public $multitur;
    public $about;
    public $group_min;
    public $group_max;
    public $age_min;
    public $age_max;
    public $duration;
    public $meal_id;
    public $dynamic_id;
    public $comfort_id;
    public $conditions;
    public $features_region;
    public $what_take;
    public $health;
    public $additional;
    public $create_at;
    public $update_at;
    public $validate_at;
    public $status_at;

    const STATUS_DRAFT = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_IN_MODERATION = 3;
    const STATUS_REJECTED = 4;
    const STATUS_PUBLISHED = 5;
    const STATUS_UNPUBLISHED = 6;
    const STATUS_ARCHIVED = 7;
    const STATUS_DELETED = 8;
    const STATUS_NAMES = [
        1 => 'Черновик',
        2 => 'Заполнена',
        3 => 'На модерации',
        4 => 'Отклонена',
        5 => 'Опубликована',
        6 => 'Не опубликована',
        7 => 'В архиве',
        8 => 'Удалена'
    ];

    // Массив полей таблицы.
    protected $arrColumnsInTable = [
        'id',
        'partner_id',
        'name',
        'status',
        'start',
        'finish',
        'finish_checkbox',
        'multitur',
        'about',
        'group_min',
        'group_max',
        'age_min',
        'age_max',
        'duration',
        'meal_id',
        'dynamic_id',
        'comfort_id',
        'conditions',
        'features_region',
        'what_take',
        'health',
        'additional',
        'create_at',
        'update_at',
        'validate_at',
        'status_at',
    ];

    // Название первичного ключа.
    protected $primaryKey = 'id';

    /**
     * Метод возрващает название таблицы.
     * @return string
     */
    public static function tableName()
    {
        return 'programs';
    }

    /**
     * Получаем название класса.
     * @return string
     */
    public function getClass()
    {
        return self::class;
    }

    public static function getAllPrograms()
    {
        // Получаем партнера.
        $partner = App::get()->auth->getPartner();

        // Получаем соединение с базой данных.
        $db = App::get()->db;

        $sql = "SELECT * FROM " . static::tableName() . " WHERE partner_id = :partner_id ORDER BY id DESC";

        return $db->queryArrObject($sql, self::class, [':partner_id' => $partner->id]);
    }

    public static function getAllProgramsSortByStatus()
    {
        // Получаем партнера.
        $partner = App::get()->auth->getPartner();

        // Получаем соединение с базой данных.
        $db = App::get()->db;

        $sql = "SELECT * FROM " . static::tableName() . " WHERE partner_id = :partner_id and status != :status ORDER BY status DESC, id DESC";

        return $db->queryArrObject($sql, self::class, [':partner_id' => $partner->id, ':status' => Program::STATUS_ARCHIVED]);
    }

    /**
     * Получаем список элементов питания.
     * @return array
     */
    public static function getArrMeals()
    {
        $arrMeals = App::get()->db->queryAll("SELECT * FROM _meal");

        return ArrayHelpers::sortByStatus($arrMeals, false);
    }

    /**
     * Получаем список элементов динамики тура.
     * @return array
     */
    public static function getArrDynamic()
    {
        $arrDynamic = App::get()->db->queryAll("SELECT * FROM _dynamic");

        return ArrayHelpers::sortByStatus($arrDynamic, false);
    }

    /**
     * Получаем список элементов уровня комфорта.
     * @return array
     */
    public static function getArrComfort()
    {
        $arrComfort = App::get()->db->queryAll("SELECT * FROM _comfort");

        return ArrayHelpers::sortByStatus($arrComfort, false);
    }

    /**
     * Получаем список элементов типов тура.
     * Магическая цифра 13 - это тип тура Мультитур, который нужно исключить.
     * @return array
     */
    public static function getArrTourType()
    {
        $arrTourType = App::get()->db->queryAll("SELECT * FROM _tour_type WHERE id != 13");

        return ArrayHelpers::sortByStatus($arrTourType);
    }

    /**
     * Получаем список id выбранных элементов типов туров.
     * @param int|null $program_id
     * @return array|bool
     */
    public function getTourType(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }

        return $this->db->queryAll("SELECT * FROM " . PrTourType::tableName() . " WHERE program_id = :program_id",
            ['program_id' => $program_id]);
    }

    /**
     * Получаем список элементов целевой аудитории.
     * @return array
     */
    public static function getArrTargetAudience()
    {
        $arrTargetAudience = App::get()->db->queryAll("SELECT * FROM _target_audience");

        return ArrayHelpers::sortByStatus($arrTargetAudience, false);
    }

    /**
     * Получаем список выбранных элементов целевой аудитории.
     * @param int|null $program_id
     * @return array|bool
     */
    public function getTargetAudience(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }
        return $this->db->queryAll("SELECT * FROM " . PrTargetAudience::tableName() . " WHERE program_id = :program_id",
            ['program_id' => $program_id]);
    }

    /**
     * Метод возвращает массив объектов всех дней программы.
     * @return array
     */
    public function getAllDays()
    {
        $sql = "SELECT * FROM " . PrDay::tableName() . " WHERE program_id = :program_id";

        return $this->db->queryArrObject($sql, PrDay::class, [':program_id' => $this->id]);
    }

    /**
     * Получаем количество дней в программе.
     * @param int|null $program_id
     * @return bool|mixed Возвращается значение из которого нужно получить count.
     */
    public static function getCountDays(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }
        return App::get()->db->queryOne("SELECT COUNT(id) AS count FROM " . PrDay::tableName() . " WHERE program_id = :program_id",
            ['program_id' => $program_id]);
    }

    /**
     * Получаем массив всех элементов фильтров.
     * @return array
     */
    public static function getArrFilters()
    {
        /** @var array $arrFilters */
        $arrFilters = [];

        // Получаем массив первого уровня.
        $arrFilters1 = App::get()->db->queryAll("SELECT * FROM _filter_1");

        // Получаем массив второго уровня.
        $arrFilters2 = App::get()->db->queryAll("SELECT * FROM _filter_2");

        // Получаем массив третьего уровня.
        $arrFilters3 = App::get()->db->queryAll("SELECT f3.filter_1_id f1_id, f3.filter_2_id f2_id, f3.id f3_id, f3.name name, f3.status status, f3.description description, f1.name f1_name, f2.name f2_name FROM _filter_3 f3 LEFT JOIN _filter_1 f1 ON f3.filter_1_id = f1.id LEFT JOIN _filter_2 f2 on f3.filter_2_id = f2.id");
        // Сортируем массив по статусу и возрастанию.
        $arrFilters3 = ArrayHelpers::sortByStatus($arrFilters3);

        foreach ($arrFilters1 as $value) {
            $arrFilters[$value['id']] = [
                'id' => $value['id'],
                'name' => $value['name']
            ];
        }

        foreach ($arrFilters2 as $value) {
            $arrFilters[$value['filter_1_id']]['data'][$value['id']] = [
                'id' => $value['id'],
                'name' => $value['name']
            ];
        }

        foreach ($arrFilters3 as $value) {
            $arrFilters[$value['f1_id']]['data'][$value['f2_id']]['data'][$value['f3_id']] = [
                'id' => $value['f3_id'],
                'name' => $value['name'],
                'status' => $value['status'],
                'description' => $value['description'],
                'filter_1_id' => $value['f1_id'],
                'filter_2_id' => $value['f2_id']
            ];
        }

        return $arrFilters;
    }

    /**
     * Получаем список выбранных элементов целевой аудитории.
     * @param int|null $program_id
     * @return array|bool
     */
    public static function getFilters(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }
        return App::get()->db->queryAll("SELECT * FROM " . PrFilter::tableName() . " WHERE program_id = :program_id",
            ['program_id' => $program_id]);
    }

    /**
     * Получаем список выбранных элементов целевой аудитории.
     * @param int|null $program_id
     * @return array|bool
     */
    public static function getVideos(?int $program_id)
    {
        if (is_null($program_id)) {
            return false;
        }
        return App::get()->db->queryAll("SELECT * FROM " . PrVideos::tableName() . " WHERE program_id = :program_id",
            ['program_id' => $program_id]);
    }

    public static function createDirForImgPrograms(?int $partner_id, ?int $program_id)
    {
        if (is_null($partner_id) || is_null($program_id)) {
            return false;
        }

        $imgDirProgram = IMG_DIR . "/tours/" . $partner_id . "/" . $program_id;

        if (!is_dir($imgDirProgram)) {
            mkdir($imgDirProgram, 0755);
        }

        if (!is_dir($imgDirProgram . "/big")) {
            mkdir($imgDirProgram . "/big", 0755);
        }

        if (!is_dir($imgDirProgram . "/micro")) {
            mkdir($imgDirProgram . "/micro", 0755);
        }

        if (!is_dir($imgDirProgram . "/middle")) {
            mkdir($imgDirProgram . "/middle", 0755);
        }

        if (!is_dir($imgDirProgram . "/mini")) {
            mkdir($imgDirProgram . "/mini", 0755);
        }

        if (!is_dir($imgDirProgram . "/user-size")) {
            mkdir($imgDirProgram . "/user-size", 0755);
        }

        return true;
    }

    /**
     * Получаем срез трансферов для программы.
     * @return array|bool
     */
    public function getTransferByProgram()
    {
        if (is_null($this->id)) {
            return false;
        }
        return $this->db->queryAll("SELECT DISTINCT t.id, t.name FROM " . PrDayTransfer::tableName() . " pt INNER JOIN _day_transfer t ON pt.day_transfer_id = t.id WHERE pt.program_id = :program_id and t.id not in ('1','2')",
            ['program_id' => $this->id]);
    }

    /**
     * Получаем срез ночевок для программы.
     * @return array|bool
     */
    public function getDayGeoByProgram()
    {
        if (is_null($this->id)) {
            return false;
        }
        return $this->db->queryAll("SELECT DISTINCT g.country_id, g.area_id, g.city_id FROM " . PrDay::tableName() . " d INNER JOIN " . PrGeo::tableName() . " g ON d.geo_id = g.id WHERE d.program_id = :program_id AND g.city_id IS NOT NULL",
            ['program_id' => $this->id]);
    }
}
