<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use DateTime;
use Yii;

/**
 * This is the model class for table "tb_avaliacao_infantil".
 *
 * @property int $id
 * @property int|null $id_aluno
 * @property date $data
 * @property string|null $idade
 * @property string|null $peso
 * @property string|null $altura
 * @property string|null $abdomem
 * @property string|null $flexao
 * @property string|null $postura
 * @property string|null $observacao
 *
 * @property TbAluno $aluno
 */
class AvaliacaoInfantil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_avaliacao_infantil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno'], 'integer'],
            [['data'], 'date', 'format' => 'dd/MM/yyyy'],
            [['peso', 'altura', 'abdomem', 'flexao', 'postura', 'idade'], 'string', 'max' => 100],
            [['observacao'], 'string', 'max' => 500],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código da Avaliação',
            'id_aluno' => 'Aluno',
            'data' => 'Data',
            'idade' => 'Idade',
            'peso' => 'Peso',
            'altura' => 'Altura',
            'abdomem' => 'Abdomem',
            'flexao' => 'Flexão',
            'postura' => 'Postura',
            'observacao' => 'Observação',
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
    
    
      public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['data'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['data'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->data);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['data'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->data, 'dd/MM/yyyy');
                }
            ],
        ];
    }
    
    public function getDataListAluno() { // could be a static func as well
        $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    }

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_avaliacao_infantil_'.date('Y-m-d').'.csv';
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
