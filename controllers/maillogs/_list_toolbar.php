<div data-control="toolbar" class="loading-indicator-container">
    <a
        href="javascript:;"
        data-request="onRefresh"
        data-load-indicator="<?= e(trans('backend::lang.list.updating')) ?>"
        class="btn btn-primary oc-icon-refresh">
        <?= e(trans('backend::lang.list.refresh')) ?>
    </a>

    <a href="<?= Backend::url('renatio/maillog/maillogs/export') ?>"
       class="btn btn-default oc-icon-download">
        <?= e(trans('renatio.maillog::lang.mail_log.export')) ?>
    </a>

    <a
        href="javascript:;"
        data-request="onEmptyLog"
        data-request-confirm="<?= e(trans('backend::lang.form.action_confirm')) ?>"
        data-load-indicator="<?= e(trans('renatio.maillog::lang.mail_log.empty_loading')) ?>"
        class="btn btn-default oc-icon-eraser">
        <?= e(trans('renatio.maillog::lang.mail_log.empty_link')) ?>
    </a>

    <button
        class="btn btn-danger oc-icon-trash-o"
        data-request="onDelete"
        data-request-confirm="<?= e(trans('backend::lang.list.delete_selected_confirm')) ?>"
        data-list-checked-trigger
        data-list-checked-request
        data-stripe-load-indicator>
        <?= e(trans('backend::lang.list.delete_selected')) ?>
    </button>
</div>
