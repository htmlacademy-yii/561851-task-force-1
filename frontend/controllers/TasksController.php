<?php

namespace frontend\controllers;

use app\models\Task;
use frontend\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
    /**
     * Display new tasks.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $tasks = Task::find([ 'status' => Task::STATUS_NEW ])->orderBy([ 'created_at'=> SORT_DESC ])->all();

        return $this->render('index', ['tasks' => $tasks]);
    }

    /**
     * Display filtered tasks.
     *
     * @return mixed
     */
    public function actionFilter()
    {
        $tasks = Task::find([ 'status' => Task::STATUS_NEW ])->orderBy([ 'created_at'=> SORT_DESC ])->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}
