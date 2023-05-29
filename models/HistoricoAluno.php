<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_historico_aluno".
 *
 * @property int $id
 * @property int $id_aluno
 * @property string|null $dt_patologia
 * @property string|null $ds_patologia
 * @property string|null $dt_cirurgia
 * @property string|null $ds_cirugia
 * @property string|null $dt_medicamento
 * @property string|null $ds_medicamento
 * @property string|null $dt_conduta
 * @property string|null $ds_conduta
 *
 * @property TbBoAvalBioHofiNatHist[] $tbBoAvalBioHofiNatHists
 * @property TbAluno $aluno
 */
class HistoricoAluno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_historico_aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aluno'], 'required'],
            [['id_aluno'], 'integer'],
            [['dt_patologia', 'dt_cirurgia', 'dt_medicamento', 'dt_conduta'], 'safe'],
            [['ds_patologia', 'ds_cirugia', 'ds_medicamento', 'ds_conduta'], 'string', 'max' => 200],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_aluno' => 'Id Aluno',
            'dt_patologia' => 'Dt Patologia',
            'ds_patologia' => 'Ds Patologia',
            'dt_cirurgia' => 'Dt Cirurgia',
            'ds_cirugia' => 'Ds Cirugia',
            'dt_medicamento' => 'Dt Medicamento',
            'ds_medicamento' => 'Ds Medicamento',
            'dt_conduta' => 'Dt Conduta',
            'ds_conduta' => 'Ds Conduta',
        ];
    }

    /**
     * Gets query for [[TbBoAvalBioHofiNatHists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoAvalBioHofiNatHists()
    {
        return $this->hasMany(BoAvalBioHofiNatHist::className(), ['id_historico' => 'id']);
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

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_historico_alunos_'.date('Y-m-d').'.csv';
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
