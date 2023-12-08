<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "unspcbipcmapping_tbl".
 *
 * @property int $unspcbipcmapping_pk Primary key
 * @property int $ubpm_bgiinduscodeprodmst_fk Reference t bgiinduscodeprodmst_tbl
 * @property int $ubpm_productmst_fk Reference to productmst_tbl
 */
class UnspcbipcmappingTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unspcbipcmapping_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubpm_bgiinduscodeprodmst_fk', 'ubpm_productmst_fk'], 'required'],
            [['ubpm_bgiinduscodeprodmst_fk', 'ubpm_productmst_fk'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unspcbipcmapping_pk' => 'Unspcbipcmapping Pk',
            'ubpm_bgiinduscodeprodmst_fk' => 'Ubpm Bgiinduscodeprodmst Fk',
            'ubpm_productmst_fk' => 'Ubpm Productmst Tbl',
        ];
    }

    public function getproductmstlist($request =  null) {
        if(isset($_GET['product']) && !empty($_GET['product'])) { 
            $product = $_GET['product'];
        } else {
            $product = $request['productid'];
        }
        if(isset($product) && !empty($product))
        { 
            
            $productmstmodel = self::find()
                ->select(['ProductMst_Pk','PrdM_ProductCode', 'PrdM_ProductName'])
                ->leftJoin('productmst_tbl','ProductMst_Pk = ubpm_productmst_fk')
                ->where(['=', 'ubpm_bgiinduscodeprodmst_fk', $product])
                ->andWhere(['!=', 'PrdM_ProductName', '-'])
                ->andWhere('PrdM_ProductName is not null')
                ->orderBy('PrdM_ProductName ASC')
                ->asArray()->all();
                // echo self::find()
                // ->select(['ProductMst_Pk','PrdM_ProductCode', 'PrdM_ProductName'])
                // ->leftJoin('productmst_tbl','ProductMst_Pk = ubpm_productmst_fk')
                // ->where(['=', 'ubpm_bgiinduscodeprodmst_fk', $product])
                // ->andWhere(['!=', 'PrdM_ProductName', '-'])
                // ->andWhere('PrdM_ProductName is not null')
                // ->orderBy('PrdM_ProductName ASC')->createCommand()->getRawSql();
            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($productmstmodel) ? $productmstmodel : [],
                'total_count' => count($productmstmodel),
            ];
        }
    }

    public function getproductmstlistforcompany($request =  null) {
       
        $prodservid = $request['proservid'];
        $type = $request['type'];
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        if(isset($prodservid) && !empty($prodservid)) { 

            if($type == 'P') {
                $proservmstmodel = self::find()
                    ->select(['ProductMst_Pk','PrdM_ProductCode', 'PrdM_ProductName'])
                    ->leftJoin('productmst_tbl','ProductMst_Pk = ubpm_productmst_fk')
                    ->leftJoin('memcompproddtls_tbl','ProductMst_Pk = MCPrD_ProductMst_Fk')
                    ->where(['=', 'ubpm_bgiinduscodeprodmst_fk', $prodservid])
                    ->andWhere(['=', 'MCPrD_MemberCompMst_Fk', $company_id])
                    ->groupBy('ProductMst_Pk')
                    ->orderBy('PrdM_ProductName ASC')
                    ->asArray()->all();
            } else {
                $proservmstmodel = UnsscbiscmappingTbl::find()
                    ->select(['ServiceMst_Pk','SrvM_ServiceCode', 'SrvM_ServiceName'])
                    ->leftJoin('servicemst_tbl','ServiceMst_Pk = ubsm_servicemst_fk')
                    ->leftJoin('memcompservicedtls_tbl','ServiceMst_Pk = MCSvD_ServiceMst_Fk')
                    ->where(['=', 'ubsm_bgiinduscodeservmst_fk', $prodservid])
                    ->andWhere(['=', 'MCSvD_MemberCompMst_Fk', $company_id])
                    ->groupBy('ServiceMst_Pk')
                    ->orderBy('SrvM_ServiceName ASC')
                    ->asArray()->all();
            }
            

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($proservmstmodel) ? $proservmstmodel : [],
                'total_count' => count($proservmstmodel),
            ];
        }
    }
}