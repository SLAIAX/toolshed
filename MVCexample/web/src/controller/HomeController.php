<?php
namespace agilman\a2\controller;
use agilman\a2\model\Model;
use agilman\a2\view\View;
session_start();
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
        if(isset($_SESSION["username"])) {
            $view = new View('homePage');
            echo $view->render();
        }else{
            $this->redirect('loginPage');
        }
    }

    public function browseAction(){
        $view = new View('browsePage');
        echo $view->render();
    }

    public function searchAction(){
        if(isset($_SESSION["username"])) {
            $view = new View('searchPage');
            echo $view->render();
        }else{
            $this->redirect('loginPage');
        }
    }

    public function logoutAction(){
        if(isset($_SESSION["username"])) {
            unset($_SESSION["username"]);
            $this->redirect('loginPage');
        }else{
            $this->redirect('loginPage');
        }

    }
}
