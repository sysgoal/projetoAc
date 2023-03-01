<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use DateTime;

use Yii;

/**
 * This is the model class for table "tb_turma".
 *
 * @property int $id_turma
 * @property string $nm_turma
 * @property string $ds_turno
 * @property int $nr_vagas
 * @property string $hr_inicio
 * @property string $hr_fim
 * @property string $dt_inicio
 * @property string $dt_fim
 * @property int $id_profissional
 * @property int $id_profissional2
 * @property int $id_especialidade
 *
 * @property TbEspecialidade $especialidade
 * @property TbProfissional $profissional
 */
class Turma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_turma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_turma', 'ds_turno', 'nr_vagas', 'hr_inicio', 'hr_fim','id_profissional', 'id_especialidade'], 'required'],
            [['nr_vagas', 'id_profissional', 'id_profissional2','id_especialidade'], 'integer'],
            [['hr_inicio', 'hr_fim'], 'safe'],
            [['nm_turma'], 'string', 'max' => 200],
            [['ds_turno'], 'string', 'max' => 100],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id_especialidade']],
            [['id_profissional'], 'exist', 'skipOnError' => true, 'targetClass' => Profissional::className(), 'targetAttribute' => ['id_profissional' => 'id_profissional']],
            [['id_profissional2'], 'exist', 'skipOnError' => true, 'targetClass' => Profissional::className(), 'targetAttribute' => ['id_profissional2' => 'id_profissional']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_turma' => 'Código da Turma',
            'nm_turma' => 'Nome da Turma',
            'ds_turno' => 'Turno',
            'nr_vagas' => 'Número de Vagas',
            'hr_inicio' => 'Horário Inicio',
            'hr_fim' => 'Horário Fim',
            'dt_inicio' => 'Data Inicio',
            'dt_fim' => 'Data Fim',
            'id_profissional' => 'Profissional',
            'id_profissional2' => 'Profissional 2',
            'id_especialidade' => 'Especialidade',
        ];
    }

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery|TbEspecialidadeQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::className(), ['id_especialidade' => 'id_especialidade']);
    }

   public function getDataListTurma() { // could be a static func as well          
        $models = Turma::find()->asArray()->distinct()->orderBy('hr_inicio')->all(); 
        array_unshift ($models, new Turma);
        return ArrayHelper::map($models, 'id_turma', 'nm_turma', 'hr_inicio');

    }
     /**
     * Gets query for [[Profissional]].
     *
     * @return \yii\db\ActiveQuery|TbProfissionalQuery
     */
    public function getProfissional()
    {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }
    
      public function getProfissional2()
    {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional2']);
    }

    /**
     * {@inheritdoc}
     * @return TurmaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TurmaQuery(get_called_class());
    }
    
     
    public function getDataListEspecialidade() { // could be a static func as well

        $models = Especialidade::find()->asArray()->all();

        return ArrayHelper::map($models, 'id_especialidade', 'nm_especialidade');

    }

    public function getDataListProfissional() { // could be a static func as well

        $models = Profissional::find()->where(['ds_ativo' => 1])->asArray()->all();
        array_unshift($models, new Profissional);
        return ArrayHelper::map($models, 'id_profissional', 'nm_profissional');

    }
    
    public function getDataListTurmaAlunos($idTurma) {
        $turma = TurmaAluno::find(['id_turma' => $idTurma])
                        ->leftJoin('tb_aluno', 'tb_aluno.id=tb_turma_aluno.id_aluno')->orderBy(['tb_aluno.nm_aluno' => SORT_ASC])
                        ->where(['=', 'id_turma', $idTurma])->all();
        // return ArrayHelper::map($turma, 'id_aluno', 'nm_aluno');
        return $turma;
    }
        public function getConduta($idAluno){        
        $conduta = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao DESC')->limit(1)->one();
        return $conduta;
    }
}


