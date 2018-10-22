<?php
namespace agilman\a2\controller;
session_start();
use agilman\a2\model\{AccountModel, AccountCollectionModel};
use agilman\a2\view\View;

/**
 * Class AccountController
 *
 * @package agilman/a2
 * @author  Andrew Gilman <a.gilman@massey.ac.nz>
 */
class AccountController extends Controller
{
    /**
     * Account Index action
     */
    public function indexAction()
    {
        $collection = new AccountCollectionModel();
        $accounts = $collection->getAccounts();
        $view = new View('accountIndex');
        echo $view->addData('accounts', $accounts)->render();
    }
    /**
     * Account Page Create action
     */
    public function createPageAction()
    {
        $view = new View('createAccountPage');
        echo $view->render();
    }

    /**
     * Account Create action
     */
    public function createAction()
    {
        try {
            $account = new AccountModel($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password']);
            //$account->validate();
            $account->save();
            $this->redirect('loginPage');
            $view = new View('accountCreated');
            echo $view->render();
        } catch (\Exception $e){
            $view = new View('createAccountPage');
            echo $view->render();
        }
    }

    public function loginAction(){

        //VALIDATE THIS FIRST
        $account = new AccountModel(null, $_POST['username'], null, $_POST['password']);
        if($account->validateLogin()) {
            $_SESSION["username"] = $_POST["username"];
            $view = new View('homePage');
            echo $view->render();
        } else{
            $view = new View('loginPage');
            echo $view->render();
        }
    }


    /**
     * Account Delete action
     *
     * @param int $id Account id to be deleted
     */
    public function deleteAction($id)
    {
        (new AccountModel())->load($id)->delete();
        $view = new View('accountDeleted');
        echo $view->addData('accountId', $id)->render();
    }
    /**
     * Account Update action
     *
     * @param int $id Account id to be updated
     */
    public function updateAction($id)
    {
        $account = (new AccountModel())->load($id);
        $account->setName('Joe')->save(); // new name will come from Form data
    }

    public function validateAccNameAction(){
// get the q parameter from URL
        $q =  $_REQUEST["q"];
        $account = new AccountModel(null, $q, null,null);

// lookup all hints from array if $q is different from ""
        if($account->availableUserName()){
            echo "Username Available";
        } else{
            echo  "Username taken. Please choose another.";
        }
// Output "no suggestion" if no hint was found or output correct values

    }
}
