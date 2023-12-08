<?php

namespace api\modules\pms\models;

use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "cmstenderpscharges_tbl".
 *
 * @property int $cmstenderpscharges_pk Primary key
 * @property int $ctpsc_shared_fk Reference to cmsquotationhdr_tbl, cmscontracthdr_tbl
 * @property int $ctpsc_shared_type 1 - Quotation, 2 - Contract
 * @property int $ctpsc_type Type of Charge: 1 - Addition, 2 - Deduction
 * @property string $ctpsc_name Charge name
 * @property string $ctpsc_amount Charge Amount
 * @property string $ctpsc_createdon Date of creation
 * @property int $ctpsc_createdby Reference to usermst_tbl
 * @property string $ctpsc_createdbyipaddr User IP Address
 * @property string $ctpsc_updatedon Date of update
 * @property int $ctpsc_updatedby Reference to usermst_tbl
 * @property string $ctpsc_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $ctpscCreatedby
 * @property UsermstTbl $ctpscUpdatedby
 */
class CmstenderpschargesTbl extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cmstenderpscharges_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['ctpsc_shared_fk', 'ctpsc_shared_type', 'ctpsc_type', 'ctpsc_name', 'ctpsc_amount', 'ctpsc_createdon', 'ctpsc_createdby'], 'required'],
            [['ctpsc_shared_fk', 'ctpsc_shared_type', 'ctpsc_type', 'ctpsc_createdby', 'ctpsc_updatedby'], 'integer'],
            [['ctpsc_amount'], 'number'],
            [['ctpsc_createdon', 'ctpsc_updatedon'], 'safe'],
            [['ctpsc_name'], 'string', 'max' => 150],
            [['ctpsc_createdbyipaddr', 'ctpsc_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctpsc_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctpsc_createdby' => 'UserMst_Pk']],
            [['ctpsc_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctpsc_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'cmstenderpscharges_pk' => 'Cmstenderpscharges Pk',
            'ctpsc_shared_fk' => 'Ctpsc Shared Fk',
            'ctpsc_shared_type' => 'Ctpsc Shared Type',
            'ctpsc_type' => 'Ctpsc Type',
            'ctpsc_name' => 'Ctpsc Name',
            'ctpsc_amount' => 'Ctpsc Amount',
            'ctpsc_createdon' => 'Ctpsc Createdon',
            'ctpsc_createdby' => 'Ctpsc Createdby',
            'ctpsc_createdbyipaddr' => 'Ctpsc Createdbyipaddr',
            'ctpsc_updatedon' => 'Ctpsc Updatedon',
            'ctpsc_updatedby' => 'Ctpsc Updatedby',
            'ctpsc_updatedbyipaddr' => 'Ctpsc Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpscCreatedby() {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctpsc_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpscUpdatedby() {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctpsc_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderpschargesTblQuery the active query used by this AR class.
     */
    public static function find() {
        return new CmstenderpschargesTblQuery(get_called_class());
    }

}
