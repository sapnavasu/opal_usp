<?php
namespace app\models;
/**
 * This is the model class for table "cmsconttypemst_tbl".
 *
 * The followings are the available columns in table 'cmsconttypemst_tbl':
 * @property integer $cmsconttypemst_pk
 * @property string $cmsctm_epcconttype
 * @property string $cmsctm_status
 * @property string $cmsctm_createdon
 * @property integer $cmsctm_createdby
 */
class CmscontypemstTbl extends \yii\db\ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
	{
		return 'cmsconttypemst_tbl';
	}

	
}
