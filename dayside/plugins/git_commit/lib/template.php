<form>
    <table class="panel_buttons ui-state-default">
        <tr class="buttons">
            <td class="refresh">
                <button class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only' type='submit'
                        name='action' value='refresh'>
                    <span class="ui-button-text">Refresh</span>
                </button>
            </td>
            <td class="view_controls">
                <div class="ui-button ui-widget ui-state-default icon-button" role="button">
                    <span class="ui-button-text">
                        <div class="combo-item">
                            <span data-value="<?= $view_type ?>" class="combo-label view_type">
                                <?= ($view_type == "history") ? "history" : "working tree" ?>
                            </span>
                        </div>
                    </span>
                </div>
            </td>
            <td class="branch_name">
                <div class="ui-button ui-widget ui-state-default icon-button icon-button branch_list" role="button">
                    <span class="ui-button-text">
                        <div class="combo-item">
                            <span class="combo-label"><?= $current_branch ?: "master" ?></span>
                        </div>
                    </span>
                </div>
                <? if (!empty($all_branches)): ?>
                    <div class="button-select-panel teacss-ui">
                        <div>
                            <? foreach ($all_branches as $branch): ?>
                                <div data-value="<?= htmlspecialchars($branch) ?>"
                                     class="branch combo-item <?= ($branch == $current_branch) ? 'selected' : '' ?>">
                                    <span class="combo-label"><?= $branch ?></span>
                                </div>
                            <? endforeach ?>
                        </div>
                    </div>
                <? endif ?>
            </td>
            <? if ($view_type == "history"): ?>
                <td class="commit_name">
                    <div class="ui-button ui-widget ui-state-default icon-button commit_list" role="button">
                        <span class="ui-button-text">
                            <div class="combo-item">
                                <span
                                    class="combo-label"><?= $selected_commit_sha ? substr($selected_commit_sha, 0, 7) : "(empty)" ?></span>
                            </div>
                        </span>
                    </div>
                    <? if (!empty($last_commits)): ?>
                        <div class="button-select-panel teacss-ui">
                            <div>
                                <? foreach ($last_commits as $commit): ?>
                                    <? $title = ($commit['excerpt'] == $commit['message']) ? '' : 'title="' . htmlspecialchars($commit['message']) . '"'; ?>
                                    <div data-value="<?= $commit["sha_full"] ?>" <?= $title ?>
                                         class="commit combo-item <?= ($commit['sha_full'] == $selected_commit_sha) ? 'selected' : '' ?>">
                                    <span class="combo-label">
                                        <p class="commit_sha_short">
                                            <b><?= $commit['sha_short'] ?></b> <?= $commit['date'] ?></p>
                                        <p class="commit_message"><?= htmlspecialchars($commit['excerpt']) ?></p>
                                    </span>
                                    </div>
                                <? endforeach ?>
                            </div>
                        </div>
                    <? endif ?>

                    <div class="ui-button ui-widget ui-state-default icon-button commit_list" role="button">
                        <span class="ui-button-text">
                            <div class="combo-item">
                                <span class="combo-label"><?= "~" . $history_depth ?></span>
                            </div>
                        </span>
                    </div>
                    <? if (!empty($after_commits)): ?>
                        <div class="button-select-panel teacss-ui">
                            <div>
                                <? foreach ($after_commits as $n => $commit): ?>
                                    <? $title = ($commit['excerpt'] == $commit['message']) ? '' : 'title="' . htmlspecialchars($commit['message']) . '"'; ?>
                                    <div data-value="<?= ($n + 1) ?>" <?= $title ?>
                                         class="history_depth combo-item <?= (($n + 1) == $history_depth) ? 'selected' : '' ?>">
                                    <span class="combo-label">
                                        <p class="commit_sha_short"><b><?= $commit['sha_short'] ?></b></p>
                                        <p class="commit_message"><?= htmlspecialchars($commit['excerpt']) ?></p>
                                    </span>
                                    </div>
                                <? endforeach ?>
                            </div>
                        </div>
                    <? endif ?>
                </td>
            <? endif ?>
            <? if ($view_type != "history"): ?>
                <td class="stage">
                    <button class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only' type='submit'
                            name='action' value='stage_all'>
                        <span class="ui-button-text">Stage All</span>
                    </button>
                </td>
                <td class="commit_msg">
                    <input name='commit_message' placeholder='commit message' value='<?= @$commit_message ?>' /input>
                </td>
                <td class="commit_btn">
                    <button class='ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only' type='submit'
                            name='action' value='commit'>
                        <span class="ui-button-text">Commit</span>
                    </button>
                    <div
                        class='commit_select_menu ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only'>
                        <span class="ui-button-text">&#9660;</span>
                    </div>
                    <div class="commit_select_menu_item button-select-panel teacss-ui">
                        <div>
                            <div class="amend combo-item">
                                <span class="combo-label">Amend</span>
                            </div>
                        </div>
                    </div>
                </td>
            <? endif ?>
            <td class="empty" style="width: 100%;"></td>

            <input type='hidden' id='status_hash' name='status_hash' value='<?= $status_hash ?>'>
            <input type='hidden' name='previous_view_type' value='<?= $view_type ?>'>
            <input type='hidden' name='selected_branch' value='<?= $current_branch ?>'>
            <input type='hidden' name='selected_commit' value='<?= $selected_commit_sha ?>'>
            <input type='hidden' name='history_depth' value='<?= $history_depth ?>'>
        </tr>
    </table>
    <div class="diff_scroll_wrap">
        <table class="diff_status">
            <tr>
                <td colspan="5">
                    <div class="ui-state-error ui-corner-all"><?= $error ?></div>
                </td>
            </tr>
            <tr class="filelist_header ui-state-default">
                <? if ($view_type != "history"): ?>
                    <th class="staged ui-state-default">Staged</th>
                <? endif ?>
                <th class="state ui-state-default">State</th>
                <th class="filename ui-state-default">Filename</th>
                <? if ($view_type != "history"): ?>
                    <th class="checkout ui-state-default">Checkout</th>
                <? endif ?>
                <th class="empty ui-state-default"></th>
            </tr>
            <? if (empty($status)): ?>
                <tr class="file ui-widget-content ui-state-default">
                    <td colspan="5">
                        <? if ($view_type == "history"): ?>
                            No changes to display
                        <? else: ?>
                            Nothing to commit, working directory clean
                        <? endif ?>
                    </td>
                </tr>
            <? endif ?>
            <? foreach ($status as $one): ?>
                <tr data-file='<?= htmlspecialchars($one['file']) ?>'
                    data-status="<?= htmlspecialchars(json_encode($one)) ?>"
                    class="file ui-widget-content ui-state-default">
                    <? if ($view_type != "history"): ?>
                        <td class="checkbox">
                            <input
                                class='checkbox <?= $one['partial'] ? 'partial' : '' ?>' <?= $one['staged'] ? 'checked' : '' ?>
                                type='checkbox'>
                        </td>
                    <? endif ?>
                    <td class='state'><?= $one['state'] ?></td>
                    <td class='filename'><?= isset($one['old_file']) ? $one['old_file'] . " -> " : "" ?><?= $one['file'] ?></td>
                    <? if ($view_type != "history"): ?>
                        <td class="checkout">
                            <button
                                class='checkout_file ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close'>
                                <span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span>
                            </button>
                        </td>
                    <? endif ?>
                    <td class="empty"></td>
                </tr>
                <tr>
                    <td class="diff_html ui-state-default" colspan='5'></td>
                </tr>
            <? endforeach ?>
        </table>
    </div>
</form>