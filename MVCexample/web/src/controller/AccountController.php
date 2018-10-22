<?php
namespace agilman\a2\controller;
session_start();
use agilman\a2\model\{AccountModel, AccountCollectionModel};
use agilman\a2\view\View;


/**
 * Class AccountController
 * @package agilman\a2\controller
 */
class AccountController extends Controller
{

    /**
     * Goes to the create new account page
     */
    public function createPageAction()
    {
        $view = new View('createAccountPage');
        echo $view->render();
    }

    /**
     * Creates a new account.
     */
    public function createAction()
    {
        try {
            $account = new AccountModel($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password']);
            $account->save();
            $this->redirect('loginPage');
            $view = new View('accountCreated');
            echo $view->render();
        } catch (\Exception $e){
            $view = new View('createAccountPage');
            echo $view->render();
        }
    }

    /**
     * Logs in a user.
     */
    public function loginAction(){
        try {
            unset($_SESSION["login"]);
            $account = new AccountModel(null, $_POST['username'], null, $_POST['password']);
            $account->validateLogin();
            $_SESSION["username"] = $_POST["username"];
            $view = new View('homePage');
            echo $view->render();
        } catch (\Exception $e){
            $_SESSION["login"] = 1;
            $view = new View('loginPage');
            echo $view->render();
        }
    }

    /**
     * Validates the username to see if it already exists.
     */
    public function validateAccNameAction(){
        // get the q parameter from URL
        $q =  $_REQUEST["q"];
        $account = new AccountModel(null, $q, null,null);

        // lookup all hints from array if $q is different from ""
        try {
            if ($account->availableUserName()) {
                echo "<p class = \"text-primary\">Username Available</p>";
            } else {
                echo "<p class = \"text-danger\">Username taken. Please choose another.</p>";
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
        // Output "no suggestion" if no hint was found or output correct values

    }
}
