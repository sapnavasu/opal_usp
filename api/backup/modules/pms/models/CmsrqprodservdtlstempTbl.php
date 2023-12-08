<?php

namespace api\modules\pms\models;

use Yii;
use \common\models\UsermstTbl;
use \api\modules\mst\models\UnitmstTbl;

/**
 * This is the model class for table "cmsrqprodservdtlstemp_tbl".
 *
 * @property int $cmsrqprodservdtlstemp_pk Primary key
 * @property int $crpsdt_shared_fk Reference to cmsrequisitionformdtls_tbl, cmscontracthdr_tbl, cmstenderhdr_tbl
 * @property int $crpsdt_shared_type 1 - Requisition/ Tender Notice, 2 - Contract, 3 -  Enquiry (RFI, EOI,etc,.)
 * @property int $crpsdt_type 1 - Product, 2 - Service
 * @property int $crpsdt_sharedmst_fk Reference to productmst_tbl, servicemst_tbl
 * @property int $crpsdt_shareddtls_fk Reference to memcompproddtls_tbl, memcompservicedtls_tbl
 * @property string $crpsdt_displayname Display Name
 * @property string $crpsdt_description Description of product/service
 * @property string $crpsdt_quantity Quantity of product/service
 * @property int $crpsdt_unitmst_fk Reference to unitmst_tbl
 * @property string $crpsdt_tagno Tag number
 * @property string $crpsdt_specothers Other Specification
 * @property int $crpsdt_deliv_mcmpld_fk Reference to memcompmplocationdtls_tbl
 * @property int $crpsdt_delivloctype  1- Branch, 2 - Warehouse, 3 - Others
 * @property string $crpsdt_delivloctypeothers to specify if delivery location type is selected as others
 * @property string $crpsdt_delivreqdate ROS Date (Required On-Site)
 * @property string $crpsdt_delivdeferreddate Don't Deliver before
 * @property int $crpsdt_delivmodeoftrans Prefered Mode of Transport 1- Railways, 2- Roadways, 3- Airways, 4- Waterways
 * @property int $crpsdt_delivfreightterms Freight Terms. 1 - EXW - Ex-Works  or Ex-Warehouse, 2 - FCA - Free Carrier, 3 - FAS - Free Alongside Ship, 4 - FOB - Free On Board, 5 - CFR - Cost and Freight, 6 - CIF - Cost, Insurance and Freight, 7 - CPT  - Carriage Paid To, 8 - CIP - Carriage And Insurance Paid To, 9 - DAP - Delivered At Place, 10 - DPU - Delivered At Place Unloaded (replaces Incoterm® 2010 DAT), 11 - DDP - Delivered Duty Paid
 * @property string $crpsdt_delivtac Delivery Terms & Conditions
 * @property string $crpsdt_delivremarks Delivery Remarks
 * @property string $crpsdt_createdon Date of creation
 * @property int $crpsdt_createdby Reference to usermst_tbl
 * @property string $crpsdt_createdbyipaddr User IP Address
 * @property string $crpsdt_updatedon Date of update
 * @property int $crpsdt_updatedby Reference to usermst_tbl
 * @property string $crpsdt_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $crpsdtCreatedby
 * @property UnitmstTbl $crpsdtUnitmstFk
 * @property UsermstTbl $crpsdtUpdatedby
 */
class CmsrqprodservdtlstempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservdtlstemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpsdt_shared_fk', 'crpsdt_shared_type', 'crpsdt_type', 'crpsdt_sharedmst_fk', 'crpsdt_quantity', 'crpsdt_createdon', 'crpsdt_createdby', 'crpsdt_createdbyipaddr'], 'required'],
            [['crpsdt_shared_fk', 'crpsdt_shared_type', 'crpsdt_type', 'crpsdt_sharedmst_fk', 'crpsdt_shareddtls_fk', 'crpsdt_unitmst_fk', 'crpsdt_deliv_mcmpld_fk', 'crpsdt_delivloctype', 'crpsdt_delivmodeoftrans', 'crpsdt_delivfreightterms', 'crpsdt_createdby', 'crpsdt_updatedby'], 'integer'],
            [['crpsdt_description', 'crpsdt_specothers', 'crpsdt_delivloctypeothers', 'crpsdt_delivtac', 'crpsdt_delivremarks'], 'string'],
            [['crpsdt_quantity'], 'number'],
            [['crpsdt_delivreqdate', 'crpsdt_delivdeferreddate', 'crpsdt_createdon', 'crpsdt_updatedon'], 'safe'],
            [['crpsdt_displayname'], 'string', 'max' => 255],
            [['crpsdt_tagno'], 'string', 'max' => 25],
            [['crpsdt_createdbyipaddr', 'crpsdt_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpsdt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsdt_createdby' => 'UserMst_Pk']],
            [['crpsdt_unitmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UnitmstTbl::className(), 'targetAttribute' => ['crpsdt_unitmst_fk' => 'unitmst_pk']],
            [['crpsdt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['crpsdt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservdtlstemp_pk' => 'Cmsrqprodservdtlstemp Pk',
            'crpsdt_shared_fk' => 'Crpsdt Shared Fk',
            'crpsdt_shared_type' => 'Crpsdt Shared Type',
            'crpsdt_type' => 'Crpsdt Type',
            'crpsdt_sharedmst_fk' => 'Crpsdt Sharedmst Fk',
            'crpsdt_shareddtls_fk' => 'Crpsdt Shareddtls Fk',
            'crpsdt_displayname' => 'Crpsdt Displayname',
            'crpsdt_description' => 'Crpsdt Description',
            'crpsdt_quantity' => 'Crpsdt Quantity',
            'crpsdt_unitmst_fk' => 'Crpsdt Unitmst Fk',
            'crpsdt_tagno' => 'Crpsdt Tagno',
            'crpsdt_specothers' => 'Crpsdt Specothers',
            'crpsdt_deliv_mcmpld_fk' => 'Crpsdt Deliv Mcmpld Fk',
            'crpsdt_delivloctype' => 'Crpsdt Delivloctype',
            'crpsdt_delivloctypeothers' => 'Crpsdt Delivloctypeothers',
            'crpsdt_delivreqdate' => 'Crpsdt Delivreqdate',
            'crpsdt_delivdeferreddate' => 'Crpsdt Delivdeferreddate',
            'crpsdt_delivmodeoftrans' => 'Crpsdt Delivmodeoftrans',
            'crpsdt_delivfreightterms' => 'Crpsdt Delivfreightterms',
            'crpsdt_delivtac' => 'Crpsdt Delivtac',
            'crpsdt_delivremarks' => 'Crpsdt Delivremarks',
            'crpsdt_createdon' => 'Crpsdt Createdon',
            'crpsdt_createdby' => 'Crpsdt Createdby',
            'crpsdt_createdbyipaddr' => 'Crpsdt Createdbyipaddr',
            'crpsdt_updatedon' => 'Crpsdt Updatedon',
            'crpsdt_updatedby' => 'Crpsdt Updatedby',
            'crpsdt_updatedbyipaddr' => 'Crpsdt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsdt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdtUnitmstFk()
    {
        return $this->hasOne(UnitmstTbl::className(), ['unitmst_pk' => 'crpsdt_unitmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpsdtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'crpsdt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlstempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqprodservdtlstempTblQuery(get_called_class());
    }
}
