<?php

namespace api\modules\pms\models;

use Yii;
use \common\models\UsermstTbl;
use \api\modules\mst\models\UnitmstTbl;

/**
 * This is the model class for table "cmsrqprodservdtlshsty_tbl".
 *
 * @property int $cmsrqprodservdtlshsty_pk Primary key
 * @property int $crpsdh_cmsrqprodservdtls_fk Reference to cmsrqprodservdtls_tbl.cmsrqprodservdtls_pk
 * @property int $crpsdh_shared_fk Reference to cmsrequisitionformdtls_tbl, cmscontracthdr_tbl, cmstenderhdr_tbl
 * @property int $crpsdh_shared_type 1 - Requisition/ Tender Notice, 2 - Contract, 3 -  Enquiry (RFI, EOI,etc,.)
 * @property int $crpsdh_type 1 - Product, 2 - Service
 * @property int $crpsdh_sharedmst_fk Reference to productmst_tbl, servicemst_tbl
 * @property int $crpsdh_shareddtls_fk Reference to memcompproddtls_tbl, memcompservicedtls_tbl
 * @property string $crpsdh_displayname Display Name
 * @property string $crpsdh_description Description of product/service
 * @property string $crpsdh_quantity Quantity of product/service
 * @property int $crpsdh_unitmst_fk Reference to unitmst_tbl
 * @property string $crpsdh_tagno Tag number
 * @property string $crpsdh_specothers Other Specification
 * @property int $crpsdh_deliv_mcmpld_fk Reference to memcompmplocationdtls_tbl
 * @property int $crpsdh_delivloctype  1- Branch, 2 - Warehouse, 3 - Others
 * @property string $crpsdh_delivloctypeothers to specify if delivery location type is selected as others
 * @property string $crpsdh_delivreqdate ROS Date (Required On-Site)
 * @property string $crpsdh_delivdeferreddate Don't Deliver before
 * @property int $crpsdh_delivmodeoftrans Prefered Mode of Transport 1- Railways, 2- Roadways, 3- Airways, 4- Waterways
 * @property int $crpsdh_delivfreightterms Freight Terms. 1 - EXW - Ex-Works  or Ex-Warehouse, 2 - FCA - Free Carrier, 3 - FAS - Free Alongside Ship, 4 - FOB - Free On Board, 5 - CFR - Cost and Freight, 6 - CIF - Cost, Insurance and Freight, 7 - CPT  - Carriage Paid To, 8 - CIP - Carriage And Insurance Paid To, 9 - DAP - Delivered At Place, 10 - DPU - Delivered At Place Unloaded (replaces Incoterm® 2010 DAT), 11 - DDP - Delivered Duty Paid
 * @property string $crpsdh_delivtac Delivery Terms & Conditions
 * @property string $crpsdh_delivremarks Delivery Remarks
 * @property string $crpsdh_createdon Date of creation
 * @property int $crpsdh_createdby Reference to usermst_tbl
 * @property string $crpsdh_createdbyipaddr User IP Address
 * @property string $crpsdh_updatedon Date of update
 * @property int $crpsdh_updatedby Reference to usermst_tbl
 * @property string $crpsdh_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $crpsdhCreatedby
 * @property UnitmstTbl $crpsdhUnitmstFk
 * @property UsermstTbl $crpsdhUpdatedby
 */
class CmsrqprodservdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpsdh_cmsrqprodservdtls_fk', 'crpsdh_shared_fk', 'crpsdh_shared_type', 'crpsdh_type', 'crpsdh_sharedmst_fk', 'crpsdh_quantity', 'crpsdh_createdon', 'crpsdh_createdby', 'crpsdh_createdbyipaddr'], 'required'],
            [['crpsdh_cmsrqprodservdtls_fk', 'crpsdh_shared_fk', 'crpsdh_shared_type', 'crpsdh_type', 'crpsdh_sharedmst_fk', 'crpsdh_shareddtls_fk', 'crpsdh_unitmst_fk', 'crpsdh_deliv_mcmpld_fk', 'crpsdh_delivloctype', 'crpsdh_delivmodeoftrans', 'crpsdh_delivfreightterms', 'crpsdh_createdby', 'crpsdh_updatedby'], 'integer'],
            [['crpsdh_description', 'crpsdh_specothers', 'crpsdh_delivloctypeothers', 'crpsdh_delivtac', 'crpsdh_delivremarks'], 'string'],
            [['crpsdh_quantity'], 'number'],
            [['crpsdh_delivreqdate', 'crpsdh_delivdeferreddate', 'crpsdh_createdon', 'crpsdh_updatedon'], 'safe'],
            [['crpsdh_displayname'], 'string', 'max' => 255],
            [['crpsdh_tagno'], 'string', 'max' => 25],
            [['crpsdh_createdbyipaddr', 'crpsdh_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpsdh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsdh_createdby' => 'UserMst_Pk']],
            [['crpsdh_unitmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UnitmstTbl::className(), 'targetAttribute' => ['crpsdh_unitmst_fk' => 'unitmst_pk']],
            [['crpsdh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsdh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservdtlshsty_pk' => 'Cmsrqprodservdtlshsty Pk',
            'crpsdh_cmsrqprodservdtls_fk' => 'Crpsdh Cmsrqprodservdtls Fk',
            'crpsdh_shared_fk' => 'Crpsdh Shared Fk',
            'crpsdh_shared_type' => 'Crpsdh Shared Type',
            'crpsdh_type' => 'Crpsdh Type',
            'crpsdh_sharedmst_fk' => 'Crpsdh Sharedmst Fk',
            'crpsdh_shareddtls_fk' => 'Crpsdh Shareddtls Fk',
            'crpsdh_displayname' => 'Crpsdh Displayname',
            'crpsdh_description' => 'Crpsdh Description',
            'crpsdh_quantity' => 'Crpsdh Quantity',
            'crpsdh_unitmst_fk' => 'Crpsdh Unitmst Fk',
            'crpsdh_tagno' => 'Crpsdh Tagno',
            'crpsdh_specothers' => 'Crpsdh Specothers',
            'crpsdh_deliv_mcmpld_fk' => 'Crpsdh Deliv Mcmpld Fk',
            'crpsdh_delivloctype' => 'Crpsdh Delivloctype',
            'crpsdh_delivloctypeothers' => 'Crpsdh Delivloctypeothers',
            'crpsdh_delivreqdate' => 'Crpsdh Delivreqdate',
            'crpsdh_delivdeferreddate' => 'Crpsdh Delivdeferreddate',
            'crpsdh_delivmodeoftrans' => 'Crpsdh Delivmodeoftrans',
            'crpsdh_delivfreightterms' => 'Crpsdh Delivfreightterms',
            'crpsdh_delivtac' => 'Crpsdh Delivtac',
            'crpsdh_delivremarks' => 'Crpsdh Delivremarks',
            'crpsdh_createdon' => 'Crpsdh Createdon',
            'crpsdh_createdby' => 'Crpsdh Createdby',
            'crpsdh_createdbyipaddr' => 'Crpsdh Createdbyipaddr',
            'crpsdh_updatedon' => 'Crpsdh Updatedon',
            'crpsdh_updatedby' => 'Crpsdh Updatedby',
            'crpsdh_updatedbyipaddr' => 'Crpsdh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsdh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdhUnitmstFk()
    {
        return $this->hasOne(UnitmstTbl::className(), ['unitmst_pk' => 'crpsdh_unitmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsdh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqprodservdtlshstyTblQuery(get_called_class());
    }
}
