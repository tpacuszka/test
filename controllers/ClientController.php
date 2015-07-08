<?php

namespace app\controllers;

use Yii;
use app\models\Client;
use app\models\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ClientModel;
use yii\web\HttpException;
use app\models\Product;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create', 'update', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $client = Client::find()->where(['id' => $id])->one();        

        $clientModel = new ClientModel;        
        $productArr = $clientModel->getClientProducts($id);
        print_r($clientModel->getSalesValue($id));
        
        #variables needed for viewing popup window with modal
        $popupVars = [
                "model" => new Product, 
                "clients" => $clientModel->getAllClients(),                
                ];
        
        return $this->render('view', [
            'model' => $client,
            'products' => $productArr,
            'popup' => $popupVars,
            'salesValue' => $clientModel->getSalesValue($id)
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();
        $model->created_at = time();
        $model->created_by = Yii::$app->user->getId();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->user->can('createClient')) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            throw new HttpException(401, "Access denied"); 
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (Yii::$app->user->can('updateClient', ['post' => $model])) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            throw new HttpException(401, "Access denied");             
        } else {
            
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteClient')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        throw new HttpException(401, "Access denied");           
    }
    
    /**
     * Returns list of related products
     * @param integer $id
     */
    public function actionRelatedProducts($id)
    {
        $clientModel = new ClientModel;
        $clientProds = $clientModel->getClientProducts($id);
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $clientProds;
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
