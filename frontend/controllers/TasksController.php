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

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $tasks = Task::find([ 'status' => Task::STATUS_NEW ]);

            if (Yii::$app->request->post()['FilterTasksForm']['q']) {
                $tasks = $tasks->where(['like', 'name', '%' . Yii::$app->request->post()['FilterTasksForm']['q'] . '%', false]);
            }

            if (Yii::$app->request->post()['FilterTasksForm']['time']) {
                $date = new \DateTime();
                $date->sub(\DateInterval::createFromDateString(Yii::$app->request->post()['FilterTasksForm']['time']));
                $result = $date->format('Y-m-d H:i:s');
                $tasks = $tasks->andFilterWhere(['>', 'created_at', $result]);
            }


            //VarDumper::dump(Yii::$app->request->post()['FilterTasksForm']['q']);

            $tasks = $tasks->orderBy([ 'created_at'=> SORT_DESC ])->all();

            return $this->render('index', ['tasks' => $tasks, 'filterTasksForm' => $form]);
        } else {
            $tasks = Task::find([ 'status' => Task::STATUS_NEW ])->orderBy([ 'created_at'=> SORT_DESC ])->all();

            return $this->render('index', ['tasks' => $tasks, 'filterTasksForm' => $form]);
        }
    }
}
