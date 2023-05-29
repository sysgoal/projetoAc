<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use DateTime;
use Yii;

/**
 * This is the model class for table "tb_boletim_infantil".
 *
 * @property int $id
 * @property string|null $ds_cor_touca
 * @property string $ds_atv1
 * @property string $ds_atv2
 * @property string $ds_atv3
 * @property string $ds_atv4
 * @property string $ds_atv5
 * @property string $peixe1
 * @property string $peixe2
 * @property string $peixe3
 * @property string $peixe4
 * @property string $peixe5
 * @property string $caixa1
 * @property string $caixa2
 * @property string $caixa3
 * @property string $caixa4
 * @property string $caixa5
 * @property date $data
 * @property int|null $id_aluno
 * @property int|null $id_profissional
 *
 * @property TbAluno $aluno
 */
class BoletimInfantil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_boletim_infantil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_profissional','id_aluno', 'ds_cor_touca'], 'required'],
            [['data'], 'date', 'format' => 'dd/MM/yyyy'],
            [['id_aluno', 'id_profissional'], 'integer'],
            [['ds_cor_touca'], 'string', 'max' => 15],
            [['ds_atv1', 'ds_atv2', 'ds_atv3', 'ds_atv4', 'ds_atv5'], 'string', 'max' => 50],
            [['peixe1', 'peixe2', 'peixe3', 'peixe4', 'peixe5'], 'string', 'max' => 20],
            [['caixa1', 'caixa2', 'caixa3', 'caixa4', 'caixa5'], 'string', 'max' => 30],
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
            'id' => 'Código',
            'ds_cor_touca' => 'Cor da Touca',
            'ds_atv1' => 'Atividade 1',
            'ds_atv2' => 'Atividade 2',
            'ds_atv3' => 'Atividade 3',
            'ds_atv4' => 'Atividade 4',
            'ds_atv5' => 'Atividade5',
            'peixe1' => 'Cor do peixinho ',
            'peixe2' => 'Cor do peixinho',
            'peixe3' => 'Cor do peixinho',
            'peixe4' => 'Cor do peixinho',
            'peixe5' => 'Cor do peixinho',
            'caixa1' => 'Resultado do teste ',
            'caixa2' => 'Resultado do teste',
            'caixa3' => 'Resultado do teste',
            'caixa4' => 'Resultado do teste',
            'caixa5' => 'Resultado do teste ',
            'data' => 'Data',
            'id_aluno' => 'Aluno',
            'id_profissional' => 'Professor',
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
    
    public function getProfissional() {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }
    
    public function getAlunoComBoletim() { // could be a static func as well
        $models = BoletimInfantil::find()->asArray()->groupBy('id_aluno')->orderBy('data')->all();
       // array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id_aluno', 'nm_aluno');
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
    
       public function getCorTouca() {
        $lista =  $cor = ['Selecione' => 'Selecione',
                          'Azul' => 'Azul', 'Amarela' => 'Amarela', 
                          'Verde' => 'Verde', 'Branca' => 'Branca',
                          'Cinza' => 'Cinza', 'Preta' => 'Preta', 
                          'Polimento' => 'Polimento' ];
        return $lista;
    }
     public function getDataListProfissional() { // could be a static func as well
        $models = Profissional::find()->asArray()->all();
        array_unshift($models, new Profissional);
        return ArrayHelper::map($models, 'id_profissional', 'nm_profissional');
    }  

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_boletim_infantil_'.date('Y-m-d').'.csv';
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
