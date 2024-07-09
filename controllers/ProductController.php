<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\filters\auth\HttpBearerAuth;

class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }

    /**
     * Cria um novo produto.
     * @return array
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->load(Yii::$app->request->getBodyParams(), '');

        if ($model->save()) {
            Yii::$app->response->setStatusCode(201); // Código 201 para criação bem-sucedida
            return ['message' => 'Produto criado com sucesso', 'product' => $model];
        } else {
            Yii::$app->response->setStatusCode(422); // Código 422 para erro de validação
            return ['errors' => $model->errors];
        }
    }

    /**
     * Lista os produtos paginados.
     * @return ActiveDataProvider
     */
    public function actionList()
    {
        $query = Product::find();
        $clientId = Yii::$app->request->get('client_id');

        if ($clientId) {
            Yii::info("Filtrando por client_id: $clientId");
            $query->andWhere(['client_id' => $clientId]);
        }

        Yii::info("Consulta SQL gerada: " . $query->createCommand()->rawSql);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Quantidade de itens por página
            ],
        ]);
    }
}

