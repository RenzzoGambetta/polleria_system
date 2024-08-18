const selected = document.querySelector('.selected')
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
        selected.innerHTML = option.querySelector('span').innerText
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
})
