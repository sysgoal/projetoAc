<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_convenio".
 *
 * @property int $id_convenio
 * @property int $nr_registro_ans
 * @property int $cd_operadora
 * @property string $vs_tiss
 * @property string $ds_nome
 * @property float $tb_preco
 */
class Convenio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_convenio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nr_registro_ans', 'cd_operadora', 'vs_tiss', 'ds_nome', 'tb_preco'], 'required'],
            [['nr_registro_ans', 'cd_operadora'], 'integer'],
            [['tb_preco'], 'number'],
            [['vs_tiss'], 'string', 'max' => 100],
            [['ds_nome'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código Convênio',
            'ds_nome' => 'Nome',
            'nr_registro_ans' => 'Nº Registro ANS',
            'cd_operadora' => 'Código na Operadora',
            'vs_tiss' => 'Versão do TISS',
            'tb_preco' => 'Tabela de Preços',
        ];
    }

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_convenio_'.date('Y-m-d').'.csv';
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
