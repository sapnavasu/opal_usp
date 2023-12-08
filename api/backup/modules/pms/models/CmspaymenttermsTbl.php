<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmspaymentterms_tbl".
 *
 * @property int $cmspaymentterms_pk Primary key
 * @property int $cmspt_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmspt_shared_fk Reference to cmstenderhdr_tbl, cmscontracthdr_tbl
 * @property int $cmspt_type 1 - eTendering, 2 - Contract
 * @property string $cmspt_name Term Name
 * @property string $cmspt_value Term Value
 *
 * @property MembercompanymstTbl $cmsptMemcompmstFk
 */
class CmspaymenttermsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmspaymentterms_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmspt_memcompmst_fk', 'cmspt_shared_fk', 'cmspt_type', 'cmspt_name', 'cmspt_value'], 'required'],
            [['cmspt_memcompmst_fk', 'cmspt_shared_fk', 'cmspt_type'], 'integer'],
            [['cmspt_name', 'cmspt_value'], 'string'],
            [['cmspt_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\MembercompanymstTbl::className(), 'targetAttribute' => ['cmspt_memcompmst_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmspaymentterms_pk' => 'Cmspaymentterms Pk',
            'cmspt_memcompmst_fk' => 'Cmspt Memcompmst Fk',
            'cmspt_shared_fk' => 'Cmspt Shared Fk',
            'cmspt_type' => 'Cmspt Type',
            'cmspt_name' => 'Cmspt Name',
            'cmspt_value' => 'Cmspt Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsptMemcompmstFk()
    {
        return $this->hasOne(\api\modules\mst\models\MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmspt_memcompmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmspaymenttermsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmspaymenttermsTblQuery(get_called_class());
    }
}
