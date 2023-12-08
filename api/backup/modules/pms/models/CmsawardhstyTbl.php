<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsawardhsty_tbl".
 *
 * @property int $cmsawardhsty_pk Primary key
 * @property int $cmsah_cmsawarddtls_fk Reference to cmsawarddtls_tbl
 * @property int $cmsah_classification Classification: 1 - MSME-Micro, 2 - MSME-Small, 3 - MSME-Medium, 4 - Large, 5 - Very Large
 * @property int $cmsah_curclassification Current Classification: 1 - MSME-Micro, 2 - MSME-Small, 3 - MSME-Medium, 4 - Large, 5 - Very Large
 * @property string $cmsah_createdon Date of creation
 * @property int $cmsah_createdby Reference to usermst_tbl
 * @property string $cmsah_comment comments if any
 *
 * @property CmsawarddtlsTbl $cmsahCmsawarddtlsFk
 * @property UsermstTbl $cmsahCreatedby
 */
class CmsawardhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsawardhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsah_cmsawarddtls_fk', 'cmsah_classification', 'cmsah_createdon', 'cmsah_createdby'], 'required'],
            [['cmsah_cmsawarddtls_fk', 'cmsah_classification', 'cmsah_curclassification', 'cmsah_createdby'], 'integer'],
            [['cmsah_createdon'], 'safe'],
            [['cmsah_comment'], 'string'],
            [['cmsah_cmsawarddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsawarddtlsTbl::className(), 'targetAttribute' => ['cmsah_cmsawarddtls_fk' => 'cmsawarddtls_pk']],
            [['cmsah_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsah_createdby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsawardhsty_pk' => 'Cmsawardhsty Pk',
            'cmsah_cmsawarddtls_fk' => 'Cmsah Cmsawarddtls Fk',
            'cmsah_classification' => 'Cmsah Classification',
            'cmsah_curclassification' => 'Cmsah Curclassification',
            'cmsah_createdon' => 'Cmsah Createdon',
            'cmsah_createdby' => 'Cmsah Createdby',
            'cmsah_comment' => 'Cmsah Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsahCmsawarddtlsFk()
    {
        return $this->hasOne(CmsawarddtlsTbl::className(), ['cmsawarddtls_pk' => 'cmsah_cmsawarddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsahCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsah_createdby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsawardhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsawardhstyTblQuery(get_called_class());
    }
}
