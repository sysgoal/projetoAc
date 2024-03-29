<?php

use bsadnu\googlecharts\ComboChart;
use yii\helpers\Html;

$imc = $model->getDadosImc($id);
$gordura = $model->getDadosGorduraCorporal($id);
$avaliacaos = $model->getDadosTodasAvaliacao($id);
$cinturaQuadril = $model->getDadosCinturaQuadril($id);
$visceral = $model->getDadosGorduraVisceral($id);
$esqueletico = $model->getDadosMusculoEsqueletico($id);
$model = $model->getDadosAvaliacaoHipo($id);

$idImc = 0;
$idGordura = 0;
$idCintura = 0;
$idVisceral = 0;
$idEsqueletico = 0;
foreach ($avaliacaos as $controle) {
    if ($controle->ds_imc != null && $controle->ds_imc != 0) {
        $idImc++;
    }
    if ($controle->ds_massa_gorda != null && $controle->ds_massa_gorda != 0) {
        $idGordura++;
    }
    if (
        $controle->ds_quadril != null && $controle->ds_quadril != 0
        && $controle->ds_cintura != null &&  $controle->ds_cintura != 0
    ) {
        $idCintura++;
    }
    if ($controle->ds_gordura_visceral != null && $controle->ds_gordura_visceral != 0) {
        $idVisceral++;
    }
    if ($controle->ds_massa_magra != null && $controle->ds_massa_magra != 0) {
        $idEsqueletico++;
    }
}


$css = "
        
table.quotation {
  border: 3px solid #037547;
  border-collapse: collapse;
  margin: 0 auto;
}

.quotation thead,tfoot {
  border-width: 3px;
  border-style: solid;
}

.quotation th,.quotation td{
  border: 1px solid #037547;
  color: #037547;
  padding: 4px 25px;
  width: auto;
}

.quotation thead th,
.quotation tfoot th{
  background-color: #E0EBE3;
}

.quotation tbody td {
  background-color: #FFFBFE;
}
@media print { 
#noprint { display:none; } 
body { background: #fff;
 width: 150mm;
            height: 220mm; 
}
}

";

$script = <<< JS
   
$(document).ready(function(){
        
        
        
 });
        
JS;
$this->registerJsFile('https://www.gstatic.com/charts/loader.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js');
$this->registerJs($script);
$this->registerCss($css);
?>
<?php
echo $model->getNavBar();
?>


