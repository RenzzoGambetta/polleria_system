
document.addEventListener('DOMContentLoaded', function () {
    const busqueda = document.getElementById('busqueda');
    const dniInput = document.getElementById('frame_dni_input');
    const msRrDiv = document.querySelector('.ms_bx');
    const msTxt = msRrDiv.querySelector('.ms_txt');
    const nameInput = document.getElementById('name_input');
    const paternalSurnameInput = document.getElementById('paternal_surname_input');
    const maternalSurnameInput = document.getElementById('maternal_surname_input');

    busqueda.addEventListener('click', function () {

        const dato = dniInput.value;

        if (dato.trim() === '') {

            msTxt.textContent = `Inserte el DNI para buscar`;

            msRrDiv.classList.remove('hide-element', 'active');

            setTimeout(function () {
                msRrDiv.classList.add('hide-element', 'active');
            }, 20000);

            return false;
        } else {
            const url = `/fetch_person_data?dni=${dato}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {

                    if (data.error) {

                        msTxt.textContent = data.error;

                        nameInput.value = '';
                        paternalSurnameInput.value = '';
                        maternalSurnameInput.value = '';

                        msRrDiv.classList.remove('hide-element', 'active');
                        setTimeout(function () {
                            msRrDiv.classList.add('hide-element', 'active');
                        }, 20000);

                    } else {

                        const personData = data.data || {};
                        const name = personData.name || '';
                        const paternalSurname = personData.paternal_surname || '';
                        const maternalSurname = personData.maternal_surname || '';
                        const dni = personData.dni || '';

                        nameInput.value = name;
                        paternalSurnameInput.value = paternalSurname;
                        maternalSurnameInput.value = maternalSurname;
                        dniInput.value = dni;

                        setTimeout(function () {
                            msRrDiv.classList.add('hide-element', 'active');
                        }, 10);
                    }

                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }
    });
});

