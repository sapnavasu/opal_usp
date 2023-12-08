<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "bgieventcatmst_tbl".
 *
 * @property int $BGIEventCatMst_Pk
 * @property string $BECM_CategoryName
 * @property string $BECM_Status 'A' - Active, 'I' - In-active
 * @property string $BECM_CreatedOn
 * @property int $BECM_CreatedBy
 *
 * @property AdminusermstTbl $bECMCreatedBy
 */
class BgieventcatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bgieventcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['BECM_CategoryName', 'BECM_Status', 'BECM_CreatedOn', 'BECM_CreatedBy'], 'required'],
            [['BECM_Status'], 'string'],
            [['BECM_CreatedOn'], 'safe'],
            [['BECM_CreatedBy'], 'integer'],
            [['BECM_CategoryName'], 'string', 'max' => 20],
            [['BECM_CreatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['BECM_CreatedBy' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'BGIEventCatMst_Pk' => 'Bgievent Cat Mst  Pk',
            'BECM_CategoryName' => 'Becm  Category Name',
            'BECM_Status' => 'Becm  Status',
            'BECM_CreatedOn' => 'Becm  Created On',
            'BECM_CreatedBy' => 'Becm  Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBECMCreatedBy()
    {
        return $this->hasOne(AdminusermstTbl::className(), ['adminusermst_pk' => 'BECM_CreatedBy']);
    }

    /**
     * {@inheritdoc}
     * @return BgieventcatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BgieventcatmstTblQuery(get_called_class());
    }
}
