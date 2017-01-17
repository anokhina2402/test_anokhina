<form id="sortForm" role="form" class="form-inline" method="POST">
    <div class="form-group">
        <label for="comment"><?php echo $arr_locale['sort']; ?>:</label>
        <select id="sort" name="sort" class="form-control" onchange="this.form.submit()">
            <option
                value="0" <?php if (!isset($data['sort']) || $date['sort'] == 0) echo 'selected'; ?>><?php echo $arr_locale['sort_date']; ?></option>
            <option
                value="1" <?php if ($data['sort'] == 1) echo 'selected'; ?>><?php echo $arr_locale['sort_name']; ?></option>
            <option
                value="2" <?php if ($data['sort'] == 2) echo 'selected'; ?>><?php echo $arr_locale['sort_email']; ?></option>
        </select>
    </div>
</form>