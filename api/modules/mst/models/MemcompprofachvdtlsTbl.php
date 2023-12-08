<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "memcompprofachvdtls_tbl".
 *
 * @property int $MemCompProfAchvDtls_Pk
 * @property int $MCPAvD_MemberCompMst_Fk
 * @property string $MCPAvD_Title
 * @property string $MCPAvD_ImgUploadFilePath
 * @property string $MCPAvD_AchvClient
 * @property string $MCPAvD_AchvDesc
 *
 * @property MembercompanymstTbl $mCPAvDMemberCompMstFk
 */
class MemcompprofachvdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprofachvdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MCPAvD_MemberCompMst_Fk', 'MCPAvD_Title', 'MCPAvD_AchvClient', 'MCPAvD_AchvDesc'], 'required'],
            [['MCPAvD_MemberCompMst_Fk'], 'integer'],
            [['MCPAvD_AchvClient', 'MCPAvD_AchvDesc'], 'string'],
            [['MCPAvD_Title', 'MCPAvD_ImgUploadFilePath'], 'string', 'max' => 250],
            [['MCPAvD_MemberCompMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['MCPAvD_MemberCompMst_Fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemCompProfAchvDtls_Pk' => 'Mem Comp Prof Achv Dtls  Pk',
            'MCPAvD_MemberCompMst_Fk' => 'Mcpav D  Member Comp Mst  Fk',
            'MCPAvD_Title' => 'Mcpav D  Title',
            'MCPAvD_ImgUploadFilePath' => 'Mcpav D  Img Upload File Path',
            'MCPAvD_AchvClient' => 'Mcpav D  Achv Client',
            'MCPAvD_AchvDesc' => 'Mcpav D  Achv Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMCPAvDMemberCompMstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'MCPAvD_MemberCompMst_Fk']);
    }

    /**
     * {@inheritdoc}
     * @return MemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberQuery(get_called_class());
    }
}
