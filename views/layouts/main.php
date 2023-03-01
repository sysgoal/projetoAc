<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use kartik\nav\NavX;
use yii\helpers\Url;

AppAsset::register($this);
//echo var_dump($usuario);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
           
            NavBar::begin([
                'brandLabel' => 'Academia Harmonia Faz Bem',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems[] = ['label' => '<i class="glyphicon glyphicon-user"></i> Search', 'url' => ['/site/search']];
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => '<i class="fas fa-address-book"></i> Agenda',
                        // 'linkOptions' => ['target'=>'_blank'],
                        'url' => ['/horario-agenda/index'], //Url::to('@web/calendario/index.php', true),                                                 
                    // 'linkOptions' => ['target'=>'_blank'],
                    //'url' =>  [ Url::to('@web/calendario/index.php', true)],
                    //'template'=> '<a href="{url}" target="_blank">{label}</a>',
                    ],
                    ['label' => '<i class="fas fa-address-card"></i> Cadastros', 'url' => ['/site/index'],
                        'items' => [
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'Aluno/Paciente', 'url' => ['/aluno/index']] : ['label' => ''],
                            // ['label' => 'Aluno/Paciente', 'url' => ['/aluno/index']],
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'Profissional', 'url' => ['/profissional/index']] : ['label' => ''],
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'Especialidade', 'url' => ['/especialidade/index']] : ['label' => ''],
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'Exercicios', 'url' => ['/exercicios/index']] : ['label' => ''],
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'Convênio', 'url' => ['/convenio/index']] : ['label' => ''],
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'Turma', 'url' => ['/turma/index']] : ['label' => ''],
                            (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => 'TurmaXAluno', 'url' => ['/turmaaluno/index']] : ['label' => ''],
                            ['label' => 'Festa das Toucas', 'url' => ['/boletim-infantil/index']],
                            ['label' => 'Nota Teste Hofi', 'url' => ['/testehofi/index']],
                            ['label' => 'Nota Pilates', 'url' => ['/testepilates/index']],
                            ['label' => 'Ficha do Aluno', 'url' => ['/ficha-aluno/index']],
                      //      ['label' => 'Backup', 'url' => ['/backup-database/backup-database']],
                            (Yii::$app->user->identity != null && Yii::$app->user->identity->permissao === 'Administrador') ? ['label' => 'Usuários', 'url' => ['/usuarios/index']] : ['label' => ''],
                        ]
                    ],
                    ['label' => '<i class="fas fa-print"></i> Relatórios', 'url' => ['/site/about'],
                        'items' => [
                            ['label' => 'Aluno/Paciente', 'options' => ['class' => 'treeview-menu'],
                                'items' => [
                                    ['label' => 'Cadastro', 'url' => ['/aluno/listaalunosrelatorio']],
                                    ['label' => 'Avaliações', 'url' => ['/aluno/listaalunosavaliacoes']],
                                    ]],
                            ['label' => 'Turma', 'url' => ['/turmaaluno/listaturma']],
                            ['label' => 'Bioimpedância', 'url' => ['/avaliacao/graficos']],                            
                            ['label' => 'Boletim do Aluno', 'url' => ['/boletim/index']],  
                            ['label' => 'Boletim Infantil', 'url' => ['/boletim-infantil/boletim']],
                            ['label' => 'Declaração', 'url' => ['/declaracao/create']],
                            ['label' => 'Relatório', 'url' => ['/relatorio/index']],
                            //['label' => 'Relatório', 'url' => ['/relatorioinformativo/create']],
                        ],
                    // ['label' => 'Avaliação', 'url' => ['/relatorio/relatorioalunoavaliacao']],
                    //  ['label' => 'Graficos', 'url' => ['/grafico/grafico1']]
                    ],
                    (Yii::$app->user->identity != null && (Yii::$app->user->identity->permissao === 'Profissional' || Yii::$app->user->identity->permissao === 'Administrador')) ? ['label' => '<i class="fas fa-chalkboard-teacher"></i> Avaliações', 'url' => ['/avaliacao/index'],
                        'items' => [
                            (Yii::$app->user->identity->permissao === 'Administrador') ? ['label' => 'Infantil', 'url' => ['/avaliacao-infantil/index']] : ['label'=>''],
                            ['label' => 'Fisioterápica', 'options' => ['class' => 'treeview-menu'],
                                'items' => [
                                    ['label' => 'Avaliação Facial', 'url' => ['/avaliacaofacial/index']],
                                    ['label' => 'Avaliação Vestibular', 'url' => ['/avaliacaovestibular/index']],
                                    ['label' => 'Coluna', 'url' => ['/avaliacaocoluna/index']],
                                    ['label' => 'Membro Inferior', 'url' => ['/avaliacaoinferior/index']],
                                    ['label' => 'Membro Superior', 'url' => ['/avaliacaosuperior/index']],
                                ]],
                            ['label' => 'Avalição da academia', 'options' => ['class' => 'treeview-menu'],
                                'items' => [
                                    ['label' => 'Avaliação', 'url' => ['/avaliacao/index']],
                                    ['label' => 'Hipopressivo', 'url' => ['/avaliacao-hipopressivo/index']],                                    
                                ]],
                        ],
                    ] : ['label'=>''],
                    Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/site/login']] :
                            [
                        'label' => '<i class="glyphicon glyphicon-user"></i> Sair (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                            ],
                ],
                'encodeLabels' => false,
            ]);

            NavBar::end();
            ?>

            <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
            <?= Alert::widget() ?>
            <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Versão 1.2 <?= date('Y') ?> </p>
            </div>
            <div id="footer-info">Desenvolvido por Sysgoal 31992381871</div>
        </footer>

                <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
