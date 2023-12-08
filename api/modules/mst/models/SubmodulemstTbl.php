<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "submodulemst_tbl".
 *
 * @property int $SubModuleMst_Pk
 * @property int $SMM_ModuleMst_Fk
 * @property string $SMM_SubModName
 * @property string $SMM_Status
 * @property string $SMM_CreatedOn
 * @property int $SMM_CreatedBy
 * @property string $SMM_UpdatedOn
 * @property int $SMM_UpdatedBy
 *
 * @property ModulemstTbl $sMMModuleMstFk
 */
class SubmodulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'submodulemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SMM_ModuleMst_Fk', 'SMM_SubModName'], 'required'],
            [['SMM_SubModName'], 'unique'],
            [['SMM_ModuleMst_Fk', 'SMM_CreatedBy', 'SMM_UpdatedBy'], 'integer'],
            [['SMM_Status'], 'string'],
            [['SMM_CreatedOn', 'SMM_UpdatedOn'], 'safe'],
            [['SMM_SubModName'], 'string', 'max' => 30],
            [['SMM_ModuleMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => ModulemstTbl::className(), 'targetAttribute' => ['SMM_ModuleMst_Fk' => 'ModuleMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SubModuleMst_Pk' => 'Sub Module Mst  Pk',
            'SMM_ModuleMst_Fk' => 'Smm  Module Mst  Fk',
            'SMM_SubModName' => 'Smm  Sub Mod Name',
            'SMM_Status' => 'Smm  Status',
            'SMM_CreatedOn' => 'Smm  Created On',
            'SMM_CreatedBy' => 'Smm  Created By',
            'SMM_UpdatedOn' => 'Smm  Updated On',
            'SMM_UpdatedBy' => 'Smm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSMMModuleMstFk()
    {
        return $this->hasOne(ModulemstTbl::className(), ['ModuleMst_Pk' => 'SMM_ModuleMst_Fk']);
    }

    /**
     * {@inheritdoc}
     * @return SubmodulemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubmodulemstTblQuery(get_called_class());
    }
	 public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
                [
                     'class' => TimeBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['SMM_CreatedOn'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['SMM_UpdatedOn'],
                     ],
                 ],
                [
                     'class' => UserBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['SMM_CreatedBy'],
//                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                     ],
                 ],
        ];
    }

    public function getSubmodules($id){
        $query = SubmodulemstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            unset($_REQUEST['search']);
            foreach(array_filter($_REQUEST) as $key => $val)
            {
                if(!is_null($val))
                {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(['SMM_Name as submodule_name','SubModuleMst_Pk as submodule_pk']);
        $query->where('SMM_ModuleMst_Fk = :SMM_ModuleMst_Fk',[':SMM_ModuleMst_Fk' => $id]);
        $query->asArray();

        $page = (isset($_REQUEST['size']))?$_REQUEST['size']:10;
        $provider = new ActiveDataProvider([
            'query' => $query, 
            // 'pagination' => ['pageSize' =>$page]
        ]);
        return $provider;
    }
}