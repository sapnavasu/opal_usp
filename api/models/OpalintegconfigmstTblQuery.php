<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalintegconfigmstTbl]].
 *
 * @see OpalintegconfigmstTbl
 */
class OpalintegconfigmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalintegconfigmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalintegconfigmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public static function getRegistrationConfig()
    {
        $response = [];
        $data = OpalintegconfigmstTbl::find()
                ->asArray()
                ->all();
        if ($data) {
            foreach ($data as $record) {
                $response[$record['oicm_integrationtask']] = ($record['oicm_integstatus'] == 1) ? 'A' : 'I';
            }
        }

        return $response;
    }
}
