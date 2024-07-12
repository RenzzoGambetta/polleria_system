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



const selected = document.querySelector('.selected');
const options = document.querySelector('.options');
const optionList = document.querySelectorAll('.option');

selected.addEventListener('click', () => {
    options.classList.toggle('active');
});

optionList.forEach(option => {
    option.addEventListener('click', () => {
        selected.innerHTML = option.querySelector('span').innerText;
        options.classList.remove("active");
    });
});

document.addEventListener('click', (event) => {
    const isClickInside = selected.contains(event.target) || options.contains(event.target);
    if (!isClickInside) {
        options.classList.remove('active');
    }
});

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

const poscargo = document.querySelector('.poscargo');
const cargos = document.querySelector('.cargos');
const cargo = document.querySelectorAll('.cargo');

poscargo.addEventListener('click', () => {
    cargos.classList.toggle('active');
});

cargo.forEach(option => {
    option.addEventListener('click', () => {
        poscargo.innerHTML = option.querySelector('span').innerText;
        cargos.classList.remove("active");
    });
});

document.addEventListener('click', (event) => {
    const isClickInside = poscargo.contains(event.target) || cargos.contains(event.target);
    if (!isClickInside) {
        cargos.classList.remove('active');
    }
});



const car1 = document.querySelector('.select-box');
const car2 = document.querySelector('.dropdown');
const car3 = document.querySelectorAll('.optio');


car1.addEventListener('click', () => {
    car2.classList.toggle('active');
});

car3.forEach(option => {
    option.addEventListener('click', () => {
        car1.innerHTML = option.querySelector('span').innerText;
        car2.classList.remove("active");
    });
});

document.addEventListener('click', (event) => {
    const isClickInside = car1.contains(event.target) || car2.contains(event.target);
    if (!isClickInside) {
        car2.classList.remove('active');
    }
});

