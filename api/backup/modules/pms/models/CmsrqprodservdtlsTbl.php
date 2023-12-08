<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsrqprodservdtls_tbl".
 *
 * @property int $cmsrqprodservdtls_pk Primary key
 * @property int $crpsd_shared_fk Reference to cmsrequisitionformdtls_tbl, cmscontracthdr_tbl
 * @property int $crpsd_shared_type 1 - Requisition/ Tender Notice, 2 - Contract
 * @property int $crpsd_type 1 - Product, 2 - Service
 * @property int $crpsd_sharedmst_fk Reference to productmst_tbl, servicemst_tbl
 * @property int $crpsd_shareddtls_fk Reference to memcompproddtls_tbl, memcompservicedtls_tbl
 * @property string $crpsd_displayname Display Name
 * @property string $crpsd_description Description of product/service
 * @property string $crpsd_quantity Quantity of product/service
 * @property int $crpsd_unitmst_fk Reference to unitmst_tbl
 * @property string $crpsd_tagno Tag number
 * @property string $crpsd_specothers Other Specification
 * @property int $crpsd_deliv_mcmpld_fk Reference to memcompmplocationdtls_tbl
 * @property int $crpsd_delivloctype  1- Branch, 2 - Warehouse, 3 - Others
 * @property string $crpsd_delivloctypeothers to specify if delivery location type is selected as others
 * @property string $crpsd_delivreqdate ROS Date (Required On-Site)
 * @property string $crpsd_delivdeferreddate Don't Deliver before
 * @property int $crpsd_delivmodeoftrans Prefered Mode of Transport 1- Railways, 2- Roadways, 3- Airways, 4- Waterways
 * @property int $crpsd_delivfreightterms Freight Terms. 1 - EXW - Ex-Works  or Ex-Warehouse, 2 - FCA - Free Carrier, 3 - FAS - Free Alongside Ship, 4 - FOB - Free On Board, 5 - CFR - Cost and Freight, 6 - CIF - Cost, Insurance and Freight, 7 - CPT  - Carriage Paid To, 8 - CIP - Carriage And Insurance Paid To, 9 - DAP - Delivered At Place, 10 - DPU - Delivered At Place Unloaded (replaces Incoterm® 2010 DAT), 11 - DDP - Delivered Duty Paid
 * @property string $crpsd_delivtac Delivery Terms & Conditions
 * @property string $crpsd_delivremarks Delivery Remarks
 * @property string $crpsd_createdon Date of creation
 * @property int $crpsd_createdby Reference to usermst_tbl
 * @property string $crpsd_createdbyipaddr User IP Address
 * @property string $crpsd_updatedon Date of update
 * @property int $crpsd_updatedby Reference to usermst_tbl
 * @property string $crpsd_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $crpsdCreatedby
 * @property UnitmstTbl $crpsdUnitmstFk
 * @property UsermstTbl $crpsdUpdatedby
 * @property CmsrqprodservtrnxTbl[] $cmsrqprodservtrnxTbls
 * @property CmstenderpsmapTbl[] $cmstenderpsmapTbls
 */
class CmsrqprodservdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpsd_shared_fk', 'crpsd_shared_type', 'crpsd_type', 'crpsd_sharedmst_fk', 'crpsd_quantity', 'crpsd_createdon', 'crpsd_createdby', 'crpsd_createdbyipaddr'], 'required'],
            [['crpsd_shared_fk', 'crpsd_shared_type', 'crpsd_type', 'crpsd_sharedmst_fk', 'crpsd_shareddtls_fk', 'crpsd_unitmst_fk', 'crpsd_deliv_mcmpld_fk', 'crpsd_delivloctype', 'crpsd_delivmodeoftrans', 'crpsd_delivfreightterms', 'crpsd_createdby', 'crpsd_updatedby'], 'integer'],
            [['crpsd_description', 'crpsd_specothers', 'crpsd_delivloctypeothers', 'crpsd_delivtac', 'crpsd_delivremarks'], 'string'],
            [['crpsd_quantity'], 'number'],
            [['crpsd_delivreqdate', 'crpsd_delivdeferreddate', 'crpsd_createdon', 'crpsd_updatedon'], 'safe'],
            [['crpsd_displayname'], 'string', 'max' => 255],
            [['crpsd_tagno'], 'string', 'max' => 25],
            [['crpsd_createdbyipaddr', 'crpsd_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpsd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['crpsd_createdby' => 'UserMst_Pk']],
            [['crpsd_unitmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\UnitmstTbl::className(), 'targetAttribute' => ['crpsd_unitmst_fk' => 'unitmst_pk']],
            [['crpsd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['crpsd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservdtls_pk' => 'Cmsrqprodservdtls Pk',
            'crpsd_shared_fk' => 'Crpsd Shared Fk',
            'crpsd_shared_type' => 'Crpsd Shared Type',
            'crpsd_type' => 'Crpsd Type',
            'crpsd_sharedmst_fk' => 'Crpsd Sharedmst Fk',
            'crpsd_shareddtls_fk' => 'Crpsd Shareddtls Fk',
            'crpsd_displayname' => 'Crpsd Displayname',
            'crpsd_description' => 'Crpsd Description',
            'crpsd_quantity' => 'Crpsd Quantity',
            'crpsd_unitmst_fk' => 'Crpsd Unitmst Fk',
            'crpsd_tagno' => 'Crpsd Tagno',
            'crpsd_specothers' => 'Crpsd Specothers',
            'crpsd_deliv_mcmpld_fk' => 'Crpsd Deliv Mcmpld Fk',
            'crpsd_delivloctype' => 'Crpsd Delivloctype',
            'crpsd_delivloctypeothers' => 'Crpsd Delivloctypeothers',
            'crpsd_delivreqdate' => 'Crpsd Delivreqdate',
            'crpsd_delivdeferreddate' => 'Crpsd Delivdeferreddate',
            'crpsd_delivmodeoftrans' => 'Crpsd Delivmodeoftrans',
            'crpsd_delivfreightterms' => 'Crpsd Delivfreightterms',
            'crpsd_delivtac' => 'Crpsd Delivtac',
            'crpsd_delivremarks' => 'Crpsd Delivremarks',
            'crpsd_createdon' => 'Crpsd Createdon',
            'crpsd_createdby' => 'Crpsd Createdby',
            'crpsd_createdbyipaddr' => 'Crpsd Createdbyipaddr',
            'crpsd_updatedon' => 'Crpsd Updatedon',
            'crpsd_updatedby' => 'Crpsd Updatedby',
            'crpsd_updatedbyipaddr' => 'Crpsd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdCreatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'crpsd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdUnitmstFk()
    {
        return $this->hasOne(\api\modules\mst\models\UnitmstTbl::className(), ['unitmst_pk' => 'crpsd_unitmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdUpdatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'crpsd_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrqprodservtrnxTbls()
    {
        return $this->hasMany(CmsrqprodservtrnxTbl::className(), ['crpst_cmsprodservdtls_fk' => 'cmsrqprodservdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderpsmapTbls()
    {
        return $this->hasMany(CmstenderpsmapTbl::className(), ['ctpsm_cmsrqprodservdtls_fk' => 'cmsrqprodservdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmscontracthdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmscontracthdrTblQuery(get_called_class());
    }
}
