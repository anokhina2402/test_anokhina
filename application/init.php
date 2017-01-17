<?php
require_once 'config.php';
require_once 'locale/' . LOCALE . '.php';
global $arr_locale;


// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';


require_once 'core/route.php';
/** start route **/
Route::start();
?>