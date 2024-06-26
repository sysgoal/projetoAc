<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\behaviors\TimestampBehavior;
use DateTime;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tb_avaliacao".
 *
 * @property int $id_avaliacao
 * @property int $id_aluno
 * @property int $id_profissional
 * @property string $dt_avaliacao
 * @property string $ds_motivo
 * @property string $ds_medicamento
 * @property string $ds_patologia
 * @property string $ds_cirurgia
 * @property string $fl_tabagista
 * @property int $nr_cigarro
 * @property int $nr_tempo_tabagismo
 * @property int $nr_tempo_ex_tabagismo
 * @property string $ds_comentario_tabagismo
 * @property string $ds_doenca_respiratoria
 * @property string $ds_comentario_doenca_respiratoria
 * @property string $nr_filhos
 * @property string $ds_ciclo_cesaria
 * @property int $nr_nocturia
 * @property string $fl_relacao_dor
 * @property string $fl_relacao_prazer
 * @property string $fl_incontinencia
 * @property string $fl_endema
 * @property string $fl_dor_circulatorio
 * @property string $ds_comentario_circulatorio
 * @property string $fl_restricao
 * @property string $ds_comentario_disgestivo
 * @property int $nr_refeicoes_dia
 * @property string $nr_litros_agua_dia
 * @property string $ds_flexibilidade
 * @property string $ds_orientacoes
 * @property string $ds_conduta
 * @property string $ds_foto1
 * @property string $ds_foto2
 * @property string $ds_foto3
 * @property string $ds_foto4
 * @property string $ds_foto5
 * @property string $ds_foto6
 * @property string $ds_foto7
 * @property string $ds_video
 * @property string $ds_medico_responsavel
 * @property string $ds_alergia
 * @property string $ds_sono
 * @property string $fl_dor
 * @property string $ds_atividade_fisica
 * @property string $ds_dor
 * @property string $ds_ativo_sedentario
 * @property string $ds_endema
 * @property string $ds_incontinencia
 * @property string $ds_intestino
 * @property string $ds_avaliacao_postural
 * @property string|null $ds_acool
 * @property string|null $ds_braco_de
 * @property string|null $ds_pa
 * @property string|null $ds_cintura
 * @property string|null $ds_temperatura
 * @property string|null $ds_torax_abm
 * @property string|null $ds_quadril_culote
 * @property string|null $ds_coxa_de
 * @property string|null $ds_panturrilha_de
 * @property string|null $ds_sexo
 * @property string|null $ds_tonus
 * @property string|null $ds_abdominal 
 * @property string|null $ds_altura
 * @property string|null $ds_peso
 * @property string|null $ds_massa_magra
 * @property string|null $ds_massa_gorda
 * @property string|null $ds_idade
 * @property string|null $ds_metabolismo
 * @property string|null $ds_imc
 * @property string|null $ds_gordura_visceral
 * @property string|null $ds_10_acima
 * @property string|null $ds_5_acima
 * @property string|null $ds_5_abaixo
 * @property string|null $ds_10_abaixo
 * @property string|null $ds_umbigo
 * @property string|null $ds_observacao
 * @property string|null $ds_competencia
 * @property string|null $ds_diastase
 * @property int|null $ds_idade_atual
 * @property string|null $ds_anamnese_medico
 * @property string|null $ds_aparelho_circ
 * @property string|null $situacao
 * 

 * @property TbAluno $aluno
 */
