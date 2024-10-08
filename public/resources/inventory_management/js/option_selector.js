/*const selected = document.querySelector('.selected')
const options = document.querySelector('.options')
const optionList = document.querySelectorAll('.option')
const subTitleDiv = document.querySelector('.sub-title-div')

selected.addEventListener('click', () => {
    options.classList.toggle('active')
    selected.classList.toggle('focus-select')


    if (options.classList.contains('active')) {
        let currentPadding = parseInt(window.getComputedStyle(options).padding) || 0
        options.style.padding = `${currentPadding + 8}px`
    } else {
        let currentPadding = parseInt(window.getComputedStyle(options).padding) || 0
        options.style.padding = `${currentPadding - 8}px`
    }
})

optionList.forEach(option => {
    option.addEventListener('click', () => {

        if (option && option.querySelector('span')) {
            selected.innerHTML = option.querySelector('span').innerText;
        }
        options.classList.remove('active')
        selected.classList.remove('focus-select')
        selected.classList.add('default-iten-color')
        subTitleDiv.style.opacity = "1"
        let currentPadding = parseInt(window.getComputedStyle(options).padding) || 0
        options.style.padding = `${currentPadding - 8}px`

    })
})

document.addEventListener('click', (event) => {
    if (!selected.contains(event.target) && !options.contains(event.target)) {
        if (options.classList.contains('active')) {
            options.classList.remove('active')
            selected.classList.remove('focus-select')
            let currentPadding = parseInt(window.getComputedStyle(options).padding) || 0
            options.style.padding = `${currentPadding - 8}px`
        }
    }
})*/
function selectorIten(select, option, listOption) {

    const selected = document.querySelector(select);
    const optionsContainer = document.querySelector(option);


    selected.addEventListener('click', () => {
        optionsContainer.classList.toggle('active');
        selected.classList.toggle('focus-select');
    });


    optionsContainer.addEventListener('click', (event) => {
        const option = event.target.closest(listOption);

        if (option) {
            const optionText = option.querySelector('span').innerText;
            selected.innerHTML = optionText;
            optionsContainer.classList.remove('active');
            selected.classList.remove('focus-select');
            selected.classList.add('default-iten-color');
        }
    });


    document.addEventListener('click', (event) => {
        if (!selected.contains(event.target) && !optionsContainer.contains(event.target)) {
            if (optionsContainer.classList.contains('active')) {
                optionsContainer.classList.remove('active');
                selected.classList.remove('focus-select');
            }
        }
    });
}
function previewImage(event) {
    const file = event.target.files[0];
    const iconPreview = document.getElementById('icon-preview');
    const textPreview = document.getElementById('text-preview');
    const existingImg = document.getElementById('preview-image');

    if (existingImg) {
        const reader = new FileReader();
        reader.onload = function(e) {
            existingImg.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgPreview = document.createElement('img');
                imgPreview.src = e.target.result;
                imgPreview.id = 'preview-image';
                imgPreview.className = 'Img-style-preview';
                iconPreview.style.display = 'none';
                textPreview.style.display = 'none';
                iconPreview.parentNode.insertBefore(imgPreview, iconPreview);
            };
            reader.readAsDataURL(file);
        }
    }
}
