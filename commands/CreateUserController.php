<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;

class CreateUserController extends Controller
{
    public $username;
    public $password;
    public $name;


    public function options($actionID)
    {
        return ['username', 'password', 'name'];
    }

    /**
     * This command creates a new user.
     * @return int Exit code
     */
    public function actionIndex()
    {
        if ($this->username === null || $this->password === null || $this->name === null) {
            $this->stderr("Erro: Argumentos obrigatórios faltando: username, password, name\n");
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $user = new User();
        $user->username = $this->username;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->name = $this->name;

        if ($user->save()) {
            echo "Usuário criado com sucesso.\n";
            return ExitCode::OK;
        } else {
            echo "Error criando usuário:\n";
            foreach ($user->errors as $error) {
                echo implode("\n", $error) . "\n";
            }
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}
