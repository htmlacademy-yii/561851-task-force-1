<?php

namespace frontend\controllers;

use app\models\Task;
use frontend\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
    /**
     * Displays tasks page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $tasks = Task::findAll(['status' => 'new']);

        return $this->render('tasks', ['tasks' => $tasks]);
    }
}
