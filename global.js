var today=new Date();
//27-Nov-2020 ->dd-MMM-yyyy
//27-November-20 ->dd-MMMM-yy
//04-07-20 ->dd-MM-yy
//4-7-20 ->d-M-yy
//04-07-20 07:53:23  ->dd-MM-yy hh:mm:ss
//04-07-20 14:53:23 pm  ->dd-MM-yy HH:mm:ss a
//04-07-20 07:53:23 am Monday ->dd-MM-yy hh:mm:ss a w
function dateFormat(f,d){
	var weeks=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

	var year=d.getFullYear();
	f=f.replace(/yyyy/g,year);
	f=f.replace(/yy/g,year%100);

	var date=d.getDate();
	if(date<10)date='0'+date;
	f=f.replace(/dd/g,date);
	f=f.replace(/d/g,d.getDate());

	var hours=d.getHours();
	hours=(hours>12?hours-12:hours);
	if(hours<10)hours='0'+hours;
	f=f.replace(/hh/g,hours);

	var hours24=d.getHours();
	if(hours24<10)hours24='0'+hours24;
	f=f.replace(/HH/g,hours24);

	var minute=d.getMinutes();
	if(minute<10)minute='0'+minute;
	f=f.replace(/mm/g,minute);
	f=f.replace(/m/g,d.getMinutes());

	var seconds=d.getSeconds();
	if(seconds<10)seconds='0'+seconds;
	f=f.replace(/ss/g,seconds);

	var ampm=(d.getHours()>11?'pm':'am');
	f=f.replace(/a/g,ampm);

	f=f.replace(/w/g,weeks[d.getDay()]);

	var monthNames=["January","February","March","April","May","June","July","August","September","October","November","December"];
	f=f.replace(/MMMM/g,monthNames[d.getMonth()]);
	f=f.replace(/MMM/g,monthNames[d.getMonth()].substr(0,3));
	var month=d.getMonth()+1;
	if(month<10)month='0'+month;
	f=f.replace(/MM/g,month);
	f=f.replace(/\bM\b/g,d.getMonth()+1);

	return f;
}
function deleteCookie(name,path){
	var cukis=document.cookie.split(';');
	for(var i=0;i<cukis.length;i++){
		var cuki=cukis[i].split('=');
		if(cuki[0]===name){
			document.cookie=name+'=;expires='+new Date(1)+';path='+path;
		}
	}
}
function validate(count){
	var done=true;
	var group=$('input.form-control-'+count+':visible,textarea.form-control-'+count+':visible,select.form-control-'+count+':visible',form);
	for(var i=0;i<group.length;i++){

		if(group[i].nodeName==='INPUT'){
			if(group[i].value===''){
				$(group[i]).addClass('is-invalid');
				error_show(0,"please enter "+group[i].name);
				group[i].focus();
				done=false;
			}
			else{
				$(group[i]).removeClass('is-invalid');
				$(group[i]).addClass('is-valid');
			}
			if(group[i].size === 20){
				group[i].size=50;
			}
			if(group[i].value.length>group[i].size){
				$(group[i]).addClass('is-invalid');
				//console.log('Maximum '+group[i].size+' characters allowed');
				error_show(0,"max size for "+group[i].name+" is :"+group[i].size);
				group[i].focus();
				done=false;
			}
			if(group[i].type==='password'){
				if(group[i].value.trim()===''){
					error_show(0,'Please enter password');
					$(group[i]).addClass('is-invalid');
					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}
			if(group[i].name==='name' ) {
				if(group[i].value.trim()===''){
					error_show(0,'Please enter name');
					$(group[i]).addClass('is-invalid');
					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}
			else if(group[i].type==='email'){
				if(!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(group[i].value)){
					error_show(0,'Please enter valid email');
					$(group[i]).addClass('is-invalid');
					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}else if(group[i].type==='radio'){
				if(form[group[i].name].value===''){
					$(group[i]).addClass('is-invalid');
					error_show(0,'Please Select '+group[i].placeholder);
					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}
			else if(group[i].name==='phone'
					|| group[i].name==='mobile'
					|| group[i].name=== 'company_phone'){
				if(!/(^\+?[1-9][0-9]{8,15})/.test(group[i].value) && group[i].value.length<15){
					$(group[i]).addClass('is-invalid');
					error_show(0,'Please enter valid phone number');
					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}else if(group[i].name=='company_website'){
				if(!/(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi.test(group[i].value)){
					$(group[i]).addClass('is-invalid');
					error_show(0,'Please enter valid company website');

					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}else if(group[i].name=='id'){
                var value = $(group[i]).data('work');
			    if(value=='id'){
    				if((!/(^[a-z0-9][a-z0-9\-]+[a-z0-9]$)/.test(group[i].value))){
    				    $(group[i]).addClass('is-invalid');
    					group[i].focus();
        				error_show(0,'Company URL is not valid format. URL must be greater than 2 character');
                        done=false;
    				}
    				else if(group[i].length < 2 || group[i].length > 20){
        				$(group[i]).addClass('is-invalid');
    					group[i].focus();	
        				error_show(0,'Company URL is must be greater than 2 and less than 20 character');
    				    done=false;
    				}else{
    					$(group[i]).removeClass('is-invalid');
    					$(group[i]).addClass('is-valid');
    				}
			    }
			}else if(group[i].type=='checkbox'){
				var val=[];
				$('input[name='+group[i].name+']').each(function(){
					if(this.checked)
						val.push(this.value);
				});
				if(val.length==0){
					$(group[i]).addClass('is-invalid');
					error_show(0,'Please select '+group[i].placeholder);
					group[i].focus();
					done=false;
				}else{
					$(group[i]).removeClass('is-invalid');
					$(group[i]).addClass('is-valid');
				}
			}
		}
		else if(group[i].nodeName=='TEXTAREA'){
			if(group[i].value==''){ 
				$(group[i]).addClass('is-invalid');
				error_show(0,"please enter "+group[i].name);
				group[i].focus();
				done=false;
			}
			else{
				$(group[i]).removeClass('is-invalid');
				$(group[i]).addClass('is-valid');
			}
		}
		else{
			if(group[i].value=='' || /\bselect\b/i.test(group[i].value)){
				$(group[i]).addClass('is-invalid');
				error_show(0,'Please Select '+group[i].value.replace(/\bselect\b\s*/i,''));
				group[i].focus();
				done=false;
			}else{
				$(group[i]).removeClass('is-invalid');
				$(group[i]).addClass('is-valid');
			}
		}
	}
	return done;
}
$('.today').html(dateFormat('w,MMM d,yyyy',new Date()));

function btnOn(){
	$('#btn-send > span').css('display','none');
	$('#btn-send').prop('disabled',false);
}
function btnOff(){
	$('#btn-send').prop('disabled',true);
	$('#btn-send > span').css('display','inline-block');
}
function tableResponsive(){
	if(window.innerWidth<1470){
		$('table').addClass('table-responsive');
	}else
		$('table').removeClass('table-responsive');
}tableResponsive();
$(window).resize(function(){
	tableResponsive();
});
$('.password-eye').click(function(){
	if($('input',this.parentElement)[0].type=='text'){

		$('input',this.parentElement)[0].type='password';
	}
	else{

		$('input',this.parentElement)[0].type='text';
	}
	$(this).toggleClass('fa-eye');
	$(this).toggleClass('fa-eye-slash');
});

/*pagination*/
$('.small-card').click(function(){
	var id=$(this).html().replace(/(\s|\&nbsp;)+/g,"");
	$('.small-card').removeClass('active-card');
	$(this).addClass('active-card');
	
	$('.dis-here').removeClass('dis-here-active');
	$('#'+id).addClass('dis-here-active');
});


/*random string*/
function random_string(n,s='aA1'){
	var a='';
	if(s.indexOf('a')!==-1){
		a+='abcdefghijklmnopqrstuvwxyz';
	}
	if(s.indexOf('A')!==-1){
		a+='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	}
	if(s.indexOf('1')!==-1){
		a+='0123456789';
	}
	if(s.indexOf('@')!==-1){
		a+='@#$%^?&.,\'";:+-*/';
	}
	var r='';
	for (var i=0;i<n;i++) { 
		r+=a[Math.floor(Math.random()* a.length)];
	}
	return r;
}

/* disable */
function otpButton(clasn,sec,text,destinationClass='NaN'){
	var oldtext=$('.'+clasn).text();
	$('.'+clasn).prop('disabled',true);
	if(destinationClass!='NaN')
		$('.'+destinationClass).prop('disabled',true);
	$('.'+clasn).addClass('spinner spinner-white spinner-right');
	if(sec!='none'){
		var iId=setInterval(function(){
			sec--;
			$('.'+clasn).html(text+' '+sec+'&nbsp;&nbsp;');
			if(sec<=0){ 
				$('.'+clasn).html(oldtext);
				$('.'+clasn).removeClass('spinner spinner-white spinner-right');
				$('.'+clasn).prop('disabled',false);
				if(destinationClass!='NaN')
					$('.'+destinationClass).prop('disabled',false);
				enableNext();
				clearInterval(iId);
			}
		},1000);
	}else{
		$('.'+clasn).html(text+' &nbsp;&nbsp;');
	}
	return 1;
}
function error_show(bol,text,reload=false){
	icn='error';
	if (bol){
		icn='success';
	}
	swal.fire({
        text:text,
        icon: icn,
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
			confirmButton: "btn font-weight-bold btn-light-primary"
		}
    }).then(function() {
    	if(reload){
			location.reload();
    	}
		//KTUtil.scrollTop();
	});
}
function error_show_link(bol,text,link=null){
	icn='error';
	if (bol){
		icn='success';
	}
	swal.fire({
        text:text,
        icon: icn,
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
			confirmButton: "btn font-weight-bold btn-light-primary"
		}
    }).then(function() {
		if(link!=null)
			location.replace(link);
		//KTUtil.scrollTop();
	});
}
function autoNextPage(bol,text){
	icn='error';
	if (bol){
		icn='success';
	}
	swal.fire({
        text:text,
        icon: icn,
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
			confirmButton: "btn font-weight-bold btn-light-primary"
		}
    }).then(function() {
		KTUtil.scrollTop();
	});
	setTimeout(function(){
		$('.swal2-confirm').click();
	},2000);
}
function scrollTop(){
	document.body.scrollTop = 0; // For Safari
 	document.documentElement.scrollTop = 0; 
}
function btnon(classname,obj=false){
    if(!obj)classname='.'+classname;
	$(classname).removeClass('spinner spinner-white spinner-right');
	$(classname).attr('disabled',false);
}
function btnoff(classname,obj=false){
    if(!obj)classname='.'+classname;
	$(classname).addClass('spinner spinner-white spinner-right');
	$(classname).attr('disabled',true);
}
function invalid_input(classname,obj=false){
	if(!obj)classname='.'+classname;
	$(classname).removeClass('is-invalid','is-valid');
	$(classname).addClass('is-invalid');
}
function valid_input(classname,obj=false){
	if(!obj)classname='.'+classname;
	$(classname).removeClass('is-invalid','is-valid');
	$(classname).addClass('is-valid');
}
/*model here*/
function img_model_next(){
	var parent=window.parent.document;
	var len=$('.img-model-mutiple img',parent).length;
	if($('.adas-img-caros',parent).is(':last-child')){
		past=$($('.img-model-mutiple img',parent)[0]);
	}else
		past=$('.adas-img-caros',parent).next();
	$('.adas-img-caros',parent).removeClass('adas-img-caros');
	$(past,parent).addClass('adas-img-caros');
	var src=$(past,parent).attr('src');
	$('.img-model-main img',parent).attr('src',src);
}

function img_model_prev(){
	var parent=window.parent.document;
	var len=$('.img-model-mutiple img',parent).length;
	if($('.adas-img-caros',parent).is(':first-child')){
		past=$($('.img-model-mutiple img',parent)[len-1]);
	}else
		past=$('.adas-img-caros',parent).prev();
	$('.adas-img-caros',parent).removeClass('adas-img-caros');
	$(past,parent).addClass('adas-img-caros');
	var src=$(past,parent).attr('src');
	$('.img-model-main img',parent).attr('src',src);
}
function img_model_toggle(){
	var parent=window.parent.document;
	if($('.img-model',parent).hasClass('active')){
		$('.img-model',parent).css('opacity','0');
		setTimeout(function(){
			parent.getElementsByClassName('img-model-mutiple')[0].innerHTML='';
			$('.img-model',parent).removeClass('active');
		},300);
	}else{
		$('.img-model',parent).addClass('active');
		setTimeout(function(){
			$('.img-model',parent).css('opacity','1');
		},10);
	}
}
function img_model_add(arr){
	var parent=window.parent.document;
	if(arr.length >= 1){
		var first=arr[0];
		$('.img-model-main img',parent).attr('src',first);
		$(".img-model-mutiple",parent).append('<img src="'+first+'" class="adas-img-caros">');
		if(arr.length >1){	
			for (var i = 1; i < arr.length; i++) {
				$(".img-model-mutiple",parent).append('<img src="'+arr[i]+'" >');
			}
		}
	img_model_toggle();	
	}
}

function img_model_add_string(...arr){
	var temp=arr[0].split(',');
	console.log(temp);
	img_model_add(temp);
}
function confirm_show(text="You won't be able to revert this!"){
var x =	Swal.fire({
	  title: 'Are you sure?',
	  text: text,
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#d33',
	  cancelButtonColor: '#3085d6',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	   return result.isConfirmed;
	});
	console.log(x);
} 
function deleteRow(obj){
    $(obj).closest('tr').remove();
    $('#datatable tbody tr').each(function(i){            
        $($(this).find('td')[0]).html(i+1);
    });
}
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('wheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('wheel.disableScroll')
})

$(document).ready(function(){
    $('.noCaps').on('input', function(){
        $(this).val($(this).val().toLowerCase());
    })
});
function calculateDistance(point1,point2){
	lat1=point1[0];
	lon1=point1[1];
	lat2=point2[0];
	lon2=point2[1];
	var MAXITERS = 20;
	// Convert lat/long to radians
	lat1 *= Math.PI / 180.0;
	lat2 *= Math.PI / 180.0;
	lon1 *= Math.PI / 180.0;
	lon2 *= Math.PI / 180.0;

	var a = 6378137.0; // WGS84 major axis
	var b = 6356752.3142; // WGS84 semi-major axis
	var f = (a - b) / a;
	var aSqMinusBSqOverBSq = (a * a - b * b) / (b * b);

	var L = lon2 - lon1;
	var A = 0.0;
	var U1 = Math.atan((1.0 - f) * Math.tan(lat1));
	var U2 = Math.atan((1.0 - f) * Math.tan(lat2));

	var cosU1 = Math.cos(U1);
	var cosU2 = Math.cos(U2);
	var sinU1 = Math.sin(U1);
	var sinU2 = Math.sin(U2);
	var cosU1cosU2 = cosU1 * cosU2;
	var sinU1sinU2 = sinU1 * sinU2;

	var sigma = 0.0;
	var deltaSigma = 0.0;
	var cosSqAlpha = 0.0;
	var cos2SM = 0.0;
	var cosSigma = 0.0;
	var sinSigma = 0.0;
	var cosLambda = 0.0;
	var sinLambda = 0.0;

	var lambda = L; // initial guess
	for (var iter = 0; iter < MAXITERS; iter++) {
		var lambdaOrig = lambda;
		cosLambda = Math.cos(lambda);
		sinLambda = Math.sin(lambda);
		var t1 = cosU2 * sinLambda;
		var t2 = cosU1 * sinU2 - sinU1 * cosU2 * cosLambda;
		var sinSqSigma = t1 * t1 + t2 * t2; // (14)
		sinSigma = Math.sqrt(sinSqSigma);
		cosSigma = sinU1sinU2 + cosU1cosU2 * cosLambda; // (15)
		sigma = Math.atan2(sinSigma, cosSigma); // (16)
		var sinAlpha = (sinSigma == 0) ? 0.0 :
			cosU1cosU2 * sinLambda / sinSigma; // (17)
		cosSqAlpha = 1.0 - sinAlpha * sinAlpha;
		cos2SM = (cosSqAlpha == 0) ? 0.0 :
			cosSigma - 2.0 * sinU1sinU2 / cosSqAlpha; // (18)

		var uSquared = cosSqAlpha * aSqMinusBSqOverBSq; // defn
		A = 1 + (uSquared / 16384.0) * // (3)
			(4096.0 + uSquared *
			 (-768 + uSquared * (320.0 - 175.0 * uSquared)));
		var B = (uSquared / 1024.0) * // (4)
			(256.0 + uSquared *
			 (-128.0 + uSquared * (74.0 - 47.0 * uSquared)));
		var C = (f / 16.0) *
			cosSqAlpha *
			(4.0 + f * (4.0 - 3.0 * cosSqAlpha)); // (10)
		var cos2SMSq = cos2SM * cos2SM;
		deltaSigma = B * sinSigma * // (6)
			(cos2SM + (B / 4.0) *
			 (cosSigma * (-1.0 + 2.0 * cos2SMSq) -
			  (B / 6.0) * cos2SM *
			  (-3.0 + 4.0 * sinSigma * sinSigma) *
			  (-3.0 + 4.0 * cos2SMSq)));

		lambda = L +
			(1.0 - C) * f * sinAlpha *
			(sigma + C * sinSigma *
			 (cos2SM + C * cosSigma *
			  (-1.0 + 2.0 * cos2SM * cos2SM))); // (11)

		var delta = (lambda - lambdaOrig) / lambda;
		if (Math.abs(delta) < 1.0e-12) {
			break;
		}
	}

	var mTotalDistance = (b * A * (sigma - deltaSigma));
	var initialBearing = Math.atan2(cosU2 * sinLambda,
		cosU1 * sinU2 - sinU1 * cosU2 * cosLambda);
	initialBearing *= 180.0 / Math.PI;
	var finalBearing = Math.atan2(cosU1 * sinLambda,
			-sinU1 * cosU2 + cosU1 * sinU2 * cosLambda);
	finalBearing *= 180.0 / Math.PI;

	return mTotalDistance;
}