<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Place $place
 * @var \Cake\Collection\CollectionInterface|string[] $subcategories
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
    <h1 class="h3 mb-3 heading-title">New Place?</h1>
</div>

<!-- Form Container -->
<div class="row">
    <div class="places form content form-wrapper" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
        <?= $this->Form->create($place) ?>
        <fieldset>
            <!-- Category Dropdown -->
            <label for="category_id" class="form-label">Category <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('category_id', [
                'label' => false,
                'options' => $categories,
                'value' => $categoryId,
                'empty' => 'Select a category',
                'class' => 'form-control pixel-input',
                'onchange' => 'this.form.submit()' // Re-submit the form when category changes
            ]) ?>

            <!-- Subcategory Dropdown -->
            <label for="subcategory_id" class="form-label mt-3">Subcategory <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('subcategory_id', [
                'label' => false,
                'options' => $subcategories,
                'empty' => 'Choose a subcategory',
                'class' => 'form-control pixel-input',
            ]) ?>

            <!-- Name -->
            <?= $this->Form->control('name', [
                'label' => 'Place Name',
                'class' => 'form-control pixel-input mt-3'
            ]) ?>

            <!-- Address -->
            <?= $this->Form->control('address', [
                'label' => 'Address',
                'id' => 'autocomplete',
                'type' => 'text',
                'class' => 'form-control pixel-input mt-3'
            ]) ?>

            <!-- Description -->
            <?= $this->Form->control('description', [
                'label' => 'Description',
                'class' => 'form-control pixel-input mt-3'
            ]) ?>
        </fieldset>

        <div class="d-flex justify-content-end mt-4">
            <?= $this->Form->button('Submit') ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
