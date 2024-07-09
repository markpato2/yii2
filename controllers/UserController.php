<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;
use yii\web\UnauthorizedHttpException;

class UserController extends Controller
{
    public function actionLogin()
    {
        $request = Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');


        $user = User::findByUsername($username);



        if ($user && $user->validatePassword($password)) {
            return ['token' => $user->access_token];
        } else {
            throw new UnauthorizedHttpException('Usuário ou senha inválida.');
        }
    }
}
