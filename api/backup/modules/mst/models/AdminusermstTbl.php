<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "adminusermst_tbl".
 *
 * @property int $adminusermst_pk
 * @property int $aum_userrole_fk
 * @property string $aum_empname
 * @property string $aum_loginid
 * @property string $aum_password
 * @property string $aum_email
 * @property int $aum_status Active - 1, Inactive – 0
 * @property string $aum_createdon
 * @property int $aum_createdby
 * @property string $aum_updatedon
 * @property int $aum_updatedby
 * @property string $auth_key
 */
class AdminusermstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    private $_user = false;
    public static function tableName()
    {
        return 'adminusermst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aum_email','aum_empname','aum_loginid'],'unique'],
            [['aum_userrole_fk', 'aum_email', 'aum_loginid', 'aum_password', 'aum_email'], 'required'],
            [['aum_userrole_fk','aum_createdby', 'aum_updatedby'], 'integer'],
            [['aum_createdon', 'aum_updatedon'], 'safe'],
            [['aum_empname'], 'string', 'max' => 100],
            [['aum_loginid'], 'string', 'max' => 20],
            [['aum_password', 'auth_key'], 'string', 'max' => 255],
            [['aum_email'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'adminusermst_pk' => 'Adminusermst Pk',
            'aum_userrole_fk' => 'Aum Userrole Fk',
            'aum_empname' => 'Aum Empname',
            'aum_loginid' => 'Aum Loginid',
            'aum_password' => 'Aum Password',
            'aum_email' => 'Aum Email',
            'aum_status' => 'Aum Status',
            'aum_createdon' => 'Aum Createdon',
            'aum_createdby' => 'Aum Createdby',
            'aum_updatedon' => 'Aum Updatedon',
            'aum_updatedby' => 'Aum Updatedby',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UseQuery(get_called_class());
    }
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
            [
                'class' => TimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['aum_createdon'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['aum_updatedon'],
                ],
            ],
            [
                'class' => UserBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['aum_createdby'],
                    //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                ],
            ],
        ];
    }
    public function getUser($data){
        return self::findOne($data['adminusermst_pk'])->aum_empname;
    }

    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['adminusermst_pk'] === (string) $token->getClaim('uid')) {
                return new static($user);
            }
        }

        return null;
    }
}
