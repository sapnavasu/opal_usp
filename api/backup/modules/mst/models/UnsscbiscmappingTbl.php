<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "unsscbiscmapping_tbl".
 *
 * @property int $unsscbiscmapping_pk Primary key
 * @property int $ubsm_bgiinduscodeservmst_fk Reference to bgiinduscodeservmst_tbl
 * @property int $ubsm_servicemst_fk Reference to servicemst_tbl
 */
class UnsscbiscmappingTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unsscbiscmapping_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubsm_bgiinduscodeservmst_fk', 'ubsm_servicemst_fk'], 'required'],
            [['ubsm_bgiinduscodeservmst_fk', 'ubsm_servicemst_fk'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unsscbiscmapping_pk' => 'Unsscbiscmapping Pk',
            'ubsm_bgiinduscodeservmst_fk' => 'Ubsm Bgiinduscodeservmst Fk',
            'ubsm_servicemst_fk' => 'Ubsm Servicemst Tbl',
        ];
    }

    public function getservicemstlist() {
        if(isset($_GET['service']) && !empty($_GET['service']))
        { 
            $serivce = $_GET['service'];
            
            $servicemstmodel = self::find()
                ->select(['ServiceMst_Pk','SrvM_ServiceCode', 'SrvM_ServiceName'])
                ->leftJoin('servicemst_tbl','ServiceMst_Pk = ubsm_servicemst_fk')
                ->where(['=', 'ubsm_bgiinduscodeservmst_fk', $serivce])
                ->andWhere(['!=', 'SrvM_ServiceName', '-'])
                ->andWhere('SrvM_ServiceName is not null')
                ->orderBy('SrvM_ServiceName ASC')
                ->asArray()->all();

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($servicemstmodel) ? $servicemstmodel : [],
                'total_count' => count($servicemstmodel),
            ];
        }
    }
}