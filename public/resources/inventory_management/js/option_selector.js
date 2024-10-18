function selectorItenandAnimation(selectedClass, optionsClass, optionClass, subTitleDivClass) {
    const $selected = $(`.${selectedClass}`);
    const $options = $(`.${optionsClass}`);
    const $optionList = $(`.${optionClass}`);
    const $subTitleDiv = $(`.${subTitleDivClass}`);
    let currentIndex = -1;

    $selected.on('click', function () {
        $options.toggleClass('active');
        $selected.toggleClass('focus-select');

        let currentPadding = parseInt($options.css('padding')) || 0;
        if ($options.hasClass('active')) {
            $options.css('padding', `${currentPadding + 8}px`);
        } else {
            $options.css('padding', `${currentPadding - 8}px`);
        }
    });

    $optionList.on('click', function () {
        selectOption($(this));
    });

    $(document).on('click', function (event) {
        if (!$selected.is(event.target) && !$options.is(event.target) && !$options.has(event.target).length) {
            if ($options.hasClass('active')) {
                $options.removeClass('active');
                $selected.removeClass('focus-select');

                let currentPadding = parseInt($options.css('padding')) || 0;
                $options.css('padding', `${currentPadding - 8}px`);
            }
        }
    });

    $(document).on('keydown', function (event) {
        if ($options.hasClass('active')) {
            const $visibleOptions = $optionList.filter(':visible');

            if (event.key === 'ArrowDown') {
                event.preventDefault();
                currentIndex = (currentIndex + 1) % $visibleOptions.length;
                highlightOption($visibleOptions.eq(currentIndex));
                scrollIntoView($visibleOptions.eq(currentIndex));
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                currentIndex = (currentIndex - 1 + $visibleOptions.length) % $visibleOptions.length;
                highlightOption($visibleOptions.eq(currentIndex));
                scrollIntoView($visibleOptions.eq(currentIndex));
            } else if (event.key === 'Enter') {
                event.preventDefault();
                if (currentIndex >= 0 && currentIndex < $visibleOptions.length) {
                    selectOption($visibleOptions.eq(currentIndex));
                }
            } else if (event.key === 'Escape') {
                $options.removeClass('active');
                $selected.removeClass('focus-select');
            }
        }
    });

    function scrollIntoView($option) {
        const containerTop = $options.scrollTop();
        const containerBottom = containerTop + $options.height();
        const optionTop = $option.position().top + containerTop;
        const optionBottom = optionTop + $option.outerHeight();

        if (optionBottom > containerBottom) {
            $options.scrollTop(containerTop + (optionBottom - containerBottom));
        } else if (optionTop < containerTop) {
            $options.scrollTop(containerTop - (containerTop - optionTop));
        }
    }

    function highlightOption($option) {
        $optionList.removeClass('highlight');
        $option.addClass('highlight');
    }

    function selectOption($option) {
        let $span = $option.find('span');
        if ($span.length) {
            $selected.html($span.text());
        }
        $options.removeClass('active');
        $selected.removeClass('focus-select').addClass('default-iten-color');
        $subTitleDiv.css('opacity', '1');

        let currentPadding = parseInt($options.css('padding')) || 0;
        $options.css('padding', `${currentPadding - 8}px`);
    }

    $optionList.on('mouseenter', function () {
        highlightOption($(this));
        currentIndex = $optionList.index($(this));
    });

    $optionList.on('mouseleave', function () {
        $(this).removeClass('highlight');
    });
}

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
