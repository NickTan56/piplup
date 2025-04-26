<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subcategory $subcategory
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 */
?>

<?= $this->Html->link('Back', $this->request->referer(), ['class' => 'px-1 pt-1', 'escape' => false]) ?>

<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">Edit Subcategory</h1>
</div>

<!-- Form Container -->
<div class="row">
    <div class="subcategories form content">
        <?= $this->Form->create($subcategory) ?>
        <fieldset>
            <!-- Category Selection -->
            <label for="category-id" class="form-label">Parent Category <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('category_id', [
                'label' => false,
                'options' => $categories,
                'class' => 'form-control pixel-input',
                'required' => true,
                'id' => 'category-id'
            ]) ?>

            <!-- Subcategory Name -->
            <label for="subcategory-name" class="form-label mt-3">Subcategory Name <span class="required-asterisk">*</span></label>
            <?= $this->Form->control('name', [
                'label' => false,
                'placeholder' => 'Enter the name',
                'class' => 'form-control pixel-input',
                'required' => true,
                'id' => 'subcategory-name'
            ]) ?>
        </fieldset>

        <div class="d-flex justify-content-end mt-3">
            <?= $this->Form->button('Submit') ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
