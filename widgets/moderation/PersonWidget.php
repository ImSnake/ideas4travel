<?php

namespace app\widgets\moderation;

use app\base\App;
use app\base\Widget;
use app\Models\organizer\Person;
use app\Models\Partner;

class PersonWidget extends Widget
{
    public function run()
    {
        /**
         * Получаем данные для профайла организации.
         */

        /** @var Partner $partner */
        $partner = $this->params['partner'];
        /** @var Person $person */
        $person = $partner->getProfile();
        $person->fullAddressReg = $this->getFullAddressReg($person);
        $person->fullAddressFact = $this->getFullAddressFact($person);

        echo $this->render('moderation/views/person', ['person' => $person]);
    }

    public function getFullAddressReg($person)
    {
        // Если нет города, то возрващаем false.
        if (!$person->reg_city) {
            return false;
        }

        $string = '';

        if ($person->reg_index) {
            $string .= $person->reg_index . ', ';
        }

        // Получаем массив: город, район, страна.
        $arrArrayCityAreaCountry = $this->getArrayCityAreaCountry($person->reg_city);

        if ($arrArrayCityAreaCountry['co_name']) {
            $string .= $arrArrayCityAreaCountry['co_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['a_name']) {
            $string .= $arrArrayCityAreaCountry['a_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['c_name']) {
            $string .= $arrArrayCityAreaCountry['c_name'] . '<br>';
        }

        if ($person->reg_address) {
            $string .= $person->reg_address;
        }

        return $string;
    }

    public function getFullAddressFact($person)
    {
        // Если нет города, то возрващаем false.
        if (!$person->fact_city) {
            return false;
        }

        $string = '';

        if ($person->fact_index) {
            $string .= $person->fact_index . ', ';
        }

        // Получаем массив: город, район, страна.
        $arrArrayCityAreaCountry = $this->getArrayCityAreaCountry($person->fact_city);

        if ($arrArrayCityAreaCountry['co_name']) {
            $string .= $arrArrayCityAreaCountry['co_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['a_name']) {
            $string .= $arrArrayCityAreaCountry['a_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['c_name']) {
            $string .= $arrArrayCityAreaCountry['c_name'] . '<br>';
        }

        if ($person->fact_address) {
            $string .= $person->fact_address;
        }

        return $string;
    }

    public function getArrayCityAreaCountry($city_id)
    {
        $db_geo = App::get()->db_geo;

        $sql = "SELECT c.name c_name, a.name a_name, co.name co_name FROM pb_city c LEFT JOIN pb_area a ON c.area = a.id LEFT JOIN pb_country co ON c.country = co.id WHERE c.id = :id";
        $result = $db_geo->queryOne($sql, [':id' => $city_id]);

        return $result;
    }
}
