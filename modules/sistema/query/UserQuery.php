<?php

namespace app\modules\sistema\query;

/**
 * This is the ActiveQuery class for [[\app\modules\sistema\models\User]].
 *
 * @see \app\modules\sistema\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\models\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\modules\sistema\models\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
