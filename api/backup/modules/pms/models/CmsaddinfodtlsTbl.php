<?php

namespace api\modules\pms\models;
use \common\models\UsermstTbl;
use common\components\Security;

use Yii;

/**
 * This is the model class for table "cmsaddinfodtls_tbl".
 *
 * @property int $cmsaddinfodtls_pk Primary key
 * @property int $caid_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property string $caid_title Title
 * @property string $caid_description Description
 * @property int $caid_index index
 * @property int $caid_status 1 - Active, 2 - Inactive
 * @property string $caid_createdon Date of creation
 * @property int $caid_createdby Reference to usermst_tbl
 * @property string $caid_createdbyipaddr User IP Address
 * @property string $caid_updatedon Date of update
 * @property int $caid_updatedby Reference to usermst_tbl
 * @property string $caid_updatedbyipaddr User IP Address
 *
 * @property CmstenderhdrTbl $caidCmstenderhdrFk
 * @property UsermstTbl $caidCreatedby
 * @property UsermstTbl $caidUpdatedby
 */
class CmsaddinfodtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsaddinfodtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caid_cmstenderhdr_fk', 'caid_title', 'caid_description', 'caid_status'], 'required'],
            [['caid_cmstenderhdr_fk', 'caid_index', 'caid_status', 'caid_createdby', 'caid_updatedby'], 'integer'],
            [['caid_title', 'caid_description'], 'string'],
            [['caid_createdon', 'caid_updatedon'], 'safe'],
            [['caid_createdbyipaddr', 'caid_updatedbyipaddr'], 'string', 'max' => 50],
            [['caid_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['caid_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['caid_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['caid_createdby' => 'UserMst_Pk']],
            [['caid_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['caid_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsaddinfodtls_pk' => 'Cmsaddinfodtls Pk',
            'caid_cmstenderhdr_fk' => 'Caid Cmstenderhdr Fk',
            'caid_title' => 'Caid Title',
            'caid_description' => 'Caid Description',
            'caid_index' => 'Caid Index',
            'caid_status' => 'Caid Status',
            'caid_createdon' => 'Caid Createdon',
            'caid_createdby' => 'Caid Createdby',
            'caid_createdbyipaddr' => 'Caid Createdbyipaddr',
            'caid_updatedon' => 'Caid Updatedon',
            'caid_updatedby' => 'Caid Updatedby',
            'caid_updatedbyipaddr' => 'Caid Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidCmstenderhdrFk()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'caid_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'caid_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'caid_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsaddinfodtlsTblQuery(get_called_class());
    }

    public static function deletereqaddinfo($addinfopk) {
        $result = array(
            'status' => 200,
            'msg' => 'failure',
            'flag' => 'U',
            'comments' => 'Something Went Wrong!',
        );

        if($addinfopk) {
            $deleteaddinfo = CmsaddinfodtlsTbl::deleteAll(['=', 'cmsaddinfodtls_pk', $addinfopk]);
            if($deleteaddinfo) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Additional Information Deleated Successfully!',
                );
            }
        }
        return $result;
    }
}
