<?php

namespace app\models;


use Yii;

class Declaracao extends \yii\db\ActiveRecord  {

    public $horainicio;
    public $horafim;
    public $data;
    public $nm_aluno;
    public $nm_profissional;
    public $tp_registro;
    public $nr_registro;

    public function rules() {
        return [
            [['horainicio', 'horafim', 'data'], 'required'],
            [['horainicio', 'horafim', 'data'], 'safe'],
            [['nm_aluno', 'nm_profissional', 'tp_registro'], 'string'],
            [['nr_registro'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'horainicio' => 'Hora início',
            'horafim' => 'Hora fim',
            'data' => 'Data',
            'nm_aluno' => 'Aluno',
            'nm_profissional' => 'Profissional',
            'nr_registro' => 'Registro ',
            'tp_registro' => 'Tipo Registro',
        ];
    }
    
}



