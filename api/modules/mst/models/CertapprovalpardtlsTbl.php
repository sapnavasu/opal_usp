<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "certapprovalpardtls_tbl".
 *
 * @property int $certapprovaltrndtls_pk
 * @property int $catd_certapprovaldtls_fk Reference to certapprovaltrn_tbl
 * @property int $catd_suppcertformpartrntmp_fk Reference to suppcertformpartrntmp_tbl
 * @property string $catd_approvalworkflowuserconfig_fk Reference to approvalworkflowuserconfig_tbl
 * @property int $catd_level Level of approval
 * @property int $catd_status 1-Approved, 2-Decilned,3-Updated
 * @property int $catd_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $catd_nxtlevel Which level the Form is moved to, should be euqal to approvalworkflowconfigtrns_tbl.awfct_level
 * @property string $catd_comments
 * @property int $catd_isvalidated 1. Validate, 2.Yet to validate
 * @property int $catd_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $catd_updatedon
 */
class CertapprovalpardtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certapprovalpardtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catd_certapprovaldtls_fk', 'catd_suppcertformpartrntmp_fk', 'catd_approvalworkflowuserconfig_fk', 'catd_level', 'catd_status', 'catd_movedtonxtlevel', 'catd_apprdclnby', 'catd_updatedon'], 'required'],
            [['catd_certapprovaldtls_fk', 'catd_suppcertformpartrntmp_fk', 'catd_level', 'catd_status', 'catd_movedtonxtlevel', 'catd_nxtlevel', 'catd_isvalidated', 'catd_apprdclnby'], 'integer'],
            [['catd_approvalworkflowuserconfig_fk', 'catd_comments'], 'string'],
            [['catd_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'certapprovaltrndtls_pk' => 'Certapprovaltrndtls Pk',
            'catd_certapprovaldtls_fk' => 'Catd Certapprovaldtls Fk',
            'catd_suppcertformpartrntmp_fk' => 'Catd Suppcertformpartrntmp Fk',
            'catd_approvalworkflowuserconfig_fk' => 'Catd Approvalworkflowuserconfig Fk',
            'catd_level' => 'Catd Level',
            'catd_status' => 'Catd Status',
            'catd_movedtonxtlevel' => 'Catd Movedtonxtlevel',
            'catd_nxtlevel' => 'Catd Nxtlevel',
            'catd_comments' => 'Catd Comments',
            'catd_isvalidated' => 'Catd Isvalidated',
            'catd_apprdclnby' => 'Catd Apprdclnby',
            'catd_updatedon' => 'Catd Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CertapprovalpardtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CertapprovalpardtlsTblQuery(get_called_class());
    }
}
