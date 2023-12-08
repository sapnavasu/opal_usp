<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[CurrencymstTbl]].
 *
 * @see CurrencymstTbl
 */
class CurrencymstTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CurrencymstTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CurrencymstTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function active($db = null) {
        return $this->andWhere(['CurM_Status' => 'A']);
    }

    public function getCurrencyArray() {
        $currencylist = CurrencymstTbl::find()
                ->select(['CurrencyMst_Pk as cvalue', 'CurM_CurrSymbol as clabel', 'CurM_CurrencyName_en as cname'])
                ->where('CurM_Status = :CurM_Status', [':CurM_Status' => 'A'])
                ->orderBy('CurM_CurrencyName_en ASC')
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $currencylist,
        );
        return $result;
    }
    function modifyArray ($array) 
    {
        foreach ($array as &$value)
        {
            $value = $value + 2; 
        } 
        $value = $value + 3; 
    } 

    public static function getCurrencyCacheQuery() {
        return CurrencymstTbl::find()
        ->select(['max(CurM_UpdatedOn), count(*)'])
        ->createCommand()
        ->getRawSql();
    }

}
