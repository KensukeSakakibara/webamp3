<?php
/**
 * TUsersTable
 *
 * @author Kensuke Sakakibara
 * @since 2016.11.04
 * @copyright Copyright (c) 2016, Kensuke Sakakibara.
 * 
 * このプロジェクトではテーブルのJOINを禁止しています。
 * JOINの代わりにIN等を利用してください。
 */
namespace Webamp3\App\Table;

class TUsersTable extends AbstractTable
{
    /**
     * コントローラ共通コンストラクタ
     *
     * @param object $container
     */
    public function __construct($container)
    {
        parent::__construct($container, 't_users');
    }
}
