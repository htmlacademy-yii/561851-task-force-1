<?php

namespace frontend\controllers;

use app\models\User;
use frontend\models\Users;
use yii\web\Controller;

class UsersController extends Controller
{
    /**
     * Displays tasks page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->all();

        return $this->render('users', ['users' => $users]);
    }
}
