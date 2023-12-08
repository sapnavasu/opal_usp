<?php
namespace api\modules\ct\models;

/**
 * This is the model class for table "jdomodulehdr_tbl".
 *  @property int $jdomodulehdr_pk Primary key
 * @property int $jdmh_memberregmst_fk reference to memberregistrationmst_tbl
 * @property int $jdmh_jdomodulemst_fk reference to jdomodulemst_tbl
 * @property int $jdmh_createdby reference to usermst_tbl
 *  @property string $jdmm_updatedbyipaddr IP Address of the user
 * */

class JdomodulehdrTbl extends \yii\db\ActiveRecord
{

      /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdomodulehdr_tbl';
    }

     /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdmh_memberregmst_fk', 'jdmh_jdomodulemst_fk'], 'integer'],
            [['jdmh_memberregmst_fk', 'jdmh_jdomodulemst_fk'], 'required']
        ];
    }

}