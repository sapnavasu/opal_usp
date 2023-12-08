<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projownersuccessstory_tbl".
 *
 * @property int $projownersuccessstory_pk Primary Key
 * @property int $poss_projectdtls_fk Reference to projectdtls_tbl
 * @property string $poss_successstory Success story as posted by the Project owner / NOC
 * @property string $poss_youtubelink Youtube link
 * @property string $poss_projname Offline Project name
 * @property string $poss_projbanner Reference to memcompfiledtls_tbl saved in comma separation
 * @property string $poss_orgname Organisation Name
 * @property string $poss_projownerlogo Reference to memcompfiledtls_tbl saved in comma separation
 * @property int $poss_status 1 - Submitted, 2 - Approved, 3 - Declined, 4 - Resubmitted
 * @property int $poss_submittedby Reference to usermst_tbl
 * @property string $poss_submittedon Submission datetime
 * @property int $poss_appdeclby Approved / Declined by
 * @property string $poss_appdeclon
 * @property string $poss_appdeclcomments Approved / Declined Comments
 */
class ProjownersuccessstoryTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projownersuccessstory_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['poss_projectdtls_fk', 'poss_status', 'poss_submittedby', 'poss_appdeclby'], 'integer'],
            [['poss_successstory', 'poss_projbanner', 'poss_projownerlogo', 'poss_appdeclcomments'], 'string'],
            [['poss_submittedon', 'poss_appdeclon'], 'safe'],
            [['poss_youtubelink', 'poss_orgname'], 'string', 'max' => 250],
            [['poss_projname'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projownersuccessstory_pk' => 'Projownersuccessstory Pk',
            'poss_projectdtls_fk' => 'Poss Projectdtls Fk',
            'poss_successstory' => 'Poss Successstory',
            'poss_youtubelink' => 'Poss Youtubelink',
            'poss_projname' => 'Poss Projname',
            'poss_projbanner' => 'Poss Projbanner',
            'poss_orgname' => 'Poss Orgname',
            'poss_projownerlogo' => 'Poss Projownerlogo',
            'poss_status' => 'Poss Status',
            'poss_submittedby' => 'Poss Submittedby',
            'poss_submittedon' => 'Poss Submittedon',
            'poss_appdeclby' => 'Poss Appdeclby',
            'poss_appdeclon' => 'Poss Appdeclon',
            'poss_appdeclcomments' => 'Poss Appdeclcomments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjownersuccessstoryTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjownersuccessstoryTblQuery(get_called_class());
    }
}
