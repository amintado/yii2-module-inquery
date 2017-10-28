<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

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
class ManageController extends Controller
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
                                                    'actions' => ['index'],
                                                    'roles' => ['InqueryIndex']
                                                ],
                                                [
                                                    'allow' => true,
                                                    'actions' => ['view'],
                                                    'roles' => ['InqueryView']
                                                ],
                                                [
                                                    'allow' => true,
                                                    'actions' => ['create'],
                                                    'roles' => ['InqueryCreate']
                                                ],
                                                [
                                                    'allow' => true,
                                                    'actions' => ['update'],
                                                    'roles' => ['InqueryUpdate']
                                                ],
                                                [
                                                    'allow' => true,
                                                    'actions' => ['delete'],
                                                    'roles' => ['InqueryDelete']
                                                ],
                                                [
                                                  'allow'=>true,
                                                    'actions'=>['pdf'],
                                                    'roles'=>['InqueryPdf']
                                                ],
                            					[
                                                  'allow'=>true,
                                                    'actions'=>['help'],
                                                    'roles'=>['InqueryHelp']
                                                ],
                                                [
                                                  'allow'=>true,
                                                    'actions'=>['confirm'],
                                                    'roles'=>['InqueryConfirm']
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        $this->module->eventClass::afterViewed($model);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionConfirm($id){
        $model=Inquery::find()->where(['id'=>$id])->one();
        if (empty($model)){
            throw new BadRequestHttpException(Yii::t('amintado_inquery', 'Bad Confirm request'));
        }else{
            if ($model->status==Inquery::STATUS_ANSWERED){
                throw new BadRequestHttpException(Yii::t('amintado_inquery', 'confirm status success alert'));
            }
        }
        if (Yii::$app->request->post()){

            if ($model->load(Yii::$app->request->post())){
                $file=UploadedFile::getInstance($model, 'afile');
                $model->status=Inquery::STATUS_ANSWERED;
                if (!empty($file)){
                    if (!realpath(Yii::getAlias(Yii::$app->controller->module->filesDirectory))){
                        mkdir(Yii::getAlias(Yii::$app->controller->module->filesDirectory),0777,true);
                        $directory=realpath(Yii::getAlias(Yii::$app->controller->module->filesDirectory));
                        $hash=hash('adler32',$model->id);
                        if ($file[0]->saveAs($directory.'/'.$hash.'.'.$file[0]->extension)){
                            $model->afile=$hash.'.'.$file[0]->extension;
                            if ($model->save()){
                                $this->module->eventClass::afterAnswer($model);
                            }else{
                                $this->module->eventClass::AnswerError($model);
                            }
                        }
                    }else{

                        $directory=realpath(Yii::getAlias(Yii::$app->controller->module->filesDirectory));

                        $hash=hash('adler32',$model->id);
                        if ($file[0]->saveAs($directory.'/'.$hash.'.'.$file[0]->extension)){
                            $model->afile=$hash.'.'.$file[0]->extension;
                            if ($model->save()){
                                $this->module->eventClass::afterAnswer($model);
                            }else{
                                $this->module->eventClass::AnswerError($model);
                            }
                        }
                    }
                }
            }


        }else{
            if (!empty($model->qfile)){
                $model->file=Yii::$app->controller->module->downloadUrl.'/'.$model->qfile;
            }
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing Inquery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Inquery model.
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
