<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projeoisubdtls_tbl".
 *
 * @property int $projeoisubdtls_pk Primary key
 * @property int $presd_projectdtls_fk Reference to projectdtls_tbl
 * @property int $presd_projshortlist_fk Reference to projshortlist_tbl
 * @property string $presd_eoiacknow
 * @property string $presd_eoisubmittedon Date of submission
 * @property int $presd_eoisubmittedby Submitted by user id
 * @property string $presd_eoisubmittedbyipaddr IP Address of the user
 * @property int $presd_status 1 - Posted for validation, 2 - Approved, 3 - Declined, 4 - Resubmitted, 5- Withdraw
 * @property string $presd_resubmittedon Resubmission/Withdrawn date
 * @property int $presd_resubmittedby Resubmission/Withdrawn by user id
 * @property string $presd_resubmittedbyipaddr Resubmission/Withdrawn by user's IP Address
 * @property string $presd_appdeclon Approved / Cancelled on
 * @property int $presd_appdeclby Approved / Cancelled by user id
 * @property string $presd_appdeclbyipaddr Approved / Cancelled by user's IP Address
 * @property string $presd_comments Reason to Approve / Cancel
 */
class ProjeoisubdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projeoisubdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['presd_projectdtls_fk', 'presd_projshortlist_fk', 'presd_eoisubmittedon', 'presd_eoisubmittedby', 'presd_status'], 'required'],
            [['presd_projectdtls_fk', 'presd_projshortlist_fk', 'presd_eoisubmittedby', 'presd_status', 'presd_resubmittedby', 'presd_appdeclby'], 'integer'],
            [['presd_eoiacknow', 'presd_comments'], 'string'],
            [['presd_eoisubmittedon', 'presd_resubmittedon', 'presd_appdeclon'], 'safe'],
            [['presd_eoisubmittedbyipaddr', 'presd_resubmittedbyipaddr', 'presd_appdeclbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projeoisubdtls_pk' => 'Projeoisubdtls Pk',
            'presd_projectdtls_fk' => 'Presd Projectdtls Fk',
            'presd_projshortlist_fk' => 'Presd Projshortlist Fk',
            'presd_eoiacknow' => 'Presd Eoiacknow',
            'presd_eoisubmittedon' => 'Presd Eoisubmittedon',
            'presd_eoisubmittedby' => 'Presd Eoisubmittedby',
            'presd_eoisubmittedbyipaddr' => 'Presd Eoisubmittedbyipaddr',
            'presd_status' => 'Presd Status',
            'presd_resubmittedon' => 'Presd Resubmittedon',
            'presd_resubmittedby' => 'Presd Resubmittedby',
            'presd_resubmittedbyipaddr' => 'Presd Resubmittedbyipaddr',
            'presd_appdeclon' => 'Presd Appdeclon',
            'presd_appdeclby' => 'Presd Appdeclby',
            'presd_appdeclbyipaddr' => 'Presd Appdeclbyipaddr',
            'presd_comments' => 'Presd Comments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjeoisubdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjeoisubdtlsTblQuery(get_called_class());
    }
}
