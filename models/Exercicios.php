<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_exercicios".
 *
 * @property int $id
 * @property string $nm_exercicio
 * @property string $cd_subtipo_exercicio
 * @property string $cd_tipo_exercicio
 * @property int|null $id_especialidade
 *
 * @property TbEspecialidade $especialidade
 */
class Exercicios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_exercicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_exercicio', 'cd_tipo_exercicio', 'cd_subtipo_exercicio'], 'required'],
            [['id_especialidade'], 'integer'],
            [['nm_exercicio', 'cd_tipo_exercicio'], 'string', 'max' => 100],
            [['cd_subtipo_exercicio'], 'string', 'max' => 200],
            [['id_especialidade'], 'exist', 'skipOnError' => true, 'targetClass' => Especialidade::className(), 'targetAttribute' => ['id_especialidade' => 'id_especialidade']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm_exercicio' => 'Nome do exercício',
            'cd_tipo_exercicio' => 'Código do tipo do exercício',
            'cd_subtipo_exercicio' => 'Código do subtipo do exercício',
            'id_especialidade' => 'Especialidade',
        ];
    }

    /**
     * Gets query for [[Especialidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidade()
    {
        return $this->hasOne(Especialidade::className(), ['id_especialidade' => 'id_especialidade']);
    }
    
     public function getDataListEspecialidade() { // could be a static func as well

        $models = Especialidade::find()->asArray()->all();

        return ArrayHelper::map($models, 'id_especialidade', 'nm_especialidade');

    }
    
}
