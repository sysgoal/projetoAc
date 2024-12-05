<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tb_avaliacao_superior".
 *
 * @property int $id
 * @property int $id_aluno
 
 * @property string $dt_avaliacao
 * @property string|null $cd_avaliacao
 * @property string $ds_atividade_laboral
 * @property string|null $nr_tempo_servico 
 * @property string|null $ds_diagnostico_medico
 * @property string|null $ds_medico_responsavel
 * @property string|null $ds_queixa_atual
 * @property string|null $ds_disfuncao_avds
 * @property string|null $ds_hma
 * @property string|null $ds_dor
 * @property string|null $ds_localizacao
 * @property string|null $ds_frequencia_dor
 * @property string|null $ds_caracteristica_dor
 * @property string|null $ds_patologia_associada
 * @property string|null $ds_medicamento_uso
 * @property string|null $ds_hp_hf_hs
 * @property string|null $ds_cirurgia_internacao
 * @property string|null $ds_fisioterapia_quando
 * @property string|null $ds_locomocao
 * @property string|null $ds_avaliacao_postural
 * @property string|null $ds_reu
 * @property string|null $ds_movimentacao_ativa
 * @property string|null $ds_phalen
 * @property string|null $ds_observacao_phalen
 * @property string|null $ds_phalen_invertido
 * @property string|null $ds_obs_phalen_invertido
 * @property string|null $ds_de_quervain
 * @property string|null $ds_obs_de_quervain
 * @property string|null $ds_ultt
 * @property string|null $ds_observacao_ultt
 * @property string|null $ds_estresse_valgo
 * @property string|null $ds_obs_estresse_valgo
 * @property string|null $ds_estresse_varo
 * @property string|null $ds_obs_estresse_varo
 * @property string|null $ds_resistencia_flexao
 * @property string|null $ds_obs_resistencia_flexao
 * @property string|null $ds_resistencia_extensao
 * @property string|null $ds_obs_resistencia_extensao
 * @property string|null $ds_subescapular
 * @property string|null $ds_obs_subescapular
 * @property string|null $ds_supraespinhal
 * @property string|null $ds_obs_supraespinhal
 * @property string|null $ds_infraespinhal
 * @property string|null $ds_obs_infraespinhal
 * @property string|null $ds_redondo_menor
 * @property string|null $ds_obs_redondo_menor
 * @property string|null $ds_biceps
 * @property string|null $ds_obs_biceps
 * @property string|null $ds_end_feel
 * @property string|null $ds_obs_end_feel
 * @property string|null $ds_exames_complementares
 * @property string|null $ds_conduta
 * @property int $id_profissional
 * @property string|null $situacao
 */
