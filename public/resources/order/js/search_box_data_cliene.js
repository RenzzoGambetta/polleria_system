class SearchBoxClient {
    constructor(texttNull, classColorInput, inputSelector, labelSelector, suggestionsSelector, idInputSelector, apiUrl, maxSuggestions, numberSpecialOperations) {
        this.inputElement = $(inputSelector);
        this.suggestionsElement = $(suggestionsSelector);
        this.idInputElement = $(idInputSelector);
        this.apiUrl = apiUrl;
        this.maxSuggestions = maxSuggestions;
        this.allItems = [];
        this.highlightedIndex = -1;
        this.labelElement = $(labelSelector);
        this.searchBox = this.inputElement.closest(classColorInput);
        this.texttNull = texttNull;
        this.init();
        this.specialOperations = numberSpecialOperations;
        this.timeout = null;
        this.statusDivOpen = 0;
        this.typeFacture = 'nota';
    }

    init() {
        this.inputElement.on('input', () => this.onInput());
        this.inputElement.on('focus', () => this.onFocus());
        this.inputElement.on('blur', () => this.onBlur());
        this.inputElement.on('keydown', (e) => this.onKeyDown(e));
    }

    setStatusDivOpen(value) {
        this.statusDivOpen = value;
    }
    setValueTypeFacture(value) {
        this.typeFacture = value;
    }
    fetchSuggestions(query, offset = 0) {
        // Generar un ID único para la solicitud actual
        const requestId = Date.now();

        // Mostrar el cargador mientras se hace la petición
        const loaderHTML = `
           <div id="loader-client" class="loader-section">
               <div class="loading">
                   <span></span>
                   <span></span>
                   <span></span>
                   <span></span>
                   <span></span>
               </div>
           </div>
       `;
        this.suggestionsElement.html(loaderHTML).addClass('loading');

        fetch(`${this.apiUrl}?query=${query}&offset=${offset}&limit=${this.maxSuggestions}&type=${this.typeFacture}`)
            .then(response => response.json())
            .then(data => {
                // Verificar si esta respuesta es la más reciente
                if (requestId !== this.currentRequestId) {
                    // Si no es la solicitud más reciente, ignorarla
                    return;
                }

                this.suggestionsElement.removeClass('loading');
                this.allItems = data.items || [];
                this.showSuggestions(this.allItems, query);
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                this.suggestionsElement.removeClass('loading');
            });

        // Actualizar el ID de la solicitud actual
        this.currentRequestId = requestId;
        //console.log(requestId);
        //console.log(query);
    }

    filterSuggestions(query) {
        const exactMatch = this.allItems.find(item => item.name.toLowerCase() === query.toLowerCase());
        if (exactMatch) {
            this.showSuggestions([exactMatch]);
            this.idInputElement.val(exactMatch.id);
            this.removeErrorStyle();
        } else {
            if (query.length > 0) {
                this.fetchSuggestions(query);
            } else {
                this.showSuggestions([]);
                this.idInputElement.val('');
                this.removeErrorStyle();
                this.specialOperatingCondition(null);
            }
        }
    }

    showSuggestions(items, query = null) {
        let suggestionsHtml = '';
        if (items.length === 0) { //aca se maneja el error
            if (/^\d+$/.test(query)) {
                const longitud = query.length;
                if (longitud == 8 && this.typeFacture != 'factura') {
                    suggestionsHtml = `<div class="no-suggestions">
                                            <button class="new-client-register-expres-button register-dni" onclick="registerExpresDataCliet('dni',${query})">
                                                <i class="fi fi-ss-registration-paper center-icon"></i> Registrar rapido el Dni: ${query}
                                            </button>
                                        </div>`;
                } else if (longitud == 11) {
                    suggestionsHtml = `<div class="no-suggestions">
                                            <button class="new-client-register-expres-button register-ruc" onclick="registerExpresDataCliet('ruc',${query})">
                                                <i class="fi fi-ss-registration-paper center-icon"></i> Registrar rapido el Ruc: ${query}
                                            </button>
                                        </div>`;
                } else {
                    let textDiv = 'No se pudo registrar este numero:';
                    if(this.typeFacture == 'factura')textDiv = 'No se encontrar este nuemro como ruc:';
                    suggestionsHtml = `<div class="no-suggestions">${textDiv} ${query}</div>`;
                }
            } else {
                suggestionsHtml = `<div class="no-suggestions">${this.texttNull}</div>`;
            }
            this.idInputElement.val(null);
            this.specialOperatingCondition(null);
        } else {
            items.forEach((item, index) => {
                suggestionsHtml += `<div class="suggestion-item" data-id="${item.id}" data-index="${index}">${item.name}</div>`;
            });
        }
        if (this.statusDivOpen == 1) this.suggestionsElement.html(suggestionsHtml).addClass('open');

        this.suggestionsElement.find('.suggestion-item').on('click', (e) => {
            this.onSuggestionClick(e);
        });

        this.suggestionsElement.find('.suggestion-item').on('mouseover', (e) => {
            this.onSuggestionMouseOver(e);
        });
    }

    hideSuggestions() {
        this.suggestionsElement.removeClass('open');
        this.highlightedIndex = -1;
    }

    onInput() {
        const query = this.inputElement.val().toLowerCase();
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
            this.filterSuggestions(query);
        }, 500);
    }

    onFocus() {
        if (this.inputElement.val().trim() === '') {
            this.showSuggestions([]);
        } else {
            this.filterSuggestions(this.inputElement.val().toLowerCase());
        }
    }

    onBlur() {
        setTimeout(() => {
            this.hideSuggestions();
            if (!this.idInputElement.val()) {
                this.applyErrorStyle();
            }
            if (this.inputElement.val().trim() === '') {
                this.removeErrorStyle();
            }
        }, 100);
    }

    onSuggestionClick(e) {
        const selectedText = $(e.currentTarget).text();
        const selectedId = $(e.currentTarget).data('id');
        this.inputElement.val(selectedText);
        this.idInputElement.val(selectedId);
        this.specialOperatingCondition(selectedId);
        this.hideSuggestions();
        this.removeErrorStyle();
    }

    onSuggestionMouseOver(e) {
        const items = this.suggestionsElement.find('.suggestion-item');
        this.highlightedIndex = $(e.currentTarget).data('index');
        this.highlightItem(items);
    }

    onKeyDown(e) {
        const items = this.suggestionsElement.find('.suggestion-item');
        if (e.key === 'ArrowDown') {
            this.highlightedIndex = (this.highlightedIndex + 1) % items.length;
            this.highlightItem(items);
            e.preventDefault();
        } else if (e.key === 'ArrowUp') {
            this.highlightedIndex = (this.highlightedIndex - 1 + items.length) % items.length;
            this.highlightItem(items);
            e.preventDefault();
        } else if (e.key === 'Enter') {
            if (this.highlightedIndex > -1) {
                this.inputElement.val(items.eq(this.highlightedIndex).text());
                this.idInputElement.val(items.eq(this.highlightedIndex).data('id'));
                this.specialOperatingCondition(items.eq(this.highlightedIndex).data('id'));
                this.hideSuggestions();
                this.removeErrorStyle();
            } else {
                const exactMatch = this.allItems.find(item => item.name.toLowerCase() === this.inputElement.val().toLowerCase());
                if (exactMatch) {
                    this.inputElement.val(exactMatch.name);
                    this.idInputElement.val(exactMatch.id);
                    this.specialOperatingCondition(exactMatch.id);
                    this.removeErrorStyle();
                } else {
                    this.applyErrorStyle();
                }
            }
        }
    }

    highlightItem(items) {
        items.removeClass('highlighted');
        if (this.highlightedIndex > -1) {
            items.eq(this.highlightedIndex).addClass('highlighted');
        }
    }

    applyErrorStyle() {
        if(this.typeFacture != "nota"){
            if (!this.idInputElement.val()) {
                this.searchBox.css('border', '2px solid #9d1616');
                this.labelElement.css('color', 'red');
            }
        }else{
            if (!this.idInputElement.val()) {
                this.searchBox.css('border', '2px solid green');
                this.labelElement.css('color', 'green');
            }
        }
    }

    removeErrorStyle() {
        this.searchBox.css('border', '');
        this.labelElement.css('color', '');
    }

    specialOperatingCondition(data1) {
        if (this.specialOperations == 1) {
            if (data1 != null) {
                // Ejecutar acción especial con el ID del cliente
                supplierConsultation(data1);
            } else {
                reverseToggleDisplay();
            }
        }
    }

}
async function registerExpresDataCliet(type, numberDocument) {
    const data = await consultDataPost("/register_express_data_client", { 'type': type, 'document': numberDocument });;

    if (data.status) {
        if (data.response) {
            await autoCompletionDataInputField(data.id, data.name_compact);
            console.log
        } else {
            await newRegisterClientData({ document: numberDocument, message: data.message });
        }
        //console.log(data);

    } else {
        showAlert(Data.message, 10);
    }
}