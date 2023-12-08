<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documentdtlsmsthsty_tbl".
 *
 * @property int $documentdtlsmsthsty_pk
 * @property int $ddmh_documentdtlsmst_fk Reference to documentdtlsmst_pk
 * @property int $ddmh_projectmst_fk reference to projectmst_pk
 * @property int $ddmh_standardcoursemst_fk Reference to standardcoursemst_tbl, if ddm_coursetype = 1
 * @property int $ddmh_requestfor Reference to referencemst_pk where rm_mastertype=13
 * @property string $ddmh_documentname_en
 * @property string $ddmh_documentname_ar
 * @property string $ddmh_documentdesc_en
 * @property string $ddmh_documentdesc_ar
 * @property int $ddmh_mandatestatus 1-Mandatory, 2-Non Mandatory (Optional), default 1
 * @property int $ddmh_status 1-Active, 2-Inactive
 * @property string $ddmh_createdon
 * @property int $ddmh_createdby
 * @property string $ddmh_updatedon
 * @property int $ddmh_updatedby
 *
 * @property DocumentdtlsmstTbl $ddmhDocumentdtlsmstFk
 * @property ProjectmstTbl $ddmhProjectmstFk
 */
class DocumentdtlsmsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documentdtlsmsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ddmh_documentdtlsmst_fk', 'ddmh_projectmst_fk', 'ddmh_documentname_en', 'ddmh_documentname_ar', 'ddmh_status', 'ddmh_createdon', 'ddmh_createdby'], 'required'],
            [['ddmh_documentdtlsmst_fk', 'ddmh_projectmst_fk', 'ddmh_standardcoursemst_fk', 'ddmh_requestfor', 'ddmh_mandatestatus', 'ddmh_status', 'ddmh_createdby', 'ddmh_updatedby'], 'integer'],
            [['ddmh_documentdesc_en', 'ddmh_documentdesc_ar'], 'string'],
            [['ddmh_createdon', 'ddmh_updatedon'], 'safe'],
            [['ddmh_documentname_en', 'ddmh_documentname_ar'], 'string', 'max' => 255],
            [['ddmh_documentdtlsmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentdtlsmstTbl::className(), 'targetAttribute' => ['ddmh_documentdtlsmst_fk' => 'documentdtlsmst_pk']],
            [['ddmh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['ddmh_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'documentdtlsmsthsty_pk' => 'Documentdtlsmsthsty Pk',
            'ddmh_documentdtlsmst_fk' => 'Ddmh Documentdtlsmst Fk',
            'ddmh_projectmst_fk' => 'Ddmh Projectmst Fk',
            'ddmh_standardcoursemst_fk' => 'Ddmh Standardcoursemst Fk',
            'ddmh_requestfor' => 'Ddmh Requestfor',
            'ddmh_documentname_en' => 'Ddmh Documentname En',
            'ddmh_documentname_ar' => 'Ddmh Documentname Ar',
            'ddmh_documentdesc_en' => 'Ddmh Documentdesc En',
            'ddmh_documentdesc_ar' => 'Ddmh Documentdesc Ar',
            'ddmh_mandatestatus' => 'Ddmh Mandatestatus',
            'ddmh_status' => 'Ddmh Status',
            'ddmh_createdon' => 'Ddmh Createdon',
            'ddmh_createdby' => 'Ddmh Createdby',
            'ddmh_updatedon' => 'Ddmh Updatedon',
            'ddmh_updatedby' => 'Ddmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDdmhDocumentdtlsmstFk()
    {
        return $this->hasOne(DocumentdtlsmstTbl::className(), ['documentdtlsmst_pk' => 'ddmh_documentdtlsmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDdmhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'ddmh_projectmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return DocumentdtlsmsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentdtlsmsthstyTblQuery(get_called_class());
    }
}
