<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "tb_boletim_aluno".
 *
 * @property int $id
 * @property int $id_aluno
 * @property int|null $id_profissional
 * @property int|null $id_turma
 * @property int $dt_boletim
 * @property float|null $ds_perda_gordura
 * @property string|null $ds_objetivo
 *
 * @property TbBoAvalBioHofiNatHist[] $tbBoAvalBioHofiNatHists
 * @property TbAluno $aluno
 * @property TbProfissional $profissional
 * @property TbTurma $turma
 */
class BoletimAluno extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tb_boletim_aluno';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id_aluno', 'dt_boletim'], 'required'],
            [['id_aluno', 'id_profissional', 'id_turma', 'dt_boletim'], 'integer'],
            [['ds_perda_gordura'], 'number'],
            [['ds_objetivo'], 'string', 'max' => 100],
            [['id_aluno'], 'exist', 'skipOnError' => true, 'targetClass' => Aluno::className(), 'targetAttribute' => ['id_aluno' => 'id']],
            [['id_profissional'], 'exist', 'skipOnError' => true, 'targetClass' => Profissional::className(), 'targetAttribute' => ['id_profissional' => 'id_profissional']],
            [['id_turma'], 'exist', 'skipOnError' => true, 'targetClass' => Turma::className(), 'targetAttribute' => ['id_turma' => 'id_turma']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_aluno' => 'Id Aluno',
            'id_profissional' => 'Id Profissional',
            'id_turma' => 'Id Turma',
            'dt_boletim' => 'Dt Boletim',
            'ds_perda_gordura' => 'Ds Perda Gordura',
            'ds_objetivo' => 'Ds Objetivo',
        ];
    }

    /**
     * Gets query for [[TbBoAvalBioHofiNatHists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoAvalBioHofiNatHists() {
        return $this->hasMany(BoAvalBioHofiNatHist::className(), ['id_boletim' => 'id']);
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
     * Gets query for [[Profissional]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfissional() {
        return $this->hasOne(Profissional::className(), ['id_profissional' => 'id_profissional']);
    }

    /**
     * Gets query for [[Turma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurma() {
        return $this->hasOne(Turma::className(), ['id_turma' => 'id_turma']);
    }

    public function getDataListAluno() { // could be a static func as well
        $models = Aluno::find()->asArray()->orderBy('nm_aluno')->all();
        array_unshift($models, new Aluno);
        return ArrayHelper::map($models, 'id', 'nm_aluno');
    }

    public function getBoletim($idAluno) {
        $aluno = Aluno::findOne($idAluno);
        $turma = TurmaAluno::find()->where(['id_aluno' => $idAluno])->orderBy('id DESC')->limit(1)->one();
        $hofi = TesteHofi::find()->where(['id_aluno' => $idAluno])->orderBy('dt_teste')->all();
        $pilates = TestePilates::find()->where(['id_aluno' => $idAluno])->orderBy('dt_teste')->all();
        $avaliacao = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao')->all();
        $nomeTurma = '';
        $nomeProfessor = '';


        if ($turma != null && $turma->turma != null) {
            $nomeTurma = $turma->turma->nm_turma;
            $nomeProfessor = $turma->turma->profissional->nm_profissional;
        }


        if ($avaliacao != null) {
            echo '<div id=noprint>';
            echo '<a href=javascript:; onclick=window.print();return false>';
            echo Html::buttonInput('Imprimir Tela ', ['class' => 'btn btn-success', 'id' => 'myButton',]);
            echo '</a><br/>';

            echo Html::a(Yii::t('app', 'Imprimir PDF'), ['/relatorioboletim/relatorioboletim', 'id' => $idAluno], ['class' => 'btn btn-success', 'style' => 'padding-right:10px;', 'target' => '_blank']);
            echo '</div>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>';
            echo '<th colspan="2"><div align="center">Boletim do Aluno</div></th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="2"> Data de Matrícula: ' . $aluno->dt_registro . ' </th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="2">Aluno: ' . $aluno->nm_aluno . ' </th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th colspan="2">Turma: ' . $nomeTurma . '</th>';
            echo '</tr><tr>
      <th colspan="2">Professor: ' . $nomeProfessor . '</th>
          </tr>      
            <th style=width:20px>DATA</th>
            <th>Objetivos do aluno</th>
           
            </thead>
        <tbody>';

            foreach ($avaliacao as $aval6) {
                if ($aval6->ds_motivo != null) {
                    echo '<tr>';
                    echo '<td>' . $aval6->dt_avaliacao . '</td>';
                    echo '<td>' . $aval6->ds_motivo . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>
  
</table>';
            // echo '<br>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>';
            echo '<th colspan="8"><div align="center">Avaliação Fisioterápica</div></th>';
            echo '</tr>';

            echo '<tr>      
            <th  style=width:20px>DATA</th>
            <th style=width:20px>ALT</th>
            <th style=width:20px>PESO</th>
            <th style=width:20px>IMC</th>
            <th style=width:20px>P.A</th>
            <th style=width:20px>ABD</th>
            <th style=width:20px>FLEX</th>        
            </tr>
            </thead>
        <tbody>';

            foreach ($avaliacao as $aval7) {
                if (!($aval7->ds_altura == null && $aval7->ds_peso == null && $aval7->ds_imc == null && $aval7->ds_pa == null && $aval7->ds_abdominal == null && $aval7->ds_flexibilidade == null)) {
                    echo '<tr>';
                    echo '<td>' . $aval7->dt_avaliacao . '</td>';
                    echo '<td>' . $aval7->ds_altura . '</td>';
                    echo '<td>' . $aval7->ds_peso . '</td>';
                    echo '<td>' . $aval7->ds_imc . '</td>';
                    echo '<td>' . $aval7->ds_pa . '</td>';
                    echo '<td>' . $aval7->ds_abdominal . '</td>';
                    echo '<td>' . $aval7->ds_flexibilidade . '</td>';                  
                    echo '</tr>';
                }
            }

            echo '</tbody>
  
</table>';

            // echo '<br>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>';
            echo '<th colspan="7"><div align="center">Biometria</div></th>';
            echo '</tr>';
            echo '<tr>      
            <th style=width:20px>DATA</th>
            <th style=width:20px>BRAÇ</th>
            <th style=width:20px>TORAX</th>
            <th style=width:20px>ABDO</th>
            <th style=width:20px>QUAD</th>
            <th style=width:20px>COXA</th>
            <th style=width:20px>PERN</th>     
            </tr>
            </thead>
        <tbody>';

            foreach ($avaliacao as $aval5) {
                if (!($aval5->ds_cintura == null && $aval5->ds_braco_de == null && $aval5->ds_torax_abm == null && $aval5->ds_quadril_culote == null && $aval5->ds_coxa_de == null && $aval5->ds_panturrilha_de == null)) {
                    echo '<tr>';
                    echo '<td>' . $aval5->dt_avaliacao . '</td>';
                    echo '<td>' . $aval5->ds_braco_de . '</td>';
                    echo '<td>' . $aval5->ds_torax_abm . '</td>';
                    echo '<td>' . $aval5->ds_cintura . '</td>';
                    echo '<td>' . $aval5->ds_quadril_culote . '</td>';
                    echo '<td>' . $aval5->ds_coxa_de . '</td>';
                    echo '<td>' . $aval5->ds_panturrilha_de . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>
  
</table>';
            // echo '<br>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>'
            . '<th colspan="3"><div align="center">100m NAT./HOFI </div></th>
            <th colspan="1"> <div id=noprint>
            <button type="button" class="btn btn-success" id="btnHofi" value="'. $idAluno .'">Inserir Hofi</button>
            </div></th>'
            . '</tr>';
            echo '<tr>      
            <th>DATA</th>
            <th>Temp</th>
            <th>Nado</th>  
            <th>Obs</th> 
            </tr>
            </thead>
        <tbody>';

            foreach ($hofi as $thofi) {
                echo '<tr>';
                echo '<td>' . $thofi->dt_teste . '</td>';
                echo '<td>' . $thofi->ds_tempo . '</td>';
                echo '<td>' . $thofi->tp_nado . '</td>';
                echo '<td>' . $thofi->ds_observacao . '</td>';
                echo '</tr>';
            }

            echo '</tbody>
  
</table>';

            // echo '<br>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>'
            . '<th colspan="6"><div align="center">TESTE PILATES  </div></th>'
           .' <th colspan="2"><div id=noprint>
               <button type="button" class="btn btn-success" id="btnPilates" value="'.$idAluno.'">Inserir Pilates</button>
              </div></th>'
           
            . '</tr>';
            echo '<tr>      
            <th>DATA</th>           
            <th>01</th>
            <th>02</th>
            <th>03</th>
            <th>04</th>  
            <th>05</th>
            <th>Total</th>
            <th>Obs</th>
            </tr>
            </thead>
        <tbody>';


            foreach ($pilates as $pil) {
                echo '<tr>';
                echo '<td>' . $pil->dt_teste . '</td>';
                echo '<td>' . $pil->ds_001 . '</td>';
                echo '<td>' . $pil->ds_002 . '</td>';
                echo '<td>' . $pil->ds_003 . '</td>';
                echo '<td>' . $pil->ds_004 . '</td>';
                echo '<td>' . $pil->ds_005 . '</td>';
                echo '<td>' . ($pil->ds_005 + $pil->ds_004 + $pil->ds_003 + $pil->ds_002 + $pil->ds_001) . '</td>';
                echo '<td>' . $pil->ds_observacao . '</td>';
                echo '</tr>';
            }

            echo '</tbody>
  
</table>';
            // echo '<br>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>';
            echo '<th colspan="2"><div align="center">HISTÓRICO</div></th>';
            echo '</tr>';
            echo '<tr>      
            <th style=width:20px>DATA</th>
            <th>PATOLOGIAS</th>           
            </tr>
            </thead>
        <tbody>';

            foreach ($avaliacao as $aval1) {
                if ($aval1->ds_patologia != null) {
                    echo '<tr>';
                    echo '<td>' . $aval1->dt_avaliacao . '</td>';
                    echo '<td>' . $aval1->ds_patologia . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>
  
</table>';
            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>      
            <th style=width:20px>DATA</th>
            <th>CIRURGIAS</th>           
            </tr>
            </thead>
        <tbody>';


            foreach ($avaliacao as $aval2) {
                if ($aval2->ds_cirurgia != null) {
                    echo '<tr>';
                    echo '<td>' . $aval2->dt_avaliacao . '</td>';
                    echo '<td>' . $aval2->ds_cirurgia . '</td>';
                    echo '</tr>';
                }
            }
            echo '</tbody>
 
</table>';

            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>      
            <th style=width:20px>DATA</th>
            <th>MEDICAMENTOS</th>           
            </tr>
            </thead>
        <tbody>';

            foreach ($avaliacao as $aval3) {
                if ($aval3->ds_medicamento != null) {
                    echo '<tr>';
                    echo '<td>' . $aval3->dt_avaliacao . '</td>';
                    echo '<td>' . $aval3->ds_medicamento . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody> 
</table>';

            echo '<table class="quotation" style=width:700px>';
            echo '<thead>';
            echo '<tr>      
            <th style=width:20px>DATA</th>
            <th>CONDUTA</th>           
            </tr>
            </thead>
        <tbody>';


            foreach ($avaliacao as $aval4) {
                if ($aval4->ds_conduta != null) {
                    echo '<tr>';
                    echo '<td>' . $aval4->dt_avaliacao . '</td>';
                    echo '<td>' . $aval4->ds_conduta . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>
  <tfoot>
    <tr >
        <th colspan="2">Academia Harmonia Faz Bem - ' . date('d/m/Y') . '</th>
    </tr>
  </tfoot>
</table>';
        } else {
            echo 'Aluno: ' . $aluno->nm_aluno . ' não possui boletim';
        }
    }

    public function getDadosImc($idAluno) {
        $imc = Avaliacao::find()->where(['id_aluno' => $idAluno])->orderBy('dt_avaliacao ASC')->all();
        if ($imc == null) {
            return null;
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

    public function getDadosAvaliacao($id) {
        $avaliacao = Avaliacao::find()->where(['id_aluno' => $id])->orderBy('dt_avaliacao ASC')->all();
        return $avaliacao;
    }

    public function getAlunoPorId($id) {
        $avaliacao = Aluno::findOne($id);
        return $avaliacao;
    }

}
