<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projacqlictmp_tbl".
 *
 * @property int $projacqlictmp_pk Primary key
 * @property int $palt_projecttmp_fk Reference to projecttmp_tbl
 * @property int $palt_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $palt_order Order of the license
 * @property string $palt_submittedon Date of first submission
 * @property int $palt_submittedby Reference to usermst_tbl
 * @property string $palt_submittedbyipaddr IP Address of the user
 * @property string $palt_updatedon Date of update
 * @property int $palt_updatedby Updated by user id
 * @property string $palt_updatedbyipaddr IP Address of the user
 */
class ProjacqlictmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projacqlictmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['palt_projecttmp_fk', 'palt_licensinginfo_fk', 'palt_order'], 'required'],
            [['palt_projecttmp_fk', 'palt_licensinginfo_fk', 'palt_order', 'palt_submittedby', 'palt_updatedby'], 'integer'],
            [['palt_submittedon', 'palt_updatedon'], 'safe'],
            [['palt_submittedbyipaddr', 'palt_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projacqlictmp_pk' => 'Projacqlictmp Pk',
            'palt_projecttmp_fk' => 'Palt Projecttmp Fk',
            'palt_licensinginfo_fk' => 'Palt Licensinginfo Fk',
            'palt_order' => 'Palt Order',
            'palt_submittedon' => 'Palt Submittedon',
            'palt_submittedby' => 'Palt Submittedby',
            'palt_submittedbyipaddr' => 'Palt Submittedbyipaddr',
            'palt_updatedon' => 'Palt Updatedon',
            'palt_updatedby' => 'Palt Updatedby',
            'palt_updatedbyipaddr' => 'Palt Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjacqlictmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjacqlictmpTblQuery(get_called_class());
    }
}
