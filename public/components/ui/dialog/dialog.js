class Dialog{
    static alert(e){
        if (e===undefined)
            throw new Error("undefined parameter!");
        const element = $(`
<div class="alas-dialog">
    <div>
        <div class="alas-modal-icon alas-modal-error animate">
            <span class="alas-modal-x-mark">
                <span class="alas-modal-line alas-modal-left animateXLeft"></span>
                <span class="alas-modal-line alas-modal-right animateXRight"></span>
            </span>
            <div class="alas-modal-placeholder"></div>
            <div class="alas-modal-fix"></div>
        </div>
        <div class="alas-modal-icon alas-modal-warning scaleWarning">
            <span class="alas-modal-body pulseWarningIns"></span>
            <span class="alas-modal-dot pulseWarningIns"></span>
        </div>
        <div class="alas-modal-icon alas-modal-success animate">
            <span class="alas-modal-line alas-modal-tip animateSuccessTip"></span>
            <span class="alas-modal-line alas-modal-long animateSuccessLong"></span>
            <div class="alas-modal-placeholder"></div>
            <div class="alas-modal-fix"></div>
        </div>
        <span class="alas-dialog-message">Welcome!</span>
        <button class="ok-button" onclick="
                $('.alas-dialog > div').css('transform','scaleY(0)');
                setTimeout(function(){$('.alas-dialog').hide();},200);
         ">Ok, got it!</button>
    </div>
</div>
        `);
        var parent = document.body;
        if (e.parent)
            parent = e.parent;
        if($(parent).find('.alas-dialog').length!==0){
            $(parent).find('.alas-dialog').remove();
        }
        $(parent).append(element);
        if (e.message){
            $(element).find('.alas-dialog-message').text(e.message);
        }
        $(element).find('.alas-modal-icon').hide();
        if (e.type!==undefined){
            if(typeof e.type == 'number'){
                switch (e.type){
                    case 0:e.type='warning';
                        break;
                    case -1:e.type='error';
                        break;
                    default:e.type='success';
                        break;
                }
            }
            $(element).find('.alas-modal-'+e.type).show();
        }
        if (e.buttonText){
            $(element).find('.ok-button').text(e.buttonText);
        }
        if (e.buttonClick){
            $(element).find('.ok-button').click(e.buttonClick);
        }
        $(element).find('.ok-button').focus();
    }
}