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
function cancelRole() {

    Swal.fire({
        title: "Estas seguro",
        text: 'Se olvidara toda la los camvios actuales',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, olvidar!",
        cancelButtonText: "Cancelar",
        didOpen: urlPostDeleteStyle
    }).then((result) => {
        if (result.isConfirmed) {
            window.history.back();
            return;
        }
    });
}
