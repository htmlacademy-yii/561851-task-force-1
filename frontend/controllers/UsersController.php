<?php

namespace frontend\controllers;

use app\models\User;
use app\models\FilterUsersForm;
use Yii;
use yii\web\Controller;

class UsersController extends Controller
{
    /**
     * Display users.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new FilterUsersForm();
        $users = User::find();

        if ($form->load(Yii::$app->request->post())) {

            $users = $form->getFilteredUsers($users);

        }

        $users = $users->orderBy([ 'created_at'=> SORT_DESC ])->all();

        return $this->render('index', ['users' => $users, 'filterUsersForm' => $form]);
    }
}
