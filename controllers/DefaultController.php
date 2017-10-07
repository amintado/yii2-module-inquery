<?php

namespace amintado\inquery\controllers;

use Yii;
use amintado\inquery\models\base\Inquery;
use amintado\inquery\models\InquerySearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * InqueryController implements the CRUD actions for Inquery model.
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'create' => ['post']
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Inquery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InquerySearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inquery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Inquery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Inquery();
        $post = Yii::$app->request->post();
        if (empty($post['Inquery'])) {
            throw new BadRequestHttpException(Yii::t('amintado_inquery', 'No Submitted Data'));
        } else {
            $post = $post['Inquery'];
        }
        $model->qdate = date('ymd');
        $model->qdescription = $post['qdescription'];
        $model->created_by = Yii::$app->user->id;
        $model->created_at=date('ymd');
        $model->status=Inquery::STATUS_WAIT;
        $model->category=$post['category'];
        if ($model->validate() && $model->save()){
            $image=UploadedFile::getInstancesByName('Inquery[qfile]');

            if (!empty($image)){
                if (!realpath(Yii::getAlias(Yii::$app->controller->module->filesDirectory))){
                    mkdir(Yii::getAlias(Yii::$app->controller->module->filesDirectory),0777,true);
                    $directory=realpath(Yii::getAlias(Yii::$app->controller->module->filesDirectory));
                    $hash=hash('adler32',$model->id);
                    if ($image[0]->saveAs($directory.'/'.$hash.'.'.$image[0]->extension)){
                        $model->qfile=$hash.'.'.$image[0]->extension;
                        $model->save();
                    }
                }else{

                    $directory=realpath(Yii::getAlias(Yii::$app->controller->module->filesDirectory));

                    $hash=hash('adler32',$model->id);
                    if ($image[0]->saveAs($directory.'/'.$hash.'.'.$image[0]->extension)){
                        $model->qfile=$hash.'.'.$image[0]->extension;
                        $model->save();
                    }
                }
        }

        return $this->redirect(['view','id'=>$model->id]);
        }else{
            return $this->render('create', ['model' => $model]);
        }

    }

    /**
     *
     * Export Inquery information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
     * Finds the Inquery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inquery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inquery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('amintado_inquery', 'The requested page does not exist.'));
        }
    }
}
