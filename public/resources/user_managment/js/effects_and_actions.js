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


const posgenero = document.querySelector('.posgenero');
const generos = document.querySelector('.generos');
const genero = document.querySelectorAll('.genero');

posgenero.addEventListener('click', () => {
    generos.classList.toggle('active');
});

genero.forEach(option => {
    option.addEventListener('click', () => {
        posgenero.innerHTML = option.querySelector('span').innerText;
        generos.classList.remove("active");
    });
});

document.addEventListener('click', (event) => {
    const isClickInside = posgenero.contains(event.target) || generos.contains(event.target);
    if (!isClickInside) {
        generos.classList.remove('active');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const msDtElement = document.querySelector('.ms_dt');

    if (msDtElement) {
        setTimeout(function () {
            msDtElement.classList.add('active');
            msDtElement.classList.add('hide-element');
        }, 20000);
        setTimeout(function () {
            msDtElement.classList.add('active');
        }, 19500);
    }
});

function skip_field(event, siguienteCampo) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById(siguienteCampo).focus();
    }
}

document.getElementById('name_input').addEventListener('keydown', function (event) {
    skip_field(event, 'frame_dni_input');
});

document.getElementById('frame_dni_input').addEventListener('keydown', function (event) {
    skip_field(event, 'paternal_surname_input');
});

document.getElementById('paternal_surname_input').addEventListener('keydown', function (event) {
    skip_field(event, 'maternal_surname_input');
});

document.getElementById('maternal_surname_input').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
        skip_field(event, 'fechaNacimiento');
    }
});

document.getElementById('fechaNacimiento').addEventListener('keydown', function (event) {
    skip_field(event, 'nacionalidad');
});

document.getElementById('nacionalidad').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        formStepsNum++;
        updateFormSteps();
        updateProgressbar();
        skip_field(event, 'Telefono');
    }
});

document.getElementById('Telefono').addEventListener('keydown', function (event) {
    skip_field(event, 'Correo');
});

document.getElementById('Correo').addEventListener('keydown', function (event) {
    skip_field(event, 'Direccion');
});


function validarFormulario(event) {
    var nombre = document.getElementById('name_input').value;
    var paterno = document.getElementById('paternal_surname_input').value;
    var materno = document.getElementById('maternal_surname_input').value;
    var dni = document.getElementById('frame_dni_input').value;
    var msRrDiv = document.querySelector('.ms_rr');
    if (
        nombre.trim() === '' ||
        paterno.trim() === '' ||
        materno.trim() === '' ||
        dni.trim() === ''
    ) {
        msRrDiv.classList.remove('hide-element', 'active');
        setTimeout(function () {
            msRrDiv.classList.add('hide-element', 'active');
        }, 20000);
        event.preventDefault();
    }
}


