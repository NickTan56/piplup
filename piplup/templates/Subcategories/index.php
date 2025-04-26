<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Subcategory> $subcategories
 */
?>

<?= $this->Html->link('Back', '/', ['class' => 'px-1 pt-1', 'escape' => false]) ?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">Subcategories</h1>
</div>

<div class="d-flex flex-column align-items-center">
    <!-- Top Action Buttons -->
    <!-- <div class="d-flex flex-wrap justify-content-center align-items-start gap-4 mb-4">
        <div class="d-flex gap-2">
            <?= $this->Html->link('New', ['action' => 'add'], ['class' => 'pixel-button orange']) ?>
            <?= $this->Html->link('Back', ['controller' => 'Places', 'action' => 'index'], ['class' => 'pixel-button blue']) ?>
        </div>
    </div> -->

    <!-- Subcategory List Section -->
    <div class="info-panel border border-dark p-3 text-dark table-wrapper" style="max-height: 500px; overflow-y: auto; width: 100%;">
        <div class="accordion" id="subcategoryAccordion">
            <?php
            $currentCategory = null;
            $rowIndex = 0;
            foreach ($subcategories as $subcategory):
                $categoryName = $subcategory->category->name ?? 'Uncategorized';
                if ($categoryName !== $currentCategory):
                    if ($currentCategory !== null): ?>
                        </tbody></table></div></div>
                    <?php endif; ?>

                    <!-- Accordion Item Start -->
                    <div class="accordion-item" style="background: none; border: none;">
                        <h2 class="accordion-header" id="heading<?= $rowIndex ?>">
                            <button class="accordion-button custom-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $rowIndex ?>" aria-expanded="false" aria-controls="collapse<?= $rowIndex ?>">
                                <?= h($categoryName) ?>
                                <span class="custom-accordion-icon">▼</span>
                            </button>
                        </h2>
                        <div id="collapse<?= $rowIndex ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $rowIndex ?>" data-bs-parent="#subcategoryAccordion">
                            <div class="accordion-body p-0">
                                <table class="place-list table table-borderless m-0">
                                    <thead class="fw-bold border-bottom pb-2 mb-2">
                                        <tr>
                                            <th>Subcategory</th>
                                            <th>Created</th>
                                            <th>Modified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    $currentCategory = $categoryName;
                    $rowIndex++;
                    endif;
                    ?>
                    <!-- Subcategory Rows -->
                    <tr class="border-bottom py-2">
                        <td><?= h($subcategory->name) ?></td>
                        <td><?= h($subcategory->created->format('n/j/y, g:iA')) ?></td>
                        <td><?= h($subcategory->modified->format('n/j/y, g:iA')) ?></td>
                        <td>
                            <?= $this->Html->link('Edit', ['action' => 'edit', $subcategory->id], ['class' => 'link-dark']) ?>
                            <?= $this->Form->postLink('Delete', ['action' => 'delete', $subcategory->id], [
                                'confirm' => __('Are you sure you want to delete {0}?', $subcategory->name),
                                'class' => 'link-dark'
                            ]) ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
                </tbody></table></div></div></div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle -->
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js') ?>
