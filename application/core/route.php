<?php

/** class for routes**/
class Route
{

    /**
     * method for start route
     */

    static function start()
    {
        /** default controller **/
        $controller_name = 'Main';
        $action_name = 'index';


        $routes = explode('/', $_SERVER['REQUEST_URI']);

        /** get controller's name by route **/
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        /** get action's name **/
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        /** add prefixes**/
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'action_' . $action_name;

        /** include model class**/

        $model_file = 'model_comment.php';
        $model_path = "application/models/" . $model_file;
        if (file_exists($model_path)) {
            include_once "application/models/" . $model_file;
        }

        /** include controller class **/
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include_once "application/controllers/" . $controller_file;
        } else {

            /** error **/
            Route::ErrorPage404();
        }

        /** create conrtoller **/
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            /** call controller action**/
            $controller->$action();
        } else {
            /** error **/
            Route::ErrorPage404();
        }

    }

    /**
     * method for start error page
     */
    static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
