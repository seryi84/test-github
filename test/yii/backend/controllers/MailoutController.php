<?php

namespace backend\controllers;

use Yii;
use common\models\Mailout;
use common\models\MailoutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * MailoutController implements the CRUD actions for Mailout model.
 */
class MailoutController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mailout models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MailoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mailout model.
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
     * Creates a new Mailout model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mailout();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->mailer->compose()
                ->setFrom('seryikr84@gmail.com')
                ->setTo($model->email)
                ->setSubject($model->theme)
                ->setTextBody($model->text)
                ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
                ->send();
               
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mailout model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mailout model.
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
     * Finds the Mailout model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mailout the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    

    protected function findModel($id)
    {
        if (($model = Mailout::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
        public function actionDeletemailout()
    {
        if (Yii::$app->request->post()) {
            $request = Yii::$app->request->post();
            //$request= Json::decode($request, $asArray = true);
            foreach ($request as $one) {
               $this->findModel($one)->delete();
            }
          }
        return $this->redirect(['index']);
    }
    
    
    
    
    
    
}
