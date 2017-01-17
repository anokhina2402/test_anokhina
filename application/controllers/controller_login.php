<?php

/** class of login controller **/
class Controller_Login extends Controller
{

    /**
     * method for check admin
     */

    function action_index()
    {

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            /** authentication **/
            if ($login == ADMIN_NAME && $password == ADMIN_PASSWORD) {
                $data["login_status"] = "access_granted";

                session_start();
                $_SESSION['admin'] = $password;
                header('Location:/admin/');
                die();
            } else {
                $data["login_status"] = "access_denied";
            }
        } else {
            $data["login_status"] = "";
        }

        header('Location:/main/' . $data["login_status"]);
    }


}
