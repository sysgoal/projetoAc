<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "tb_avaliacao_vestibular".
 *
 * @property int $id
 * @property int $id_aluno
 * @property int $id_profissional
 * @property string $dt_avaliacao
 * @property string|null $ds_diagnostico
 * @property string|null $ds_medico_responsavel
 * @property string|null $ds_queixa_atual
 * @property string|null $ds_disfuncao_avds
 * @property string|null $ds_hma
 * @property string|null $ds_dor
 * @property string|null $ds_localizacao_dor
 * @property string|null $ds_frequencia_dor
 * @property string|null $ds_patologias_associadas
 * @property string|null $ds_medicamento_uso
 * @property string|null $ds_hp_hf_hs
 * @property string|null $ds_cirurgias
 * @property string|null $ds_unipodal_olhos_abertos
 * @property string|null $ds_unipodal_olhos_fechados
 * @property string|null $ds_apoio_mid
 * @property string|null $ds_apoio_mie
 * @property string|null $ds_index_nariz
 * @property string|null $ds_pammhg_deitado
 * @property string|null $ds_pammhg_sentado
 * @property string|null $ds_basiliar
 * @property string|null $ds_exames
 * @property string|null $ds_conduta
 * @property string|null $situacao
 *
 * @property TbAluno $aluno
 * @property TbProfissional $profissional
 */
class AvaliacaoVestibular extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_avaliacao_vestibular';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'id_profissional'], 'required'],
            [['id_aluno', 'id_profissional'], 'integer'],
            [['ds_hp_hf_hs', 'ds_patologias_associadas', ], 'safe'],
              [['dt_avaliacao'], 'date', 'format' => 'dd/MM/yyyy'],
            [['ds_unipodal_olhos_abertos', 'ds_unipodal_olhos_fechados', 'ds_apoio_mid', 'ds_apoio_mie', 'ds_index_nariz', 'ds_pammhg_deitado', 'ds_pammhg_sentado', 'ds_basiliar',  'situacao'], 'string', 'max' => 400],
            [['ds_exames', 'ds_conduta','ds_cirurgias', 'ds_disfuncao_avds', 'ds_hma', 'ds_localizacao_dor', 'ds_frequencia_dor',  'ds_medicamento_uso', 'ds_diagnostico', 'ds_medico_responsavel', 'ds_queixa_atual', 'ds_dor'], 'string', 'max' => 800],
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
            'id_aluno' => 'Aluno',
            'id_profissional' => 'Profissional',
            'dt_avaliacao' => 'Data da avaliação',
            'ds_diagnostico' => 'Diagnóstico médico',
            'ds_medico_responsavel' => 'Médico responsável',
            'ds_queixa_atual' => 'Queixa Atual',
            'ds_disfuncao_avds' => 'Disfunção Avd\'s',
            'ds_hma' => 'HMA',
            'ds_dor' => 'Possui dor?',
            'ds_localizacao_dor' => 'Localização da dor',
            'ds_frequencia_dor' => 'Frequência da dor',
            'ds_patologias_associadas' => 'Patologias Associadas',
            'ds_medicamento_uso' => 'Medicamentos em uso',
            'ds_hp_hf_hs' => 'HP HF HS',
            'ds_cirurgias' => 'Cirurgia/Internação(Quando)',
            'ds_unipodal_olhos_abertos' => 'Apoio MID - Olhos fechados',
            'ds_unipodal_olhos_fechados' => 'Apoio MIE - Olhos fechados',
            'ds_apoio_mid' => 'Apoio MID - Olhos abertos',
            'ds_apoio_mie' => 'Apoio MIE - Olhos abertos' ,
            'ds_index_nariz' => 'Index Nariz',
            'ds_pammhg_deitado' => 'PAMMHG Deitado',
            'ds_pammhg_sentado' => 'PAMMHG Sentado',
            'ds_basiliar' => 'Teste Arterio Basiliar',
            'ds_exames' => 'Exames',
            'ds_conduta' => 'Conduta',
            'situacao' => 'Situação',
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
   
}
