<?php

namespace api\modules\mst\models;

/**
<<<<<<< Updated upstream:api/modules/mst/models/OpentendersTblQuery.php
 * This is the ActiveQuery class for [[OpentendersTbl]].
 *
 * @see OpentendersTbl
 */
class OpentendersTblQuery extends \yii\db\ActiveQuery
=======
 * This is the ActiveQuery class for [[LanguagemstTbl]].
 *
 * @see LanguagemstTbl
 */
class LanguagemstTblQuery extends \yii\db\ActiveQuery
>>>>>>> Stashed changes:api/modules/mst/models/LanguagemstTblQuery.php
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
<<<<<<< Updated upstream:api/modules/mst/models/OpentendersTblQuery.php
     * @return OpentendersTbl[]|array
=======
     * @return LanguagemstTbl[]|array
>>>>>>> Stashed changes:api/modules/mst/models/LanguagemstTblQuery.php
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
<<<<<<< Updated upstream:api/modules/mst/models/OpentendersTblQuery.php
     * @return OpentendersTbl|array|null
=======
     * @return LanguagemstTbl|array|null
>>>>>>> Stashed changes:api/modules/mst/models/LanguagemstTblQuery.php
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
