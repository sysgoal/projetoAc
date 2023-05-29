<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tb_avaliacao_coluna".
 *
 * @property int $id
 * @property int $id_aluno
 * @property string $dt_avaliacao
 * @property string|null $cd_avaliacao
 * @property int $nr_tempo_servico
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
 * @property string|null $ds_movimentacao_ativa
 * @property string|null $ds_compressao
 * @property string|null $ds_observacao_compressao
 * @property string|null $ds_distracao
 * @property string|null $ds_observacao_distracao
 * @property string|null $ds_slump
 * @property string|null $ds_observacao_slump
 * @property string|null $ds_esfigmomanometro
 * @property string|null $ds_obs_esfigmomanometro
 * @property string|null $ds_gillet
 * @property string|null $ds_observacao_gillet
 * @property string|null $ds_mackenzie
 * @property string|null $ds_obs_mackenzie
 * @property string|null $ds_william
 * @property string|null $ds_obs_william
 * @property string|null $ds_subirdescer
 * @property string|null $ds_obs_subirdescer
 * @property string|null $ds_piriforme
 * @property string|null $ds_obs_piriforme
 * @property string|null $ds_exames_complementares
 * @property string|null $ds_conduta
 * @property int $id_profissional
 * @property string|null $situacao
 */
class AvaliacaoColuna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_avaliacao_coluna';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'cd_avaliacao', 'id_profissional'], 'required'],
            [['id_aluno', 'nr_tempo_servico', 'id_profissional'], 'integer'],
            [['dt_avaliacao'], 'date', 'format' => 'dd/MM/yyyy'],
            [[  'ds_dor', 'ds_cirurgia_internacao', 
                'ds_fisioterapia_quando', 'ds_locomocao', 'ds_compressao', 'ds_distracao', 
                'ds_slump', 'ds_esfigmomanometro', 'ds_gillet', 'ds_mackenzie', 'ds_william', 
                'ds_subirdescer', 'ds_piriforme', 'situacao'], 'string'],
            [['ds_diagnostico_medico', 'ds_medico_responsavel', 'ds_queixa_atual', 'ds_disfuncao_avds',
                'ds_hma', 'ds_localizacao', 'ds_medicamento_uso', 'ds_avaliacao_postural', 
                'ds_movimentacao_ativa', 'ds_observacao_compressao', 'ds_observacao_distracao', 
                'ds_observacao_slump', 'ds_obs_esfigmomanometro', 'ds_observacao_gillet', 'ds_obs_mackenzie',
                'ds_obs_william', 'ds_obs_subirdescer', 'ds_obs_piriforme', 'ds_exames_complementares',
                'ds_conduta','cd_avaliacao'], 'string'],
            [['ds_frequencia_dor'], 'string', 'max' => 20],
            [['ds_patologia_associada', 'ds_hp_hf_hs', 'ds_caracteristica_dor'],  'safe'],
            
        ];
    }
    public $ds_caracteristica_dor_fake;
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
            'ds_convenio' => 'Convênio',
            'nr_tempo_servico' => 'Tempo de trabalho em horas',
            'ds_cuidador' => 'Cuidador',
            'ds_parentesco' => 'Parentesco',
            'ds_diagnostico_medico' => 'Diagnóstico Médico',
            'ds_medico_responsavel' => 'Médico responsável',
            'ds_queixa_atual' => 'Queixa atual',
            'ds_disfuncao_avds' => 'Disfunção Avds',
            'ds_hma' => 'HMA',
            'ds_dor' => 'Dor',
            'ds_localizacao' => 'Localização\irradiação da dor',
            'ds_frequencia_dor' => 'Frequência da dor',
            'ds_caracteristica_dor' => 'Característica da dor',
            'ds_caracteristica_dor_fake' => 'Característica da dor',
            'ds_patologia_associada' => 'Patologias associadas',
            'ds_medicamento_uso' => 'Medicamentos em uso',
            'ds_hp_hf_hs' => 'HP, HF, HS',
            'ds_cirurgia_internacao' => 'Cirurgias/internações (quando)',
            'ds_fisioterapia_quando' => 'Já realizou fisioterapia (quando)',
            'ds_locomocao' => 'Locomoção',
            'ds_avaliacao_postural' => 'Avaliação postural',
            'ds_movimentacao_ativa' => 'Movimentação ativa e passiva/Avaliação de força',
            'ds_compressao' => 'Spurling (compressão)',
            'ds_observacao_compressao' => 'Observação compressão',
            'ds_distracao' => 'Distração',
            'ds_observacao_distracao' => 'Observação Distração',
            'ds_slump' => 'Slump',
            'ds_observacao_slump' => 'Observação Slump',
            'ds_esfigmomanometro' => 'Teste do Esfigmomanômetro',
            'ds_obs_esfigmomanometro' => 'Observação Esfigmomanômetro',
            'ds_gillet' => 'Gillet',
            'ds_observacao_gillet' => 'Observação Gillet',
            'ds_mackenzie' => 'Mackenzie',
            'ds_obs_mackenzie' => 'Observação Mackenzie',
            'ds_william' => 'William',
            'ds_obs_william' => 'Observação William',
            'ds_subirdescer' => 'Subir e descer escada /Trndelemburg ',
            'ds_obs_subirdescer' => 'Observação Trndelemburg',
            'ds_piriforme' => 'Teste do piriforme',
            'ds_obs_piriforme' => 'Observação Piriforme',
            'ds_exames_complementares' => 'Exames complementares',
            'ds_conduta' => 'Conduta Inicial',
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
        $filename = 'backup_avaliacao_coluna_'.date('Y-m-d').'.csv';
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
