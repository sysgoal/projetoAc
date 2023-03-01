<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use app\models\Aluno;
use app\models\Profissional;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;

use Yii;

/**
 * This is the model class for table "tb_horario_agenda".
 *
 * @property int $id
 * @property int|null $id_aluno
 * @property int|null $id_profissional
 * @property string $dt_inicio
 * @property string|null $dt_termino
 * @property string|null $tp_agendamento
 * @property string|null $ds_agendamento
 * @property string|null $ds_cor
 * @property string|null $fl_efetuado
 * @property string|null $hr_inicio
 * @property string|null $hr_fim
 * @property string|null $ds_descricao
 * @property string|null $ds_objetivo
 * @property string|null $nome
 * @property string|null $telefone
 * @property string|null $dt_modificacao
 * @property string|null $ds_usuario_modificacao
 * @property int|null $status
 * 
 * @property Aluno $aluno
 * @property Profissional $profissional
 */
class HorarioAgenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_horario_agenda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno', 'id_profissional', 'status'], 'integer'],
            [['dt_inicio', 'dt_termino','hr_inicio', 'hr_fim', 'dt_modificacao'], 'safe'],
            [['tp_agendamento', 'ds_cor'], 'string', 'max' => 100],
            [['ds_agendamento', 'nome', 'telefone', 'ds_usuario_modificacao'], 'string', 'max' => 200],
            [['ds_descricao', 'ds_objetivo'], 'string', 'max' => 600],
            [['fl_efetuado'], 'string', 'max' => 5],
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
            'dt_inicio' => 'Data do Agendamento',
            'dt_termino' => 'Data Término',
            'hr_inicio' => 'Horário início',
            'hr_fim' => 'Horário término',
            'tp_agendamento' => 'Tipo de Agendamento',
            'ds_agendamento' => 'Descrição Agendamento',
            'ds_cor' => 'Cor',
            'fl_efetuado' => 'Efetuado',
            'ds_descricao' => 'Descrição',
            'ds_objetivo' => 'Observação',
            'nome' => 'Nome',
            'telefone' => 'Telefone',
            'dt_modificacao' => 'Data da Modificação',
            'ds_usuario_modificacao' => 'Usuário da Modificação',
            'status' => 'Situação',
            
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
    
    public function getDataListAluno(){     
        $models = Aluno::find()->select(['id', 'nm_aluno'])->asArray()->orderBy('nm_aluno')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    
    }
    
      public function getDataListProfissional(){     
        return Profissional::find()->where(['ds_ativo'=>1])->orderBy('nm_profissional')->all();                
    
    }
    
    public function getProfissionalId($id){
        return Profissional::find()->select(['id_profissional', 'nm_profissional'])->where(['id_profissional' => $id])->one();
    }
    
      public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_inicio'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_inicio'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_inicio);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
        
            
        ];
    }

}
