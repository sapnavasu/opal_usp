<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "memcompboardmemdtls_tbl".
 *
 * @property int $memcompboardmemdtls_pk
 * @property int $mcbmd_membercompmst_fk
 * @property int $mcbmd_type 1-Board Member, 2-Management Team
 * @property string $mcbmd_name
 * @property int $mcbmd_upload
 * @property string $mcbmd_desgination
 * @property string $mcbmd_shortbio
 * @property int $mcbmd_nationality reference to countrymst_tbl
 * @property string $mcbmd_msgfrom
 * @property string $mcbmd_linkedin
 * @property string $mcbmd_createdon
 * @property int $mcbmd_createdby
 * @property string $mcbmd_updatedon
 * @property int $mcbmd_updatedby
 */
class MemcompboardmemdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompboardmemdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbmd_membercompmst_fk', 'mcbmd_createdon', 'mcbmd_createdby'], 'required'],
            [['mcbmd_membercompmst_fk', 'mcbmd_type', 'mcbmd_upload', 'mcbmd_nationality', 'mcbmd_createdby', 'mcbmd_updatedby'], 'integer'],
            [['mcbmd_shortbio', 'mcbmd_msgfrom', 'mcbmd_linkedin'], 'string'],
            [['mcbmd_createdon', 'mcbmd_updatedon'], 'safe'],
            [['mcbmd_name', 'mcbmd_desgination'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompboardmemdtls_pk' => 'Memcompboardmemdtls',
            'mcbmd_membercompmst_fk' => 'Mcbmd Membercompmst Fk',
            'mcbmd_type' => 'Mcbmd Type',
            'mcbmd_name' => 'Mcbmd Name',
            'mcbmd_upload' => 'Mcbmd Upload',
            'mcbmd_desgination' => 'Mcbmd Desgination',
            'mcbmd_shortbio' => 'Mcbmd Shortbio',
            'mcbmd_nationality' => 'Mcbmd Nationality',
            'mcbmd_msgfrom' => 'Mcbmd Msgfrom',
            'mcbmd_linkedin' => 'Mcbmd Linkedin',
            'mcbmd_createdon' => 'Mcbmd Createdon',
            'mcbmd_createdby' => 'Mcbmd Createdby',
            'mcbmd_updatedon' => 'Mcbmd Updatedon',
            'mcbmd_updatedby' => 'Mcbmd Updatedby',
        ];
    }
    public static function boardmemberCacheQuery() {
        return self::find()
        ->select(['count(*)'])
        ->createCommand()
        ->getRawSql();
    }
    public static function getBoardOfDirectors($companypk, $userpk = ''){
        $boardmemebersfilled = $managmentfilled = false;
        $boardmemebersfilled = MemcompboardmemdtlsTbl::find()->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = 1',
                        [':mcbmd_membercompmst_fk' => $companypk])->count();
        $managmentfilled = MemcompboardmemdtlsTbl::find()->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = 2',
                        [':mcbmd_membercompmst_fk' => $companypk])->count();
        $search = \common\components\Security::sanitizeInput($_REQUEST['search'], "string");
        $size = (!empty($_REQUEST['size'])) ? $_REQUEST['size'] : 10;  
        
        $res = [];
        if(!empty($_REQUEST['panel']) && $_REQUEST['panel'] == 1) {
            $res['boardmembers'] = self::getData(1, $companypk, $search,$size);
        } else if(!empty($_REQUEST['panel']) && $_REQUEST['panel'] == 2) {
            $res['management'] = self::getData(2, $companypk, $search,$size);
        } else {
            $res['boardmembers'] = self::getData(1, $companypk, $search,$size);
            $res['management'] = self::getData(2, $companypk, $search,$size);
        }
        
        return [
            'msg' => 'success',
            'status' => 1,
            'items' => $res,
            'logo_url' => \common\models\MembercompanymstTbl::getCompanyLogo(),
            'boardofdirectorfilled' => $boardmemebersfilled,
            'managmentfilled' => $managmentfilled
        ];
    }
    public static function getData($type, $companypk, $search,$size) {
        $query = self::find()
                ->select(['memcompboardmemdtls_pk as bod_pk','mcbmd_name as name','dsg_designationname as designation','bmd_messagefrom as messagefrom',
                    'mcbmd_upload as image','mcbmd_nationality as natinality','mcbmd_shortbio as shortbio',
                    'mcbmd_type as membertype','mcbmd_linkedin as linkedin','mcbmd_nationality as country','CyM_CountryName_en as countryName'])
                ->leftJoin('countrymst_tbl','CountryMst_Pk = mcbmd_nationality')
                ->leftJoin('designationmst_tbl','mcbmd_desgination=designationmst_pk')
                ->where('mcbmd_membercompmst_fk = :mcbmd_membercompmst_fk and mcbmd_type = :mcbmd_type',
                        [':mcbmd_membercompmst_fk' => $companypk, ':mcbmd_type' => $type])
                ->andWhere(['OR',
                    ['LIKE','lower(mcbmd_name)', $search],
                    ['LIKE','lower(mcbmd_desgination)', $search]
                ])
                ->orderBy(['bmd_sortindex' => SORT_ASC])
                ->asArray();
        $page = (!empty($size)) ? $size: 10;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $page]
        ]);
        $data = $provider->getModels();
        
        $i = 0; $res = [];
        foreach($data as $key => $val){
            $res[$i] = [];
            $res[$i] = $val;
            $res[$i]['imageUrl'] = \common\components\Drive::generateUrl($val['image'],$val['mcbmd_membercompmst_fk'],$userpk);
            $i++;
        }
        return $res;
    }
}
