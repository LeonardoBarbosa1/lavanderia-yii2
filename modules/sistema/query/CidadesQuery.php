<?php

namespace app\modules\sistema\query;

/**
 * This is the ActiveQuery class for [[\app\modules\sistema\models\Cidades]].
 *
 * @see \app\modules\sistema\models\Cidades
 */
class CidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\models\Cidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\models\Cidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
