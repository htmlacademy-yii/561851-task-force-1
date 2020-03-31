<?php

namespace app\models;

use yii\base\Model;

class FilterTasksForm extends Model
{
    public $q;
    public $task_category;
    public $additional;
    public $time;

    public function rules()
    {
        return [

        ];
    }
}
