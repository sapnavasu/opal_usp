<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "certcatsubcatapprovaldtls_tbl".
 *
 * @property int $certcatsubcatapprovaldtls_pk
 * @property int $ccscad_certapprovaldtls_fk Reference to certapprovaltrn_tbl
 * @property int $ccscad_suppcertformcattmp_fk Reference to suppcertformcattmp_tbl
 * @property int $ccscad_suppcertformtrntmp_fk Reference to suppcertformtrntmp_tbl
 * @property int $ccscad_level 1-Approved, 2-Decilned
 * @property int $ccscad_status 1-Approved, 2-Decilned
 * @property int $ccscad_movedtonxtlevel 1 - not moved, 2 - moved, by default 1
 * @property int $ccscad_nxtlevel Which level the Form is moved to, should be euqal to approvalworkflowconfigtrns_tbl.awfct_level
 * @property string $ccscad_comments
 * @property int $ccscad_apprdclnby Reference to usermst_tbl and should be equal to approvalworkflowuserconfig_tbl.awfuc_usermst_fk
 * @property string $ccscad_updatedon
 */
class CertcatsubcatapprovaldtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'certcatsubcatapprovaldtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ccscad_certapprovaldtls_fk', 'ccscad_suppcertformcattmp_fk', 'ccscad_level', 'ccscad_movedtonxtlevel', 'ccscad_apprdclnby', 'ccscad_updatedon'], 'required'],
            [['ccscad_certapprovaldtls_fk', 'ccscad_suppcertformcattmp_fk', 'ccscad_suppcertformtrntmp_fk', 'ccscad_level', 'ccscad_status', 'ccscad_movedtonxtlevel', 'ccscad_nxtlevel', 'ccscad_apprdclnby'], 'integer'],
            [['ccscad_comments'], 'string'],
            [['ccscad_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'certcatsubcatapprovaldtls_pk' => 'Certcatsubcatapprovaldtls Pk',
            'ccscad_certapprovaldtls_fk' => 'Ccscad Certapprovaldtls Fk',
            'ccscad_suppcertformcattmp_fk' => 'Ccscad Suppcertformcattmp Fk',
            'ccscad_suppcertformtrntmp_fk' => 'Ccscad Suppcertformtrntmp Fk',
            'ccscad_level' => 'Ccscad Level',
            'ccscad_status' => 'Ccscad Status',
            'ccscad_movedtonxtlevel' => 'Ccscad Movedtonxtlevel',
            'ccscad_nxtlevel' => 'Ccscad Nxtlevel',
            'ccscad_comments' => 'Ccscad Comments',
            'ccscad_apprdclnby' => 'Ccscad Apprdclnby',
            'ccscad_updatedon' => 'Ccscad Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CertcatsubcatapprovaldtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CertcatsubcatapprovaldtlsTblQuery(get_called_class());
    }
}