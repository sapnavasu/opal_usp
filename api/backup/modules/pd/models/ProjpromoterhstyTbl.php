<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projpromoterhsty_tbl".
 *
 * @property int $projpromoterhsty_pk Primary key
 * @property int $pph_projecthsty_fk Reference to projecthsty_tbl
 * @property string $pph_promotername Promoter Name
 * @property string $pph_website Promoter Website
 * @property string $pph_address Promoter Address
 * @property int $pph_citymst_fk Reference to citymst_tbl
 * @property int $pph_statemst_fk Reference to statemst_tbl
 * @property int $pph_countrymst_fk Reference to countrymst_tbl
 * @property string $pph_others Other information
 * @property string $pph_projectrole Project role of the promoter
 * @property string $pph_promsummary Promoter Summary
 * @property string $pph_histcreatedon Date of history creation
 * @property string $pph_appdeclon Updated on
 * @property int $pph_appdeclby Reference to Usermst_tbl
 * @property string $pph_appdeclbyipaddr IP Address of the user
 * @property string $pph_submittedon Submitted on
 * @property int $pph_submittedby Reference to Usermst_tbl
 * @property string $pph_submittedbyipaddr IP Address of the user
 */
class ProjpromoterhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projpromoterhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pph_projecthsty_fk', 'pph_citymst_fk', 'pph_statemst_fk', 'pph_countrymst_fk', 'pph_appdeclby', 'pph_submittedby'], 'integer'],
            [['pph_promotername', 'pph_histcreatedon', 'pph_appdeclon', 'pph_appdeclby'], 'required'],
            [['pph_address', 'pph_others', 'pph_projectrole', 'pph_promsummary'], 'string'],
            [['pph_histcreatedon', 'pph_appdeclon', 'pph_submittedon'], 'safe'],
            [['pph_promotername', 'pph_appdeclbyipaddr', 'pph_submittedbyipaddr'], 'string', 'max' => 50],
            [['pph_website'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projpromoterhsty_pk' => 'Projpromoterhsty Pk',
            'pph_projecthsty_fk' => 'Pph Projecthsty Fk',
            'pph_promotername' => 'Pph Promotername',
            'pph_website' => 'Pph Website',
            'pph_address' => 'Pph Address',
            'pph_citymst_fk' => 'Pph Citymst Fk',
            'pph_statemst_fk' => 'Pph Statemst Fk',
            'pph_countrymst_fk' => 'Pph Countrymst Fk',
            'pph_others' => 'Pph Others',
            'pph_projectrole' => 'Pph Projectrole',
            'pph_promsummary' => 'Pph Promsummary',
            'pph_histcreatedon' => 'Pph Histcreatedon',
            'pph_appdeclon' => 'Pph Appdeclon',
            'pph_appdeclby' => 'Pph Appdeclby',
            'pph_appdeclbyipaddr' => 'Pph Appdeclbyipaddr',
            'pph_submittedon' => 'Pph Submittedon',
            'pph_submittedby' => 'Pph Submittedby',
            'pph_submittedbyipaddr' => 'Pph Submittedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjpromoterhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjpromoterhstyTblQuery(get_called_class());
    }
}
