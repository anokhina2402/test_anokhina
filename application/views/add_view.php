<h2>
    <?php echo $arr_locale['new_comment']; ?>
</h2>
<form id="addForm" role="form" method="post" action="/add/" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name"><?php echo $arr_locale['name']; ?>:</label>
        <input type="name" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="email"><?php echo $arr_locale['email']; ?>:</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="comment"><?php echo $arr_locale['comment']; ?>:</label>
        <textarea class="form-control" rows="10" cols="88" id="comment" name="comment"></textarea>
    </div>
    <input id="file" class="file" type="file" multiple data-min-file-count="0" name="file">

    <div class="form-group">
        <button type="submit" class="btn btn-success"><?php echo $arr_locale['save']; ?></button>
    </div>
</form>