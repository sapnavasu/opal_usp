<?php

namespace api\modules\inv\models;

use Yii;

/**
 * This is the model class for table "investortypeprefmst_tbl".
 *
 * @property int $investortypeprefmst_pk Primary key
 * @property string $itpm_investortype
 * @property int $itpm_status 1 - Active, 2 - Inactive
 * @property string $itpm_createdon
 * @property int $itpm_createdby Reference to usermst_tbl
 * @property string $itpm_createdbyipaddr User IP Address
 * @property string $itpm_updatedon
 * @property int $itpm_updatedby Reference to usermst_tbl
 * @property string $itpm_updatedbyipaddr User IP Address
 */
class InvestortypeprefmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'investortypeprefmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itpm_investortype', 'itpm_status'], 'required'],
            [['itpm_status', 'itpm_createdby', 'itpm_updatedby'], 'integer'],
            [['itpm_createdon', 'itpm_updatedon'], 'safe'],
            [['itpm_investortype'], 'string', 'max' => 80],
            [['itpm_createdbyipaddr', 'itpm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'investortypeprefmst_pk' => 'Investortypeprefmst Pk',
            'itpm_investortype' => 'Itpm Investortype',
            'itpm_status' => 'Itpm Status',
            'itpm_createdon' => 'Itpm Createdon',
            'itpm_createdby' => 'Itpm Createdby',
            'itpm_createdbyipaddr' => 'Itpm Createdbyipaddr',
            'itpm_updatedon' => 'Itpm Updatedon',
            'itpm_updatedby' => 'Itpm Updatedby',
            'itpm_updatedbyipaddr' => 'Itpm Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InvestortypeprefmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvestortypeprefmstTblQuery(get_called_class());
    }
}
