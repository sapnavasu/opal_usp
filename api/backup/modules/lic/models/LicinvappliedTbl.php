<?php

namespace api\modules\lic\models;

use Yii;

/**
 * This is the model class for table "licinvapplied_tbl".
 *
 * @property int $licinvapplied_pk Primary key
 * @property int $lia_projectdtls_fk Reference to projectdtls_tbl Towards which project the Investor has applied license for
 * @property int $lia_licensinginfo_fk Reference to licensinginfo_tbl. The license which is applied by the investor
 * @property int $lia_memregmst_fk Reference to memberregistrationmst_tbl. Investor reference who have applied the license
 * @property string $lia_applicationno Application number
 * @property string $lia_applsubmon Application Submitted date (Offline)
 * @property int $lia_status 1 - Approved, 2 - Cancelled, 3 - Declined, 4 - Submitted, 5 - Re-submitted, 6 - Not Applicable
 * @property int $lia_createdby Record created by user id
 * @property string $lia_createdbyipaddr IP Address of the user
 * @property string $lia_createdon
 * @property int $lia_updatedby Record updated by user id
 * @property string $lia_updatedbyipaddr IP Address of the user
 * @property string $lia_updatedon
 * @property string $lia_appdeclon Approval / Declined on date & time
 * @property int $lia_appdeclby Approval / Declined by user id
 * @property string $lia_appdeclbyipaddr IP Address of the user
 * @property string $lia_comments Comments
 * @property string $lia_appdeclcomment
 */
class LicinvappliedTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licinvapplied_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lia_projectdtls_fk', 'lia_licensinginfo_fk', 'lia_memregmst_fk', 'lia_status', 'lia_createdby', 'lia_updatedby', 'lia_appdeclby'], 'integer'],
            [['lia_licensinginfo_fk', 'lia_memregmst_fk', 'lia_applicationno', 'lia_applsubmon', 'lia_status', 'lia_createdby', 'lia_createdon'], 'required'],
            [['lia_applsubmon', 'lia_createdon', 'lia_updatedon', 'lia_appdeclon'], 'safe'],
            [['lia_comments', 'lia_appdeclcomment'], 'string'],
            [['lia_applicationno'], 'string', 'max' => 30],
            [['lia_createdbyipaddr', 'lia_updatedbyipaddr', 'lia_appdeclbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licinvapplied_pk' => 'Licinvapplied Pk',
            'lia_projectdtls_fk' => 'Lia Projectdtls Fk',
            'lia_licensinginfo_fk' => 'Lia Licensinginfo Fk',
            'lia_memregmst_fk' => 'Lia Memregmst Fk',
            'lia_applicationno' => 'Lia Applicationno',
            'lia_applsubmon' => 'Lia Applsubmon',
            'lia_status' => 'Lia Status',
            'lia_createdby' => 'Lia Createdby',
            'lia_createdbyipaddr' => 'Lia Createdbyipaddr',
            'lia_createdon' => 'Lia Createdon',
            'lia_updatedby' => 'Lia Updatedby',
            'lia_updatedbyipaddr' => 'Lia Updatedbyipaddr',
            'lia_updatedon' => 'Lia Updatedon',
            'lia_appdeclon' => 'Lia Appdeclon',
            'lia_appdeclby' => 'Lia Appdeclby',
            'lia_appdeclbyipaddr' => 'Lia Appdeclbyipaddr',
            'lia_comments' => 'Lia Comments',
            'lia_appdeclcomment' => 'Lia Appdeclcomment',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicinvappliedTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicinvappliedTblQuery(get_called_class());
    }
}
