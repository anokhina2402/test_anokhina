<?php

/** class of main controller **/
class Controller_Main extends Controller
{

    function __construct()
    {
        $this->model = new Model_comment();
        $this->view = new View();
    }

    /**
     * method for generate main view
     */

    function action_index()
    {
        /** get sort **/
        $sort = 0;
        if (isset($_POST['sort']) && $_POST['sort']) {
            $sort = $_POST['sort'];
            $_SESSION['sort'] = $_POST['sort'];
        } else if (isset($_SESSION['sort']) && $_SESSION['sort'])
            $sort = $_SESSION['sort'];

        $data = array('data' => $this->model->getDataGuest($sort), 'sort' => $sort);
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }

    /**
     * method for generate exit view
     */

    function action_exit()
    {
        session_start();
        session_destroy();
        header('Location:/');
    }


    /**
     * method for generate error login
     */

    function action_access_denied()
    {
        $data = array('data' => $this->model->getDataGuest(0), 'login_status' => 'access_denied', 'sort' => 0);
        session_start();
        session_destroy();
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }


}