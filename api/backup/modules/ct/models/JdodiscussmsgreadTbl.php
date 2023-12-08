<?php

namespace api\modules\ct\models;


/**
 * This is the model class for table "jdodiscussmsgread_tbl".
 *
 * @property int $jdodiscussmsgread_pk Primary key
 * @property int $jddmr_jdodiscussdtl_fk Reference to jdodiscussdtl_tbl
 * @property int $jddmr_received_jdodiscussmember_fk Reference to jdodiscussmember_tbl
 * @property int $jddmr_isread Read status. 1 - Unread, 2 - Read
 * @property int $jddmr_isdeleted 1 - Yes, 2 - No
 * @property string $jddmr_createdon Date of creation
 * @property int $jddmr_createdby Reference to usermst_tbl
 * @property string $jddmr_createdbyipaddr User IP Address
 * @property string $jddmr_updatedon Date of update
 * @property string $jddmr_updatedby Reference to usermst_tbl
 * @property string $jddmr_updatedbyipaddr User IP Address
 * 
 **/

class JdodiscussmsgreadTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdodiscussmsgread_tbl';
    }
    
     /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jddmr_jdodiscussdtl_fk', 'jddmr_received_jdodiscussmember_fk', 'jddmr_isread', 'jddmr_isdeleted', 'jddmr_createdby'], 'required'],
            [['jddmr_jdodiscussdtl_fk', 'jddmr_received_jdodiscussmember_fk', 'jddmr_isread', 'jddmr_isdeleted', 'jddmr_createdby'], 'integer'],
            [['jddmr_createdon', 'jddmr_updatedon'], 'safe'],
            [['jddmr_createdbyipaddr', 'jddmr_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }
    
}