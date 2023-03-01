<?php

namespace app\models;


use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use DateTime;
use Yii;

/**
 * This is the model class for table "tb_aluno".
 *
 * @property int $id
 * @property string $nm_aluno
 * @property string $ds_cpf
 * @property string $dt_nascimento
 * @property string $ds_sexo
 * @property string $ds_identidade
 * @property string $ds_responsaveis
 * @property string $ds_estado
 * @property string $ds_cidade
 * @property string $ds_endereco
 * @property string $ds_bairro
 * @property string $ds_complemento
 * @property string $ds_cep
 * @property string $ds_email
 * @property string $ds_profissao
 * @property int $ds_telefone1
 * @property int $ds_telefone2
 * @property int $ds_whatsapp
 * @property int $id_convenio
 * @property int $id_profissional 
 * @property string $filename
 * @property array $avatar 
 * @property string $declaracao
 * @property date $dt_registro
 * @property string $ds_parentesco
 * @property int $ds_ativo
 * @property string $ds_chave_acesso
 * @property string $ds_arquivo1
 * @property string $ds_arquivo2
 * @property string $ds_arquivo3
 * @property string $ds_arquivo4
 * @property string $ds_arquivo5
 * @property string $ds_arquivo6
 * @property string $ds_arquivo7
 * @property string $ds_arquivo8
 * @property string $ds_arquivo9
 * @property string $ds_arquivo10
 * 
 */
