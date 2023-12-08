<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "certapprovaldtls_tbl".
 *
 * @property int $certapprovaldtls_pk
 * @property int $cad_membercompanymst_fk Reference to membercompanymst_tbl
 * @property int $cad_suppcertformmembtmp_fk Reference to suppcertformmembtmp_tbl
 * @property string $cad_approvalworkflowuserconfig_fk Reference to approvalworkflowuserconfig_tbl
 * @property string $cad_approvalworkflowuserconfigtrns_fk Reference to approvalworkflowuserconfigtrns_tbl
 * @property int $cad_status 1-Approved, 2-Decilned, 0 by dafult
 * @property int $cad_actioncompleted 1 - Not Completed, 2 - Completed, 1 by default
 * @property string $cad_comments
 * @property string $cad_updatedon
 */
class CertapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cad_membercompanymst_fk', 'cad_suppcertformmembtmp_fk', 'cad_approvalworkflowuserconfig_fk', 'cad_approvalworkflowuserconfigtrns_fk'], 'required'],
            [['cad_membercompanymst_fk', 'cad_suppcertformmembtmp_fk', 'cad_status', 'cad_actioncompleted'], 'integer'],
            [['cad_approvalworkflowuserconfig_fk', 'cad_approvalworkflowuserconfigtrns_fk', 'cad_comments'], 'string'],
            [['cad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'certapprovaldtls_pk' => 'Certapprovaldtls Pk',
            'cad_membercompanymst_fk' => 'Cad Membercompanymst Fk',
            'cad_suppcertformmembtmp_fk' => 'Cad Suppcertformmembtmp Fk',
            'cad_approvalworkflowuserconfig_fk' => 'Cad Approvalworkflowuserconfig Fk',
            'cad_approvalworkflowuserconfigtrns_fk' => 'Cad Approvalworkflowuserconfigtrns Fk',
            'cad_status' => 'Cad Status',
            'cad_actioncompleted' => 'Cad Actioncompleted',
            'cad_comments' => 'Cad Comments',
            'cad_updatedon' => 'Cad Updatedon',
        ];
    }
    public function getUserconfig(){
        return $this->hasOne(\api\modules\mst\models\ApprovalworkflowuserconfigTbl::className(),['approvalworkflowuserconfig_pk'=>'cad_approvalworkflowuserconfig_fk']);
    }
}
