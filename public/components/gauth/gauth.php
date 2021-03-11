<style>
    .g-signin2{
        width:100%;
    }
    .g-signin2 > div{
        margin: 0 auto;
        width: 100%!important;
        height: 50px;
    }
    .g-signin2 > div > div{
        display: flex;
        flex-direction: row;
        justify-content:center;
    }
</style>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
<script>
	let gAuth;
	window.onLoadCallback = function(){
		gapi.load('auth2', function() {
			gapi.auth2.init({
				client_id:'<?=GOOGLE_CLIENT_ID?>'
			}).then(function(auth2){
				gAuth = auth2;
                if (typeof gAuthLoaded !== "undefined")
                    gAuthLoaded();
			});
		});
	};
</script>
