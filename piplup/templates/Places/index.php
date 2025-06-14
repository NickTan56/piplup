<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Place> $places
 */
?>
<!-- Piplup Header -->
<div class="d-flex flex-wrap justify-content-start align-items-center">
    <?= $this->Html->image('piplup.png', [
        'class' => 'mb-3',
        'style' => 'width:113px; height:113px;',
        'alt' => 'Piplup'
    ]) ?>
    <h1 class="h3 mb-3 heading-title">Piplup Places</h1>
</div>
<div class="d-flex flex-column align-items-center">
    <!-- Header with pixel box + buttons -->
    <div class="d-flex flex-wrap justify-content-center align-items-start gap-4 mb-4">
        <!-- Top Action Panel -->
        <div class="row g-3 align-items-center">
            <!-- Left box -->
            <div class="col-auto">
                <div class="pixel-box">
                    <strong>What will you do?</strong>
                </div>
            </div>

            <!-- Right buttons -->
            <div class="col-auto d-flex flex-column gap-2">
                <div class="d-flex gap-2">
                    <!-- Filter Option -->
                    <div class="dropdown">
                        <button class="pixel-button pink" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu p-3" aria-labelledby="filterDropdown" style="width: 400px;">
                            <?= $this->Form->create(null, ['type' => 'get']) ?>

                            <div class="row">
                                <!-- Categories Section -->
                                <div class="col-6">
                                    <strong>Categories</strong>
                                    <?php foreach ($categories as $catId => $catName): ?>
                                        <div class="form-check">
                                            <?= $this->Form->checkbox('categories[]', [
                                                'value' => $catId,
                                                'id' => "category-$catId",
                                                'checked' => in_array($catId, (array) $this->request->getQuery('categories')),
                                                'hiddenField' => false
                                            ]) ?>
                                            <?= $this->Form->label("category-$catId", h($catName)) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Subcategories Section -->
                                <div class="col-6">
                                    <strong>Subcategories</strong>
                                    <div id="subcategory-list">
                                        <?php foreach ($subcategories as $subcat): ?>
                                            <div class="form-check subcategory-item" data-category="<?= h($subcat->category_id) ?>">
                                                <?= $this->Form->checkbox('subcategories[]', [
                                                    'value' => $subcat->id,
                                                    'id' => "subcategory-$subcat->id",
                                                    'checked' => in_array($subcat->id, (array) $this->request->getQuery('subcategories')),
                                                    'hiddenField' => false
                                                ]) ?>
                                                <?= $this->Form->label("subcategory-$subcat->id", h($subcat->name)) ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div id="subcategory-placeholder" style="display: none; font-style: italic; color: #666;">
                                        Select categories first!
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <?= $this->Form->button('Apply Filter', ['class' => 'pixel-button green']) ?>
                            </div>

                            <?= $this->Form->end() ?>
                        </div>
                    </div>

                    <!-- New Menu Option -->
                    <?= $this->Html->link('New', '/new-menu', ['class' => 'pixel-button orange']) ?>
                </div>
                <div class="d-flex gap-2">
                    <!-- Sort Option -->
                    <?php
                    // Capture the current filter queries so they don't disappear after sorting
                    $currentQuery = $this->request->getQuery();
                    ?>
                    <div class="dropdown">
                        <button class="pixel-button green" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li>
                                <?= $this->Html->link(
                                    'Category (A-Z)', 
                                    ['?' => array_merge($currentQuery, ['sort' => 'Categories.name', 'direction' => 'asc'])], 
                                    ['class' => 'dropdown-item']
                                ) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(
                                    'Subcategory (A-Z)', 
                                    ['?' => array_merge($currentQuery, ['sort' => 'Subcategories.name', 'direction' => 'asc'])], 
                                    ['class' => 'dropdown-item']
                                ) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(
                                    'Name (A-Z)', 
                                    ['?' => array_merge($currentQuery, ['sort' => 'Places.name', 'direction' => 'asc'])], 
                                    ['class' => 'dropdown-item']
                                ) ?>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <?= $this->Html->link(
                                    'Name (Z-A)', 
                                    ['?' => array_merge($currentQuery, ['sort' => 'Places.name', 'direction' => 'desc'])], 
                                    ['class' => 'dropdown-item']
                                ) ?>
                            </li>
                        </ul>
                    </div>
                    <!-- List Menu Option -->
                    <?= $this->Html->link('List', '/list-menu', ['class' => 'pixel-button blue']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Place List Section -->
    <div class="info-panel border border-dark p-3 text-dark table-wrapper" style="max-height: 400px; overflow-y: auto;">
        <table class="place-list table table-borderless">
            <thead class="fw-bold border-bottom pb-2 mb-2">
                <tr>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Name</th>
                    <th>Direction</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($places as $index => $place): ?>
                    <tr class="border-bottom py-2 clickable-row" data-index="<?= $index ?>">
                        <td><?= h($place->subcategory->category->name ?? '') ?></td>
                        <td><?= h($place->subcategory->name ?? '') ?></td>
                        <td><?= h($place->name) ?></td>
                        <td>
                            <div class="d-flex flex-column align-items-center">
                                <a href="https://www.google.com/maps/dir/?api=1&destination=<?= urlencode($place->address) ?>" target="_blank" rel="noopener">
                                    <?= $this->Html->link('<i class="bi bi-sign-turn-right-fill"></i>', 
                                        "https://www.google.com/maps/dir/?api=1&destination=" . urlencode($place->address), [
                                        'escape' => false,
                                        'target' => '_blank',
                                        'rel' => 'noopener',
                                        'title' => 'Open in Google Maps',
                                        'class' => 'justify-content-center'
                                    ]) ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    const allPlaces = <?= json_encode($allPlaces); ?>; // Pass places data to JavaScript
</script>
<?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js') ?>
<?= $this->Html->script('indexFilter') ?>