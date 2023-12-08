<?php

namespace api\modules\pd\models;


use Yii;

/**
 * This is the model class for table "projshortlist_tbl".
 *
 * @property int $projshortlist_pk Primary key
 * @property int $prjsl_projectdtls_fk Reference to projectdtls_tbl
 * @property int $prjsl_memberregmst_fk Reference to stkholdregistration_tbl
 * @property int $prjsl_status 1 - Shortlist, 2 - Cancelled
 * @property string $prjsl_shortlistedcancon Date of shortlist
 * @property int $prjsl_shortlistedcancby Shortlisted by userid
 * @property string $prjsl_shortlistedbycancipaddr IP Address of the user
 */
class ProjshortlistTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projshortlist_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjsl_projectdtls_fk', 'prjsl_memberregmst_fk', 'prjsl_shortlistedcancon', 'prjsl_shortlistedcancby'], 'required'],
            [['prjsl_projectdtls_fk', 'prjsl_memberregmst_fk', 'prjsl_status', 'prjsl_shortlistedcancby'], 'integer'],
            [['prjsl_shortlistedcancon'], 'safe'],
            [['prjsl_shortlistedbycancipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projshortlist_pk' => 'Projshortlist Pk',
            'prjsl_projectdtls_fk' => 'Prjsl Projectdtls Fk',
            'prjsl_memberregmst_fk' => 'Prjsl Memberregmst Fk',
            'prjsl_status' => 'Prjsl Status',
            'prjsl_shortlistedcancon' => 'Prjsl Shortlistedcancon',
            'prjsl_shortlistedcancby' => 'Prjsl Shortlistedcancby',
            'prjsl_shortlistedbycancipaddr' => 'Prjsl Shortlistedbycancipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjshortlistTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjshortlistTblQuery(get_called_class());
    }
}
