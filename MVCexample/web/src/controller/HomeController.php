<?php
namespace agilman\a2\controller;
use agilman\a2\model\Model;
use agilman\a2\view\View;

/**
 * Class HomeController
 *
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class HomeController extends Controller
{
    /**
     * Account Index action
     */
    public function indexAction()
    {
        new Model();
        $view = new View('loginPage');
        echo $view->render();
    }

    public function homeAction(){
        $view = new View('homePage');
        echo $view->render();
    }
}
