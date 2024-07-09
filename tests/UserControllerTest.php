<?php


namespace tests;

use Yii;
use app\controllers\UserController;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginSuccess()
    {
        $controller = new UserController('user', Yii::$app);

        // Simulate a POST request with valid username and password
        $response = $controller->actionLogin([
            'username' => 'marcelo', // Coloque o nome de usuário correto
            'password' => 'marcelo', // Coloque a senha correta
        ]);

        // Assert that the response contains a token
        $this->assertArrayHasKey('token', $response);
    }

    public function testLoginFailure()
    {
        $controller = new UserController('user', Yii::$app);

        // Simulate a POST request with invalid username and password
        $this->expectException('yii\web\UnauthorizedHttpException');
        $controller->actionLogin([
            'username' => 'usuario_invalido', // Usuário inválido
            'password' => 'senha_invalida',   // Senha inválida
        ]);
    }
}
