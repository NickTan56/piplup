<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<?= $this->Html->link('Back', '/new-menu', ['class' => 'px-1 pt-1', 'escape' => false]) ?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">New Category?</h1>
</div>
<!-- Form Container -->
<div class="row">
    <div class="categories form content">
        <?= $this->Form->create($category) ?>
        <fieldset>
            <label for="name" class="form-label">Category Name <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('name', [
                'label' => false,
                'class' => 'form-control pixel-input mt-2 mb-4',
                'required' => true,
                'id' => 'name',
            ]) ?>
        </fieldset>
        <?= $this->Form->button('Submit') ?>
        <?= $this->Form->end() ?>
    </div>
</div>

