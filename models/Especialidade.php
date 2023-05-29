<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_especialidade".
 *
 * @property int $id_especialidade
 * @property string $nm_especialidade
 * @property int $nr_tempo_duracao
 *
 * @property Turma[] $turmas
 */
class Especialidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_especialidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_especialidade', 'nr_tempo_duracao'], 'required'],
            [['nr_tempo_duracao',], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_especialidade' => 'Código da Especialidade',
            'nm_especialidade' => 'Nome Especialidade',
            'nr_tempo_duracao' => 'Tempo de Duração (minutos)',
        ];
    }

    /**
     * Gets query for [[TbTurmas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurmas()
    {
        return $this->hasMany(Turma::className(), ['id_especialidade' => 'id_especialidade']);
    }

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_especialidade_'.date('Y-m-d').'.csv';
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
