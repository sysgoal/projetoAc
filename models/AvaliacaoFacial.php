<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "tb_avaliacao_facial".
 *
 * @property int $id
 * @property int $id_aluno
 * @property int $id_profissional
 * @property string|null $ds_medico_responsavel
 * @property string|null $ds_diagnostico
 * @property string|null $ds_queixa
 * @property string|null $ds_objetivo
 * @property string|null $ds_hma
 * @property string|null $ds_hp
 * @property string|null $ds_medicacao_uso
 * @property string|null $ds_face_comprometida
 * @property string|null $ds_mimicas_faciais
 * @property string|null $ds_observacao_mimicas
 * @property string $dt_avaliacao
 * @property string|null $ds_disfuncoes
 * @property string|null $ds_inspecao
 * @property Aluno $aluno
 * @property Profissional $profissional
 * @property string|null $situacao
 * @property string|null $ds_hp_hf_hs
 * @property string|null $ds_historia_molestia
 */
class AvaliacaoFacial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_avaliacao_facial';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno'], 'required'],
            [['id_aluno', 'id_profissional'], 'integer'],
            [['ds_hp_hf_hs', 'ds_patologias_associadas','ds_mimicas_faciais', 'ds_observacao_mimicas'], 'safe'],
              [['dt_avaliacao'], 'date', 'format' => 'dd/MM/yyyy'],
            [['ds_medico_responsavel', 'ds_inspecao', 'ds_diagnostico', 'ds_queixa', 'ds_objetivo', 'ds_hma', 'ds_hp', 'ds_medicacao_uso', 'ds_face_comprometida', 'ds_disfuncoes', 'situacao', 'ds_historia_molestia'], 'string', 'max' => 800],
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
            'id_aluno' => 'Paciente',
            'id_profissional' => 'Profissional',
            'ds_medico_responsavel' => 'Médico responsável',
            'ds_diagnostico' => 'Diagnóstico médico',
            'ds_queixa' => 'Queixa principal',
            'ds_objetivo' => 'Objetivos',
            'ds_hma' => 'HMA',
            'ds_hp' => 'HP',
            'ds_hp_hf_hs' => 'HP HF HS',
            'ds_medicacao_uso' => 'Medicação em uso',
            'ds_face_comprometida' => 'Face comprometida',
            'ds_mimicas_faciais' => 'Mímicas faciais comprometidas',
            'ds_observacao_mimicas' => 'Observação',
            'dt_avaliacao' => 'Data da avaliação',
            'ds_disfuncoes' => 'Disfunções',
            'ds_inspecao' => 'Inspeção',
            'situacao' => 'Situação',
            'ds_historia_molestia' => 'História da Moléstia Atual',
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

      public function getDadoUmAluno($idAluno) { // could be a static func as well
        $aluno = Aluno::findOne($idAluno);      
        return [$aluno->id => $aluno->nm_aluno];         
    }
    
        public function getAvaliador($id){
        //Yii::$app->user->identity->id
       return Profissional::findOne($id);
       
    }
    
    
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_avaliacao'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_avaliacao'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_avaliacao);                                        
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
                    
             [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_avaliacao'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->dt_avaliacao, 'dd/MM/yyyy');
                }
            ],
                    ];
     }

     public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_avaliacao_facil_'.date('Y-m-d').'.csv';
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
