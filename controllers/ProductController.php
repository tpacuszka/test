<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use app\models\ProductModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ClientModel;
use app\models\Client;
use yii\web\HttpException;
use app\models\Image;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all deleted Product models.
     * @return mixed
     */
    public function actionDeleted()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('deleted', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Discard all deleted Product models.
     * @return mixed
     */
    public function actionDiscard($id = null)
    {
        $productModel = new ProductModel;
        $productModel->discardDeleted($id);
    }
    
    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->created_at = time();
        $model->created_by = Yii::$app->user->getId();
        
        $clients = ClientModel::getAllClients();        

        if ($model->load(Yii::$app->request->post()) 
                && Yii::$app->user->can('createProduct')) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->upload();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'clients' => $clients,
            ]);
        }
    }
    
    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAjaxCreate()
    {
        $model = new Product();
        $model->created_at = time();
        $model->created_by = Yii::$app->user->getId();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (Yii::$app->user->can('createProduct') && $model->save()) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;               
                Yii::$app->response->statusCode = 200;
                
                return ['id' => $model->id, 
                    'name' => $model->product_name,
                    'price' => $model->price];
            } else {
                throw new HttpException(401, "Access denied");
            }
        } else {
            throw new HttpException(401, "Access denied");
        }
    }
    
    
    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        
        $clientModel = new ClientModel;
        $clients = $clientModel->getAllClients();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {            
            if (Yii::$app->user->can('updateOwnProduct', ['post' => $model])) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            throw new HttpException(401, "Access denied");            
        } else {
            return $this->render('update', [
                'model' => $model,
                'clients' => $clients
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteProduct')) {
            #$this->findModel($id)->delete();
            $model = $this->findModel($id);
            $model->deleted = 1;
            $model->save();
            return $this->redirect(['index']);
        }
        
        throw new HttpException(401, "Access denied");
    }

    /**
     * Show all related products to client with given id
     * @param integer $id
     */
    public function actionRelated($id)
    {
        $client = Client::find()->where(['id' => $id])->one();
    }
    
    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
