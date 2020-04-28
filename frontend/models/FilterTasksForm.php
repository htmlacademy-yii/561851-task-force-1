<?php

namespace app\models;

use yii\base\Model;
use app\models\Task;
use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use app\models\Reply;

class FilterTasksForm extends Model
{
    public $taskCategories;
    public $additionalParamRemoteJob;
    public $additionalParamWithoutReply;
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

        if ($this->additionalParamRemoteJob) {
            $tasks = $tasks->andWhere(['lat' => null, 'lng' => null]);
        }

        if ($this->additionalParamWithoutReply) {
            $tasksWithreplyes = Reply::find()->select('task_id')->all();
            $tasksWithreplyesIds = [];
            foreach ($tasksWithreplyes as $id) {
                if (!in_array($id->task_id, $tasksWithreplyesIds)) {
                    $tasksWithreplyesIds[] = $id->task_id;
                }
            }

            $tasks = $tasks->andWhere(['not in','id', $tasksWithreplyesIds]);
        }

        if ($this->taskCategories) {
            $tasks = $tasks->andWhere(['category_id' => $this->taskCategories]);
        }

        return $tasks;
    }

    public function rules()
    {
        return [
            [
                [
                    'taskCategories',
                    'additionalParamRemoteJob',
                    'additionalParamWithoutReply',
                    'period',
                    'searchByName'
                ],
                'safe'
            ]
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

    public function getCategories()
    {
        $categories = Category::find()->all();
        $categoriesForForm = ArrayHelper::map($categories, 'id', 'name');

        return $categoriesForForm;
    }
}
