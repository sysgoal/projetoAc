<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;


/**
 * This is the model class for table "tb_teste_pilates".
 *
 * @property int $id
 * @property int $id_aluno
 * @property string $dt_teste
 * @property string|null $ds_001
 * @property string|null $ds_002
 * @property string|null $ds_003
 * @property string|null $ds_004
 * @property string|null $ds_005
 * @property string|null $ds_005
 * @property string $ds_observacao
 * @property TbAluno $aluno
 */
class TestePilates extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_teste_pilates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_aluno', 'dt_teste'], 'required'],
            [['id_aluno'], 'integer'],
            [['dt_teste'], 'safe'],
            [['ds_observacao'], 'string'],
            [['ds_001', 'ds_002', 'ds_003', 'ds_004', 'ds_005'], 'string'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_aluno' => 'Nome do Aluno/Paciente',
            'dt_teste' => 'Data do Teste',
            'ds_001' => '001',
            'ds_002' => '002',
            'ds_003' => '003',
            'ds_004' => '004',
            'ds_005' => '005',
            'ds_observacao' => 'Observação',
        ];
    }


    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno() {
        return $this->hasOne(Aluno::className(), ['id' => 'id_aluno']);
    }

    public function getDataListAluno() { // could be a static func as well
        $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    }
 public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_teste'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_teste'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_teste);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_teste'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->dt_teste, 'dd/MM/yyyy');
                }
            ],
        ];
    }

}

