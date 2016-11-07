<?php
/**
 * IndexController
 *
 * @author Kensuke Sakakibara
 * @since 2016.11.02
 * @copyright Copyright (c) 2016, Kensuke Sakakibara.
 * 
 * コントローラーから直接Tableへアクセスは禁止しています。
 * 必ずModelを経由してTableへアクセスしてください。
 * FatControllerを避けてください。
 * SessionはControllerのみで利用してください。
 */
namespace Webamp3\App\Controller;

use \Webamp3\App\Model\TUsersModel;

class IndexController extends AbstractController
{
    /**
     * コンストラクタ
     *
     * @param object $container
     */
    public function __construct($container)
    {
        parent::__construct($container);
    }
    
    /**
     * デフォルトページ
     */
    public function indexAction()
    {
        $tUsersModel = new TUsersModel($this->_container);
        $users = $tUsersModel->getRowById(2);
        
        $this->_viewData = array('name' => 'suisui!');
        
        // 画面画面表示
        $this->_render('app/index/index.tpl');
    }
}
