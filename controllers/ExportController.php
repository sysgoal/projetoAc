<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Aluno;
use app\models\Avaliacao;
use app\models\AvaliacaoSuperior;
use app\models\AvaliacaoInferior;
use app\models\AvaliacaoHipopressivo;
use app\models\AvaliacaoFacial;
use app\models\AvaliacaoVestibular;
use app\models\AvaliacaoInfantil;
use app\models\Convenio;
use app\models\Declaracao;
use app\models\Especialidade;
use app\models\Exercicios;
use app\models\FichaAluno;
use app\models\HorarioAgenda;
use app\models\Profissional;
use app\models\TesteHofi;
use app\models\TestePilates;
use app\models\Turma;
use app\models\TurmaAluno;
use app\models\Usuarios;
use app\models\BoletimInfantil;
use ZipArchive;

class ExportController extends Controller
{
    public function actionIndex()
    {
        $aluno = new Aluno();
        $avaliacao = new Avaliacao();
        $avaliacaoHipo = new AvaliacaoHipopressivo();
        $avaliacaoSuperior = new AvaliacaoSuperior();
        $avaliacaoInferor = new AvaliacaoInferior();
        $avaliacaoFacial = new AvaliacaoFacial();
        $avaliacaoVestibular = new AvaliacaoVestibular();
        $avaliacaoInfantil = new AvaliacaoInfantil();
        $convenio = new Convenio();
        $especialidade = new Especialidade();
        $exercicios = new Exercicios();
        $fichaAluno = new FichaAluno();
        $horarios = new HorarioAgenda();
        $profissional = new Profissional();
        $testeHofi = new TesteHofi();
        $testePilates = new TestePilates();
        $turma = new Turma();
        $turmaAluno = new TurmaAluno();
        $usuarios = new Usuarios();
        $boletimInfantil = new BoletimInfantil();
        
        // Lista de arquivos CSV a serem juntados
        $csvFiles[] = $aluno->exportData();
        $csvFiles[] = $avaliacao->exportData();
        $csvFiles[] = $avaliacaoFacial->exportData();
        $csvFiles[] = $avaliacaoHipo->exportData();
        $csvFiles[] = $avaliacaoInferor->exportData();
        $csvFiles[] = $avaliacaoSuperior->exportData();
        $csvFiles[] = $avaliacaoVestibular->exportData();
        $csvFiles[] = $avaliacaoInfantil->exportData();
        $csvFiles[] = $convenio->exportData();
        $csvFiles[] = $especialidade->exportData();
        $csvFiles[] = $exercicios->exportData();
        $csvFiles[] = $fichaAluno->exportData();
        $csvFiles[] = $horarios->exportData();
        $csvFiles[] = $profissional->exportData();
        $csvFiles[] = $testeHofi->exportData();
        $csvFiles[] = $testePilates->exportData();
        $csvFiles[] = $turma->exportData();
        $csvFiles[] = $turmaAluno->exportData();
        $csvFiles[] = $usuarios->exportData();
        $csvFiles[] = $boletimInfantil->exportData();
        
        //return Yii::$app->response->sendFile($csvFiles);
        // Cria o arquivo ZIP
        $zipFile = Yii::getAlias('@app/runtime/backup_csv_academia_'.date('Y-m-d').'.zip');
        $zip = new ZipArchive();
        $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($csvFiles as $csvFile) {
            $zip->addFile($csvFile, basename($csvFile));
        }

        // Fecha o arquivo ZIP
        $zip->close();
        
        
        // Define o cabeçalho de resposta para o tipo de arquivo ZIP
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/zip');
        Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="backup_csv_academia_'.date('Y-m-d').'.zip"');
        
        
        return Yii::$app->response->sendFile($zipFile);
        
    }

}



