<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsimportaudittraildtls_tbl".
 *
 * @property int $cmsimportaudittraildtls_pk Primary Key
 * @property int $cmiadd_cmsimportaudittrailmst_fk Reference to cmsimportaudittrailmst_pk
 * @property string $cmiadd_prjd_projectid Reference to projectdtls_tbl.prjd_projectid
 * @property string $cmiadd_cmsth_refno Reference to cmstenderhdr_tbl.cmsth_refno
 * @property string $cmiadd_contractid Reference to cmscontracthdr_tbl.cmsch_contractrefno
 * @property array $cmiadd_importrecord Entire row record of particular import record inserted in this column as JSON format
 * @property int $cmiadd_status 1 - Success, 2 - Fail
 * @property string $cmiadd_comments Fail comments
 */
class CmsimportaudittraildtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsimportaudittraildtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmiadd_cmsimportaudittrailmst_fk', 'cmiadd_contractid', 'cmiadd_importrecord', 'cmiadd_status'], 'required'],
            [['cmiadd_cmsimportaudittrailmst_fk', 'cmiadd_status'], 'integer'],
            [['cmiadd_importrecord'], 'safe'],
            [['cmiadd_comments'], 'string'],
            [['cmiadd_prjd_projectid', 'cmiadd_cmsth_refno', 'cmiadd_contractid'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsimportaudittraildtls_pk' => 'Cmsimportaudittraildtls Pk',
            'cmiadd_cmsimportaudittrailmst_fk' => 'Cmiadd Cmsimportaudittrailmst Fk',
            'cmiadd_prjd_projectid' => 'Cmiadd Prjd Projectid',
            'cmiadd_cmsth_refno' => 'Cmiadd Cmsth Refno',
            'cmiadd_contractid' => 'Cmiadd Contractid',
            'cmiadd_importrecord' => 'Cmiadd Importrecord',
            'cmiadd_status' => 'Cmiadd Status',
            'cmiadd_comments' => 'Cmiadd Comments',
        ];
    }
}