<br>
<div id="oculta">

    <br>
    <div id="noprint">
        <p align="center">
            <a href="javascript:;" onclick="window.print();return false">
                <?= Html::buttonInput('Imprimir', ['class' => 'btn btn-success', 'id' => 'myButton',]) ?>
            </a>

        </p>
    </div>
    <div class="print" id="print">
        <table class="quotation" style="width:85%">
            <thead>
                <tr>
                    <th colspan="2">Avaliador: <?php echo $model->profissional->nm_profissional ?> | CREF: <?php echo $model->profissional->nr_registro ?> </th>

                </tr>
                <tr>
                    <th colspan="2">Aluno: <b><?php echo $model->aluno->nm_aluno ?> | </b> Idade: <b> <?php echo $model->aluno->getIdade() ?> anos</b> </th>

                </tr>
                <tr>
                    <th colspan="2">Peso: <?php echo $model->ds_peso ?> Kg | Altura: <?php echo $model->ds_altura ?> m</th>

                </tr>
            </thead>
            <tbody>


                <tr>
                    <th>
                        <?php
                        if ($idImc != 0) {
                            echo ComboChart::widget([
                                'id' => 'my-simple-area-chart-id',
                                'data' => $imc,
                                'options' => [
                                    'chartArea' => [
                                        'left' => '15%',
                                        'width' => '60%',
                                        'height' => 350
                                    ],
                                    // 'MaxValue' => 50,
                                    'width' => 900,
                                    'height' => 400,
                                    'isStacked' => true,
                                    'legend' => 'bottom',
                                    'seriesType' => 'area',
                                    'areaOpacity' => 0.4,

                                    'series' => [
                                        0 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        1 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        2 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        3 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        4 => [
                                            'type' => 'line',
                                            'color' => 'yellow',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        5 => [
                                            'type' => 'line',
                                            'color' => 'green',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        6 => [
                                            'type' => 'line',
                                            'color' => '#FF6633',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        7 => [
                                            'type' => 'line',
                                            'color' => 'red',
                                            'pointSize' => 4,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                            'lineWidth' => 1,
                                        ],
                                        8 => [
                                            'type' => 'line',
                                            'color' => 'black',
                                            'pointSize' => 10,
                                            'pointShape' => 'square',
                                        ]
                                    ],
                                    'colors' => ['yellow', 'green', '#FF6633', 'red'],
                                    'pointSize' => 4,
                                    'vAxis' => [
                                        'title' => 'Valor do IMC',
                                        'titleTextStyle' => [
                                            'fontSize' => 13,
                                            'italic' => false
                                        ],
                                        'viewWindow' => [
                                            'min' => 0,
                                            'max' => 40
                                        ]
                                    ],
                                    'legend' => [
                                        'position' => 'top',
                                        'alignment' => 'end',
                                        'textStyle' => [
                                            'fontSize' => 12
                                        ]
                                    ],
                                ]
                            ]);
                        }
                        ?>
                    </th>
                    <th> <?php
                            if ($idImc != 0) {
                                echo '<table><tr><td>Data</td><td>Imc</td></tr>';
                                foreach ($avaliacaos as $aval) {
                                    echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . $aval->ds_imc . '</td></tr>';
                                }
                                echo '</table>';
                            }
                            ?></th>
                </tr>

                <tr>
                    <th>
                        <br>
                        <br>
                        <?php
                        if ($idGordura != 0) {
                            echo ComboChart::widget([
                                'id' => 'gorduraCorporal',
                                'data' => $gordura,
                                'options' => [
                                    'chartArea' => [
                                        'left' => '15%',
                                        'width' => '60%',
                                        'height' => 350
                                    ],
                                    // 'MaxValue' => 50,
                                    'width' => 900,
                                    'height' => 400,
                                    'isStacked' => true,
                                    'legend' => 'bottom',
                                    'seriesType' => 'area',
                                    'areaOpacity' => 0.4,
                                    'series' => [
                                        0 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        1 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        2 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        3 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        4 => [
                                            'type' => 'line',
                                            'color' => 'yellow',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        5 => [
                                            'type' => 'line',
                                            'color' => 'green',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        6 => [
                                            'type' => 'line',
                                            'color' => '#FF6633',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        7 => [
                                            'type' => 'line',
                                            'color' => 'red',
                                            'pointSize' => 4,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                            'lineWidth' => 1,
                                        ],
                                        8 => [
                                            'type' => 'line',
                                            'color' => 'black',
                                            'pointSize' => 10,
                                            'pointShape' => 'square',
                                        ]
                                    ],
                                    'colors' => ['yellow', 'green', '#FF6633', 'red'],
                                    'pointSize' => 4,
                                    'vAxis' => [
                                        'title' => '% gordura corporal',
                                        'titleTextStyle' => [
                                            'fontSize' => 13,
                                            'italic' => false
                                        ],
                                        'viewWindow' => [
                                            'min' => 0,
                                            'max' => 50
                                        ]
                                    ],
                                    'legend' => [
                                        'position' => 'top',
                                        'alignment' => 'end',
                                        'textStyle' => [
                                            'fontSize' => 12
                                        ]
                                    ],
                                ]
                            ]);
                        }
                        ?>
                    </th>
                    <th> <?php
                            if ($idGordura != 0) {
                                echo '<table><tr><td>Data</td><td>% Gordura</td></tr>';
                                foreach ($avaliacaos as $aval) {
                                    echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . $aval->ds_massa_gorda . '</td></tr>';
                                }
                                echo '</table>';
                            }
                            ?></th>
                </tr>

                <tr>
                    <th>
                        <?php
                        if ($idCintura != 0) {
                            echo ComboChart::widget([
                                'id' => 'cinturaQuadril',
                                'data' => $cinturaQuadril,
                                'options' => [
                                    'chartArea' => [
                                        'left' => '15%',
                                        'width' => '60%',
                                        'height' => 350
                                    ],
                                    // 'MaxValue' => 50,
                                    'width' => 900,
                                    'height' => 400,
                                    'isStacked' => true,
                                    'legend' => 'bottom',
                                    'seriesType' => 'area',
                                    'areaOpacity' => 0.4,
                                    'series' => [
                                        0 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        1 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        2 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        3 => [
                                            'type' => 'line',
                                            'color' => 'yellow',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        4 => [
                                            'type' => 'line',
                                            'color' => 'green',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        5 => [
                                            'type' => 'line',
                                            'color' => '#FF6633',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        6 => [
                                            'type' => 'line',
                                            'color' => 'black',
                                            'pointSize' => 10,
                                            'pointShape' => 'square',
                                        ]
                                    ],
                                    'colors' => ['yellow', 'green', '#FF6633'],
                                    'pointSize' => 4,
                                    'vAxis' => [
                                        'title' => 'Relação Cintura - Quadril (RCQ)',
                                        'titleTextStyle' => [
                                            'fontSize' => 13,
                                            'italic' => false
                                        ],
                                        'viewWindow' => [
                                            'min' => 0,
                                            'max' => 1.5
                                        ]
                                    ],
                                    'legend' => [
                                        'position' => 'top',
                                        'alignment' => 'end',
                                        'textStyle' => [
                                            'fontSize' => 12
                                        ]
                                    ],
                                ]
                            ]);
                        }
                        ?>
                    </th>
                    <th> <?php
                            if ($idCintura != 0) {
                                echo '<table><tr><td>Data</td><td>Cintura/Quadril</td></tr>';
                                foreach ($avaliacaos as $aval) {
                                    if ($aval->ds_quadril != 0 && $aval->ds_cintura != null) {
                                        echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . ($aval->ds_cintura / $aval->ds_quadril) . '</td></tr>';
                                    } else {
                                        echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>0</td></tr>';
                                    }
                                }
                                echo '</table>';
                            }
                            ?>
                    </th>
                </tr>

                <tr>
                    <th>
                        <?php
                        if ($idVisceral != 0) {
                            echo ComboChart::widget([
                                'id' => 'gorduraVisceral',
                                'data' => $visceral,
                                'options' => [
                                    'chartArea' => [
                                        'left' => '15%',
                                        'width' => '60%',
                                        'height' => 350
                                    ],
                                    // 'MaxValue' => 50,
                                    'width' => 900,
                                    'height' => 400,
                                    'isStacked' => true,
                                    'legend' => 'bottom',
                                    'seriesType' => 'area',
                                    'areaOpacity' => 0.4,
                                    'series' => [
                                        0 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        1 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        2 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        3 => [
                                            'type' => 'line',
                                            'color' => 'yellow',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        4 => [
                                            'type' => 'line',
                                            'color' => 'green',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        5 => [
                                            'type' => 'line',
                                            'color' => '#FF6633',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        6 => [
                                            'type' => 'line',
                                            'color' => 'black',
                                            'pointSize' => 10,
                                            'pointShape' => 'square',
                                        ]
                                    ],
                                    'colors' => ['yellow', 'green', '#FF6633'],
                                    'pointSize' => 4,
                                    'vAxis' => [
                                        'title' => 'Gordura Visceral Relativo',
                                        'titleTextStyle' => [
                                            'fontSize' => 13,
                                            'italic' => false
                                        ],
                                        'viewWindow' => [
                                            'min' => 0,
                                            'max' => 20
                                        ]
                                    ],
                                    'legend' => [
                                        'position' => 'top',
                                        'alignment' => 'end',
                                        'textStyle' => [
                                            'fontSize' => 12
                                        ]
                                    ],
                                ]
                            ]);
                        }
                        ?>
                    </th>
                    <th> <?php
                            if ($idVisceral != 0) {
                                echo '<table><tr><td>Data</td><td>Gordura Visceral</td></tr>';
                                foreach ($avaliacaos as $aval) {
                                    echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . $aval->ds_gordura_visceral . '</td></tr>';
                                }
                                echo '</table>';
                            }
                            ?>
                    </th>
                </tr>

                <tr>
                    <th>
                        <br>
                        <br>
                        <?php
                        if ($idEsqueletico != 0) {
                            echo ComboChart::widget([
                                'id' => 'massaEsqueletica',
                                'data' => $esqueletico,
                                'options' => [
                                    'chartArea' => [
                                        'left' => '15%',
                                        'width' => '60%',
                                        'height' => 350
                                    ],
                                    // 'MaxValue' => 50,
                                    'width' => 900,
                                    'height' => 400,
                                    'isStacked' => true,
                                    'legend' => 'bottom',
                                    'seriesType' => 'area',
                                    'areaOpacity' => 0.4,
                                    'series' => [
                                        0 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        1 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        2 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        3 => [
                                            'lineWidth' => 0,
                                            'visibleInLegend' => false,
                                            'enableInteractivity' => false,
                                        ],
                                        4 => [
                                            'type' => 'line',
                                            'color' => 'yellow',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        5 => [
                                            'type' => 'line',
                                            'color' => 'green',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        6 => [
                                            'type' => 'line',
                                            'color' => '#FF6633',
                                            'pointSize' => 4,
                                            'lineWidth' => 1,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                        ],
                                        7 => [
                                            'type' => 'line',
                                            'color' => 'red',
                                            'pointSize' => 4,
                                            'pointShape' => 'square',
                                            'visibleInLegend' => true,
                                            'lineWidth' => 1,
                                        ],
                                        8 => [
                                            'type' => 'line',
                                            'color' => 'black',
                                            'pointSize' => 10,
                                            'pointShape' => 'square',
                                        ]
                                    ],
                                    'colors' => ['yellow', 'green', '#FF6633', 'red'],
                                    'pointSize' => 4,
                                    'vAxis' => [
                                        'title' => 'Músculo Esquelético',
                                        'titleTextStyle' => [
                                            'fontSize' => 13,
                                            'italic' => false
                                        ],
                                        'viewWindow' => [
                                            'min' => 0,
                                            'max' => 50
                                        ]
                                    ],
                                    'legend' => [
                                        'position' => 'top',
                                        'alignment' => 'end',
                                        'textStyle' => [
                                            'fontSize' => 12
                                        ]
                                    ],
                                ]
                            ]);
                        }
                        ?>
                    </th>
                    <th> <?php
                            if ($idEsqueletico != 0) {
                                echo '<table><tr><td>Data</td><td>Músculo Esquelético</td></tr>';
                                foreach ($avaliacaos as $aval) {
                                    echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . $aval->ds_massa_magra . '</td></tr>';
                                }
                                echo '</table>';
                            }
                            ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php
                                    echo '<table><tr><td> Data</td><td colspan=2>Antebraço</td>
                        <td colspan=2>Braço Rel. M</td><td colspan=2> Braço Cont.
                        </td><td colspan=2> Coxa M.</td><td colspan=2> Panturrilha</td></tr>';
                                    echo '<tr><td></td><td>Dir</td><td>Esq</td><td>Dir</td><td>Esq</td><td>Dir</td><td>Esq</td><td>Dir
                        </td><td>Esq</td><td>Dir</td><td>Esq</td><td> Abd.</td><td> Quadril</td><td> Cint.</td><td> 
                        Tórax</td><td> Ombro</td><td> Pesc.</td></tr>';
                                    foreach ($avaliacaos as $aval) {
                                        echo '<tr><td>' . $aval->dt_avaliacao . '</td><td>' . $aval->ds_antebraco_d . '</td><td>' . $aval->ds_antebraco_e . '</td>
                            <td>' . $aval->ds_braco_relax_d . '</td><td>' . $aval->ds_braco_relax_e . '</td>
                            <td>' . $aval->ds_braco_cont_d . '</td><td>' . $aval->ds_braco_cont_e . '</td>
                            <td>' . $aval->ds_coxa_med_d . '</td><td>' . $aval->ds_coxa_med_e . '</td>
                            <td>' . $aval->ds_panturrilha_d . '</td><td>' . $aval->ds_panturrilha_e . '</td>
                            <td>' . $aval->ds_abdomen . '</td><td>' . $aval->ds_quadril . '</td><td>' . $aval->ds_cintura . '</td>
                            <td>' . $aval->ds_torax . '</td><td>' . $aval->ds_ombro . '</td><td>' . $aval->ds_pescoco . '</td>
                            </tr>';
                                    }
                                    echo '</table>';
                                    ?>
                    </th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Academia Harmonia Faz Bem - <?php echo date('Y') ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>