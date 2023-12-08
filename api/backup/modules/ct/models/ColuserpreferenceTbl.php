<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "coluserpreference_tbl".
 *
 * @property int $coluserpreference_pk Primary key
 * @property int $cup_usermst_fk Reference to usermst_tbl
 * @property int $cup_shared_type 
 * @property int $cup_shared_fk Reference to collaborativemst_tbl, coldiscusshdr_tbl, coltaskdtls_tbl, colnotesdtl_tbl, colmeetingdtls_tbl
 * @property int $cup_category 
 * @property int $cup_createdtz_fk 
 * @property string $ctd_createdon Datetime of creation
 * @property int $cup_createdfrom Reference to colprojaudience_tbl
 * @property string $cup_updatedon IP Address of the user
 * @property string $cup_updatedfrom IP Address of the user
*/

class ColuserpreferenceTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coluserpreference_tbl';
    }

      /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cup_usermst_fk', 'cup_shared_type', 'cup_shared_fk', 'cup_category', 'cup_status', 'cup_createdtz_fk', 'cup_createdon', 'cup_createdfrom'], 'required'],
            [['cup_usermst_fk', 'cup_shared_type', 'cup_shared_fk', 'cup_category', 'cup_status', 'cup_createdtz_fk'], 'integer'],
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'coluserpreference_pk' => 'Coluserpreference Pk',
            'cup_usermst_fk' => 'Cup Usermst Tbl',
            'cup_shared_type' => 'Cup Shared Type',
            'cup_shared_fk' => 'Cup Shared Fk',
            'cup_category' => 'Cup Category',
            'cup_status' => 'Cup Status',
            'cup_createdtz_fk' => 'Cup Timezone Tbl',
            'cup_createdon' => 'Cup Createdon',
            'cup_createdfrom' => 'Cup Createdfrom',
            'cup_updatedon' => 'Cup Updatedon',
            'cup_updatedfrom' => 'Cup updatedFrom'
        ];
    }
}


