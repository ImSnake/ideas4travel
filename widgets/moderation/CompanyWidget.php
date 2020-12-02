<?php

namespace app\widgets\moderation;

use app\base\App;
use app\base\Widget;
use app\Models\Partner;

class CompanyWidget extends Widget
{
    public function run()
    {
        /**
         * Получаем данные для профайла организации.
         */

        /** @var Partner $partner */
        $partner = $this->params['partner'];
        $company = $partner->getProfile();
        $company->fullAddressReg = $this->getFullAddressReg($company);
        $company->fullAddressFact = $this->getFullAddressFact($company);

        echo $this->render('moderation/views/company',
            ['company' => $company, 'partner' => $partner]);
    }

    public function getFullAddressReg($company)
    {
        // Если нет города, то возрващаем false.
        if (!$company->reg_city) {
            return false;
        }

        $string = '';

        if ($company->reg_index) {
            $string .= $company->reg_index . ', ';
        }

        // Получаем массив: город, район, страна.
        $arrArrayCityAreaCountry = $this->getArrayCityAreaCountry($company->reg_city);

        if ($arrArrayCityAreaCountry['co_name']) {
            $string .= $arrArrayCityAreaCountry['co_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['a_name']) {
            $string .= $arrArrayCityAreaCountry['a_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['c_name']) {
            $string .= $arrArrayCityAreaCountry['c_name'] . ', ';
        }

        if ($company->reg_address) {
            $string .= $company->reg_address;
        }

        return $string;
    }

    public function getFullAddressFact($company)
    {
        // Если нет города, то возрващаем false.
        if (!$company->fact_city) {
            return false;
        }

        $string = '';

        if ($company->fact_index) {
            $string .= $company->fact_index . ', ';
        }

        // Получаем массив: город, район, страна.
        $arrArrayCityAreaCountry = $this->getArrayCityAreaCountry($company->fact_city);

        if ($arrArrayCityAreaCountry['co_name']) {
            $string .= $arrArrayCityAreaCountry['co_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['a_name']) {
            $string .= $arrArrayCityAreaCountry['a_name'] . ', ';
        }

        if ($arrArrayCityAreaCountry['c_name']) {
            $string .= $arrArrayCityAreaCountry['c_name'] . ', ';
        }

        if ($company->fact_address) {
            $string .= $company->fact_address;
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
