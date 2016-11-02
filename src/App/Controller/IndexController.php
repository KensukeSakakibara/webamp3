<?php
/**
 * IndexController
 *
 * @author Kensuke Sakakibara
 * @since 2016.11.02
 * @copyright Copyright (c) 2016, Kensuke Sakakibara.
 */
namespace Webamp3\App\Controller;

class IndexController extends AbstractController
{
    /**
     * コンストラクタ
     *
     * @param object $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }
    
    public function indexAction()
    {
        $this->_viewData = array('name' => 'suisui!');
        
        // 画面画面表示
        $this->_render('app/index/index.tpl');
    }
}
