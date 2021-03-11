class DataList {
    constructor(container, options) {
        this.container = $(container);
        this.input = $('input',this.container);
        this.list = $('<ul></ul>');
        this.container.append(this.list);
        this.options = options;
        this.threshold = 0;
        this.isCaseSensitive = false;
        this.selected = null;

        this.create();
        this.addListeners(this);
    }
    updateData(list){
        this.options = list;
        this.input.trigger('input');
    }

    create(filter = "") {
        let self = this;
        const filterOptions = this.options.filter(
            d => filter === "" || (
                (!self.isCaseSensitive && d.text.toLowerCase().includes(filter.toLowerCase())) ||
                (self.isCaseSensitive && d.text.includes(filter))
            )
        );

        if (filterOptions.length === 0) {
            this.list.removeClass("active");
        } else {
            this.list.addClass("active");
        }

        this.list.html(filterOptions
            .map(o => `<li id=${o.value}>${o.text}</li>`)
            .join(""));
    }

    addListeners(datalist) {
        const container = this.container;
        const input = this.input;
        const list = this.list;
        container.click((e)=> {
            if (e.target.id === this.inputId) {
                container.toggleClass("active");
            } else if (e.target.id === "datalist-icon") {
                container.toggleClass("active");
                input.focus();
            }
        });

        let self = this;
        input.on("input", function(e) {
            self.selected = null;
            let v = input.val();
            if (v.length >= self.threshold) {
                if (!container.hasClass("active")) {
                    container.addClass("active");
                    if (self.onShow)
                        self.onShow();
                }
                datalist.create(input.val());
            }else{
                container.removeClass('active');
            }
        });

        list.click(function(e) {
            if (e.target.nodeName.toLocaleLowerCase() === "li") {
                input.val(e.target.innerText);
                self.selected = {id:e.target.id,text:e.target.innerText};
                container.removeClass("active");
            }
        });
    }
}