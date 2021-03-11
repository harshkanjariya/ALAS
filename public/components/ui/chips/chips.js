class Chips{
    constructor(e){
        if (e===undefined){
            throw new Error('Chips object require html element');
        }
        this.element = $($(e)[0]);
    }
    current(){
        return this.element.find('.chips.active')[0];
    }
    addChip(id,text){
        let div = $('<div class="chips" chip-id="'+id+'">'+text+'</div>');
        let self = this;
        div.click(function(){
            self.makeActive(this,self);
        });
        if (this.element.children().length===0){
            div.addClass('active');
            if (self.onChange!==undefined){
                self.onChange(div,$(div).attr('chip-id'));
            }
        }
        this.element.append(div);
    }
    addAllChips(obj){
        let s = '';
        for (var i=0;i<obj.length; i++){
            s += '<div class="chips'+(i===0?' active':'')+'" chip-id="'+obj[i].id+'">'+obj[i].text+'</div>';
        }
        this.element.html(s);
        let chips = this.element.find('.chips');
        if (this.onChange!==undefined && chips.length>0){
            let div = chips[0];
            this.onChange(div,$(div).attr('chip-id'));
        }
        let self = this;
        chips.click(function(e){
            self.makeActive(this,self);
        });
    }
    makeActive(chip,self){
        self.element.find('.chips').removeClass('active');
        $(chip).addClass('active');
        if (self.onChange!==undefined){
            self.onChange(chip,$(chip).attr('chip-id'));
        }
    }
    removeChip(id){
        this.element.remove('[chip-id='+id+']');
    }
    clearChips(){
        this.element.html('');
    }
    changeChip(keyCode){
        let currentChip = null,lastChip;
        let chips = this.element.find('.chips');
        chips.each(function(i,e){
            if($(e).hasClass('active')){
                lastChip = i;
            }
        });
        switch(keyCode){
            case 39:
                currentChip = (lastChip+1) % chips.length;
                break;
            case 37:
                currentChip = lastChip===0 ? chips.length-1 : lastChip-1;
                break;
            case 40:
            case 38:
                let code = keyCode;
                let pos = this.element.find('.chips.active').position();
                let selected = 0, selectedPos = null;
                let maxTop = 0;
                let distance = this.distance;
                chips.each(function(i,e){maxTop = Math.max(maxTop,$(e).position().top);});
                chips.each(function(i,e){
                    if (i===lastChip)return;

                    let currentPos = $(e).position();

                    if (selectedPos == null) {
                        if((code===38 && (currentPos.top < pos.top || (currentPos.top===maxTop && pos.top===0))) ||
                            (code===40 && (currentPos.top > pos.top || (currentPos.top===0 && pos.top===maxTop)) )) {
                            selectedPos = currentPos;
                            selected = i;
                        }
                    }else{
                        if (distance(currentPos,pos)<distance(selectedPos,pos) &&
                            ((code===38 && (currentPos.top < pos.top || (currentPos.top===maxTop && pos.top===0))) ||
                                (code===40 && (currentPos.top > pos.top || (currentPos.top===0 && pos.top===maxTop))) )){
                            selectedPos = currentPos;
                            selected = i;
                        }
                    }
                });
                if (selectedPos!==null){
                    currentChip = selected;
                }
                break;
        }
        if (typeof currentChip==='number') {
            this.makeActive(chips[currentChip],this);
        }
    }
    distance(a,b) {
        let dx = a.left - b.left;
        let dy = a.top - b.top;
        return Math.sqrt(dx*dx + dy*dy);
    }
}