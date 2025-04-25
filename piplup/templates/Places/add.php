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
    <div class="places form content">
        <?= $this->Form->create($place) ?>
        <fieldset>
            <!-- Subcategory -->
            <label for="subcategory-id" class="form-label">Subcategory <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('subcategory_id', [
                'label' => false,
                'options' => $subcategories,
                'class' => 'form-control pixel-input mt-2 mb-4',
                'required' => true,
                'id' => 'subcategory-id'
            ]) ?>

            <!-- Name -->
            <label for="place-name" class="form-label">Place Name <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('name', [
                'label' => false,
                'class' => 'form-control pixel-input mt-2 mb-4',
                'required' => true,
                'id' => 'place-name'
            ]) ?>

            <!-- Address -->
            <label for="autocomplete" class="form-label">Address <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('address', [
                'label' => false,
                'id' => 'autocomplete',
                'type' => 'text',
                'placeholder' => 'Enter an address',
                'class' => 'form-control pixel-input mt-2 mb-4',
                'required' => true
            ]) ?>

            <!-- Description -->
            <label for="place-description" class="form-label">Description</label>
            <?= $this->Form->control('description', [
                'label' => false,
                'id' => 'place-description',
                'class' => 'form-control pixel-input mt-2 mb-4'
            ]) ?>
        </fieldset>

        <div class="d-flex justify-content-end">
            <?= $this->Form->button('Submit') ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
