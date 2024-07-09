<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use app\models\Client;
use yii\filters\auth\HttpBearerAuth;

class ClientController extends ActiveController
{
    public $modelClass = 'app\models\Client';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        // Desabilitar a ação 'create' padrão para usar uma personalizada
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $model = new Client();
        $model->load(Yii::$app->request->getBodyParams(), '');

        try {
            if ($model->save()) {
                Yii::$app->response->setStatusCode(201);
                return ['message' => 'Cliente criado com sucesso', 'client' => $model];
            } else {
                Yii::$app->response->setStatusCode(422);
                return ['errors' => $model->errors];
            }
        } catch (\Exception $e) {
            Yii::error('Erro ao criar cliente: ' . $e->getMessage());
            Yii::$app->response->setStatusCode(500); // Internal Server Error
            return ['error' => 'Erro ao processar a requisição. Verifique os logs para mais detalhes.'];
        }
    }

    /**
     * Lista os clientes paginados.
     * @return ActiveDataProvider
     */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Client::find(),
            'pagination' => [
                'pageSize' => 10, // Quantidade de clientes por página
            ],
        ]);

        return $dataProvider;
    }

    /**
     * Busca um cliente pelo ID.
     * @param int $id O ID do cliente a ser buscado
     * @return Client|array|null
     * @throws NotFoundHttpException Se o cliente não for encontrado
     */
    public function actionView($id)
    {
        $client = Client::findOne($id);

        if ($client === null) {
            throw new \yii\web\NotFoundHttpException("Cliente com ID $id não encontrado.");
        }

        return $client;
    }
}
