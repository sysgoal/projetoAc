<?php

namespace app\models;

use app\models\Aluno;
use yii\helpers\ArrayHelper;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tb_ficha_aluno".
 *
 * @property int $id
 * @property int $id_aluno
 * @property int $id_profissional
 * @property string|null $dt_ficha
 * @property int|null $id_exercicio_1
 * @property int|null $id_exercicio_2
 * @property int|null $id_exercicio_3
 * @property int|null $id_exercicio_4
 * @property int|null $id_exercicio_5
 * @property int|null $id_exercicio_6
 * @property int|null $id_exercicio_7
 * @property int|null $id_exercicio_8
 * @property int|null $id_exercicio_9
 * @property int|null $id_exercicio_10
 * @property int|null $id_exercicio_11
 * @property int|null $id_exercicio_12
 * @property int|null $id_exercicio_13
 * @property int|null $id_exercicio_14
 * @property int|null $id_exercicio_15
 * @property int|null $id_exercicio_16
 * @property int|null $id_exercicio_17
 * @property int|null $id_exercicio_18
 * @property string|null $nr_repeticao1
 * @property string|null $nr_repeticao2
 * @property string|null $nr_repeticao3
 * @property string|null $nr_repeticao4
 * @property string|null $nr_repeticao5
 * @property string|null $nr_repeticao6
 * @property string|null $nr_repeticao7
 * @property string|null $nr_repeticao8
 * @property string|null $nr_repeticao9
 * @property string|null $nr_repeticao10
 * @property string|null $nr_repeticao11
 * @property string|null $nr_repeticao12
 * @property string|null $nr_repeticao13
 * @property string|null $nr_repeticao14
 * @property string|null $nr_repeticao15
 * @property string|null $nr_repeticao16
 * @property string|null $nr_repeticao17
 * @property string|null $nr_repeticao18
 *
 * @property TbAluno $aluno
 * @property TbExercicios $exercicio1
 * @property TbExercicios $exercicio10
 * @property TbExercicios $exercicio11
 * @property TbExercicios $exercicio12
 * @property TbExercicios $exercicio13
 * @property TbExercicios $exercicio14
 * @property TbExercicios $exercicio15
 * @property TbExercicios $exercicio16
 * @property TbExercicios $exercicio17
 * @property TbExercicios $exercicio18
 * @property TbExercicios $exercicio2
 * @property TbExercicios $exercicio3
 * @property TbExercicios $exercicio4
 * @property TbExercicios $exercicio5
 * @property TbExercicios $exercicio6
 * @property TbExercicios $exercicio7
 * @property TbExercicios $exercicio8
 * @property TbExercicios $exercicio9
 * @property TbProfissional $profissional
 */
