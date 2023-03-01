<?php

namespace app\models;
use app\models\Aluno;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use DateTime;

use Yii;

/**
 * This is the model class for table "tb_relatorio".
 *
 * @property int $id
 * @property int $id_aluno
 * @property int|null $id_profissional
 * @property string $ds_relatorio
 * @property string|null $dt_relatorio
 *
 * @property Aluno $aluno
 * @property Profissional $profissional
 */
class Relatorio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_relatorio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'ds_relatorio'], 'required'],
            [['id_aluno', 'id_profissional'], 'integer'],
            [['dt_relatorio'], 'date', 'format' => 'dd/MM/yyyy'],
            [['ds_relatorio'], 'string', 'max' => 2000],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_profissional'], 'exist', 'skipOnError' => true, 'targetClass' => Profissional::className(), 'targetAttribute' => ['id_profissional' => 'id_profissional']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_aluno' => 'Aluno/Paciente',
            'id_profissional' => 'Profissional',
            'ds_relatorio' => 'Descrição',
            'dt_relatorio' => 'Data do relatorio',
        ];
    }

    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'id_aluno']);
    }

    /**
     * Gets query for [[Profissional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissional()
    {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }
     public function getDataListAluno() { // could be a static func as well
        $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    }
    
     public function getDataListProfissional() { // could be a static func as well
        $models = Profissional::find()->asArray()->all();
        array_unshift($models, new Profissional);
        return ArrayHelper::map($models, 'id_profissional', 'nm_profissional');
    }
    
    
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                   
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_relatorio'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_relatorio);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_relatorio'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->dt_relatorio, 'dd/MM/yyyy');
                }
            ],
           
        ];
    }

    
}
