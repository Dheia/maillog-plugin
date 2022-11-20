<div class="scoreboard">
    <div data-control="toolbar">
        <div class="scoreboard-item title-value">
            <h4><?= e(trans('renatio.maillog::lang.field.id')) ?></h4>
            <p>
                #<?= $formModel->id ?>
            </p>
        </div>

        <div class="scoreboard-item title-value">
            <h4><?= e(trans('renatio.maillog::lang.field.is_sent')) ?></h4>
            <p class="<?= $formModel->is_sent ? 'text-success' : 'text-danger' ?>">
                <?= $formModel->is_sent ? e(trans('backend::lang.list.column_switch_true')) : e(trans('backend::lang.list.column_switch_false')) ?>
            </p>
            <p class="description">
                <?= $formModel->sent_at ?>
            </p>
        </div>

        <?php if (\Renatio\MailLog\Models\Settings::get('track_opens')) : ?>
            <div class="scoreboard-item title-value">
                <h4><?= e(trans('renatio.maillog::lang.field.opened')) ?></h4>
                <p>
                    <?= $formModel->opened ?>
                </p>
            </div>

            <?php if ($formModel->first_opened_at) : ?>
                <div class="scoreboard-item title-value">
                    <h4><?= e(trans('renatio.maillog::lang.field.first_opened_at')) ?></h4>
                    <p>
                        <?= $formModel->first_opened_at->diffForHumans() ?>
                    </p>
                    <p class="description">
                        <?= $formModel->first_opened_at ?>
                    </p>
                </div>
            <?php endif ?>

            <?php if ($formModel->last_opened_at) : ?>
                <div class="scoreboard-item title-value">
                    <h4><?= e(trans('renatio.maillog::lang.field.last_opened_at')) ?></h4>
                    <p>
                        <?= $formModel->last_opened_at->diffForHumans() ?>
                    </p>
                    <p class="description">
                        <?= $formModel->last_opened_at ?>
                    </p>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>


