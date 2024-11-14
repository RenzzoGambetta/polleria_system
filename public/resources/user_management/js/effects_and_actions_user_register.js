const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;

nextBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
    });
});

prevBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        formStepsNum--;
        updateFormSteps();
        updateProgressbar();
    });
});

function updateFormSteps() {
    formSteps.forEach((formStep) => {
        formStep.classList.contains("form-step-active") &&
            formStep.classList.remove("form-step-active");
    });

    formSteps[formStepsNum].classList.add("form-step-active");
}

function updateProgressbar() {
    progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
            progressStep.classList.add("progress-step-active");
        } else {
            progressStep.classList.remove("progress-step-active");
        }
    });

    const progressActive = document.querySelectorAll(".progress-step-active");

    progress.style.width =
        ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

function setupDropdown(toggleSelector, optionsSelector, itemSelector) {
    const toggle = document.querySelector(toggleSelector);
    const options = document.querySelector(optionsSelector);
    const items = document.querySelectorAll(itemSelector);

    toggle.addEventListener('click', () => {
        options.classList.toggle('active');
    });

    items.forEach(option => {
        option.addEventListener('click', () => {
            toggle.innerHTML = option.querySelector('span').innerText;
            options.classList.remove('active');
        });
    });

    document.addEventListener('click', (event) => {
        if (!toggle.contains(event.target) && !options.contains(event.target)) {
            options.classList.remove('active');
        }
    });
}

setupDropdown('.posemployer', '.employers', '.employer');
setupDropdown('.posrole', '.roles', '.role');

function skip_field(event, siguienteCampo) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById(siguienteCampo).focus();
    }
}

document.getElementById('user_name').addEventListener('keydown', function (event) {
    skip_field(event, 'password_primary');
});

document.getElementById('password_primary').addEventListener('keydown', function (event) {
    skip_field(event, 'password_repeat');
});


document.addEventListener('DOMContentLoaded', function () {
    const fields = [
        { labelId: 'user_name', inputId: 'user_name' },
        { labelId: 'password_primary', inputId: 'password_primary' },
        { labelId: 'password_repeat', inputId: 'password_repeat' },
    ];

    fields.forEach(function (field) {
        const label = document.querySelector(`label[for="${field.labelId}"]`);
        const input = document.getElementById(field.inputId);

        if (label && input) {
            label.addEventListener('click', function () {
                input.focus();
            });
        }
    });
});


function validarFormulario(event) {
    var user_name = document.getElementById('user_name').value.trim();
    var password_primary = document.getElementById('password_primary').value.trim();
    var password_repeat = document.getElementById('password_repeat').value.trim();

    const msRrDiv = document.querySelector('.ms_bx');
    const msTxt = msRrDiv.querySelector('.ms_txt');

    msRrDiv.classList.add('hide-element');

    if (user_name === '' || password_primary === '' || password_repeat === '') {
        mostrarError(msTxt, msRrDiv, 'Todos los campos son obligatorios.');
        event.preventDefault();
        return;
    }

    if (password_primary.length < 8) {
        mostrarError(msTxt, msRrDiv, 'La contraseña debe tener al menos 8 caracteres.');
        event.preventDefault();
        return;
    }
    if (password_primary !== password_repeat) {
        mostrarError(msTxt, msRrDiv, 'Las contraseñas no coinciden.');
        event.preventDefault();
        return;
    }

    if (!validarSeleccion(msTxt, msRrDiv, 'employee_id', 'Debes seleccionar un empleado.') ||
        !validarSeleccion(msTxt, msRrDiv, 'role_id', 'Debes seleccionar un rol.')) {
        activarRetroceso();
        event.preventDefault(); return;
    }
}

function validarSeleccion(text, element, name, mensajeError) {
    var seleccionado = document.querySelector(`input[name="${name}"]:checked`);
    if (!seleccionado) {
        mostrarError(text, element, mensajeError);
        return false;
    }
    return true;

}

function mostrarError(text, element, message) {
    text.textContent = message;
    element.classList.remove('hide-element', 'active');
    setTimeout(function () {
        element.classList.add('hide-element', 'active');
    }, 20000);
}
function activarRetroceso() {
    prevBtns.forEach((btn) => {
        formStepsNum--;
        updateFormSteps();
        updateProgressbar();
    });
}
