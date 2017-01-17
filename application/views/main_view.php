<h1>&nbsp;
</h1>
<h1><?php echo $arr_locale['comments']; ?></h1>

<?php include 'application/views/sort_view.php'; ?>
<table class="table table-striped">
    <?php
    foreach ($data['data'] as $row) {
        echo '<tr><td style="width:10%">' . (is_file(PREFIX_UPLOADDIR . $row['photo']) ?
                '<img src="/' . PREFIX_UPLOADDIR . $row['photo'] . '" alt="' . PREFIX_UPLOADDIR . $row['photo'] . '">' :
                '<img src="/images/no_image.png" alt="no_image">') . '</td>
              <td><h2>' . $row['name'] . '</h2></br>' . $row['comment'] . '</td>
              </tr>';
    }
    ?>
</table>
<?php if (isset($data['add_status']) && $data['add_status'] == 'success_add') { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $arr_locale['success']; ?>!</strong> <?php echo $arr_locale['success_add']; ?>
    </div>
<?php } else if (isset($data['add_status']) && $data['add_status'] == 'error_add') { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $arr_locale['error']; ?>!</strong> <?php echo $arr_locale['error_add']; ?>
    </div>
<?php } ?>
<?php include_once 'application/views/add_view.php'; ?>
