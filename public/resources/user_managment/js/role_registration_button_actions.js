document.addEventListener('DOMContentLoaded', function () {
    const previousButton = document.querySelector('.button-opcion.previous');

    if (previousButton) {
        previousButton.addEventListener('click', function (event) {
            event.preventDefault();
            window.history.back();
        });
    }
});

    document.addEventListener('DOMContentLoaded', function() {
        function updateCategoryCheckboxes() {
            document.querySelectorAll('.sub-rol').forEach(subRoleContainer => {
                const categoryCheckbox = subRoleContainer.previousElementSibling.querySelector('input[type="checkbox"]');
                const anyPermissionChecked = subRoleContainer.querySelector('input[type="checkbox"]:checked');
                categoryCheckbox.checked = !!anyPermissionChecked;
            });
        }

        // Manejar la selección/deselección de categorías
        document.querySelectorAll('.checkbox-1 input[type="checkbox"]').forEach(categoryCheckbox => {
            categoryCheckbox.addEventListener('change', function() {
                const categoryId = this.id;
                const permissionsContainer = document.querySelector(`#${categoryId}.sub-rol`);
                if (permissionsContainer) {
                    permissionsContainer.querySelectorAll('input[type="checkbox"]').forEach(permissionCheckbox => {
                        permissionCheckbox.checked = categoryCheckbox.checked;
                    });
                }
            });
        });

        // Manejar la selección/deselección de permisos
        document.querySelectorAll('.sub-rol input[type="checkbox"]').forEach(permissionCheckbox => {
            permissionCheckbox.addEventListener('change', updateCategoryCheckboxes);
        });

        // Inicializar el estado de los checkboxes de categoría
        updateCategoryCheckboxes();
    });

