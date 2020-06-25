<?php

namespace frontend\controllers;

use app\models\Category;
use app\models\FilterTasksForm;
use app\models\Task;
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
        $categories = Category::find()->all();

        return $this->render('index', ['tasks' => $tasks, 'filterTasksForm' => $form, 'categories' => $categories]);
    }
}
