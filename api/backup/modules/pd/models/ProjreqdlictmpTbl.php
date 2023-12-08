<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projreqdlictmp_tbl".
 *
 * @property int $projreqdlictmp_pk Primary key
 * @property int $prlt_projecttmp_fk Reference to projecttmp_tbl
 * @property int $prlt_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $prlt_order Order of the license
 * @property string $prlt_submittedon Date of first submission
 * @property int $prlt_submittedby Reference to usermst_tbl
 * @property string $prlt_submittedbyipaddr IP Address of the user
 * @property string $prlt_updatedon Date of update
 * @property int $prlt_updatedby Reference to usermst_tbl
 * @property string $prlt_updatedbyipaddr IP Address of the user
 */
class ProjreqdlictmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projreqdlictmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prlt_projecttmp_fk', 'prlt_licensinginfo_fk', 'prlt_order'], 'required'],
            [['prlt_projecttmp_fk', 'prlt_licensinginfo_fk', 'prlt_order', 'prlt_submittedby', 'prlt_updatedby'], 'integer'],
            [['prlt_submittedon', 'prlt_updatedon'], 'safe'],
            [['prlt_submittedbyipaddr', 'prlt_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projreqdlictmp_pk' => 'Projreqdlictmp Pk',
            'prlt_projecttmp_fk' => 'Prlt Projecttmp Fk',
            'prlt_licensinginfo_fk' => 'Prlt Licensinginfo Fk',
            'prlt_order' => 'Prlt Order',
            'prlt_submittedon' => 'Prlt Submittedon',
            'prlt_submittedby' => 'Prlt Submittedby',
            'prlt_submittedbyipaddr' => 'Prlt Submittedbyipaddr',
            'prlt_updatedon' => 'Prlt Updatedon',
            'prlt_updatedby' => 'Prlt Updatedby',
            'prlt_updatedbyipaddr' => 'Prlt Updatedbyipaddr',
        ];
    }
    /**
     * {@inheritdoc}
     * @return ProjreqdlictmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjreqdlictmpTblQuery(get_called_class());
    }
}
