<h1>&nbsp;
</h1>
<h1><?php echo $arr_locale['comments']; ?></h1>

<?php if (isset($data['edit_status']) && $data['edit_status'] == 'success_edit') { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $arr_locale['success']; ?>!</strong> <?php echo $arr_locale['success_edit']; ?>
    </div>
<?php } else if (isset($data['edit_status']) && $data['edit_status'] == 'error_edit') { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $arr_locale['error']; ?>!</strong> <?php echo $arr_locale['error_edit']; ?>
    </div>
<?php } ?>
<?php include_once 'application/views/sort_view.php'; ?>

<table class="table table-striped">
    <?php
    foreach ($data['data'] as $row) {
        echo '<tr class="' . ($row['flag'] == 1 ? 'accepted' : ($row['flag'] == 2 ? 'rejected' : '')) . '"><td style="width:10%">' . (is_file(PREFIX_UPLOADDIR . $row['photo']) ?
                '<img src="/' . PREFIX_UPLOADDIR . $row['photo'] . '" alt="' . PREFIX_UPLOADDIR . $row['photo'] . '">' :
                '<img src="/images/no_image.png" alt="no_image">') . '</td>
              <td>' . ($row['modified'] ? '<p class="grey">' . $arr_locale['edited_admin'] . '</p>' : '') . '<h3>' . $row['name'] . '</h3></br><h4>' . $row['email'] . '</h4></br>' . $row['comment'] . '</td>
              <td style="width:10%">
              <form id="adminForm" role="form"  method="post" action="/admin/">
                <input type="hidden" class="form-control" id="id" name="id" value="' . $row['id'] . '">
                <div><button id="button" name="button" type="submit" class="btn btn-default width_50" value="edit">' . $arr_locale['edit'] . '</div>
                <div><button  id="button" name="button" type="submit" class="btn btn-success width_50" value="accept">' . $arr_locale['accept'] . '</div>
                <div><button  id="button" name="button" type="submit" class="btn btn-danger width_50" value="reject">' . $arr_locale['reject'] . '</div>
               </form>
            </td></tr>';
    }
    ?>
</table>
