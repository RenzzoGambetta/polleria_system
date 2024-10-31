class SearchBox {
    constructor(texttNull, classColorInput, inputSelector, labelSelector, suggestionsSelector, loaderSelector, idInputSelector, apiUrl, maxSuggestions, numberSpecialOperations) {
        this.inputElement = $(inputSelector);
        this.suggestionsElement = $(suggestionsSelector);
        this.loaderElement = $(loaderSelector);
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
    }

    init() {
        this.fetchAllItems();
        this.inputElement.on('input', () => this.onInput());
        this.inputElement.on('focus', () => this.onFocus());
        this.inputElement.on('blur', () => this.onBlur());
        this.inputElement.on('keydown', (e) => this.onKeyDown(e));
    }

    fetchAllItems() {
        this.loaderElement.show();
        this.inputElement.hide();
        this.labelElement.hide();
        fetch(this.apiUrl)
            .then(response => response.json())
            .then(data => {
                this.allItems = data;
                this.loaderElement.hide();
                this.inputElement.show();
                this.labelElement.show();
                //console.log(data);
            })
            .catch(error => {
                console.error('Error fetching all items:', error);
            });
    }

    filterSuggestions(query) {
        const filteredItems = this.allItems.filter(item =>
            item.name.toLowerCase().includes(query)
        );
        this.showSuggestions(filteredItems);


        const exactMatch = this.allItems.find(item => item.name.toLowerCase() === query);
        if (exactMatch) {
            this.idInputElement.val(exactMatch.id);
            this.specialOperatingCondition(exactMatch.id);
            this.removeErrorStyle();
        } else {
            this.idInputElement.val(null);
            this.applyErrorStyle();
            this.specialOperatingCondition(null);

        }
    }

    showSuggestions(items) {
        let suggestionsHtml = '';
        if (items.length === 0) {
            suggestionsHtml = `<div class="no-suggestions">${this.texttNull}</div>`;
            this.idInputElement.val(null);
            this.specialOperatingCondition(null);

        } else {
            items.slice(0, this.maxSuggestions).forEach((item, index) => {
                suggestionsHtml += `<div class="suggestion-item" data-id="${item.id}" data-index="${index}">${item.name}</div>`;
            });
        }
        this.suggestionsElement.html(suggestionsHtml).addClass('open');

        this.suggestionsElement.find('.suggestion-item').on('click', (e) => {
            this.onSuggestionClick(e);
        });

        this.suggestionsElement.find('.suggestion-item').on('mouseover', (e) => {
            this.onSuggestionMouseOver(e);
        });

        if (items.length > 0) {
            this.highlightedIndex = 0;
            this.highlightItem(this.suggestionsElement.find('.suggestion-item'));
        } else {
            this.highlightedIndex = -1;
        }
    }

    hideSuggestions() {
        this.suggestionsElement.removeClass('open');
        this.highlightedIndex = -1;
    }

    onInput() {
        const query = this.inputElement.val().toLowerCase();
        if (query.length > 0) {
            this.filterSuggestions(query);
        } else {
            this.showSuggestions(this.allItems.slice(0, this.maxSuggestions));
            this.idInputElement.val('');
            this.removeErrorStyle();
            this.specialOperatingCondition(null);

        }
    }

    onFocus() {
        if (this.inputElement.val().trim() === '') {
            this.showSuggestions(this.allItems.slice(0, this.maxSuggestions));
            this.removeErrorStyle();
        } else {
            this.showSuggestions(this.allItems.filter(item => item.name.toLowerCase().includes(this.inputElement.val().toLowerCase())));
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
        if (!this.idInputElement.val()) {
            this.searchBox.css('border', '2px solid #9d1616');
            this.labelElement.css('color', 'red');
        }
    }

    removeErrorStyle() {
        this.searchBox.css('border', '');
        this.labelElement.css('color', '');
    }

    specialOperatingCondition(data1){
        if(this.specialOperations == 1){
            if(data1 != null ){
                //console.log(data1)
                supplierConsultation(data1);
            }else{
                reverseToggleDisplay();
            }
        }

    }

}

