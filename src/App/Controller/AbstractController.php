<?php
/**
 * AbstractController
 *
 * @author Kensuke Sakakibara
 * @since 2016.11.02
 * @copyright Copyright (c) 2016, Kensuke Sakakibara.
 */
namespace Webamp3\App\Controller;

abstract class AbstractController
{
    protected $_app;
    protected $_request;
    protected $_response;
    protected $_params;
    private   $_twig;
    protected $_viewData;
    
    /**
     * コントローラ共通コンストラクタ
     *
     * @param object $app
     */
    public function __construct($app)
    {
        $this->_app      = $app;
        $this->_request  = $app->request;
        $this->_response = $app->response;
        $this->_params   = $app->request->getParams();
        $this->_twig     = $app->get('view');
        $this->_viewData = array();
    }
    
    /**
     * 画面画面表示
     * 
     * @param string $template テンプレートのパス
     */
    protected function _render($template)
    {
        // コントローラー名を取得してテンプレートへ差し込む
        $dbg = debug_backtrace();
        $className = $dbg[1]['class'];
        $classNameArray = explode('\\', $className);
        preg_match('/^(.*)Controller$/', $classNameArray[count($classNameArray)-1], $match);
        $controllerName = mb_strtolower($match[1]);
        $this->_viewData['controller'] = $controllerName;

        // アクション名を取得してテンプレートへ差し込む
        $functionName = $dbg[1]['function'];
        preg_match('/^(.*)Action$/', $functionName, $match);
        $actionName = mb_strtolower($match[1]);
        $this->_viewData['action'] = $actionName;

        // パラメータをテンプレートへ差し込む
        $this->_viewData['params'] = $this->_params;
        
        // 画面表示
        $this->_viewData['template'] = $template;
        $this->_twig->render($this->_response, 'app/layout.tpl', $this->_viewData);
    }
}
