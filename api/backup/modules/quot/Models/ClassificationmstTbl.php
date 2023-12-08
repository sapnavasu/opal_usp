<?php
namespace api\modules\quot\models;

/**
 * This is the model class for table "classificationmst_tbl"
 * @property integer ClassificationMst_Pk primary key
 * @property integer clm_globalportalmst_fk
* @property string ClM_ClassificationType
* @property string ClM_HeadCount 
* @property string ClM_AnnualSales  
* @property integer ClM_Status 
* @property string ClM_CreatedOn  
* @property integer ClM_CreatedBy  
* @property string ClM_UpdatedOn  
* @property integer ClM_UpdatedBy
 */

class ClassificationmstTbl extends \yii\db\ActiveRecord
{
     /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classificationmst_tbl';
    }


}
