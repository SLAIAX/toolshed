<?php
namespace agilman\a2\controller;
use agilman\a2\model\Model;
use agilman\a2\view\View;
session_start();
/**
 * Class HomeController
 * @package agilman/a2
 */
class HomeController extends Controller
{
    /**
     * Goes to the login page.
     */
    public function indexAction()
    {
        try {
            new Model();
        } catch (\Exception $e) {
            $e->getMessage();
        }
        $view = new View('loginPage');
        echo $view->render();
    }

    /**
     * Goes to the home page.
     */
    public function homeAction()
    {
        if (isset($_SESSION["username"])) {
            $view = new View('homePage');
            echo $view->render();
        } else {
            $this->redirect('loginPage');
        }
    }

    /**
     * Goes to the browse page.
     */
    public function browseAction()
    {
        if (isset($_SESSION["username"])) {
            $view = new View('browsePage');
            echo $view->render();
        } else {
            $this->redirect('loginPage');
        }
    }

    /**
     * Goes to the search page.
     */
    public function searchAction()
    {
        if (isset($_SESSION["username"])) {
            $view = new View('searchPage');
            echo $view->render();
        } else {
            $this->redirect('loginPage');
        }
    }

    /**
     * Logs out a user, and redirects to the login page.
     */
    public function logoutAction()
    {
        if (isset($_SESSION["username"])) {
            unset($_SESSION["username"]);
            $this->redirect('loginPage');
        } else {
            $this->redirect('loginPage');
        }
    }
}
