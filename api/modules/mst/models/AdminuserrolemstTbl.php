<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "adminuserrolemst_tbl".
 *
 * @property int $adminuserrolemst_pk
 * @property string $aurm_userrole
 * @property string $aurm_status Active - 1, Inactive – 0
 * @property string $aurm_createdon
 * @property int $aurm_createdby
 * @property string $aurm_updatedon
 * @property int $aurm_updatedby
 */
class AdminuserrolemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adminuserrolemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aurm_userrole'],'unique'],
            [['aurm_userrole', 'aurm_status'], 'required'],
            [['aurm_status'], 'string'],
            [['aurm_createdon', 'aurm_updatedon'], 'safe'],
            [['aurm_createdby', 'aurm_updatedby'], 'integer'],
            [['aurm_userrole'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adminuserrolemst_pk' => 'Adminuserrolemst Pk',
            'aurm_userrole' => 'Aurm Userrole',
            'aurm_status' => 'Aurm Status',
            'aurm_createdon' => 'Aurm Createdon',
            'aurm_createdby' => 'Aurm Createdby',
            'aurm_updatedon' => 'Aurm Updatedon',
            'aurm_updatedby' => 'Aurm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdminuserrolemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdminuserrolemstTblQuery(get_called_class());
    }
     public function behaviors()
            {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
                   [
                        'class' => TimeBehavior::className(),
                        'attributes' => [
                            ActiveRecord::EVENT_BEFORE_INSERT => ['aurm_createdon'],
                            ActiveRecord::EVENT_BEFORE_UPDATE => ['aurm_updatedon'],
                        ],
                    ],
                   [
                        'class' => UserBehavior::className(),
                        'attributes' => [
                            ActiveRecord::EVENT_BEFORE_INSERT => ['aurm_createdby'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                        ],
                    ],
            ];
            }
}
