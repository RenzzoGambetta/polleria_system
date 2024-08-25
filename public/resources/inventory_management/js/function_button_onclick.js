function cancelPage() {
    window.history.back();
}
function clearInput() {
    document.getElementById('data-input').value = null;
    document.getElementById('comment-input').value = null;
    document.getElementById('issue-date-input').value = new Date().toISOString().slice(0, 10);
    revertSelectionChanges();


}
async function addItems() {

    const htmlContent = await loadHtmlFromFile('/resources/inventory_management/template/template_alert_input_inventary.html');


    Swal.fire({
        title: '<h1 class="title">Nuevo producto</h1>' ,
        html: htmlContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i class='bx bxs-face-mask' id="alert_btn"> <span> Mas info!</span></i> `,
        cancelButtonText: `<i id="alert_btn"><span>Cancel</span></i>`,
        cancelButtonAriaLabel: "Thumbs down",
    })
    revertStyleDefaultAlert()
}



function revertStyleDefaultAlert() {
    const bodyElement = document.querySelector('body.dark.swal2-shown.swal2-height-auto');
    if (bodyElement) {
        bodyElement.style.paddingRight = '';
    }
}
function revertSelectionChanges() {
    const selected = document.querySelector('.selected');
    const options = document.querySelector('.options');
    const subTitleDiv = document.querySelector('.sub-title-div');
    const optionList = document.querySelectorAll('.option');

    selected.classList.remove('focus-select', 'default-iten-color');
    if (options.classList.contains('active')) {
        options.classList.remove('active');
        let currentPadding = parseInt(window.getComputedStyle(options).padding) || 0;
        options.style.padding = `${currentPadding - 8}px`;
    }
    subTitleDiv.style.opacity = "0";
    selected.innerHTML = 'Seleccionar un provedor';
}

async function loadHtmlFromFile(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Error al cargar el archivo HTML');
        }
        return await response.text();
    } catch (error) {
        console.error(error);
        return '';
    }
}