class Avaliacao extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_avaliacao';
    }

    /**
     * {@inheritdoc}
     */
    public $image1;
    public $image2;
    public $image3;
    public $image4;
    public $image5;
    public $image6;
    public $image7;
    public $video;
    public $ocupacao;
    public $ds_alcool;

    public function rules() {
        return [
            // [['id_aluno', 'ds_motivo', 'ds_medicamento', 'ds_patologia', 'ds_cirurgia', 'fl_tabagista', 'nr_cigarro', 'nr_tempo_tabagismo', 'nr_tempo_ex_tabagismo', 'ds_comentario_tabagismo', 'ds_doenca_respiratoria', 'ds_comentario_doenca_respiratoria', 'nr_filhos', 'ds_ciclo_cesaria', 'nr_nocturia', 'fl_relacao_dor', 'fl_relacao_prazer', 'fl_incontinencia', 'fl_endema', 'fl_dor_circulatorio', 'ds_comentario_circulatorio', 'fl_restricao', 'ds_comentario_disgestivo', 'nr_refeicoes_dia', 'nr_litros_agua_dia', 'ds_flexibilidade', 'ds_orientacoes'], 'required'],
            [['ds_idade_atual', 'id_aluno', 'id_profissional', 'nr_cigarro',], 'integer'],
            [[ 'ds_doenca_respiratoria', 
                'ds_ciclo_cesaria',  'ds_flexibilidade', 
                 'situacao'], 'string', 'max' => 400],
            [['fl_tabagista', 'fl_relacao_dor', 'fl_relacao_prazer', 'fl_endema', 
                'fl_dor_circulatorio', 'fl_restricao'], 'string', 'max' => 3],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 
                'targetAttribute' => ['id_aluno' => 'id']],
            [['id_profissional'], 'exist', 'skipOnError' => true, 'targetClass' => Profissional::className(), 
                'targetAttribute' => ['id_profissional' => 'id_profissional']],
            [['dt_avaliacao'], 'date', 'format' => 'dd/MM/yyyy'],
            [[ 'ds_medico_responsavel', 'ds_alergia', 'ds_sono', 'fl_dor', 
                'ds_dor', 'fl_incontinencia', 'ds_atividade_fisica', 'ds_ativo_sedentario', 
                'ds_endema', 'ds_intestino', 'ds_incontinencia'], 'string'],
            [['ds_avaliacao_postural', 'ds_competencia'], 'string'],
            [['nr_tempo_tabagismo', 'nr_tempo_ex_tabagismo'], 'string', 'max' =>100],
            [['ds_motivo', 'ds_medicamento', 'ds_patologia', 'ds_comentario_circulatorio', 
                'ds_comentario_disgestivo',  'ds_anamnese_medico',  'ds_comentario_doenca_respiratoria',
                'ds_cirurgia', 'ds_comentario_tabagismo', 'nr_refeicoes_dia',  'nr_litros_agua_dia',
                 'ds_orientacoes', 'ds_conduta',], 'string', 'max' =>500],
            [['image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'video'], 'safe'],
            [['image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7'], 'file',
                'extensions' => 'jpg, gif, png, jpeg, JPG, JPEG'],
            [['video'], 'file', 'extensions' => 'avi, rmvb, mkv, mp4, AVI, RMVB, MKV, MP4'],
            [['ds_acool', 'ds_braco_de', 'ds_pa', 'ds_cintura', 'ds_temperatura', 'ds_torax_abm',
            'ds_quadril_culote',
            'ds_coxa_de',
            'ds_sexo',
            'ds_tonus',
            'ds_panturrilha_de',
            'ds_abdominal',
            'ds_massa_magra',
            'ds_massa_gorda',
            'ds_idade',
            'ds_metabolismo',
            'ds_imc',
            'ds_gordura_visceral',
            'ds_10_acima',
            'ds_5_acima',
            'ds_5_abaixo',
            'ds_10_abaixo',
            'ds_umbigo',
            'ds_observacao',
            'ds_diastase',
           
            'ds_aparelho_circ',
           
            'nr_filhos',
            'nr_nocturia', 'ds_altura', 'ds_peso',
                ], 'string'],
                // [[ 'ds_altura',
                //    'ds_peso'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_aluno' => 'Paciente',
            'id_profissional' => 'Profissional',
            'ds_idade_atual' => 'Idade',
            'dt_avaliacao' => 'Data da avaliação',
            'ds_motivo' => 'Motivo',
            'ds_medicamento' => 'Medicamentos',
            'ds_patologia' => 'Patologias',
            'ds_cirurgia' => 'Cirurgias',
            'fl_tabagista' => 'É tabagista?',
            'nr_cigarro' => 'Qtd de cigarros',
            'nr_tempo_tabagismo' => 'Tempo de tabagismo',
            'nr_tempo_ex_tabagismo' => 'Tempo que foi tabagista',
            'ds_comentario_tabagismo' => 'Comentário sobre tabagismo',
            'ds_doenca_respiratoria' => 'Doenças respiratorias',
            'ds_comentario_doenca_respiratoria' => 'Comentario de doenças respiratorias',
            'nr_filhos' => 'Filhos',
            'ds_ciclo_cesaria' => 'Ciclo Cesária',
            'nr_nocturia' => 'Noctúria',
            'fl_relacao_dor' => 'Dor na relação',
            'fl_relacao_prazer' => 'Alcança orgasmo?',
            'fl_incontinencia' => 'Possui incontinência?',
            'fl_endema' => 'Possui Queixa?',
            'fl_dor_circulatorio' => 'Dor circulatório',
            'ds_comentario_circulatorio' => 'Comentário de circulatório',
            'fl_restricao' => 'Possui Restrição?',
            'ds_comentario_disgestivo' => 'Comentario Disgestivo',
            'nr_refeicoes_dia' => 'Número de refeições ao dia',
            'nr_litros_agua_dia' => 'Número de litros de água ao dia',
            'ds_flexibilidade' => 'Flexibilidade',
            'ds_orientacoes' => 'Orientações',
            'ocupacao' => 'Ocupação',
            'ds_conduta' => 'Conduta',
            'ds_foto1' => 'Imagem 1',
            'ds_foto2' => 'Imagem 2',
            'ds_foto3' => 'Imagem 3',
            'ds_foto4' => 'Imagem 4',
            'ds_foto5' => 'Imagem 5',
            'ds_foto6' => 'Imagem 6',
            'ds_foto7' => 'Imagem 7',
            'ds_video' => 'Vídeo',
            'ds_medico_responsavel' => 'Médico Responsável',
            'ds_alergia' => 'Alergias',
            'ds_sono' => 'Sono',
            'fl_dor' => 'Dor',
            'ds_dor' => 'Descrição da Dor',
            'ds_atividade_fisica' => 'Descrição da atividade física',
            'ds_ativo_sedentario' => 'Atividade física',
            'ds_endema' => 'Descrição',
            'ds_incontinencia' => 'Descrição da incontinência',
            'ds_intestino' => 'Intestino',
            'ds_avaliacao_postural' => 'Avaliação Postural',
            'ds_acool' => 'Consumo de Álcool',
            'ds_braco_de' => 'Braço D/ Braço E',
            'ds_pa' => 'P.A',
            'ds_cintura' => 'Abdomen(Cintura)',
            'ds_temperatura' => 'Temperatura',
            'ds_torax_abm' => 'Tórax',
            'ds_quadril_culote' => 'Quadril',
            'ds_coxa_de' => 'Coxa D/ Coxa E',
            'ds_panturrilha_de' => 'Panturrilha D/E',
            'ds_sexo' => 'Descrição Sexo',
            'ds_tonus' => 'Força / Tônus',
            'ds_abdominal' => 'Abdominal',
            'ds_altura' => 'Altura',
            'ds_peso' => 'Peso',
            'ds_massa_magra' => 'Músculo esquelético',
            'ds_massa_gorda' => '% de gordura corporal',
            'ds_idade' => 'Idade Corporal',
            'ds_metabolismo' => 'Metabolismo',
            'ds_imc' => 'Imc',
            'ds_gordura_visceral' => 'Gordura visceral',
            'ds_10_acima' => 'Perimetria +10',
            'ds_5_acima' => 'Perimetria +5',
            'ds_5_abaixo' => 'Perimetria -5',
            'ds_10_abaixo' => 'Perimetria -10',
            'ds_umbigo' => 'Perimeria Umbigo',
            'ds_observacao' => 'Observação',
            'ds_alcool' => 'Consome álcool?',
            'image1' => 'Foto 1',
            'image2' => 'Foto 2',
            'image3' => 'Foto 3',
            'image4' => 'Foto 4',
            'image5' => 'Foto 5',
            'image6' => 'Foto 6',
            'image7' => 'Foto 7',
            'video' => 'Vídeo',
            'ds_competencia' => 'Competência',
            'ds_diastase' => 'Diástase',
            'ds_anamnese_medico' => 'Anamnese',
            'ds_aparelho_circ' => 'Aparelho Circulatório',
            'situacao' => 'Situação',
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

    public function getProfissional() {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }

    public function getDataListAluno() { // could be a static func as well
        $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    }

    public function getDadoUmAluno($idAluno) { // could be a static func as well
        $aluno = Aluno::findOne($idAluno);
        return [$aluno->id => $aluno->nm_aluno];
    }
    
     public function getDadoAlunoPorId($idAluno) { // could be a static func as well
        $aluno = Aluno::findOne($idAluno);
        return $aluno;
    }

    public function getDadosAvaliacao($id) {
        return Avaliacao::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao DESC')->limit(1)->one();
    }

    public function getDadosAvaliacaoHipo($id) {
        return AvaliacaoHipopressivo::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao DESC')->limit(1)->one();
    }

    public function getDadosTodasAvaliacao($id) {
        $avaliacao = AvaliacaoHipopressivo::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
        if ($avaliacao == null) {
            $avaliacao = Avaliacao::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
        }
        return $avaliacao;
    }

    public function getDadosImc($idAluno) {
        $imc = AvaliacaoHipopressivo::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        if ($imc == null) {
            $imc = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        }
        $data[] = ["Data", "Abaixo do peso", "Normal", "Sobrepeso", "Obesidade", "Abaixo do peso", "Normal", "Sobrepeso", "Obesidade", "Imc"];
        $aux = 0;
        $data1 = '';
        $imc1 = 0;
        foreach ($imc as $bio) {

            $item['data'] = $bio->dt_avaliacao;
            $data1 = $bio->dt_avaliacao;
            // $item['abaixo1'] = 0;
            $item['abaixo'] = 18.5;
            $item['normal'] = 24.9;
            $item['acima'] = 29.9;
            // $item['normal1'] = 18.5;
            // $item['acima1'] = 24.9;
            $item['obesidade'] = 40;

            $item['imc'] = $bio->ds_imc;
            $imc1 = $bio->ds_imc;

            $data[] = [(string) $item['data'],
                (float) $item['abaixo'],
                (float) ($item['normal'] - $item['abaixo']),
                (float) ($item['acima'] - $item['normal']),
                (float) ($item['obesidade']),
                (float) $item['abaixo'], //ok
                (float) $item['normal'],
                (float) $item['acima'],
                (float) $item['obesidade'],
                (float) $item['imc']];
            $aux++;
        }

        if ($aux == 1) {

            $data[] = [$data1,
                (float) 18.5,
                (float) (24.9 - 18.5),
                (float) (29.9 - 24.9),
                (float) 40,
                (float) 18.5, //ok
                (float) 24.9,
                (float) 29.9,
                (float) 40,
                $imc1];
            $aux++;
        }

        return $data;
    }

    public function getDadosGorduraCorporal($idAluno) {
        $gordura = AvaliacaoHipopressivo::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        if ($gordura == null) {
            $gordura = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        }
        $aluno = Aluno::findOne($idAluno);
        // $idade = $aluno->getIdade();
        $sexo = '';
        if ($aluno != null) {
            $sexo = $aluno->ds_sexo;
        }

        $data[] = ["Data", "Baixo(-)", "Normal(0)", "Alto(+)", "Muito alto(++)", "Baixo(-)", "Normal(0)", "Alto(+)", "Muito alto(++)", "% de gordura"];
        $aux = 0;
        $data1 = '';
        $gord = 0;
        $idade1 = 0;

        foreach ($gordura as $bio) {
            $item['data'] = $bio->dt_avaliacao;
            $data1 = $bio->dt_avaliacao;
            $idade1 = $bio->ds_idade_atual;
            if ($sexo == 'Feminino') {
                if ($bio->ds_idade_atual <= 39) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 21;
                    $item['normal'] = 32.9;
                    $item['alto'] = 38.9;
                    // $item['normal1'] = 21;
                    // $item['alto1'] = 33;
                    $item['muito'] = 39;
                } else if ($bio->ds_idade_atual <= 59) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 23;
                    $item['normal'] = 33.9;
                    $item['alto'] = 39.9;
                    //$item['normal1'] = 23;
                    // $item['alto1'] = 34;
                    $item['muito'] = 40;
                } else {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 24;
                    $item['normal'] = 35.9;
                    $item['alto'] = 41.9;
                    // $item['normal1'] = 24;
                    //$item['alto1'] = 36;
                    $item['muito'] = 42;
                }
            } else {
                if ($bio->ds_idade_atual <= 39) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 8;
                    $item['normal'] = 19.9;
                    $item['alto'] = 24.9;
                    // $item['normal1'] = 8;
                    // $item['alto1'] = 20;
                    $item['muito'] = 25;
                } else if ($bio->ds_idade_atual <= 59) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 11;
                    $item['normal'] = 21.9;
                    $item['alto'] = 27.9;
                    //  $item['normal1'] = 11;
                    // $item['alto1'] = 22;
                    $item['muito'] = 28;
                } else {
                    //  $item['baixo1'] = 0;
                    $item['baixo'] = 13;
                    $item['normal'] = 29.9;
                    $item['alto'] = 41.9;
                    // $item['normal1'] = 13;
                    // $item['alto1'] = 25;
                    $item['muito'] = 30;
                }
            }

            $item['gordura'] = $bio->ds_massa_gorda;
            $gord = $bio->ds_massa_gorda;
            $data[] = [(string) $item['data'],
                (float) $item['baixo'],
                (float) ($item['normal'] - $item['baixo']),
                (float) ($item['alto'] - $item['normal']),
                (float) ($item['muito']),
                (float) $item['baixo'], //ok
                (float) $item['normal'],
                (float) $item['alto'],
                (float) $item['muito'],
                (float) $item['gordura']];
            $aux++;
        }

        if ($aux == 1) {
            if ($sexo == 'Feminino') {
                if ($idade1 <= 39) {

                    $a = 21;
                    $b = 32.9;
                    $c = 38.9;
                    $d = 39;
                } else if ($idade1 <= 59) {
                    $a = 23;
                    $b = 33.9;
                    $c = 39.9;
                    $d = 40;
                } else {
                    $a = 24;
                    $b = 35.9;
                    $c = 41.9;
                    $d = 42;
                }
            } else {
                if ($idade1 <= 39) {
                    $a = 8;
                    $b = 19.9;
                    $c = 24.9;
                    $d = 25;
                } else if ($idade1 <= 59) {
                    $a = 11;
                    $b = 21.9;
                    $c = 27.9;
                    $d = 28;
                } else {
                    $a = 13;
                    $b = 29.9;
                    $c = 41.9;
                    $d = 30;
                }
            }
            $data[] = [(string) $data1,
                (float) $a,
                (float) ($b - $a),
                (float) ($c - $b),
                (float) ($d),
                (float) $a, //ok
                (float) $b,
                (float) $c,
                (float) $d,
                (float) $gord];
        }
        return $data;
    }

    public function getDadosCinturaQuadril($idAluno) {
        $gordura = AvaliacaoHipopressivo::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        /* if($gordura == null){
          $gordura = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
          } */
        if ($gordura == null) {
            return null;
        }
        $aluno = Aluno::findOne($idAluno);
        // $idade = $aluno->getIdade();
        $sexo = '';
        if ($aluno != null) {
            $sexo = $aluno->ds_sexo;
        }

        $data[] = ["Data", "Normal", "Ideal", "Alto", "Baixo", "Ideal", "Alto", "Cintura - Quadril"];
        $aux = 0;
        $data1 = '';
        $quadr = 0;
        foreach ($gordura as $bio) {
            $item['data'] = $bio->dt_avaliacao;
            $data1 = $bio->dt_avaliacao;
            if ($sexo == 'Feminino') {

                // $item['baixo1'] = 0;
                $item['baixo'] = 0.80;
                $item['moderado'] = 0.85;

                // $item['moderado1'] = 0.80;
                $item['alto1'] = 0.86;
            } else {

                //$item['baixo1'] = 0;
                $item['baixo'] = 0.95;
                $item['moderado'] = 1;

                // $item['moderado1'] = 0.95;
                $item['alto1'] = 1.1;
            }
            $item['alto'] = 2;
            if ($bio->ds_quadril != 0 && $bio->ds_cintura != null) {
                

                $conta = ( str_replace(',', '.', $bio->ds_cintura) / str_replace(',', '.', $bio->ds_quadril));
                $item['cintura'] = round($conta, 2);
            } else {
                $item['cintura'] = 0;
            }
            $quadr = $item['cintura'];
            $data[] = [(string) $item['data'],
                (float) $item['baixo'],
                (float) ($item['moderado'] - $item['baixo']),
                (float) ($item['alto'] - $item['moderado']),
                (float) $item['baixo'], //ok
                (float) $item['moderado'],
                (float) $item['alto1'],
                (float) $item['cintura']];
            $aux++;
        }

        if ($aux == 1) {
            if ($sexo == 'Feminino') {
                $a = 0.80;
                $b = 0.85;
                $c = 0.86;
            } else {
                $a = 0.95;
                $b = 1;
                $c = 1.1;
            }

            $data[] = [(string) $data1,
                (float) $a,
                (float) ($b - $a),
                (float) (2 - $b),
                (float) $a, //ok
                (float) $b,
                (float) $c,
                (float) $quadr];
        }
        return $data;
    }

    public function getDadosGorduraVisceral($idAluno) {
        $gordura = AvaliacaoHipopressivo::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        if ($gordura == null) {
            $gordura = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        }
        $aluno = Aluno::findOne($idAluno);
        // $idade = $aluno->getIdade();
        $sexo = '';
        if ($aluno != null) {
            $sexo = $aluno->ds_sexo;
        }

        $data[] = ["Data", "Normal", "Alto", "Muito alto", "Normal", "Alto", "Muito alto", "Gordura Visceral"];
        $aux = 0;
        $data1 = '';
        $gord = 0;
        foreach ($gordura as $bio) {
            $item['data'] = $bio->dt_avaliacao;
            $data1 = $bio->dt_avaliacao;
            // $item['normal1'] = 0;
            $item['normal'] = 9;
            //$item['alto1'] = 10;
            $item['alto'] = 14;
            $item['muitoAlto'] = 15;
            $item['muitoAlto1'] = 20;

            $item['gordura'] = $bio->ds_gordura_visceral;
            $gord = $bio->ds_gordura_visceral;

            $data[] = [(string) $item['data'],
                (float) $item['normal'],
                (float) ($item['alto'] - $item['normal']),
                (float) ($item['muitoAlto1'] - $item['alto']),
                (float) $item['normal'], //ok
                (float) $item['alto'],
                (float) $item['muitoAlto'],
                (float) $item['gordura']];
            $aux++;
        }

        if ($aux == 1) {
            $data[] = [(string) $data1,
                (float) 9,
                (float) (14 - 9),
                (float) (20 - 14),
                (float) 9, //ok
                (float) 14,
                (float) 15,
                (float) $gord];
        }
        return $data;
    }

    public function getDadosMusculoEsqueletico($idAluno) {
        $gordura = AvaliacaoHipopressivo::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        if ($gordura == null) {
            $gordura = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        }
        $aluno = Aluno::findOne($idAluno);
        // $idade = $aluno->getIdade();
        $sexo = '';
        if ($aluno != null) {
            $sexo = $aluno->ds_sexo;
        }

        $data[] = ["Data", "Baixo(-)", "Normal(0)", "Alto(+)", "Muito alto(++)", "Baixo(-)", "Normal(0)", "Alto(+)", "Muito alto(++)", "Músculo Esq."];
        $aux = 0;
        $data1 = '';
        $gord = 0;
        $idade1 = 0;
        foreach ($gordura as $bio) {
            $item['data'] = $bio->dt_avaliacao;
            $data1 = $bio->dt_avaliacao;
            $idade1 = $bio->ds_idade_atual;
            if ($sexo == 'Feminino') {
                if ($bio->ds_idade_atual <= 39) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 24.3;
                    $item['normal'] = 30.3;
                    $item['alto'] = 35.3;
                    // $item['normal1'] = 24.3;
                    //$item['alto1'] = 30.4;
                    $item['muito'] = 35.4;
                } else if ($bio->ds_idade_atual <= 59) {
                    //  $item['baixo1'] = 0;
                    $item['baixo'] = 24.1;
                    $item['normal'] = 30.1;
                    $item['alto'] = 35.1;
                    // $item['normal1'] = 24.1;
                    // $item['alto1'] = 30.2;
                    $item['muito'] = 35.2;
                } else {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 23.9;
                    $item['normal'] = 29.9;
                    $item['alto'] = 34.9;
                    // $item['normal1'] = 23.9;
                    //  $item['alto1'] = 30;
                    $item['muito'] = 35;
                }
            } else {
                if ($bio->ds_idade_atual <= 39) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 33.3;
                    $item['normal'] = 39.3;
                    $item['alto'] = 44;
                    //  $item['normal1'] = 33.3;
                    //  $item['alto1'] = 39.4;
                    $item['muito'] = 44.1;
                } else if ($bio->ds_idade_atual <= 59) {
                    // $item['baixo1'] = 0;
                    $item['baixo'] = 33.1;
                    $item['normal'] = 39.1;
                    $item['alto'] = 43.8;
                    // $item['normal1'] = 33.1;
                    // $item['alto1'] = 39.2;
                    $item['muito'] = 43.9;
                } else {
                    //  $item['baixo1'] = 0;
                    $item['baixo'] = 32.9;
                    $item['normal'] = 38.9;
                    $item['alto'] = 43.6;
                    //  $item['normal1'] = 32.9;
                    //  $item['alto1'] = 39;
                    $item['muito'] = 43.7;
                }
            }

            $item['gordura'] = $bio->ds_massa_magra;
            $gord = $bio->ds_massa_magra;
            $data[] = [(string) $item['data'],
                (float) $item['baixo'],
                (float) ($item['normal'] - $item['baixo']),
                (float) ($item['alto'] - $item['normal']),
                (float) ($item['muito']),
                (float) $item['baixo'], //ok
                (float) $item['normal'],
                (float) $item['alto'],
                (float) $item['muito'],
                (float) $item['gordura']];
            $aux++;
        }


        if ($aux == 1) {
            if ($sexo == 'Feminino') {
                if ($idade1 <= 39) {
                    $a = 24.3;
                    $b = 30.3;
                    $c = 35.3;
                    $d = 35.4;
                } else if ($idade1 <= 59) {
                    $a = 24.1;
                    $b = 30.1;
                    $c = 35.1;
                    $d = 35.2;
                } else {
                    $a = 23.9;
                    $b = 29.9;
                    $c = 34.9;
                    $d = 35;
                }
            } else {
                if ($idade1 <= 39) {
                    $a = 33.3;
                    $b = 39.3;
                    $c = 44;
                    $d = 44.1;
                } else if ($idade1 <= 59) {
                    $a = 33.1;
                    $b = 39.1;
                    $c = 43.8;
                    $d = 43.9;
                } else {
                    $a = 32.9;
                    $b = 38.9;
                    $c = 43.6;
                    $d = 43.7;
                }
            }

            $data[] = [(string) $data1,
                (float) $a,
                (float) ($b - $a),
                (float) ($c - $b),
                (float) ($d),
                (float) $a, //ok
                (float) $b,
                (float) $c,
                (float) $d,
                (float) $gord];
        }
        return $data;
    }

    public function getImc($idAluno) {
        $fisioterapica = AvaliacaoHipopressivo::findAll(['id_aluno' => $idAluno]);
        if ($fisioterapica == null) {
            $fisioterapica = Avaliacao::findAll(['id_aluno' => $idAluno]);
        }
        return ArrayHelper::map($fisioterapica, 'id_aluno', 'dt_avaliacao', 'vr_imc');
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_avaliacao'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_avaliacao'],
                ],
                'value' => function() {
                    $date = DateTime::createFromFormat('d/m/Y', $this->dt_avaliacao);
                    return Yii::$app->formatter->asDate($date, 'php:Y-m-d');
                }
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_AFTER_FIND => ['dt_avaliacao'],
                ],
                'value' => function() {
                    return Yii::$app->formatter->asDate($this->dt_avaliacao, 'dd/MM/yyyy');
                }
            ],
        ];
    }

    public function getNavBar() {
        NavBar::begin([
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems[] = ['label' => '<i class="glyphicon glyphicon-user"></i> Search', 'url' => ['/site/search']];
        echo Nav::widget([
            'encodeLabels' => false,
        ]);

        NavBar::end();
    }

    public function getAvaliador($id) {
        //Yii::$app->user->identity->id
        return Profissional::findOne($id);
    }

    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_avaliacao_'.date('Y-m-d').'.csv';
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
