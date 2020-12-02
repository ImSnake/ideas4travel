<?php

namespace app\widgets\program;

use app\base\App;
use app\base\Widget;
use app\Models\program\Program;

class EditProgramAdditional extends Widget
{
    public function run()
    {
        /** @var Program $program */
        $program = $this->params['program'];

        // Получаем массив элементов фильтров.
        $arrAllFilters = Program::getArrFilters();

        // Получаем массив ids элементов выбранных фильтров.
        $arrFilters = Program::getFilters($program->id);
        $arrFiltersIds = [];
        if ($arrFilters) {
            foreach ($arrFilters as $key => $val) {
                $arrFiltersIds[] = $val['filter_id'];
            }
        }

        echo $this->render('program/views/form_additional',
            [
                'program' => $program,
                'arrAllFilters' => $arrAllFilters,
                'arrFiltersIds' => $arrFiltersIds,
            ]
        );
    }
}
