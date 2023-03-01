<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Turma]].
 *
 * @see Turma
 */
class TurmaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Turma[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Turma|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
