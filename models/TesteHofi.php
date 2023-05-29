<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tb_teste_hofi".
 *
 * @property int $id
 * @property string $dt_teste
 * @property string|null $ds_tempo
 * @property string|null $tp_nado
 * @property int $id_aluno
 * @property string $ds_observacao
 * @property TbAluno $aluno
 */
class TesteHofi extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_teste_hofi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['dt_teste', 'id_aluno'], 'required'],
            [['dt_teste'], 'safe'],
            [['ds_tempo'], 'string'],
            [['id_aluno'], 'integer'],
            [['ds_observacao'], 'string'],
            [['tp_nado'], 'string', 'max' => 200],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'dt_teste' => 'Data do Teste',
            'ds_tempo' => 'Tempo',
            'tp_nado' => 'Nado',
            'id_aluno' => 'Nome do Aluno/Paciente',
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

    public function getDataListProfissionais() { // could be a static func as well
        $models = Profisional::find()->asArray()->orderBy('nm_profissional')->all();
        array_unshift($models, new Profissional);
        return ArrayHelper::map($models, 'id', 'nm_profissional');
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

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_testehofi_'.date('Y-m-d').'.csv';
        $filepath = Yii::getAlias('@app/runtime/' . $filename);
        
        if($data !=null){
            $file = fopen($filepath, 'w');
            fputcsv($file, array_keys($data[0])); // Escreve os cabeçalhos
            
            foreach ($data as $row) {
                fputcsv($file, $row); // Escreve os dados
            }
            
            fclose($file);
        }
        
        return $filepath;
    }

}
