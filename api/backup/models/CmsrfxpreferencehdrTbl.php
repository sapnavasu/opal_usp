<?php

namespace api\models;

use Yii;
use common\models\UsermstTbl;
use common\models\MembercompanymstTbl;

/**
 * This is the model class for table "cmsrfxpreferencehdr_tbl".
 *
 * @property int $cmsrfxpreferencehdr_pk Primary key
 * @property int $crfxph_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $crfxph_title Preference Title
 * @property string $crfxph_criteria Criteria
 * @property array $crfxph_criteriabag Criteria Bag
 * @property int $crfxph_status 1 - Active, 2 - Inactive
 * @property string $crfxph_createdon Date of creation
 * @property int $crfxph_createdby Reference to usermst_tbl
 * @property string $crfxph_createdbyipaddr User IP Address
 * @property string $crfxph_updatedon Date of update
 * @property int $crfxph_updatedby Reference to usermst_tbl
 * @property string $crfxph_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $crfxphCreatedby
 * @property MembercompanymstTbl $crfxphMemcompmstFk
 * @property UsermstTbl $crfxphUpdatedby
 */
class CmsrfxpreferencehdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrfxpreferencehdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crfxph_memcompmst_fk', 'crfxph_title', 'crfxph_criteria', 'crfxph_status'], 'required'],
            [['crfxph_memcompmst_fk', 'crfxph_status', 'crfxph_createdby', 'crfxph_updatedby'], 'integer'],
            [['crfxph_title', 'crfxph_criteria'], 'string'],
            [['crfxph_criteriabag', 'crfxph_createdon', 'crfxph_updatedon'], 'safe'],
            [['crfxph_createdbyipaddr', 'crfxph_updatedbyipaddr'], 'string', 'max' => 50],
            [['crfxph_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crfxph_createdby' => 'UserMst_Pk']],
            [['crfxph_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['crfxph_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['crfxph_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crfxph_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrfxpreferencehdr_pk' => 'Cmsrfxpreferencehdr Pk',
            'crfxph_memcompmst_fk' => 'Crfxph Memcompmst Fk',
            'crfxph_title' => 'Crfxph Title',
            'crfxph_criteria' => 'Crfxph Criteria',
            'crfxph_criteriabag' => 'Crfxph Criteriabag',
            'crfxph_status' => 'Crfxph Status',
            'crfxph_createdon' => 'Crfxph Createdon',
            'crfxph_createdby' => 'Crfxph Createdby',
            'crfxph_createdbyipaddr' => 'Crfxph Createdbyipaddr',
            'crfxph_updatedon' => 'Crfxph Updatedon',
            'crfxph_updatedby' => 'Crfxph Updatedby',
            'crfxph_updatedbyipaddr' => 'Crfxph Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfxphCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crfxph_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfxphMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'crfxph_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrfxphUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crfxph_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrfxpreferencehdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrfxpreferencehdrTblQuery(get_called_class());
    }
}
