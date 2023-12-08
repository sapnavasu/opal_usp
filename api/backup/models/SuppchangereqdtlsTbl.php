<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "suppchangereqdtls_tbl".
 *
 * @property int $suppchangereqdtls_pk Primary Key
 * @property int $scrd_suppchangereqhdr_fk Reference to suppchangereqhdr_tbl
 * @property int $scrd_classupdin To store only when classification is updated: 1 - Profile, 2 - Renewal, 3 - Profile & Renewal
 * @property int $scrd_flag 1 - Company, 2 - Email, 3 - Classification, 4 - Subscription, 5 - Head Count, 6 - Total membership amount, 7 - Primary Contact, 8 - Style of Incorporation
 * @property string $scrd_oldvalue Old Value
 * @property string $scrd_newvalue New Value
 *
 * @property SuppchangereqhdrTbl $scrdSuppchangereqhdrFk
 */
class SuppchangereqdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suppchangereqdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrd_suppchangereqhdr_fk', 'scrd_flag', 'scrd_oldvalue', 'scrd_newvalue'], 'required'],
            [['scrd_suppchangereqhdr_fk', 'scrd_classupdin', 'scrd_flag'], 'integer'],
            [['scrd_oldvalue', 'scrd_newvalue'], 'string', 'max' => 250],
            [['scrd_suppchangereqhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => SuppchangereqhdrTbl::className(), 'targetAttribute' => ['scrd_suppchangereqhdr_fk' => 'suppchangereqhdr_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'suppchangereqdtls_pk' => 'Suppchangereqdtls Pk',
            'scrd_suppchangereqhdr_fk' => 'Scrd Suppchangereqhdr Fk',
            'scrd_classupdin' => 'Scrd Classupdin',
            'scrd_flag' => 'Scrd Flag',
            'scrd_oldvalue' => 'Scrd Oldvalue',
            'scrd_newvalue' => 'Scrd Newvalue',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScrdSuppchangereqhdrFk()
    {
        return $this->hasOne(SuppchangereqhdrTbl::className(), ['suppchangereqhdr_pk' => 'scrd_suppchangereqhdr_fk']);
    }

    /**
     * {@inheritdoc}
     * @return SuppchangereqdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuppchangereqdtlsTblQuery(get_called_class());
    }
    
    
}
