<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\AlunoSearch;
use app\models\TesteHofi;
use app\models\TestePilates;

/**
 * BiometriaController implements the CRUD actions for Biometria model.
 */
class BoletimController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actionIndex() {
        if (Yii::$app->user->id) {
            $model = new \app\models\BoletimAluno();
            $searchModel = new AlunoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'model' => $model,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionView($id) {
        if (Yii::$app->user->id) {

            $model = new TesteHofi();
            $model2 = new TestePilates();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                 return $this->render('view', [
                        'id' => $model->id_aluno, 
                ]);
            }
            if ($model2->load(Yii::$app->request->post()) && $model2->save()) {
                 return $this->render('view', [
                        'id' => $model2->id_aluno, 
                ]);                          
                 //$this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('view', [
                        'id' => $id,
            ]);
        } else {
            return $this->redirect(['site/about']);
        }
    }

    public function actionCreate() {
        if (Yii::$app->user->id) {
            $model = new TesteHofi();
            $model2 = new TestePilates();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                 return $this->render('view', [
                        'id' => $model->id_aluno, 
                ]);
            }
            if ($model2->load(Yii::$app->request->post()) && $model2->save()) {
                 return $this->render('view', [
                        'id' => $model2->id_aluno, 
                ]);                          
                 //$this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->redirect(['site/about']);
        }
    }

}
