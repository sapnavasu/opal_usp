<?php

namespace api\modules\gcc\models;

use Yii;

/**
 * This is the model class for table "gcctenddtls_tbl".
 *
 * @property int $gcctenddtls_pk
 * @property string $gtd_postingid Unique Id which is used by the GCC tender team for their internal reference
 * @property string $gtd_refno Tender Notice Reference Number
 * @property string $gtd_tendername Tender Name
 * @property string $gtd_projectname Project Name
 * @property string $gtd_corrigendum Corrigendum Details
 * @property string $gtd_noticetype Notice Type
 * @property string $gtd_biddingtype Bidding Type
 * @property string $gtd_tenderpublishedon The published date of tender
 * @property int $gtd_currencymst_fk Reference to currency master table
 * @property string $gtd_estcost Estimated Tender Cost
 * @property string $gtd_tenderdesc Tender Description
 * @property string $gtd_region Tender Location – Region
 * @property string $gtd_regioncode Tender Location – Region Code
 * @property int $gtd_citymst_fk Reference to city master table
 * @property int $gtd_statemst_fk Reference to state master table
 * @property int $gtd_pincode Pin code
 * @property int $gtd_countrymst_fk Reference to country master table
 * @property int $gtd_status If the tender is active or not. Active - 1, Inactive – 0
 * @property string $gtd_createdon The date and time when the record is created
 * @property string $gtd_updatedon
 */
class GcctenddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcctenddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gtd_postingid', 'gtd_refno', 'gtd_tendername', 'gtd_noticetype', 'gtd_biddingtype', 'gtd_tenderpublishedon', 'gtd_tenderdesc', 'gtd_status', 'gtd_createdon'], 'required'],
            [['gtd_postingid', 'gtd_currencymst_fk', 'gtd_citymst_fk', 'gtd_statemst_fk', 'gtd_pincode', 'gtd_countrymst_fk', 'gtd_status'], 'integer'],
            [['gtd_tendername', 'gtd_tenderdesc', 'gtd_regioncode'], 'string'],
            [['gtd_tenderpublishedon', 'gtd_createdon', 'gtd_updatedon'], 'safe'],
            [['gtd_refno'], 'string', 'max' => 250],
            [['gtd_projectname', 'gtd_corrigendum'], 'string', 'max' => 150],
            [['gtd_noticetype', 'gtd_estcost'], 'string', 'max' => 20],
            [['gtd_biddingtype', 'gtd_region'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcctenddtls_pk' => 'Gcctenddtls Pk',
            'gtd_postingid' => 'Gtd Postingid',
            'gtd_refno' => 'Gtd Refno',
            'gtd_tendername' => 'Gtd Tendername',
            'gtd_projectname' => 'Gtd Projectname',
            'gtd_corrigendum' => 'Gtd Corrigendum',
            'gtd_noticetype' => 'Gtd Noticetype',
            'gtd_biddingtype' => 'Gtd Biddingtype',
            'gtd_tenderpublishedon' => 'Gtd Tenderpublishedon',
            'gtd_currencymst_fk' => 'Gtd Currencymst Fk',
            'gtd_estcost' => 'Gtd Estcost',
            'gtd_tenderdesc' => 'Gtd Tenderdesc',
            'gtd_region' => 'Gtd Region',
            'gtd_regioncode' => 'Gtd Regioncode',
            'gtd_citymst_fk' => 'Gtd Citymst Fk',
            'gtd_statemst_fk' => 'Gtd Statemst Fk',
            'gtd_pincode' => 'Gtd Pincode',
            'gtd_countrymst_fk' => 'Gtd Countrymst Fk',
            'gtd_status' => 'Gtd Status',
            'gtd_createdon' => 'Gtd Createdon',
            'gtd_updatedon' => 'Gtd Updatedon',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GcctenddtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GcctenddtlsTblQuery(get_called_class());
    }

    public function getSectorlist($compk) {
       
        if (!empty($compk)) {
              $seclist =  "SELECT `t`.`gtssd_totaltenders`, `t`.`gtssd_unreadtend`,`t`.`gtssd_gcctendsectmst_fk`,gtsm_sectorname,
            `t`.`gtssd_subscriptionstatus`, `t`.`gtssd_subscribedfrom`, `t`.`gtssd_subscribedto`
            FROM `gcctendsectorsubsdtls_tbl` `t` 
            Left join gcctendsubsdtls_tbl as gcc on gcc.gcctendsubsdtls_pk = t.gtssd_gcctendsubsdtls_fk
            Left join jsrst3invoicedtls_tbl as inv on inv.jsrst3invoicedtls_pk = t.gtssd_jsrst3invoicedtls_fk 
            left join gcctendsectmst_tbl as gsm on gtssd_gcctendsectmst_fk = gsm. gcctendsectmst_pk
            WHERE (gcc.gtsd_membcompmst_fk=$compk) 
            AND (if(gtssd_subscriptionstatus IN(5,6,9) AND gtssd_subscribedto > now(),1,if(gtssd_subscriptionstatus IN (3,7) OR inv.jtid_invoicestatus IN ('CP'),1,0))) order by gtssd_subscribedto desc";
            $seclistres = Yii::$app->db->createCommand($seclist)->queryAll();
          }  
          if(!empty($seclistres)){
        foreach($seclistres as $key=>$value){
        $response['data'][$key]['gtssd_totaltenders'] = $value['gtssd_totaltenders'];
        $response['data'][$key]['gtssd_unreadtend'] = $value['gtssd_unreadtend'];
        $response['data'][$key]['gtssd_gcctendsectmst_fk'] = $value['gtssd_gcctendsectmst_fk'];
        $response['data'][$key]['gtsm_sectorname'] = $value['gtsm_sectorname'];
        $response['data'][$key]['gtssd_subscriptionstatus'] = $value['gtssd_subscriptionstatus'];
        $response['data'][$key]['gtssd_subscribedfrom'] = $value['gtssd_subscribedfrom'];
        $response['data'][$key]['gtssd_subscribedto'] = $value['gtssd_subscribedto'];
        }  
        }  
        return $response;
        }
}
