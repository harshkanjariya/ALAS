class Dialog{
    static alert(e){
        if (e===undefined)
            throw new Error("undefined parameter!");
        const element = $(`
<div class="adas-error-dialog">
    <div>
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>
        <span class="adas-dialog-message">hello</span>
        <button class="ok-button" onclick="$('.adas-error-dialog').hide()">Ok, got it!</button>
    </div>
</div>
        `);
        var parent = document.body;
        if (e.parent)
            parent = e.parent;
        if($(parent).find('.adas-error-dialog').length!==0){
            $(parent).find('.adas-error-dialog').remove();
        }
        $(parent).append(element);
        if (e.message){
            $(element).find('span').text(e.message);
        }
        $(element).find('button').focus();
    }
}