<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\db\Query;

use Yii;

/**
 * This is the model class for table "tb_turma_aluno".
 *
 * @property int $id
 * @property int $id_aluno
 * @property int $id_turma
 *
 * @property TbAluno $aluno
 * @property TbTurma $turma
 */
class TurmaAluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_turma_aluno';
    }

    /**
     * {@inheritdoc}
     */
    public $nomes;
    public function rules()
    {
        return [
            [['id_aluno', 'id_turma'], 'required'],
            [['id_aluno', 'id_turma'], 'integer'],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_turma'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['id_turma' => 'id_turma']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código da turma/aluno',
            'id_aluno' => 'Aluno',
            'id_turma' => 'Turma',
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
     * Gets query for [[Turma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurma()
    {
        return $this->hasOne(Turma::className(), ['id_turma' => 'id_turma']);
    }
    
    public function getDataListAluno() { // could be a static func as well          
       $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();               
        array_unshift ($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');

    }
    
     public function getListNameAluno() { // could be a static func as well        
        $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();       
        return ArrayHelper::map($models, 'id', 'nm_aluno');

    }
    
    public function getTurmaById($id){         
        $turma = Turma::findOne(['id_turma' => $id]);
        return $turma;
    }
    
      public function getAlunoById($id){         
        $aluno = Aluno::findOne(['id' => $id]);
        return $aluno;
    }
    
    public function getDataListTurma() { // could be a static func as well          
        $models = Turma::find()->asArray()->distinct()->orderBy('hr_inicio')->all(); 
        array_unshift ($models, new Turma);
        return ArrayHelper::map($models, 'id_turma', 'nm_turma', 'hr_inicio');

    }
    
    public function getListNameTurma() { // could be a static func as well          
        $models = Turma::find()->asArray()->distinct()->orderBy('nm_turma')->all();        
        return ArrayHelper::map($models, 'id_turma', 'nm_turma');

    }
    
    public function getDadosTurma() { // could be a static func as well          
        $models = Turma::find()->asArray()->distinct()->orderBy('nm_turma')->all();        
        return $models;

    }
    
     public function getDataListTurmaTurno($nomeTurma) { 
         $turma = Turma::find(['nm_turma' => $nomeTurma])->distinct();               
        return ArrayHelper::map($turma, 'id_turma', 'ds_turno');
    }
    
    public function getDataListTurmaHorarios($nomeTurma, $turno) { 
         $turma = Turma::findAll(['nm_turma' => $nomeTurma, 'ds_turno' => $turno]);               
        return ArrayHelper::map($turma, 'id_turma', 'hr_inicio', 'hr_fim');
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

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_turmaaluno_'.date('Y-m-d').'.csv';
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
