<?php

namespace api\modules\mst\models;

use api\modules\pd\models\MemcompmplocationdtlsTbl;
use common\components\Security;
use common\models\MemcompproddtlsTbl;
use Yii;

/**
 * This is the model class for table "memcompprodmarketpresence_tbl".
 *
 * @property int $memcompprodmarketpresence_pk Primary
 * @property int $mcpmp_memcompproddtls_fk Reference to memcompproddtls_tbl
 * @property int $mcpmp_memcompmplocationdtls_fk Reference to memcompmplocationdtls_tbl
 */
class MemcompprodmarketpresenceTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodmarketpresence_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpmp_memcompproddtls_fk', 'mcpmp_memcompmplocationdtls_fk'], 'required'],
            [['mcpmp_memcompproddtls_fk', 'mcpmp_memcompmplocationdtls_fk'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodmarketpresence_pk' => 'Memcompprodmarketpresence Pk',
            'mcpmp_memcompproddtls_fk' => 'Mcpmp Memcompproddtls Fk',
            'mcpmp_memcompmplocationdtls_fk' => 'Mcpmp Memcompmplocationdtls Fk',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmarketpresenceTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodmarketpresenceTblQuery(get_called_class());
    }

    public static function savedata($data,$model){
        if($data && $model){
            $data_ids= $data['string_ids'];
            $product_pk=$model->MemCompProdDtls_Pk;
            $type_lc=$data['locationtype'];
            $location_dt=MemcompprodmarketpresenceTbl::find()->select('group_concat(memcompprodmarketpresence_pk) as marketpresence')
                ->innerJoin('memcompmplocationdtls_tbl','mcpmp_memcompmplocationdtls_fk=memcompmplocationdtls_pk')
                ->where('mcpmp_memcompproddtls_fk=:prod and mcmpld_locationtype =:lctype',[':prod'=>$product_pk,':lctype'=>$type_lc])->asArray()->all();
                if($product_pk || $location_dt){
                $set_of_loction_ids=$location_dt[0]['marketpresence']?$location_dt[0]['marketpresence']:0;
                $save_marketpresence=MemcompprodmarketpresenceTbl::find()->where('memcompprodmarketpresence_pk in('.$set_of_loction_ids.')')->exists();
                $log_url = '/j3/api/pm/profile/partisionsave';
                if($location_dt[0]['marketpresence'] ==  null) {
                    $log_msg = 'Saved ' . $data['addinfo_name'] . " Details";
                    $log_action = 1;
                } else {
                    $log_msg = 'Edited ' . $data['addinfo_name'] . " Details";
                    $log_action = 2;
                }
                if($save_marketpresence){
                    $delete_model=MemcompprodmarketpresenceTbl::deleteAll('memcompprodmarketpresence_pk in('.$set_of_loction_ids.')');
                    $log_msg = 'Deleted ' . $data['addinfo_name'] . " Information";
                    $log_action = 3;
                }
                if($data_ids){
                    $arr_data_ids=explode(',',$data_ids);
                    foreach ($arr_data_ids as $val_dt){
                        $mark_pr_model=New MemcompprodmarketpresenceTbl();
                        $mark_pr_model->mcpmp_memcompproddtls_fk=$product_pk;
                        $mark_pr_model->mcpmp_memcompmplocationdtls_fk=$val_dt;
                        if(!$mark_pr_model->save(false)){
                            $error[]=$mark_pr_model->getErrors();
                        }
                    }
                }
            }
            \common\components\UserActivityLog::logUserActivity($log_action, $log_msg, $log_url, 22);
        }
        return empty($error)?$model:$error;
    }
}
