<?php

namespace frontend\controllers;

use app\models\Task;
use frontend\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
	const status = 'new';

    /**
     * Display new tasks.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $tasks = Task::find([ 'status' => self::status ])->orderBy([ 'created_at'=> SORT_DESC ])->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}
