<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\mst\models\MembercompanymstTbl;

/**
 * This is the model class for table "cmssdrldoccattemp_tbl".
 *
 * @property int $cmssdrldoccattemp_pk Primary key
 * @property int $csdrldct_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $csdrldct_doccategory Document Category
 * @property string $csdrldct_doccode Document Code
 * @property string $csdrldct_docdesc Document Description
 * @property string $csdrldct_createdon Date of creation
 * @property int $csdrldct_createdby Reference to usermst_tbl
 * @property string $csdrldct_createdbyipaddr User IP Address
 *
 * @property UsermstTbl $csdrldctCreatedby
 * @property MembercompanymstTbl $csdrldctMemcompmstFk
 */
class CmssdrldoccattempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssdrldoccattemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrldct_memcompmst_fk', 'csdrldct_doccategory', 'csdrldct_doccode', 'csdrldct_docdesc', 'csdrldct_createdon', 'csdrldct_createdby'], 'required'],
            [['csdrldct_memcompmst_fk', 'csdrldct_createdby'], 'integer'],
            [['csdrldct_docdesc'], 'string'],
            [['csdrldct_createdon'], 'safe'],
            [['csdrldct_doccategory'], 'string', 'max' => 255],
            [['csdrldct_doccode'], 'string', 'max' => 10],
            [['csdrldct_createdbyipaddr'], 'string', 'max' => 50],
            [['csdrldct_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldct_createdby' => 'UserMst_Pk']],
            [['csdrldct_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['csdrldct_memcompmst_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssdrldoccattemp_pk' => 'Cmssdrldoccattemp Pk',
            'csdrldct_memcompmst_fk' => 'Csdrldct Memcompmst Fk',
            'csdrldct_doccategory' => 'Csdrldct Doccategory',
            'csdrldct_doccode' => 'Csdrldct Doccode',
            'csdrldct_docdesc' => 'Csdrldct Docdesc',
            'csdrldct_createdon' => 'Csdrldct Createdon',
            'csdrldct_createdby' => 'Csdrldct Createdby',
            'csdrldct_createdbyipaddr' => 'Csdrldct Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldctCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldct_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldctMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'csdrldct_memcompmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmssdrldoccattempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssdrldoccattempTblQuery(get_called_class());
    }
}
