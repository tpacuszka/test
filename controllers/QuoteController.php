<?php

namespace app\controllers;

use Yii;
use app\models\Quote;
use app\models\QuoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ClientModel;
use yii\web\HttpException;
use app\models\ItemModel;
use mPDF;
use app\models\QuoteModel;
use DOMPDF;

/**
 * QuoteController implements the CRUD actions for Quote model.
 */
class QuoteController extends Controller
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
     * Lists all Quote models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quote model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $items = $model->getItems()->all();
        return $this->render('view', [
            'model' => $model,
            'items' => $items
        ]);
    }

    /**
     * Creates a new Quote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quote();
        $model->created_at = time();
        $model->created_by = Yii::$app->user->getId();
        
        $clients = ClientModel::getAllClients();
        
        $request = Yii::$app->request;
        $post = $request->post();
        
        if ($model->load($post) && $model->validate()) {
            $model->save();
            $items = ItemModel::fetchItemsData($post);

            #saving items related to quote, if succesfull redirect to created quote
            if (ItemModel::saveItems($items, $model)) {           
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return new HttpException(500);
            }
        } else if (!$request->isAjax) {
            return $this->render('create', [
                'model' => $model,
                'clients' => $clients
            ]);
        } 
    }

    /**
     * Updates an existing Quote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $items = $model->getItems()->all();
        $clientModel = new ClientModel;
        $clients = $clientModel->getAllClients();

        $request = Yii::$app->request;
        $post = $request->post();
        
        if ($model->load($post) && $model->validate()) {
            $model->save();
            $items = ItemModel::fetchItemsData($post);

            #saving items related to quote, if succesfull redirect to updated quote
            if (ItemModel::saveItems($items, $model)) {           
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return new HttpException(500);
            }
        } else if (!$request->isAjax) {
            return $this->render('update', [
                'model' => $model,
                'clients' => $clients,
                'items' => $items,
            ]);
        }
    }

    /**
     * Deletes an existing Quote model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    /**
     * Generates pdf for quote with given $id
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        
        $page = QuoteModel::generatePdfLayout($model);
        $mpdf = new mPDF;
        $mpdf->WriteHTML($page);
        $mpdf->Output();
        exit;
        
    }
    
    /**
     * Finds the Quote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quote::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
