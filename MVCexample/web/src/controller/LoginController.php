<?php
namespace agilman\a2\controller;
use agilman\a2\view\View;

/**
 * Class HomeController
 *
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class LoginController extends Controller
{
    /**
     * Account Index action
     */
    public function indexAction()
    {
        $view = new View('loginPage');
        echo $view->render();
    }
}
