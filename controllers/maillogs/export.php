<?php Block::put('breadcrumb') ?>
    <ul>
        <li>
            <a href="<?= Backend::url('renatio/maillog/maillogs') ?>">
                <?= e(trans('renatio.maillog::lang.navigation.mail_logs')) ?>
            </a>
        </li>
        <li><?= e($this->pageTitle) ?></li>
    </ul>
<?php Block::endPut() ?>

<?= Form::open(['class' => 'layout']) ?>

    <div class="layout-row">
        <?= $this->exportRender() ?>
    </div>

    <div class="form-buttons">
        <div class="loading-indicator-container">
            <button
                type="submit"
                data-control="popup"
                data-handler="onExportLoadForm"
                data-keyboard="false"
                class="btn btn-primary">
                <?= e(trans('renatio.maillog::lang.mail_log.export')) ?>
            </button>

            <span class="btn-text">
                <?= e(trans('backend::lang.form.or')) ?>
                <a href="<?= Backend::url('renatio/maillog/maillogs') ?>">
                    <?= e(trans('backend::lang.form.cancel')) ?>
                </a>
            </span>
        </div>
    </div>

<?= Form::close() ?>
