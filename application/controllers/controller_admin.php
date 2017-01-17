<?php

/** class of controller admin**/
class Controller_Admin extends Controller
{

    function __construct()
    {
        $this->model = new Model_comment();
        $this->view = new View();
    }

    /**
     * method for generate admin view
     */

    function action_index()
    {
        session_start();


        /** check password **/
        if ($_SESSION['admin'] == ADMIN_PASSWORD) {
            if (isset($_POST['button']) && $_POST['button']) {


                /** click button **/
                switch ($_POST['button']) {
                    case 'edit':
                        $data = $this->model->getComment($_POST['id']);
                        $this->view->generate('edit_view.php', 'template_view.php', $data);
                        die();
                        break;
                    case 'accept':
                        $this->model->acceptedComment($_POST['id']);
                        break;
                    case 'reject':
                        $this->model->rejectedComment($_POST['id']);
                        break;
                }
            }
            $sort = 0;
            if (isset($_POST['sort']) && $_POST['sort']) {
                $sort = $_POST['sort'];
                $_SESSION['sort'] = $_POST['sort'];
            } else if (isset($_SESSION['sort']) && $_SESSION['sort'])
                $sort = $_SESSION['sort'];
            $data = array('data' => $this->model->getDataAdmin($sort), 'sort' => $sort);
            $this->view->generate('admin_view.php', 'template_view.php', $data);
        } else {
            session_destroy();
            Route::ErrorPage404();
        }

    }

    /**
     * method for save comment
     */

    function action_save()
    {
        session_start();

        /** check password **/
        if ($_SESSION['admin'] == ADMIN_PASSWORD) {
            if (isset($_POST['id']) && $_POST['id']) {
                $this->model->updateComment(array(Model_comment::COMMENTS_COLUMN_COMMENT => $_POST['comment'], Model_comment::COMMENTS_COLUMN_MODIFIED => '1'), $_POST['id']);
                $data['edit_status'] = 'success_edit';
            } else {
                $data['edit_status'] = 'error_edit';
            }
            if (isset($_SESSION['sort']) && $_SESSION['sort'])
                $data['sort'] = $_SESSION['sort'];
            $data['data'] = $this->model->getDataAdmin($data['sort']);
            $this->view->generate('admin_view.php', 'template_view.php', $data);
        }
    }

}
