<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "officetypemst_tbl".
 *
 * @property int $officetypemst_pk
 * @property string $otm_officename_en
 * @property string $otm_officename_ar
 * @property int $ofm_status Country status. A - Active, I - Inactive, by default A
 * @property string $ofm_createdon
 * @property int $ofm_createdby
 * @property string $ofm_updatedon
 * @property int $ofm_updatedby
 */
class OfficetypemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'officetypemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['otm_officename_en', 'otm_officename_ar', 'ofm_status', 'ofm_createdon', 'ofm_createdby'], 'required'],
            [['ofm_status', 'ofm_createdby', 'ofm_updatedby'], 'integer'],
            [['ofm_createdon', 'ofm_updatedon'], 'safe'],
            [['otm_officename_en', 'otm_officename_ar'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'officetypemst_pk' => 'Officetypemst Pk',
            'otm_officename_en' => 'Otm Officename En',
            'otm_officename_ar' => 'Otm Officename Ar',
            'ofm_status' => 'Ofm Status',
            'ofm_createdon' => 'Ofm Createdon',
            'ofm_createdby' => 'Ofm Createdby',
            'ofm_updatedon' => 'Ofm Updatedon',
            'ofm_updatedby' => 'Ofm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OfficetypemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OfficetypemstTblQuery(get_called_class());
    }
    
    public function getDefaultOfficeTypes(){
        $OfficetypemstTbl = OfficetypemstTbl::find()
                                ->select('officetypemst_pk as offPk, otm_officename_en as offName_en, otm_officename_ar as offName_ar')
                                ->where(['ofm_status'=>1])
                                ->orderBy(['otm_officename_en'=>SORT_ASC])
                                ->asArray()->all();
//        array_push($DepartmentmstTbl,['deptPk' => '0', 'deptName' => 'Others']);
        return $OfficetypemstTbl;
    }
}
