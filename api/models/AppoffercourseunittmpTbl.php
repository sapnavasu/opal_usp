<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoffercourseunittmp_tbl".
 *
 * @property int $appoffercourseunittmp_pk Primary Key
 * @property int $appocut_appoffercoursetmp_fk Reference to appoffercoursetmp_pk
 * @property string $appocut_unitcode
 * @property string $appocut_unittitle
 * @property string $appocut_createdon
 * @property int $appocut_createdby
 * @property string $appocut_updatedon
 * @property int $appocut_updatedby
 * @property int $appocut_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appocut_appdecon
 * @property int $appocut_appdecby
 * @property string $appocut_appdeccomment
 *
 * @property AppoffercoursetmpTbl $appocutAppoffercoursetmpFk
 */
class AppoffercourseunittmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoffercourseunittmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appocut_appoffercoursetmp_fk', 'appocut_unitcode', 'appocut_unittitle', 'appocut_createdon', 'appocut_createdby', 'appocut_status'], 'required'],
            [['appocut_appoffercoursetmp_fk', 'appocut_createdby', 'appocut_updatedby', 'appocut_status', 'appocut_appdecby'], 'integer'],
            [['appocut_unitcode', 'appocut_unittitle', 'appocut_appdeccomment'], 'string'],
            [['appocut_createdon', 'appocut_updatedon', 'appocut_appdecon'], 'safe'],
            [['appocut_appoffercoursetmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursetmpTbl::className(), 'targetAttribute' => ['appocut_appoffercoursetmp_fk' => 'appoffercoursetmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appoffercourseunittmp_pk' => 'Appoffercourseunittmp Pk',
            'appocut_appoffercoursetmp_fk' => 'Appocut Appoffercoursetmp Fk',
            'appocut_unitcode' => 'Appocut Unitcode',
            'appocut_unittitle' => 'Appocut Unittitle',
            'appocut_createdon' => 'Appocut Createdon',
            'appocut_createdby' => 'Appocut Createdby',
            'appocut_updatedon' => 'Appocut Updatedon',
            'appocut_updatedby' => 'Appocut Updatedby',
            'appocut_status' => 'Appocut Status',
            'appocut_appdecon' => 'Appocut Appdecon',
            'appocut_appdecby' => 'Appocut Appdecby',
            'appocut_appdeccomment' => 'Appocut Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppocutAppoffercoursetmpFk()
    {
        return $this->hasOne(AppoffercoursetmpTbl::className(), ['appoffercoursetmp_pk' => 'appocut_appoffercoursetmp_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppoffercourseunittmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoffercourseunittmpTblQuery(get_called_class());
    }

    public static function fetchFavResult($courseid, $pageSize , $page){
  
        $favQuery = self::find();
        $favQuery->select([
                        '*','DATE_FORMAT(appoct_appdecon,"%d-%m-%Y") AS appoct_appdecon'
                    ])
                    ->leftJoin('appoffercoursetmp_tbl  temp','temp.appoffercoursetmp_pk = appocut_appoffercoursetmp_fk')
                    ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = temp.appoct_applicationdtlstmp_fk')
                    ->leftJoin('coursecategorymst_tbl main','main.coursecategorymst_pk = appoct_coursecategorymst_fk');
                   
        $favQuery->where([
                        'appoffercoursetmp_pk'=> $courseid,
                    ]);
        $favQry = $favQuery->orderBy(['appoffercoursetmp_pk'=>SORT_DESC])
                    ->asArray();
        $favProvider = new \yii\data\ActiveDataProvider([
            'query' => $favQry,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
        ]);
        foreach ($favProvider->getModels() as $key => $favResData) {
           
            $favData[$key] = $favResData;
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appoct_appdecby']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
           }

        $favouriteRes['data'] = $favData;
        $favouriteRes['totalcount'] = $favProvider->getTotalCount();
        $favouriteRes['size'] = $pageSize;
        $favouriteRes['page'] = $page;
    
        return $favouriteRes;
    }
}
