<?php global $arr_locale; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <title><?php echo $arr_locale['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap-theme.css"/>
    <link href="/css/style.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="#"><?php echo $arr_locale['title']; ?></a>

            <div class="nav-collapse">
                <?php include_once 'application/views/login_view.php'; ?>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <?php include_once 'application/views/' . $content_view; ?>
</div>
<div id="footer">
    <a href="/"><?php echo $arr_locale['title']; ?></a>
</div>

<script src="/js/jquery-1.12.3.min.js" type="text/javascript"></script>
<script src="/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/js/ckeditor/adapters/jquery.js" type="text/javascript"></script>
<script src="/assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="/assets/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="/assets/js/fileinput.min.js" type="text/javascript"></script>
<script src="/assets/js/fileinput_locale_ru.js"></script>
<script src="/bootstrap/js/bootstrap.js" type="text/javascript"></script>

<script src="/bootstrap/js/transition.js" type="text/javascript"></script>
<script src="/bootstrap/js/alert.js" type="text/javascript"></script>
<script src="/bootstrap/js/modal.js" type="text/javascript"></script>
<script src="/bootstrap/js/dropdown.js" type="text/javascript"></script>
<script src="/bootstrap/js/scrollspy.js" type="text/javascript"></script>
<script src="/bootstrap/js/tab.js" type="text/javascript"></script>
<script src="/bootstrap/js/tooltip.js" type="text/javascript"></script>
<script src="/bootstrap/js/popover.js" type="text/javascript"></script>
<script src="/bootstrap/js/button.js" type="text/javascript"></script>
<script src="/bootstrap/js/collapse.js" type="text/javascript"></script>
<script src="/bootstrap/js/carousel.js" type="text/javascript"></script>
<script src="/bootstrap/js/affix.js" type="text/javascript"></script>

<script src="/js/main.js" type="text/javascript"></script>


</body>
</html>