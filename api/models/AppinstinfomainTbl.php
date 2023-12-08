<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appinstinfomain_tbl".
 *
 * @property int $appinstinfomain_pk
 * @property int $appiim_appinstinfotmp_fk Reference to appinstinfotmp_pk
 * @property int $appiim_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appiim_applicationdtlsmain_fk Reference to applicationdtlsmain_pk
 * @property string $appiim_branchname_en
 * @property string $appiim_branchname_ar
 * @property int $appiim_officetype 1-Main office, 2-branch office
 * @property int $appiim_noofexpat
 * @property int $appiim_noofomani
 * @property string $appiim_loclatitude
 * @property string $appiim_loclongitude
 * @property string $appiim_locmapurl
 * @property string $appiim_molpercent
 * @property int $appiim_nooftechstaff
 * @property int $appiim_noofcurlearners
 * @property int $appiim_maxcapacity
 * @property string $appiim_addrline1
 * @property string $appiim_addrline2
 * @property int $appiim_statemsm_fk Reference to statemst_pk
 * @property int $appiim_citymsm_fk Reference to citymst_pk
 * @property string $appiim_updatedon
 * @property int $appiim_updatedby
 *
 * @property AppinstinfohstyTbl[] $appinstinfohstyTbls
 * @property ApplicationdtlsmainTbl $appiimApplicationdtlsmainFk
 * @property OpalcitymstTbl $appiimCitymsmFk
 * @property OpalmemberregmstTbl $appiimOpalmemberregmstFk
 * @property OpalstatemstTbl $appiimStatemsmFk
 * @property AppinstinfotmpTbl $appiimAppinstinfotmpFk
 * @property AppstaffinfohstyTbl[] $appstaffinfohstyTbls
 * @property AppstaffinfomainTbl[] $appstaffinfomainTbls
 * @property AppstaffinfomainTbl[] $appstaffinfomainTbls0
 * @property BatchmgmtdtlsTbl[] $batchmgmtdtlsTbls
 */
class AppinstinfomainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appinstinfomain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appiim_appinstinfotmp_fk', 'appiim_opalmemberregmst_fk', 'appiim_applicationdtlsmain_fk', 'appiim_officetype', 'appiim_noofexpat', 'appiim_noofomani', 'appiim_molpercent', 'appiim_nooftechstaff', 'appiim_noofcurlearners', 'appiim_maxcapacity'], 'required'],
            [['appiim_appinstinfotmp_fk', 'appiim_opalmemberregmst_fk', 'appiim_applicationdtlsmain_fk', 'appiim_officetype', 'appiim_noofexpat', 'appiim_noofomani', 'appiim_nooftechstaff', 'appiim_noofcurlearners', 'appiim_maxcapacity', 'appiim_statemsm_fk', 'appiim_citymsm_fk', 'appiim_updatedby'], 'integer'],
            [['appiim_loclatitude', 'appiim_loclongitude', 'appiim_locmapurl', 'appiim_addrline1', 'appiim_addrline2'], 'string'],
            [['appiim_molpercent'], 'number'],
            [['appiim_updatedon'], 'safe'],
            [['appiim_branchname_en', 'appiim_branchname_ar'], 'string', 'max' => 100],
            [['appiim_applicationdtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appiim_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']],
            [['appiim_citymsm_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcitymstTbl::className(), 'targetAttribute' => ['appiim_citymsm_fk' => 'opalcitymst_pk']],
            [['appiim_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appiim_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['appiim_statemsm_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['appiim_statemsm_fk' => 'opalstatemst_pk']],
            [['appiim_appinstinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfotmpTbl::className(), 'targetAttribute' => ['appiim_appinstinfotmp_fk' => 'appinstinfotmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appinstinfomain_pk' => 'Appinstinfomain Pk',
            'appiim_appinstinfotmp_fk' => 'Appiim Appinstinfotmp Fk',
            'appiim_opalmemberregmst_fk' => 'Appiim Opalmemberregmst Fk',
            'appiim_applicationdtlsmain_fk' => 'Appiim Applicationdtlsmain Fk',
            'appiim_branchname_en' => 'Appiim Branchname En',
            'appiim_branchname_ar' => 'Appiim Branchname Ar',
            'appiim_officetype' => 'Appiim Officetype',
            'appiim_noofexpat' => 'Appiim Noofexpat',
            'appiim_noofomani' => 'Appiim Noofomani',
            'appiim_loclatitude' => 'Appiim Loclatitude',
            'appiim_loclongitude' => 'Appiim Loclongitude',
            'appiim_locmapurl' => 'Appiim Locmapurl',
            'appiim_molpercent' => 'Appiim Molpercent',
            'appiim_nooftechstaff' => 'Appiim Nooftechstaff',
            'appiim_noofcurlearners' => 'Appiim Noofcurlearners',
            'appiim_maxcapacity' => 'Appiim Maxcapacity',
            'appiim_addrline1' => 'Appiim Addrline1',
            'appiim_addrline2' => 'Appiim Addrline2',
            'appiim_statemsm_fk' => 'Appiim Statemsm Fk',
            'appiim_citymsm_fk' => 'Appiim Citymsm Fk',
            'appiim_updatedon' => 'Appiim Updatedon',
            'appiim_updatedby' => 'Appiim Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppinstinfohstyTbls()
    {
        return $this->hasMany(AppinstinfohstyTbl::className(), ['appiih_AppInstInfoMain_FK' => 'appinstinfomain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiimApplicationdtlsmainFk()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appiim_applicationdtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiimCitymsmFk()
    {
        return $this->hasOne(OpalcitymstTbl::className(), ['opalcitymst_pk' => 'appiim_citymsm_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiimOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appiim_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiimStatemsmFk()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'appiim_statemsm_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiimAppinstinfotmpFk()
    {
        return $this->hasOne(AppinstinfotmpTbl::className(), ['appinstinfotmp_pk' => 'appiim_appinstinfotmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_AppInstInfoMain_FK' => 'appinstinfomain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfomainTbls()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_AppInstInfoMain_FK' => 'appinstinfomain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfomainTbls0()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_AppOfferCourseMain_FK' => 'appinstinfomain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdtlsTbls()
    {
        return $this->hasMany(BatchmgmtdtlsTbl::className(), ['bmd_appinstinfomain_fk' => 'appinstinfomain_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppinstinfomainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppinstinfomainTblQuery(get_called_class());
    }
}
