<?php
/**
 * TUsersModel
 *
 * @author Kensuke Sakakibara
 * @since 2016.11.04
 * @copyright Copyright (c) 2016, Kensuke Sakakibara.
 * 
 * Modelと同名でないTableへのアクセスは禁止しています。
 * 別のTableへアクセスする際は、必ず該当のModelを経由してアクセスしてください。
 */
namespace Webamp3\App\Model;

// TusersTable以外のTableは使用してはいけません
use \Webamp3\App\Table\TUsersTable;

class TUsersModel extends AbstractModel
{
    /**
     * コントローラ共通コンストラクタ
     *
     * @param object $container
     */
    public function __construct($container)
    {
        $table = new TUsersTable($container);
        parent::__construct($container, $table);
    }
}
