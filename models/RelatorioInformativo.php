<?php

namespace app\models;


use Yii;


class RelatorioInformativo extends \yii\db\ActiveRecord  {

    public $nm_aluno;
    public $nm_profissional;
    public $tp_registro;
    public $nr_registro;
    public $descricao;

    public function rules() {
        return [
            [['nm_aluno'], 'required'],
            [['nm_aluno'], 'safe'],
            [['nm_aluno', 'nm_profissional', 'tp_registro', 'descricao'], 'string'],
            [['nr_registro'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
         
            'nm_aluno' => 'Aluno',
            'nm_profissional'=>'Profissional',
            'descricao' => 'Descrição',
            
           
        ];
    }
    
}