class FichaAluno extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_ficha_aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_aluno', 'id_profissional'], 'required'],
            [['id_aluno', 'id_profissional', 'id_exercicio_1', 'id_exercicio_2', 'id_exercicio_3', 'id_exercicio_4', 'id_exercicio_5', 'id_exercicio_6', 'id_exercicio_7', 'id_exercicio_8', 'id_exercicio_9', 'id_exercicio_10', 'id_exercicio_11', 'id_exercicio_12', 'id_exercicio_13', 'id_exercicio_14', 'id_exercicio_15', 'id_exercicio_16', 'id_exercicio_17', 'id_exercicio_18'], 'integer'],
            [['dt_ficha'], 'safe'],
            [['nr_repeticao1', 'nr_repeticao2', 'nr_repeticao3', 'nr_repeticao4', 'nr_repeticao5', 'nr_repeticao6', 'nr_repeticao7', 'nr_repeticao8', 'nr_repeticao9', 'nr_repeticao10', 'nr_repeticao11', 'nr_repeticao12', 'nr_repeticao13', 'nr_repeticao14', 'nr_repeticao15', 'nr_repeticao16', 'nr_repeticao17', 'nr_repeticao18'], 'string', 'max' => 50],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_exercicio_1'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_1' => 'id']],
            [['id_exercicio_10'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_10' => 'id']],
            [['id_exercicio_11'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_11' => 'id']],
            [['id_exercicio_12'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_12' => 'id']],
            [['id_exercicio_13'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_13' => 'id']],
            [['id_exercicio_14'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_14' => 'id']],
            [['id_exercicio_15'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_15' => 'id']],
            [['id_exercicio_16'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_16' => 'id']],
            [['id_exercicio_17'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_17' => 'id']],
            [['id_exercicio_18'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_18' => 'id']],
            [['id_exercicio_2'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_2' => 'id']],
            [['id_exercicio_3'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_3' => 'id']],
            [['id_exercicio_4'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_4' => 'id']],
            [['id_exercicio_5'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_5' => 'id']],
            [['id_exercicio_6'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_6' => 'id']],
            [['id_exercicio_7'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_7' => 'id']],
            [['id_exercicio_8'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_8' => 'id']],
            [['id_exercicio_9'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicios::className(), 'targetAttribute' => ['id_exercicio_9' => 'id']],
            [['id_profissional'], 'exist', 'skipOnError' => true, 'targetClass' => Profissional::className(), 'targetAttribute' => ['id_profissional' => 'id_profissional']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_aluno' => 'Aluno',
            'id_profissional' => 'Profissional',
            'dt_ficha' => 'Data',
            'id_exercicio_1' => 'Exercicio 1',
            'id_exercicio_2' => 'Exercicio 2',
            'id_exercicio_3' => 'Exercicio 3',
            'id_exercicio_4' => 'Exercicio 4',
            'id_exercicio_5' => 'Exercicio 5',
            'id_exercicio_6' => 'Exercicio 6',
            'id_exercicio_7' => 'Exercicio 7',
            'id_exercicio_8' => 'Exercicio 8',
            'id_exercicio_9' => 'Exercicio 9',
            'id_exercicio_10' => 'Exercicio 10',
            'id_exercicio_11' => 'Exercicio 11',
            'id_exercicio_12' => 'Exercicio 12',
            'id_exercicio_13' => 'Exercicio 13',
            'id_exercicio_14' => 'Exercicio 14',
            'id_exercicio_15' => 'Exercicio 15',
            'id_exercicio_16' => 'Exercicio 16',
            'id_exercicio_17' => 'Exercicio 17',
            'id_exercicio_18' => 'Exercicio 18',
            'nr_repeticao1' => 'Número de Repetições',
            'nr_repeticao2' => 'Número de Repetições',
            'nr_repeticao3' => 'Número de Repetições',
            'nr_repeticao4' => 'Número de Repetições',
            'nr_repeticao5' => 'Número de Repetições',
            'nr_repeticao6' => 'Número de Repetições',
            'nr_repeticao7' => 'Número de Repetições',
            'nr_repeticao8' => 'Número de Repetições',
            'nr_repeticao9' => 'Número de Repetições',
            'nr_repeticao10' => 'Número de Repetições',
            'nr_repeticao11' => 'Número de Repetições',
            'nr_repeticao12' => 'Número de Repetições',
            'nr_repeticao13' => 'Número de Repetições',
            'nr_repeticao14' => 'Número de Repetições',
            'nr_repeticao15' => 'Número de Repetições',
            'nr_repeticao16' => 'Número de Repetições',
            'nr_repeticao17' => 'Número de Repetições',
            'nr_repeticao18' => 'Número de Repetições',
        ];
    }

    /**
     * Gets query for [[Aluno]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAluno() {
        return $this->hasOne(Aluno::className(), ['id' => 'id_aluno']);
    }

    /**
     * Gets query for [[Exercicio1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio1() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_1']);
    }

    /**
     * Gets query for [[Exercicio10]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio10() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_10']);
    }

    /**
     * Gets query for [[Exercicio11]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio11() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_11']);
    }

    /**
     * Gets query for [[Exercicio12]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio12() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_12']);
    }

    /**
     * Gets query for [[Exercicio13]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio13() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_13']);
    }

    /**
     * Gets query for [[Exercicio14]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio14() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_14']);
    }

    /**
     * Gets query for [[Exercicio15]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio15() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_15']);
    }

    /**
     * Gets query for [[Exercicio16]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio16() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_16']);
    }

    /**
     * Gets query for [[Exercicio17]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio17() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_17']);
    }

    /**
     * Gets query for [[Exercicio18]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio18() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_18']);
    }

    /**
     * Gets query for [[Exercicio2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio2() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_2']);
    }

    /**
     * Gets query for [[Exercicio3]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio3() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_3']);
    }

    /**
     * Gets query for [[Exercicio4]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio4() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_4']);
    }

    /**
     * Gets query for [[Exercicio5]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio5() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_5']);
    }

    /**
     * Gets query for [[Exercicio6]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio6() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_6']);
    }

    /**
     * Gets query for [[Exercicio7]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio7() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_7']);
    }

    /**
     * Gets query for [[Exercicio8]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio8() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_8']);
    }

    /**
     * Gets query for [[Exercicio9]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio9() {
        return $this->hasOne(Exercicios::className(), ['id' => 'id_exercicio_9']);
    }

    /**
     * Gets query for [[Profissional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissional() {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }

    public function getDataListAluno() { // could be a static func as well
        $models = Aluno::find()->asArray()->orderBy('nm_aluno ASC')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    }
    
    public function getTurmaAluno($id) { // could be a static func as well
        $turma = \app\models\TurmaAluno::find()->where(['id_aluno'=>$id])->limit(1)->one();       
        return $turma;
    }

    public function getDataListProfissional() { // could be a static func as well
        $models2 = Profissional::find()->asArray()->orderBy('nm_profissional ASC')->all();
        array_unshift($models2, new Profissional);
        return ArrayHelper::map($models2, 'id_profissional', 'nm_profissional');
    }
      public function getDataListExercicios() { // could be a static func as well
        $models2 = Exercicios::find()->asArray()->orderBy('cd_tipo_exercicio ASC')->all();
        array_unshift($models2, new Exercicios);
        return ArrayHelper::map($models2, 'id', 'nm_exercicio', 'cd_tipo_exercicio');
    }

    public function behaviors() {
        return [
           
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_ficha'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->dt_ficha, 'dd/MM/yyyy');
                }
            ],
        ];
    }
    
}
