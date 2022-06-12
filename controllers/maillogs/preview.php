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

<?php if (! $this->fatalError): ?>
    <?php Block::put('form-contents') ?>

    <div class="layout-row min-size">
        <?= $this->formRender(['preview' => true, 'section' => 'outside']) ?>
    </div>

    <p>
        <a href="<?= Backend::url('renatio/maillog/maillogs') ?>"
           class="btn btn-default oc-icon-chevron-left"><?= e(trans('backend::lang.form.return_to_list')) ?></a>
    </p>

    <?php Block::endPut() ?>

    <?php Block::put('form-sidebar') ?>
    <?= $this->formRender(['preview' => true, 'section' => 'secondary']) ?>
    <?php Block::endPut() ?>

    <?php Block::put('body') ?>
    <?= Form::open(['class' => 'layout stretch']) ?>
    <?= $this->makeLayout('form-with-sidebar') ?>
    <?= Form::close() ?>
    <?php Block::endPut() ?>
<?php else: ?>
    <p class="flash-message static error"><?= e($this->fatalError) ?></p>
    <p><a href="<?= Backend::url('renatio/formbuilder/forms') ?>"
          class="btn btn-default"><?= e(trans('renatio.formbuilder::lang.forms.return')) ?>
        </a></p>
<?php endif ?>



