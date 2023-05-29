<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $cpf
 * @property string $permissao
 * @property string|null $email
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'cpf', 'permissao'], 'required'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['cpf'], 'integer', 'min' => 11],
            [['permissao'], 'string', 'max' => 30],
            [['email'], 'email'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuário',
            'password' => 'Senha',
            'cpf' => 'Cpf',
            'permissao' => 'Permissao',
            'email' => 'Email',
        ];
    }
    
    public function exportData()
    {
        $data = $this->find()->asArray()->all();
        $filename = 'backup_usuarios_'.date('Y-m-d').'.csv';
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
