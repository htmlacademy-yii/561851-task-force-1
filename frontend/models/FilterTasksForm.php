<?php

namespace app\models;

use yii\base\Model;
use app\models\Task;
use yii\helpers\VarDumper;

class FilterTasksForm extends Model
{
    public $taskCategories;
    public $additionalParamRemoteJob;
    public $period;
    public $searchByName;

    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';
    const PERIOD_MONTH = 'month';
    const PERIOD_YEAR = 'year';
    const PERIOD_DAY_LABEL = 'За день';
    const PERIOD_WEEK_LABEL = 'За неделю';
    const PERIOD_MONTH_LABEL = 'За месяц';
    const PERIOD_YEAR_LABEL = 'За год';


    public function getFilteredTasks($tasks)
    {
        if ($this->searchByName) {
            $tasks = $tasks->where(['like', 'name', $this->searchByName]);
        }

        if ($this->period) {
            switch ($this->period) {
                case 'day' :
                    $tasks = $tasks->andWhere('created_at >= CURDATE()');
                    break;
                case 'week' :
                    $tasks = $tasks->andWhere('created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)');
                    break;
                case 'month' :
                    $tasks = $tasks->andWhere('created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)');
                    break;
                case 'year' :
                    $tasks = $tasks->andWhere('created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 YEAR)');
                    break;
            }
        }

        VarDumper::dump($this->additionalParamRemoteJob);

        if ($this->additionalParamRemoteJob) {
            die;
//            $tasks = $tasks->where(['lat' => null, 'lng' => null]);
        }

        if ($this->taskCategories) {
            VarDumper::dump($this->taskCategories);
        }

        return $tasks;
    }

    public function rules()
    {
        return [
            [['taskCategories', 'additionalParams', 'period', 'searchByName'], 'safe']
            //Изучить валидацию
        ];
    }

    public function getPeriods()
    {
        return [
            self::PERIOD_DAY   => self::PERIOD_DAY_LABEL,
            self::PERIOD_WEEK  => self::PERIOD_WEEK_LABEL,
            self::PERIOD_MONTH => self::PERIOD_MONTH_LABEL,
            self::PERIOD_YEAR  => self::PERIOD_YEAR_LABEL
        ];
    }
}
