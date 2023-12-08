<?php

namespace api\modules\inv\models;


use Yii;

/**
 * This is the model class for table "licprocedurepinup_tbl".
 *
 * @property int $licprocedurepinup_pk Primary key
 * @property int $lppu_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $lppu_sectorprocedure_fk Reference to sectorprocedure_tbl
 * @property string $lppu_pinned_on Date of pin
 * @property int $lppu_pinnedby Reference to usrmst_tbl
 * @property int $lppu_memcompmst_fk Refrence to membercompanymst_tbl
 * @property string $lppu_pinnedbyipaddr IP Address of the user
 */
class LicprocedurepinupTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licprocedurepinup_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lppu_licensinginfo_fk', 'lppu_sectorprocedure_fk', 'lppu_pinnedby', 'lppu_memcompmst_fk'], 'integer'],
            [['lppu_pinned_on', 'lppu_pinnedby', 'lppu_memcompmst_fk'], 'required'],
            [['lppu_pinned_on'], 'safe'],
            [['lppu_pinnedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licprocedurepinup_pk' => 'Licprocedurepinup Pk',
            'lppu_licensinginfo_fk' => 'Lppu Licensinginfo Fk',
            'lppu_sectorprocedure_fk' => 'Lppu Sectorprocedure Fk',
            'lppu_pinned_on' => 'Lppu Pinned On',
            'lppu_pinnedby' => 'Lppu Pinnedby',
            'lppu_memcompmst_fk' => 'Lppu Memcompmst Fk',
            'lppu_pinnedbyipaddr' => 'Lppu Pinnedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicprocedurepinupTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicprocedurepinupTblQuery(get_called_class());
    }




}
