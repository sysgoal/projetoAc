<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tb_avaliacao_inferior".
 *
 * @property int $id
 * @property int $id_aluno 
 * @property string $dt_avaliacao
 * @property string $cd_avaliacao
 
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
 * @property string|null $ds_trendelenburg
 * @property string|null $ds_obs_trendelenburg
 * @property string|null $ds_patrick
 * @property string|null $ds_obs_patrick
 * @property string|null $ds_gillet
 * @property string|null $ds_obs_gillet
 * @property string|null $ds_ober
 * @property string|null $ds_obs_ober
 * @property string|null $ds_teste_rigidez_quadril
 * @property string|null $ds_obs_teste_rigidez_quadril
 * @property string|null $ds_teste_apley
 * @property string|null $ds_obs_teste_apley
 * @property string|null $ds_gaveta_anterior
 * @property string|null $ds_obs_gaveta_anterior
 * @property string|null $ds_gaveta_posterior
 * @property string|null $ds_obs_gaveta_posterior
 * @property string|null $ds_teste_clarke
 * @property string|null $ds_obs_teste_clarke
 * @property string|null $ds_estresse_valgo
 * @property string|null $ds_obs_estresse_valgo
 * @property string|null $ds_estresse_varo
 * @property string|null $ds_obs_estresse_varo
 * @property string|null $ds_teste_thompson
 * @property string|null $ds_obs_teste_thompson
 * @property string|null $ds_adm_dorsiflexao
 * @property string|null $ds_obs_adm_dorsiflexao
 * @property string|null $ds_exames_complementares
 * @property string|null $ds_conduta
 * @property int $id_profissional
 * @property string|null $situacao
 */
class AvaliacaoInferior extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public static function tableName()
    {
        return 'tb_avaliacao_inferior';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'cd_avaliacao', 'id_profissional'], 'required'],
            [['id_aluno', 'nr_tempo_servico', 'id_profissional'], 'integer'],
            [['ds_hp_hf_hs', 'ds_patologia_associada', 'ds_caracteristica_dor'], 'safe'],
            [['dt_avaliacao'], 'date', 'format' => 'dd/MM/yyyy'],
            [['cd_avaliacao', 'ds_cirurgia_internacao', 
                'ds_fisioterapia_quando', 'ds_trendelenburg', 'ds_patrick', 'ds_gillet',
                'ds_ober', 'ds_teste_rigidez_quadril', 'ds_teste_apley', 'ds_gaveta_anterior', 'ds_gaveta_posterior', 
                'ds_teste_clarke', 'ds_estresse_valgo', 'ds_estresse_varo', 'ds_teste_thompson', 
                'ds_adm_dorsiflexao'], 'string', 'max' => 100],
            [[  'ds_disfuncao_avds',], 'string', 'max' => 200],
            [['ds_diagnostico_medico', 'ds_medico_responsavel', 'ds_queixa_atual', 
               'ds_dor', 'ds_localizacao', 'ds_medicamento_uso',
                'ds_avaliacao_postural', 'ds_movimentacao_ativa', 'ds_obs_trendelenburg', 'ds_obs_patrick',
                'ds_obs_gillet', 'ds_obs_ober', 'ds_obs_teste_rigidez_quadril', 'ds_obs_teste_apley',
                'ds_obs_gaveta_anterior', 'ds_obs_gaveta_posterior', 'ds_obs_teste_clarke', 'ds_obs_estresse_valgo', 
                'ds_obs_estresse_varo', 'ds_obs_teste_thompson', 'ds_obs_adm_dorsiflexao', 
                'ds_exames_complementares', 'ds_conduta','ds_locomocao', 'ds_hma'], 'string', 'max' => 800],
            [['ds_frequencia_dor', 'situacao'], 'string', 'max' => 20],          
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
          
            'nr_tempo_servico' => 'Tempo de serviço de trabalho',           
            
            'ds_diagnostico_medico' => 'Diagnóstico médico',
            'ds_medico_responsavel' => 'Médico responsável',
            'ds_queixa_atual' => 'Queixa atual',
            'ds_disfuncao_avds' => 'Disfunção Avds',
            'ds_hma' => 'HMA',
            'ds_dor' => 'Dor',
            'ds_localizacao' => 'Localização\irradiação da dor',
            'ds_frequencia_dor' => 'Frequência dor',
            'ds_caracteristica_dor' => 'Característica da dor',
            'ds_patologia_associada' => 'Patologias associadas',
            'ds_medicamento_uso' => 'Medicamentos em uso',
            'ds_hp_hf_hs' => 'HP, HF, HS',
            'ds_cirurgia_internacao' => 'Cirurgias/internações (quando)',
            'ds_fisioterapia_quando' => 'Já realizou fisioterapia (quando)',
            'ds_locomocao' => 'Locomoção',
            'ds_avaliacao_postural' => 'Avaliação postural',
            'ds_movimentacao_ativa' => 'Movimentação ativa e passiva/Avaliação de força',
            'ds_trendelenburg' => 'Trendelenburg',
            'ds_obs_trendelenburg' => 'Obervação trendelenburg',
            'ds_patrick' => 'Patrick',
            'ds_obs_patrick' => 'Obervação patrick',
            'ds_gillet' => 'Gillet',
            'ds_obs_gillet' => 'Obervação gillet',
            'ds_ober' => 'Ober',
            'ds_obs_ober' => 'Obervação ober',
            'ds_teste_rigidez_quadril' => 'Teste rigidez quadril',
            'ds_obs_teste_rigidez_quadril' => 'Obervação teste rigidez quadril',
            'ds_teste_apley' => 'Teste apley',
            'ds_obs_teste_apley' => 'Obervação teste apley',
            'ds_gaveta_anterior' => 'Gaveta anterior',
            'ds_obs_gaveta_anterior' => 'Obervação gaveta anterior',
            'ds_gaveta_posterior' => 'Gaveta posterior',
            'ds_obs_gaveta_posterior' => 'Obervação gaveta posterior',
            'ds_teste_clarke' => 'Teste clarke',
            'ds_obs_teste_clarke' => 'Obervação teste clarke',
            'ds_estresse_valgo' => 'Estresse em valgo',
            'ds_obs_estresse_valgo' => 'Obervação estresse em valgo',
            'ds_estresse_varo' => 'Estresse em varo',
            'ds_obs_estresse_varo' => 'Obervação estresse em varo',
            'ds_teste_thompson' => 'Teste thompson',
            'ds_obs_teste_thompson' => 'Obervação teste thompson',
            'ds_adm_dorsiflexao' => 'ADM de dorsiflexao',
            'ds_obs_adm_dorsiflexao' => 'Obervação ADM de dorsiflexao',
            'ds_exames_complementares' => 'Exames complementares',
            'ds_conduta' => 'Conduta inicial',
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
        $filename = 'backup_avaliacao_inferior_'.date('Y-m-d').'.csv';
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

