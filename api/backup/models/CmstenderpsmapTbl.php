<?php

namespace app\models;
use Yii;
use common\components\Security;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

/**
 * This is the model class for table "cmstenderpsmap_tbl".
 *
 * @property int $cmstenderpsmap_pk Primary key
 * @property int $ctpsm_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property int $ctpsm_cmsrqprodservdtls_fk Reference to cmsrqprodservdtls_tbl
 * @property string $ctpsm_quantity Quantity of product/service
 *
 * @property CmsrqprodservdtlsTbl $ctpsmCmsrqprodservdtlsFk
 * @property CmstenderhdrTbl $ctpsmCmstenderhdrFk
 */
class CmstenderpsmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderpsmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctpsm_cmstenderhdr_fk', 'ctpsm_cmsrqprodservdtls_fk', 'ctpsm_quantity'], 'required'],
            [['ctpsm_cmstenderhdr_fk', 'ctpsm_cmsrqprodservdtls_fk'], 'integer'],
            [['ctpsm_quantity'], 'number'],
            [['ctpsm_cmsrqprodservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservdtlsTbl::className(), 'targetAttribute' => ['ctpsm_cmsrqprodservdtls_fk' => 'cmsrqprodservdtls_pk']],
            [['ctpsm_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['ctpsm_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderpsmap_pk' => 'Cmstenderpsmap Pk',
            'ctpsm_cmstenderhdr_fk' => 'Ctpsm Cmstenderhdr Fk',
            'ctpsm_cmsrqprodservdtls_fk' => 'Ctpsm Cmsrqprodservdtls Fk',
            'ctpsm_quantity' => 'Ctpsm Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmCmsrqprodservdtlsFk()
    {
        return $this->hasOne(CmsrqprodservdtlsTbl::className(), ['cmsrqprodservdtls_pk' => 'ctpsm_cmsrqprodservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtpsmCmstenderhdrFk()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'ctpsm_cmstenderhdr_fk']);
    }

    /**
     * {@inheritdoc}
     * @return MapreqproductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MapreqproductQuery(get_called_class());
    }

    public static function getAwardedcontractList($data) {
        $query = CmstenderpsmapTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        $pageIndex =  Security::sanitizeInput($data['index'], "number");

        $query->select('*');

        /*if($sortpk==1){
            $query->orderBy('MRM_CreatedOn DESC');
        } else {
            $query->orderBy('MRM_CreatedOn ASC');    
        }*/
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page,'page' => $pageIndex]]);

        return [
            'items' =>$provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'page' => $pageIndex

        ];
    }
}