class Aluno extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_aluno';
    }

    /**
     * {@inheritdoc}
     */
    public $image;
    public $pdfDeclaracao;
    public $nomeConvenio;
    public $arquivo1;
    public $arquivo10;
    public $arquivo2;
    public $arquivo3;
    public $arquivo4;
    public $arquivo5;
    public $arquivo6;
    public $arquivo7;
    public $arquivo8;
    public $arquivo9;

    public function rules() {

        return [
            //   [['nm_aluno', 'ds_cpf', 'dt_nascimento', 'ds_sexo', 'ds_identidade', 'ds_responsaveis', 'ds_estado', 'ds_cidade', 'ds_endereco', 'ds_cep', 'ds_email', 'ds_profissao', 'ds_telefone1', 'ds_telefone2', 'ds_whatsapp'], 'required'],  
            //   [['nm_aluno', 'ds_cpf', 'dt_nascimento', 'ds_sexo', 'ds_identidade', 'ds_responsaveis', 'ds_estado', 'ds_cidade', 'ds_endereco', 'ds_cep', 'ds_email', 'ds_profissao', 'ds_telefone1', 'ds_telefone2', 'ds_whatsapp'], 'required'],             
            [['id_convenio', 'nm_aluno', 'ds_profissao', 'ds_cpf', 'dt_nascimento', 'ds_sexo', 'ds_estado', 'ds_cidade', 'ds_endereco', 'ds_cep', 'ds_observacao'], 'required'],
            [['dt_nascimento', 'dt_registro'], 'date', 'format' => 'dd/MM/yyyy'],
            [['ds_ativo'], 'integer'],
            [['nm_aluno', 'ds_responsaveis', 'ds_cidade', 'ds_endereco', 'ds_email'], 'string', 'max' => 200],
            [['ds_cpf'], 'string', 'max' => 11],
            [['ds_sexo'], 'string', 'max' => 100],
            [['ds_identidade'], 'string', 'max' => 50],
            [['ds_estado'], 'string', 'max' => 2],
            [['ds_bairro'], 'string'],
            [['ds_complemento'], 'string'],
            [['ds_cep'], 'string', 'max' => 10],
            [['ds_profissao'], 'string', 'max' => 100],
            [['ds_telefone1'], 'string', 'max' => 15],
            [['ds_telefone2'], 'string', 'max' => 15],
            [['ds_whatsapp'], 'string', 'max' => 15],
            [['fl_paciente'], 'string', 'max' => 10],
            [['nr_matricula_conv'], 'integer'],
            [['dt_validade'], 'date', 'format' => 'dd/MM/yyyy'],
            [['ds_observacao'], 'string', 'max' => 200],
            [['ds_parentesco'], 'string', 'max' => 100],
            // [['id_convenio'], 'string'],
            [['id_profissional'], 'integer'],
            [['image'], 'safe'],
            [['nomeConvenio', 'ds_chave_acesso'], 'string'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png, jpeg, JPG, JPEG'],
            [['pdfDeclaracao', 'arquivo1', 'arquivo2', 'arquivo3', 'arquivo4', 'arquivo5', 'arquivo6',
                'arquivo7', 'arquivo8', 'arquivo9', 'arquivo10'], 'safe'],
            [['pdfDeclaracao','arquivo1', 'arquivo2', 'arquivo3', 'arquivo4', 'arquivo5', 'arquivo6',
                'arquivo7', 'arquivo8', 'arquivo9', 'arquivo10'], 'file', 'extensions' => 'jpg, gif, png, jpeg, JPG, JPEG, pdf, PDF']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'Código do Aluno',
            'nm_aluno' => 'Nome do Aluno/Paciente',
            'ds_cpf' => 'Cpf',
            'dt_nascimento' => 'Data de Nascimento',
            'ds_sexo' => 'Sexo',
            'ds_identidade' => 'RG',
            'ds_responsaveis' => 'Responsável',
            'ds_parentesco' => 'Parentesco',
            'ds_estado' => 'Estado',
            'ds_cidade' => 'Cidade',
            'ds_endereco' => 'Endereço',
            'ds_complemento' => 'Complemento',
            'ds_bairro' => 'Bairro',
            'ds_cep' => 'Cep',
            'ds_email' => 'Email',
            'ds_profissao' => 'Profissão',
            'ds_telefone1' => 'Telefone Fixo',
            'ds_telefone2' => 'Telefone Celular',
            'ds_whatsapp' => 'Whatsapp',
            'id_convenio' => 'Convênio / UBS',
            'fl_paciente' => 'Paciente',
            'nr_matricula_conv' => 'Matrícula de Convênio',
            'dt_validade' => 'Validade',
            'ds_observacao' => 'Observação / Nome dos Pais',
            'id_profissional' => 'Profissional',
            'pdfDeclaracao' => 'Declaração',
            'image' => 'Foto',
            'ds_ativo' => 'Ativo',
            'arquivo1' => 'Arquivo 1',
            'arquivo2' => 'Arquivo 2',
            'arquivo3' => 'Arquivo 3',
            'arquivo4' => 'Arquivo 4',
            'arquivo5' =>'Arquivo 5',
            'arquivo6' => 'Arquivo 6',
            'arquivo7' =>'Arquivo 7',
            'arquivo8' => 'Arquivo 8',
            'arquivo9' =>'Arquivo 9',
            'arquivo10' => 'Arquivo 10',
            'dt_registro' => 'Data de registro',
        ];
    }

    public function getProfissional() {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }

    public function getConvenio() {
        return $this->hasOne(Convenio::className(), ['id' => 'id_convenio']);
    }

    public function getParentescos() {
        return $parentescos = [
            '' => '',
            'PAI' => 'PAI',
            'MÃE' => 'MÃE',
            'ESPOSO' => 'ESPOSO',
            'ESPOSA' => 'ESPOSA',
            'TIO' => 'TIO',
            'TIA' => 'TIA',
            'IRMÃO' => 'IRMÃO',
            'IRMÃ' => 'IRMÃ',
            'SOBRINHO' => 'SOBRINHO',
            'SOBRINHA' => 'SOBRINHA',
            'AVÔ' => 'AVÔ',
            'AVÓ' => 'AVÓ',
            'SOGRO' => 'SOGRO',
            'SOGRA' => 'SOGRA',
            'PRIMO' => 'PRIMO',
            'PRIMA' => 'PRIMA',
            'CUNHADO' => 'CUNHADO',
            'CUNHADA' => 'CUNHADA',
            'FILHO' => 'FILHO',
            'FILHA' => 'FILHA',
            'AMIGO' => 'AMIGO',
            'AMIGA' => 'AMIGA',
            'OUTROS' => 'OUTROS'];
    }

    public function getDataListConvenio() { // could be a static func as well
        $models = Convenio::find()->asArray()->all();
        array_unshift($models, new Convenio);
        return ArrayHelper::map($models, 'id', 'ds_nome');
    }

    public function getDataListProfissional() { // could be a static func as well
        $models = Profissional::find()->asArray()->all();
        array_unshift($models, new Profissional);
        return ArrayHelper::map($models, 'id_profissional', 'nm_profissional');
    }

    public function behaviors() {
        return [
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
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_validade'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_validade'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_validade);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_validade'],
                ],
                'value' => function() {
                    if ($this->dt_validade != null) {
                        return Yii::$app->formatter->asDate($this->dt_validade, 'dd/MM/yyyy');
                    } else {
                        return null;
                    }
                }
            ],
                     [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_registro'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_registro'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_registro);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
                   
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_registro'],
                ],
                'value' => function() {
                    if ($this->dt_registro != null) {
                        return Yii::$app->formatter->asDate($this->dt_registro, 'dd/MM/yyyy');
                    } else {
                        return null;
                    }
                }
            ],
        ];
    }

    public function getIdade() {
        $idade = 0;
        $data_nascimento = $this->dt_nascimento;
        list($diaNasc, $mesNasc, $anoNasc) = explode('/', $data_nascimento);

        $idade = date("Y") - $anoNasc;
        if (date("m") < $mesNasc) {
            $idade -= 1;
        } elseif ((date("m") == $mesNasc) && (date("d") <= $diaNasc)) {
            $idade -= 1;
        }

        return $idade;
    }

    public function getListNameAluno() { // could be a static func as well        
        $alunos = $this->find()->asArray()->orderBy('nm_aluno')->all();
        return ArrayHelper::map($alunos, 'id', 'nm_aluno');
    }

}
