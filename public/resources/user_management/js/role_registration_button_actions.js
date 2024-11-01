document.addEventListener('DOMContentLoaded', function () {
    function updateCategoryCheckboxes() {
        document.querySelectorAll('.sub-rol').forEach(subRoleContainer => {
            const categoryCheckboxId = subRoleContainer.getAttribute('data-category-id');
            const categoryCheckbox = document.getElementById(categoryCheckboxId);
            const anyPermissionChecked = subRoleContainer.querySelector('input[type="checkbox"]:checked') !== null;

            categoryCheckbox.checked = anyPermissionChecked;
        });
    }
    document.querySelectorAll('.category-checkbox').forEach(categoryCheckbox => {
        categoryCheckbox.addEventListener('change', function () {
            const categoryId = this.id;
            const permissionsContainer = document.querySelector(`.sub-rol[data-category-id="${categoryId}"]`);
            if (permissionsContainer) {
                permissionsContainer.querySelectorAll('input[type="checkbox"]').forEach(permissionCheckbox => {
                    permissionCheckbox.checked = categoryCheckbox.checked;
                });
            }
            updateCategoryCheckboxes();
        });
    });
    document.querySelectorAll('.permission-checkbox').forEach(permissionCheckbox => {
        permissionCheckbox.addEventListener('change', function () {
            updateCategoryCheckboxes();
        });
    });
    updateCategoryCheckboxes();
});
