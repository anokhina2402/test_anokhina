<?php if (!$_SESSION['admin']) { ?>
    <form id="loginForm" role="form" method="post" action="/login/">
        <input name="login" id=login" type="text" placeholder="<?php echo $arr_locale['login']; ?>">
        <input name="password" id="password" type="password" placeholder="<?php echo $arr_locale['password']; ?>">
        <button class="btn btn-success" type="submit"><?php echo $arr_locale['enter']; ?></button>
    </form>
<?php } else { ?>
    <form class="navbar-form pull-right" method="post" action="/main/exit/">

        <a href="#"><span>Admin  </span></a>
        <button class="btn" type="submit"><?php echo $arr_locale['exit']; ?></button>
    </form>
<?php } ?>
<?php
if ($data["login_status"] == "access_denied") { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $arr_locale['error']; ?>!</strong> <?php echo $arr_locale['wrong_login_passw']; ?>
    </div>
<?php } ?>
