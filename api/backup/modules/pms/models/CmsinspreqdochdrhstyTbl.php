<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "cmsinspreqdochdrhsty_tbl".
 *
 * @property int $cmsinspreqdochdrhsty_pk Primary key
 * @property int $cirdhh_cmsinspreqdochdr_fk Reference to cmsinspreqdochdr_tbl.cmsinspreqdochdr_pk
 * @property int $cirdhh_cmstnchdr_fk Reference to cmstnchdr_tbl
 * @property int $cirdhh_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdrhsty_tbl, cmscontracthdr_tbl
 * @property int $cirdhh_shared_type 1 - Requisition/ Tender Notice, 2 - Enquiry (RFP, RFQ) 3 - Contract/ Purchase Order
 * @property string $cirdhh_itprefno Inspection Test Plan (ITP) Reference No
 * @property string $cirdhh_itpdate ITP Date
 * @property int $cirdhh_itpusermst_fk ITP Issued By: Reference to usermst_tbl
 * @property string $cirdhh_technote Technical Notes
 * @property string $cirdhh_generalnote General Notes
 * @property string $cirdhh_applspec Applicable Specifications
 * @property int $cirdhh_status 1 - Active, 2 - Inactive
 * @property string $cirdhh_createdon Date of creation
 * @property int $cirdhh_createdby Reference to usermst_tbl
 * @property string $cirdhh_createdbyipaddr User IP Address
 * @property string $cirdhh_updatedon Date of update
 * @property int $cirdhh_updatedby Reference to usermst_tbl
 * @property string $cirdhh_updatedbyipaddr User IP Address
 *
 * @property CmstnchdrTbl $cirdhhCmstnchdrFk
 * @property UsermstTbl $cirdhhCreatedby
 * @property UsermstTbl $cirdhhItpusermstFk
 * @property UsermstTbl $cirdhhUpdatedby
 */
class CmsinspreqdochdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdochdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdhh_cmsinspreqdochdr_fk', 'cirdhh_cmstnchdr_fk', 'cirdhh_shared_fk', 'cirdhh_shared_type', 'cirdhh_itprefno', 'cirdhh_itpdate', 'cirdhh_itpusermst_fk', 'cirdhh_status', 'cirdhh_createdon', 'cirdhh_createdby'], 'required'],
            [['cirdhh_cmsinspreqdochdr_fk', 'cirdhh_cmstnchdr_fk', 'cirdhh_shared_fk', 'cirdhh_shared_type', 'cirdhh_itpusermst_fk', 'cirdhh_status', 'cirdhh_createdby', 'cirdhh_updatedby'], 'integer'],
            [['cirdhh_itpdate', 'cirdhh_createdon', 'cirdhh_updatedon'], 'safe'],
            [['cirdhh_technote', 'cirdhh_generalnote', 'cirdhh_applspec'], 'string'],
            [['cirdhh_itprefno', 'cirdhh_createdbyipaddr', 'cirdhh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cirdhh_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['cirdhh_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['cirdhh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdhh_createdby' => 'UserMst_Pk']],
            [['cirdhh_itpusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdhh_itpusermst_fk' => 'UserMst_Pk']],
            [['cirdhh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdhh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdochdrhsty_pk' => 'Cmsinspreqdochdrhsty Pk',
            'cirdhh_cmsinspreqdochdr_fk' => 'Cirdhh Cmsinspreqdochdr Fk',
            'cirdhh_cmstnchdr_fk' => 'Cirdhh Cmstnchdr Fk',
            'cirdhh_shared_fk' => 'Cirdhh Shared Fk',
            'cirdhh_shared_type' => 'Cirdhh Shared Type',
            'cirdhh_itprefno' => 'Cirdhh Itprefno',
            'cirdhh_itpdate' => 'Cirdhh Itpdate',
            'cirdhh_itpusermst_fk' => 'Cirdhh Itpusermst Fk',
            'cirdhh_technote' => 'Cirdhh Technote',
            'cirdhh_generalnote' => 'Cirdhh Generalnote',
            'cirdhh_applspec' => 'Cirdhh Applspec',
            'cirdhh_status' => 'Cirdhh Status',
            'cirdhh_createdon' => 'Cirdhh Createdon',
            'cirdhh_createdby' => 'Cirdhh Createdby',
            'cirdhh_createdbyipaddr' => 'Cirdhh Createdbyipaddr',
            'cirdhh_updatedon' => 'Cirdhh Updatedon',
            'cirdhh_updatedby' => 'Cirdhh Updatedby',
            'cirdhh_updatedbyipaddr' => 'Cirdhh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhhCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'cirdhh_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdhh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhhItpusermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdhh_itpusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdhh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdochdrhstyTblQuery(get_called_class());
    }
}