class AvaliacaoSuperior extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_avaliacao_superior';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'cd_avaliacao', 'id_profissional'], 'required'],
              [['dt_avaliacao'], 'date', 'format' => 'dd/MM/yyyy'],
            [['id_aluno', 'id_profissional'], 'integer'],
            [['ds_atividade_laboral',                 
                'ds_cirurgia_internacao', 'ds_fisioterapia_quando', 'ds_locomocao', 
                'ds_phalen', 'ds_phalen_invertido', 'ds_de_quervain', 'ds_ultt', 
                'ds_estresse_valgo', 'ds_estresse_varo', 'ds_resistencia_flexao', 
                'ds_resistencia_extensao', 'ds_subescapular', 'ds_supraespinhal', 'ds_infraespinhal', 
                'ds_redondo_menor', 'ds_biceps', 'ds_end_feel','cd_avaliacao',], 'string', 'max' => 100],
            [[ 'ds_disfuncao_avds', 
                'ds_hma',  'ds_observacao_phalen', 'ds_obs_phalen_invertido', 
                 'situacao'], 'string', 'max' => 800],
                 [['ds_movimentacao_ativa'], 'string', 'max'=>8000] , 
            [['ds_obs_de_quervain', 'ds_observacao_ultt', 'ds_obs_estresse_valgo', 'ds_obs_estresse_varo',
                'ds_obs_resistencia_flexao', 'ds_obs_resistencia_extensao', 'ds_obs_subescapular', 
                'ds_obs_supraespinhal', 'ds_obs_infraespinhal', 'ds_obs_redondo_menor', 'ds_obs_biceps', 
                'ds_obs_end_feel', 'ds_conduta','ds_dor', 'ds_localizacao', 'ds_medicamento_uso', 'ds_avaliacao_postural', 'ds_diagnostico_medico', 'ds_medico_responsavel', 'ds_queixa_atual','ds_exames_complementares',
                ], 'string', 'max' => 500],
            [['ds_frequencia_dor', 'ds_reu'], 'string', 'max' => 20],
            [['nr_tempo_servico','ds_patologia_associada', 'ds_hp_hf_hs', 'ds_caracteristica_dor'],  'safe'],
          
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
           
            'dt_avaliacao' => 'Data da avaliação',
            'cd_avaliacao' => 'Código da patologia',
            'ds_atividade_laboral' => 'Atividade Laboral',
            'nr_tempo_servico' => 'Tempo de serviço de trabalho',
           
          
            'ds_diagnostico_medico' => 'Diagnóstico Médico',
            'ds_medico_responsavel' => 'Médico responsável',
            'ds_queixa_atual' => 'Queixa atual',
            'ds_disfuncao_avds' => 'Disfunção Avds',
            'ds_hma' => 'HMA',
            'ds_dor' => 'Dor',
            'ds_localizacao' => 'Localização\irradiação da dor',
            'ds_frequencia_dor' => 'Frequência da dor',
            'ds_caracteristica_dor' => 'Característica da dor',
            'ds_patologia_associada' => 'Patologias associadas',
            'ds_medicamento_uso' => 'Medicamentos em uso',
            'ds_hp_hf_hs' => 'HP, HF, HS',
            'ds_cirurgia_internacao' => 'Cirurgias/internações (quando)',
            'ds_fisioterapia_quando' => 'Já realizou fisioterapia (quando)',
            'ds_locomocao' => 'Locomoção',
            'ds_avaliacao_postural' => 'Avaliação postural',
            'ds_reu' => 'REU',
            'ds_movimentacao_ativa' => 'Movimentação ativa e passiva/Avaliação de força',
            'ds_phalen' => 'Phalen',
            'ds_observacao_phalen' => 'Obervação phalen',
            'ds_phalen_invertido' => 'Phalen invertido',
            'ds_obs_phalen_invertido' => 'Obervação phalen invertido',
            'ds_de_quervain' => 'De Quervain',
            'ds_obs_de_quervain' => 'Obervação De Quervain',
            'ds_ultt' => 'ULTT',
            'ds_observacao_ultt' => 'Obervação ULTT',
            'ds_estresse_valgo' => 'Estresse em valgo',
            'ds_obs_estresse_valgo' => 'Obervação estresse em valgo',
            'ds_estresse_varo' => 'Estresse em varo',
            'ds_obs_estresse_varo' => 'Obervação estresse em varo',
            'ds_resistencia_flexao' => 'Resistência em flexão',
            'ds_obs_resistencia_flexao' => 'Obervação resistência em flexão',
            'ds_resistencia_extensao' => 'Resistência em extensao',
            'ds_obs_resistencia_extensao' => 'Obervação resistência em extensão',
            'ds_subescapular' => 'Guerber (subescapular)',
            'ds_obs_subescapular' => 'Obervação subescapular',
            'ds_supraespinhal' => 'Jober (supraespinhal)',
            'ds_obs_supraespinhal' => 'Obervação supraespinhal',
            'ds_infraespinhal' => 'Patte (infraespinhal)',
            'ds_obs_infraespinhal' => 'Obervação infraespinhal',
            'ds_redondo_menor' => 'Redondo menor',
            'ds_obs_redondo_menor' => 'Obervação redondo menor',
            'ds_biceps' => 'Speed (biceps)',
            'ds_obs_biceps' => 'Obervação biceps',
            'ds_end_feel' => 'End feel',
            'ds_obs_end_feel' => 'Obervação end feel',
            'ds_exames_complementares' => 'Exames Complementares',
            'ds_conduta' => 'Conduta',
            'id_profissional' => 'Profissional',
            'situacao' => 'Situação',
        ];
    }
    
 public function getAluno()
    {
        return $this->hasOne(Aluno::className(), ['id' => 'id_aluno']);
    }
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
        $filename = 'backup_avaliacao_superior_'.date('Y-m-d').'.csv';
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

