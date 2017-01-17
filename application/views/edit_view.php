<h1>&nbsp;
</h1>
<h2>
    <?php echo $arr_locale['edit_comment']; ?>
</h2>
<form id="editForm" role="form" method="post" action="/admin/save">
    <div class="form-group">
        <label for="comment"><?php echo $arr_locale['comment']; ?>:</label>
        <textarea class="form-control" rows="10" cols="88" id="comment"
                  name="comment"><?php echo $data['comment']; ?></textarea>
    </div>
    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $data['id']; ?>">

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success"><?php echo $arr_locale['save']; ?></button>
        </div>
    </div>
</form>