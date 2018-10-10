<?php
namespace agilman\a2\controller;

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
            //$this->redirect('loginPage');
//            $view = new View('accountCreated');
//            echo $view->render();
        } catch (\Exception $e){
            $view = new View('createAccountPage');
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
}
