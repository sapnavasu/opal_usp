<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmscontractagreementdtls_tbl".
 *
 * @property int $cmscontractagreementstls_pk Primary key
 * @property int $cmscad_cmscontractagreementhdr_fk Reference to cmscontractagreementhdr_tbl
 * @property int $cmscad_shared_type Supplier Type: 1 - JSRS, 2 - Non-JSRS
 * @property int $cmscad_shared_fk Reference to membercompanymst_tbl, cmsnonjsrssupdtls_tbl
 * @property int $cmscad_isprimarycontractor Is Primary Contractor: 1 - Yes, 2 - No
 * @property int $cmscad_status 1 - Active, 2 - Inactive
 * @property string $cmscad_createdon Date of creation
 * @property int $cmscad_createdby Reference to usermst_tbl
 * @property string $cmscad_createdbyipaddr User IP Address
 * @property string $cmscad_updatedon Date of update
 * @property int $cmscad_updatedby Reference to usermst_tbl
 * @property string $cmscad_updatedbyipaddr User IP Address
 *
 * @property CmscontractagreementhdrTbl $cmscadCmscontractagreementhdrFk
 * @property UsermstTbl $cmscadCreatedby
 * @property UsermstTbl $cmscadUpdatedby
 */
class CmscontractagreementdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmscontractagreementdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmscad_cmscontractagreementhdr_fk', 'cmscad_shared_type', 'cmscad_shared_fk', 'cmscad_isprimarycontractor', 'cmscad_status'], 'required'],
            [['cmscad_cmscontractagreementhdr_fk', 'cmscad_shared_type', 'cmscad_shared_fk', 'cmscad_isprimarycontractor', 'cmscad_status', 'cmscad_createdby', 'cmscad_updatedby'], 'integer'],
            [['cmscad_createdon', 'cmscad_updatedon'], 'safe'],
            [['cmscad_createdbyipaddr', 'cmscad_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmscad_cmscontractagreementhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmscontractagreementhdrTbl::className(), 'targetAttribute' => ['cmscad_cmscontractagreementhdr_fk' => 'cmscontractagreementhdr_pk']],
            [['cmscad_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmscad_createdby' => 'UserMst_Pk']],
            [['cmscad_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmscad_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmscontractagreementstls_pk' => 'Cmscontractagreementstls Pk',
            'cmscad_cmscontractagreementhdr_fk' => 'Cmscad Cmscontractagreementhdr Fk',
            'cmscad_shared_type' => 'Cmscad Shared Type',
            'cmscad_shared_fk' => 'Cmscad Shared Fk',
            'cmscad_isprimarycontractor' => 'Cmscad Isprimarycontractor',
            'cmscad_status' => 'Cmscad Status',
            'cmscad_createdon' => 'Cmscad Createdon',
            'cmscad_createdby' => 'Cmscad Createdby',
            'cmscad_createdbyipaddr' => 'Cmscad Createdbyipaddr',
            'cmscad_updatedon' => 'Cmscad Updatedon',
            'cmscad_updatedby' => 'Cmscad Updatedby',
            'cmscad_updatedbyipaddr' => 'Cmscad Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscadCmscontractagreementhdrFk()
    {
        return $this->hasOne(CmscontractagreementhdrTbl::className(), ['cmscontractagreementhdr_pk' => 'cmscad_cmscontractagreementhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscadCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmscad_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscadUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmscad_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmscontractagreementdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmscontractagreementdtlsTblQuery(get_called_class());
    }
}
