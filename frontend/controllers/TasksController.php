<?php

namespace frontend\controllers;

use app\models\FilterTasksForm;
use app\models\Task;
use frontend\models\Tasks;
use Yii;
use yii\debug\panels\DumpPanel;
use yii\helpers\VarDumper;
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
        $form = new FilterTasksForm();
        $tasks = Task::find([ 'status' => Task::STATUS_NEW ]);

        if ($form->load(Yii::$app->request->post())) {

            $tasks = $form->getFilteredTasks($tasks);

        }

        $tasks = $tasks->orderBy([ 'created_at'=> SORT_DESC ])->all();

        return $this->render('index', ['tasks' => $tasks, 'filterTasksForm' => $form]); //дОБАВИТЬ СПИСОК КАТЕГОРИЙ ИЗ бд
    }
}
