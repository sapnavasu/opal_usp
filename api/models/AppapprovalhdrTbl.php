<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appapprovalhdr_tbl".
 *
 * @property int $appapprovalhdr_pk primary key
 * @property int $aah_projapprovalworkflowhrd_fk Reference to projapprovalworkflowhrd_tbl
 * @property int $aah_projapprovalworkflowdtls_fk Reference to projapprovalworkflowdtls_tbl
 * @property int $aah_projapprovalworkflowuserdtls_fk Reference to projapprovalworkflowuserdtls_tbl
 * @property int $aah_applicationdtlstmp_fk Reference to applicationdtlstmp_tbl
 * @property int $aah_formstatus 1-Initial, 2-update(No new staff added OR New staff role/language/sub-categories added),3-Update(added new staff OR added new staff role/language/sub-categories),4-Renewal
 * @property int $aah_status 1-Approved, 2-Declined, 3-in progress, by default NULL
 * @property string $aah_appdecon
 * @property int $aah_appdecby
 * @property string $aah_appdecComments
 *
 * @property ApplicationdtlstmpTbl $aahApplicationdtlstmpFk
 * @property ProjapprovalworkflowdtlsTbl $aahProjapprovalworkflowdtlsFk
 * @property ProjapprovalworkflowhrdTbl $aahProjapprovalworkflowhrdFk
 * @property ProjapprovalworkflowuserdtlsTbl $aahProjapprovalworkflowuserdtlsFk
 */
class AppapprovalhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appapprovalhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aah_projapprovalworkflowhrd_fk', 'aah_projapprovalworkflowdtls_fk', 'aah_projapprovalworkflowuserdtls_fk', 'aah_applicationdtlstmp_fk', 'aah_formstatus'], 'required'],
            [['aah_projapprovalworkflowhrd_fk', 'aah_projapprovalworkflowdtls_fk', 'aah_projapprovalworkflowuserdtls_fk', 'aah_applicationdtlstmp_fk', 'aah_formstatus', 'aah_status', 'aah_appdecby'], 'integer'],
            [['aah_appdecon'], 'safe'],
            [['aah_appdecComments'], 'string'],
            [['aah_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['aah_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['aah_projapprovalworkflowdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjapprovalworkflowdtlsTbl::className(), 'targetAttribute' => ['aah_projapprovalworkflowdtls_fk' => 'projapprovalworkflowdtls_pk']],
            [['aah_projapprovalworkflowhrd_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjapprovalworkflowhrdTbl::className(), 'targetAttribute' => ['aah_projapprovalworkflowhrd_fk' => 'projapprovalworkflowhrd_pk']],
            [['aah_projapprovalworkflowuserdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjapprovalworkflowuserdtlsTbl::className(), 'targetAttribute' => ['aah_projapprovalworkflowuserdtls_fk' => 'projapprovalworkflowuserdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appapprovalhdr_pk' => 'Appapprovalhdr Pk',
            'aah_projapprovalworkflowhrd_fk' => 'Aah Projapprovalworkflowhrd Fk',
            'aah_projapprovalworkflowdtls_fk' => 'Aah Projapprovalworkflowdtls Fk',
            'aah_projapprovalworkflowuserdtls_fk' => 'Aah Projapprovalworkflowuserdtls Fk',
            'aah_applicationdtlstmp_fk' => 'Aah Applicationdtlstmp Fk',
            'aah_formstatus' => 'Aah Formstatus',
            'aah_status' => 'Aah Status',
            'aah_appdecon' => 'Aah Appdecon',
            'aah_appdecby' => 'Aah Appdecby',
            'aah_appdecComments' => 'Aah Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAahApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'aah_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAahProjapprovalworkflowdtlsFk()
    {
        return $this->hasOne(ProjapprovalworkflowdtlsTbl::className(), ['projapprovalworkflowdtls_pk' => 'aah_projapprovalworkflowdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAahProjapprovalworkflowhrdFk()
    {
        return $this->hasOne(ProjapprovalworkflowhrdTbl::className(), ['projapprovalworkflowhrd_pk' => 'aah_projapprovalworkflowhrd_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAahProjapprovalworkflowuserdtlsFk()
    {
        return $this->hasOne(ProjapprovalworkflowuserdtlsTbl::className(), ['projapprovalworkflowuserdtls_pk' => 'aah_projapprovalworkflowuserdtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppapprovalhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppapprovalhdrTblQuery(get_called_class());
    }
    public static function saveAppapproval($requestdata){
    $appAprHdr = new AppapprovalhdrTbl();
    $appAprHdr->aah_projapprovalworkflowhrd_fk = 1;
    $appAprHdr->aah_projapprovalworkflowdtls_fk = 1; 
    $appAprHdr->aah_projapprovalworkflowuserdtls_fk =   $requestdata['user_id'];
    $appAprHdr->aah_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
    $appAprHdr->aah_formstatus = 1;
    if($appAprHdr->save()){
    return $appAprHdr->appapprovalhdr_pk;
    }else{
   // echo "<pre>";return $appAprHdr->getErrors();exit;
    }

}
}
