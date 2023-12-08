<?php

namespace api\modules\mst\models;

/**
<<<<<<< Updated upstream:api/modules/mst/models/AdminuserrolemstTblQuery.php
 * This is the ActiveQuery class for [[AdminuserrolemstTbl]].
 *
 * @see AdminuserrolemstTbl
 */
class AdminuserrolemstTblQuery extends \yii\db\ActiveQuery
=======
 * This is the ActiveQuery class for [[MemcompprofachvdtlsTbl]].
 *
 * @see MemcompprofachvdtlsTbl
 */
class MemberQuery extends \yii\db\ActiveQuery
>>>>>>> Stashed changes:api/modules/mst/models/MemberQuery.php
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
<<<<<<< Updated upstream:api/modules/mst/models/AdminuserrolemstTblQuery.php
     * @return AdminuserrolemstTbl[]|array
=======
     * @return MemcompprofachvdtlsTbl[]|array
>>>>>>> Stashed changes:api/modules/mst/models/MemberQuery.php
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
<<<<<<< Updated upstream:api/modules/mst/models/AdminuserrolemstTblQuery.php
     * @return AdminuserrolemstTbl|array|null
=======
     * @return MemcompprofachvdtlsTbl|array|null
>>>>>>> Stashed changes:api/modules/mst/models/MemberQuery.php
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
