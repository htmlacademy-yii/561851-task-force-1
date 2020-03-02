<?php

namespace frontend\controllers;

use app\models\User;
use frontend\models\Users;
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
        $users = User::find()->orderBy([ 'created_at'=> SORT_DESC ])->all();

        return $this->render('index', ['users' => $users]);
    }
}
