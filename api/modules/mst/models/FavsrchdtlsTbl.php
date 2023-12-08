<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "favsrchdtls_tbl".
 *
 * @property int $favsrchdtls_pk
 * @property int $fsd_favsrchmst_fk
 * @property string $fsd_srchtype ALL- All, C-Company, A-Activities, P-Products, S-Services, V-Validation Bank, SP-Sector Partner, PL-People Search,E-EPC, U - User, BU - Business Unit,  ML - Monitor Logs, MP - Market Presence
 * @property string $fsd_criteria
 * @property array $fsd_criteriabag
 * @property int $fsd_prevsrchcnt
 * @property int $fsd_status 1 - Active, 2 - Delete
 * @property string $fsd_deletedon Deleted on datetime
 * @property int $fsd_deletedby Reference to usermst_tbl
 *
 * @property FavsrchmstTbl $fsdFavsrchmstFk
 */
class FavsrchdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'favsrchdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fsd_favsrchmst_fk', 'fsd_srchtype', 'fsd_criteria', 'fsd_criteriabag', 'fsd_prevsrchcnt'], 'required'],
            [['fsd_favsrchmst_fk', 'fsd_prevsrchcnt', 'fsd_status', 'fsd_deletedby'], 'integer'],
            [['fsd_srchtype', 'fsd_criteria'], 'string'],
            [['fsd_criteriabag', 'fsd_deletedon'], 'safe'],
            [['fsd_favsrchmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FavsrchmstTbl::className(), 'targetAttribute' => ['fsd_favsrchmst_fk' => 'favsrchmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'favsrchdtls_pk' => 'Favsrchdtls Pk',
            'fsd_favsrchmst_fk' => 'Fsd Favsrchmst Fk',
            'fsd_srchtype' => 'Fsd Srchtype',
            'fsd_criteria' => 'Fsd Criteria',
            'fsd_criteriabag' => 'Fsd Criteriabag',
            'fsd_prevsrchcnt' => 'Fsd Prevsrchcnt',
            'fsd_status' => 'Fsd Status',
            'fsd_deletedon' => 'Fsd Deletedon',
            'fsd_deletedby' => 'Fsd Deletedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsdFavsrchmstFk()
    {
        return $this->hasOne(FavsrchmstTbl::className(), ['favsrchmst_pk' => 'fsd_favsrchmst_fk']);
    }
}
