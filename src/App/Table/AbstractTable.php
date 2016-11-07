<?php
/**
 * AbstractTable
 *
 * @author Kensuke Sakakibara
 * @since 2016.11.02
 * @copyright Copyright (c) 2016, Kensuke Sakakibara.
 * 
 * このプロジェクトではテーブルのJOINを禁止しています。
 * JOINの代わりにIN等を利用してください。
 */
namespace Webamp3\App\Table;

abstract class AbstractTable
{
    protected $_container;
    protected $_tableName;
    private $_getMasterFlg;

    /**
     * テーブル共通コンストラクタ
     *
     * @param object $container コンテナオブジェクト
     * @param string $tableName テーブル名
     */
    public function __construct($container, $tableName)
    {
        $this->_container = $container;
        $this->_tableName = $tableName;
        $this->_getMasterFlg = false;
    }

    /**
     * テーブルのオブジェクトを取得する
     * 
     * @return object テーブルオブジェクト
     */
    private function _getTable()
    {
        if ($this->_getMasterFlg) {
            $database = $this->_container->get('db_master');
            $database = $database->setFetchMode(\PDO::FETCH_ASSOC);
            $table = $database->table($this->_tableName);
            return $table;
        } else {
            // スレーブのラウンドロビン
            $rondCount = count($this->_container['settings']['db']) - 1; // masterは除くのでマイナス1
            $slaveNum = rand(1, $rondCount);
            $slaveNumStr = str_pad($slaveNum, 2, 0, STR_PAD_LEFT);
            
            // 該当テーブルを取得
            $database = $this->_container->get('db_slave'. $slaveNumStr);
            $database = $database->setFetchMode(\PDO::FETCH_ASSOC);
            $table = $database->table($this->_tableName);
            return $table;
        }
    }

    /**
     * レプリケーションの遅延でスレーブから読めないときはマスターを明示的に指定して読む
     * 
     * @return object 自分自身をリターン
     */
    public function getMaster()
    {
        $this->_getMasterFlg = true;
        return $this;
    }

    /**
     * 該当テーブルの全データを取得する（基本的に使わない）
     * 
     * @return array データ全件
     */
    public function getAll()
    {
        $table = $this->_getTable();
        return $table->get()->toArray();
    }
    
    /**
     * IDをキーにして対象のデータを取得する
     * 
     * @param integer $id ID番号（pkey）
     * @return array 取得したデータ1件
     */
    public function getRowById($id)
    {
        $table = $this->_getTable();
        return $table->find($id);
    }
}