/*
document.addEventListener('DOMContentLoaded', function ()  {
    const form = document.getElementById('miFormulario');
    const lupa = document.getElementById('lupa');

    lupa.addEventListener('click', function () {
        const selectedDni = document.querySelector('input[name="dni"]:checked');
        const selectedRuc = document.querySelector('input[name="ruc"]:checked');
        const datoInput = document.querySelector('.effect-6');

        // Verifica si se seleccionó un tipo de documento
        if (selectedDni || selectedRuc) {
            // Agrega valores al formulario antes de enviarlo
            if (selectedDni) {
               const data='dni';
            } else {
                const data='ruc';
            }

            form.append('dato', datoInput.value);

            // Construye la URL con los datos del formulario
            const url = `/tu-nueva-ruta/?tipo_documento=${data}&dato=${form.get('dato')}`;

            // Redirige a la nueva página
            window.location.href = url;
        } else {
            alert('Selecciona un tipo de documento');
        }
    });
});
*/
document.addEventListener('DOMContentLoaded', function () {
    const busqueda = document.getElementById('busqueda');
    const radioDNI = document.getElementById('uiux');
    const radioRUC = document.getElementById('frontend');
    const datoInput = document.querySelector('.effect-6');
    var msRrDiv = document.querySelector('.ms_bx');
    busqueda.addEventListener('click', function () {
        // Verificar si se seleccionó un tipo de documento
        if (radioDNI.checked || radioRUC.checked) {
            // Obtener el valor del tipo de documento seleccionado
            const tipoDocumento = radioDNI.checked ? 'dni' : 'ruc';

            // Obtener el valor del input
            const dato = datoInput.value;

            // Construir la URL con los datos del formulario
            //const url = `/sunat-consulta-7b132a2c1f8f88f15191976b63c19753?td=${tipoDocumento}&dato=${dato}`;

            // Redirigir a la nueva página
            window.location.href = url;
        } else {

                        msRrDiv.classList.remove('hide-element', 'active');

                        // Set a timeout to reapply the classes after 20 seconds
                        setTimeout(function () {
                            msRrDiv.classList.add('hide-element', 'active');
                        }, 20000);
                        return false; // Prevent form submission

        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const msDtElement = document.querySelector('.ms_dt');

    // Check if msDtElement is not null before manipulating classList
    if (msDtElement) {
        // Esperar 20 segundos (20000 milisegundos) antes de agregar la clase hide-element
        setTimeout(function () {
            msDtElement.classList.add('active');
            msDtElement.classList.add('hide-element');
        }, 20000);

        // Simular un efecto de desvanecimiento después de 2 segundos
        setTimeout(function () {
            msDtElement.classList.add('active');
        }, 19500); // 2000 milisegundos = 2 segundos
    }
});



/*function saltarCampo(event, siguienteCampo) {
    if (event.key === 'Enter') {
        event.preventDefault();  // Evitar que el formulario se envíe al presionar "Enter"
        document.getElementById(siguienteCampo).focus();  // Activar el foco en el siguiente campo
    }
}*/
    function saltarCampo(event, siguienteCampo) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById(siguienteCampo).focus();
        }
    }

    document.getElementById('Nombre').addEventListener('keydown', function(event) {
        saltarCampo(event, 'fechaNacimiento');
    });

    document.getElementById('fechaNacimiento').addEventListener('keydown', function(event) {
        saltarCampo(event, 'Paterno');
    });

    document.getElementById('Paterno').addEventListener('keydown', function(event) {
        saltarCampo(event, 'Materno');
    });


    document.getElementById('Correo').addEventListener('keydown', function(event) {
        saltarCampo(event, 'Contraseña');
    });

    document.getElementById('Contraseña').addEventListener('keydown', function(event) {
        saltarCampo(event, 'C_Contraseña');
    });

    document.getElementById('Materno').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            formStepsNum++;
            updateFormSteps();
            updateProgressbar();
        }
    });
    document.getElementById('nacionalidad').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            formStepsNum++;
            updateFormSteps();
            updateProgressbar();
        }
    });
    document.getElementById('Direccion').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            formStepsNum++;
            updateFormSteps();
            updateProgressbar();
        }
    });
    document.getElementById('C_Contraseña').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            formStepsNum++;
            updateFormSteps();
            updateProgressbar();
        }
    });

    function validarFormulario(event) {
        var nombre = document.getElementById('Nombre').value;
        var fechaNacimiento = document.getElementById('fechaNacimiento').value;
        var paterno = document.getElementById('Paterno').value;
        var materno = document.getElementById('Materno').value;
        var nacionalidad = document.getElementById('nacionalidad').value;
        var telefono = document.getElementById('Telefono').value;
        var direccion = document.getElementById('Direccion').value;
        var correo = document.getElementById('Correo').value;

        // Reference to the div with class "ms_rr"
        var msRrDiv = document.querySelector('.ms_rr');

        // Validar si alguno de los campos es null o está vacío
        if (
            nombre.trim() === '' ||
            fechaNacimiento.trim() === '' ||
            paterno.trim() === '' ||
            materno.trim() === '' ||
            nacionalidad.trim() === '' ||
            telefono.trim() === '' ||
            direccion.trim() === '' ||
            correo.trim() === ''
        ) {
            // Remove the "hide-element" class from the "ms_rr" div
            msRrDiv.classList.remove('hide-element', 'active');

    // Set a timeout to reapply the classes after 20 seconds
    setTimeout(function () {
        msRrDiv.classList.add('hide-element', 'active');
    }, 20000);

            // Evitar que el formulario se envíe
            event.preventDefault();
        }
    }


    var contraseñaInput = document.getElementById('Contraseña');
    var confirmarContraseñaInput = document.getElementById('C_Contraseña');
    var mensajeContraseña = document.getElementById('mensaje-contraseña');
    var submitButton = document.getElementById('submitButton');

    function validarContraseñas() {
        var contraseña = contraseñaInput.value;
        var confirmarContraseña = confirmarContraseñaInput.value;

        if (contraseña === confirmarContraseña) {
            mensajeContraseña.textContent = 'Las contraseñas coinciden';
            mensajeContraseña.className = 'password-match';
            submitButton.type = 'submit';
        } else {
            mensajeContraseña.textContent = 'Las contraseñas no coinciden';
            mensajeContraseña.className = 'password-mismatch';
            submitButton.type = '#';
        }
    }

    // Event listener para validar las contraseñas en ambos sentidos
    contraseñaInput.addEventListener('input', validarContraseñas);
    confirmarContraseñaInput.addEventListener('input', validarContraseñas);
