<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coursecategorymsthsty_tbl".
 *
 * @property int $coursecategorymsthsty_tbl
 * @property int $ccmh_coursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $ccmh_coursecategorymst_pk If there is a subcategory for a category then this column should refer to coursecategorymst_pk
 * @property string $ccmh_catname_en if ccm_coursecategorymst_pk is not null then this column should hold Sub category name
 * @property string $ccmh_catname_ar
 * @property string $ccmh_catcode Category Code is only for Categories, not for Sub categories
 * @property string $ccmh_subcatcode Sub Category code
 * @property int $ccmh_status 1-Active, 2-Inactive
 * @property string $ccmh_createdon
 * @property int $ccmh_createdby
 * @property string $ccmh_updatedon
 * @property int $ccmh_updatedby
 *
 * @property CoursecategorymstTbl $ccmhCoursecategorymstFk
 */
class CoursecategorymsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coursecategorymsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ccmh_coursecategorymst_fk', 'ccmh_catname_en', 'ccmh_catname_ar', 'ccmh_status', 'ccmh_createdon', 'ccmh_createdby'], 'required'],
            [['ccmh_coursecategorymst_fk', 'ccmh_coursecategorymst_pk', 'ccmh_status', 'ccmh_createdby', 'ccmh_updatedby'], 'integer'],
            [['ccmh_createdon', 'ccmh_updatedon'], 'safe'],
            [['ccmh_catname_en', 'ccmh_catname_ar'], 'string', 'max' => 255],
            [['ccmh_catcode', 'ccmh_subcatcode'], 'string', 'max' => 50],
            [['ccmh_coursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['ccmh_coursecategorymst_fk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coursecategorymsthsty_tbl' => 'Coursecategorymsthsty Tbl',
            'ccmh_coursecategorymst_fk' => 'Ccmh Coursecategorymst Fk',
            'ccmh_coursecategorymst_pk' => 'Ccmh Coursecategorymst Pk',
            'ccmh_catname_en' => 'Ccmh Catname En',
            'ccmh_catname_ar' => 'Ccmh Catname Ar',
            'ccmh_catcode' => 'Ccmh Catcode',
            'ccmh_subcatcode' => 'Ccmh Subcatcode',
            'ccmh_status' => 'Ccmh Status',
            'ccmh_createdon' => 'Ccmh Createdon',
            'ccmh_createdby' => 'Ccmh Createdby',
            'ccmh_updatedon' => 'Ccmh Updatedon',
            'ccmh_updatedby' => 'Ccmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcmhCoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'ccmh_coursecategorymst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CoursecategorymsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoursecategorymsthstyTblQuery(get_called_class());
    }
}
