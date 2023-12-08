<?php
namespace api\modules\ct\models;

/**
 * This is the model class for table "jdonotesmember_tbl".
 * @property int $jdonotesmember_pk Primary key
 * @property int $jdnm_jdonoteshdr_fk Reference to jdonoteshdr_tbl
 * @property int $jdnm_jdotargetmember_fk Shared Notes - Members to whom notes is Shared: Reference to jdotargetmember_tbl 
 * @property int $jdnm_status 1 - Active, 2 - Inactive
 * @property string $jdnm_createdon Datetime of creation
 * @property string $jdnm_createdby Reference to usermst_tbl
 * @property int $jdnm_createdbyipaddr IP Address of the user
 * @property int $jdnm_updatedon Date of update
 * @property int $jdnm_updatedby Reference to usermst_tbl
 * @property int $jdnm_updatedbyipaddr User IP Address 
 * 
 * */

 
class JdonotesmemberTbl extends \yii\db\ActiveRecord
{

      /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdonotesmember_tbl';
    }

      /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdnm_jdonoteshdr_fk', 'jdnm_jdotargetmember_fk', 'jdnm_status', 'jdnm_createdon'], 'required'],
            [['jdnm_jdonoteshdr_fk', 'jdnm_jdotargetmember_fk', 'jdnm_status', 'jdnm_createdby'], 'integer'],
            [['jdnm_createdon'], 'safe'],
            [['jdnm_createdbyipaddr', 'jdnm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }
}