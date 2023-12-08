<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projownersuccessstoryhsty_tbl".
 *
 * @property int $projownersuccessstoryhsty_pk Primary Key
 * @property int $possh_projownersuccessstory_fk Reference to projownersuccessstory_tbl
 * @property int $possh_projectdtls_fk Reference to projectdtls_tbl
 * @property string $possh_successstory Success story as posted by the Project owner / NOC
 * @property string $possh_youtubelink Youtube link
 * @property string $possh_projname Offline Project name
 * @property string $possh_projbanner Reference to memcompfiledtls_tbl saved in comma separation
 * @property string $possh_orgname Organisation Name
 * @property string $possh_projownerlogo Reference to memcompfiledtls_tbl saved in comma separation
 * @property int $possh_status 1 - Submitted, 2 - Approved, 3 - Declined, 4 - Resubmitted
 * @property string $possh_histcreatedon History creation datetime
 * @property int $possh_submittedby Reference to usermst_tbl
 * @property string $possh_submittedon Submission datetime
 * @property int $possh_appdeclby Approved / Declined by
 * @property string $possh_appdeclon
 * @property string $possh_appdeclcomments Approved / Declined Comments
 */
class ProjownersuccessstoryhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projownersuccessstoryhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['possh_projownersuccessstory_fk', 'possh_histcreatedon'], 'required'],
            [['possh_projownersuccessstory_fk', 'possh_projectdtls_fk', 'possh_status', 'possh_submittedby', 'possh_appdeclby'], 'integer'],
            [['possh_successstory', 'possh_projbanner', 'possh_projownerlogo', 'possh_appdeclcomments'], 'string'],
            [['possh_histcreatedon', 'possh_submittedon', 'possh_appdeclon'], 'safe'],
            [['possh_youtubelink', 'possh_orgname'], 'string', 'max' => 250],
            [['possh_projname'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projownersuccessstoryhsty_pk' => 'Projownersuccessstoryhsty Pk',
            'possh_projownersuccessstory_fk' => 'Possh Projownersuccessstory Fk',
            'possh_projectdtls_fk' => 'Possh Projectdtls Fk',
            'possh_successstory' => 'Possh Successstory',
            'possh_youtubelink' => 'Possh Youtubelink',
            'possh_projname' => 'Possh Projname',
            'possh_projbanner' => 'Possh Projbanner',
            'possh_orgname' => 'Possh Orgname',
            'possh_projownerlogo' => 'Possh Projownerlogo',
            'possh_status' => 'Possh Status',
            'possh_histcreatedon' => 'Possh Histcreatedon',
            'possh_submittedby' => 'Possh Submittedby',
            'possh_submittedon' => 'Possh Submittedon',
            'possh_appdeclby' => 'Possh Appdeclby',
            'possh_appdeclon' => 'Possh Appdeclon',
            'possh_appdeclcomments' => 'Possh Appdeclcomments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjownersuccessstoryhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjownersuccessstoryhstyTblQuery(get_called_class());
    }
}
