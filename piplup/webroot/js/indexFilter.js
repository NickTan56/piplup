document.addEventListener('DOMContentLoaded', function() {
    const categoryCheckboxes = document.querySelectorAll('input[name="categories[]"]');
    const subcategoryItems = document.querySelectorAll('.subcategory-item');
    const subcategoryList = document.getElementById('subcategory-list');
    const subcategoryPlaceholder = document.getElementById('subcategory-placeholder');

    function updateSubcategories() {
        let selectedCategories = Array.from(categoryCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selectedCategories.length === 0) {
            subcategoryList.style.display = 'none';
            subcategoryPlaceholder.style.display = 'block';
        } else {
            subcategoryList.style.display = 'block';
            subcategoryPlaceholder.style.display = 'none';

            subcategoryItems.forEach(item => {
                if (selectedCategories.includes(item.getAttribute('data-category'))) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    }

    categoryCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateSubcategories);
    });

    updateSubcategories();
});