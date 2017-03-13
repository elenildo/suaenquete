
	function fctLogin(){
	$.post('require/jp/jpLogin.php',{
			email:$('#email').val(),
			senha:$('#senha').val()
		},function(res){
			if(res)
				$('main form span').html(res).css({color:'#f00'});
			else
				location.href='admin';
		});
	}

