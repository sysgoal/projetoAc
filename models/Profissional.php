<?php

namespace app\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use DateTime;
use Yii;

/**
 * This is the model class for table "tb_profissional".
 *
 * @property int $id_profissional
 * @property string $nm_profissional
 * @property string $tp_registro
 * @property int $nr_registro
 * @property int $nr_registro
 * @property string $ds_estado
 * @property string $ds_cidade
 * @property string $ds_endereco
 * @property string $ds_bairro
 * @property string $ds_cep
 * @property string $ds_complemento
 * @property string $dt_nascimento
 * @property int $nr_whatsapp
 * @property int $nr_telefone
 * @property date $dt_cadastro
 * @property date $ds_cpf
 * @property date $ds_ativo
 * 
 * @property TbEspecialidadeProfissional[] $tbEspecialidadeProfissionals
 */
class Profissional extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_profissional';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nr_registro','nm_profissional', 'tp_registro', 'ds_cpf', 'ds_estado', 'ds_cidade', 'ds_endereco', 'ds_cep'], 'required'],
            [[ 'ds_ativo'], 'integer'],
            [['ds_cpf'], 'string', 'max' => 11],
            [['ds_cidade', 'ds_endereco'], 'string', 'max' => 200],
            [['dt_nascimento', 'dt_cadastro'], 'date', 'format' => 'dd/MM/yyyy'],
            [['nm_profissional'], 'string', 'max' => 200],
            [['tp_registro'], 'string', 'max' => 100],
            [['ds_estado'], 'string', 'max' => 2],
            [['ds_bairro'], 'string'],
            [['ds_complemento'], 'string'],
            [['ds_cep'], 'string', 'max' => 10],
            [['nr_telefone'], 'string', 'max' => 15],
            [['nr_whatsapp'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_profissional' => 'Código do Profissional',
            'nm_profissional' => 'Nome do Profissional',
            'tp_registro' => 'Tipo de Registro',
            'nr_registro' => 'Número do Registro',
            'ds_cpf' => 'Cpf',
            'dt_nascimento' => 'Data de Nascimento',
            'ds_endereco' => 'Endereço',
            'ds_cep' => 'Cep',
            'ds_complemento' => 'Complemento',
            'ds_bairro' => 'Bairro',
            'ds_estado' => 'Estado',
            'ds_cidade' => 'Cidade',
            'nr_whatsapp' => 'Whatsapp',
            'nr_telefone' => 'Telefone Fixo',
            'dt_cadastro' => 'Data de Registro',
            'ds_ativo' => 'Ativo',
        ];
    }

    public function getEstados() {
        return $estados = ['MG' => 'MG',
            'AC' => 'AC',
            'AL' => 'AL',
            'AM' => 'AM',
            'AP' => 'AP',
            'BA' => 'BA',
            'CE' => 'CE',
            'DF' => 'DF',
            'ES' => 'ES',
            'GO' => 'GO',
            'MA' => 'MA',
            'MT' => 'MT',
            'MS' => 'MS',
            'PA' => 'PA',
            'PB' => 'PB',
            'PR' => 'PR',
            'PE' => 'PE',
            'PI' => 'PI',
            'RJ' => 'RJ',
            'RN' => 'RN',
            'RO' => 'RO',
            'RS' => 'RS',
            'RR' => 'RR',
            'SC' => 'SC',
            'SE' => 'SE',
            'SP' => 'SP',
            'TO' => 'TO'];
    }

    public function getTipoRegistro() {
        $lista =  ['CREFITO' => 'CREFITO', 'CREF' => 'CREF', 'CRM' => 'CRM' ];
        return $lista;
    }

    /**
     * Gets query for [[TbEspecialidadeProfissionals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecialidadeProfissionals() {
        return $this->hasMany(EspecialidadeProfissional::className(), ['id_profissional' => 'id_profissional']);
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_cadastro'],
                    
                ],
                'value' => function() {
                    if ($this->dt_cadastro != null) {
                        return Yii::$app->formatter->asDate($this->dt_cadastro, 'dd/MM/yyyy');
                    } else {
                        return null;
                    }
                }
            ],
                    [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_cadastro'],
                    
                ],
                'value' => function() {
                    if ($this->dt_cadastro != null) 
                         $date = DateTime::createFromFormat('d/m/Y', $this->dt_cadastro);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');                        
                }
            ],
                    
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_nascimento'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_nascimento'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_nascimento);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_nascimento'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->dt_nascimento, 'dd/MM/yyyy');
                }
            ],
        ];
    }

}
