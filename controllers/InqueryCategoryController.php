<?php

namespace amintado\inquery\controllers;

use Yii;
use amintado\inquery\models\base\InqueryCategory;
use amintado\inquery\models\InqueryCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InqueryCategoryController implements the CRUD actions for InqueryCategory model.
 */
class InqueryCategoryController extends Controller
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
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'add-inquery'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['InqueryCategoryIndex']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['InqueryCategoryView']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['InqueryCategoryCreate']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['InqueryCategoryUpdate']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['InqueryCategoryDelete']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['pdf'],
                        'roles' => ['InqueryCategoryPdf']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['help'],
                        'roles' => ['InqueryCategoryHelp']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all InqueryCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InqueryCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new InqueryCategory();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single InqueryCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerInquery = new \yii\data\ArrayDataProvider([
            'allModels' => $model->inqueries,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerInquery' => $providerInquery,
        ]);
    }

    /**
     * Creates a new InqueryCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InqueryCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InqueryCategory model.
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
     * Deletes an existing InqueryCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    /**
     *
     * Export InqueryCategory information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $providerInquery = new \yii\data\ArrayDataProvider([
            'allModels' => $model->inqueries,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerInquery' => $providerInquery,
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
     * Finds the InqueryCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InqueryCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InqueryCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('amintado_inquery', 'The requested page does not exist.'));
        }
    }

    /**
     * Action to load a tabular form grid
     * for Inquery
     * @author Yohanes Candrajaya <moo.tensai@gmail.com>
     * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
     *
     * @return mixed
     */
    public function actionAddInquery()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('Inquery');
            if ((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formInquery', ['row' => $row]);
        } else {
            throw new NotFoundHttpException(Yii::t('amintado_inquery', 'The requested page does not exist.'));
        }
    }
}
