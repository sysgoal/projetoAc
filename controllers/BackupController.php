<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use Date;

class BackupController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->id) {
            $db = Yii::$app->db;
            $dbName = $db->createCommand('SELECT DATABASE()')->queryScalar();
            $nomeArquivo = 'backup_'.date('Y-m-d').'.sql';
            $backupFile = Yii::$app->basePath . '\\web\\backups\\' . $nomeArquivo;

            // Executar o comando de backup usando o utilitário mysqldump
            exec("mysqldump -u " . $db->username . " -p" . $db->password . " " . $dbName . " > $backupFile");
            echo"<br>"."mysqldump -u" . $db->username . " -p" . $dn . " " . $db->dsn . " > $backupFile";
            echo "Backup da base de dados criado com sucesso em: $backupFile\n";
         
        }else{
            return $this->redirect(['site/about']);
        }
    }
}
