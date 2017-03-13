$(document).ready(function(){
	
	var status = '';
	var chave = '';
	var email = '';
	var cod_enq = [];
	var itens = true;

	$("#div-codigo").hide();
	$("#div-loading").hide();
	$("#div-msg").hide();
	$(".div-qtd-votos").hide();

	$("#btn-enviar-email").click(function(){
		//var dados = $('#form-email').serialize();
		email = $('#email').val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: 'envia_email.php',
            beforeSend: function(){
            	$('#div-email').hide();
            	$("#div-loading").show();
            },
            async: true,
            data: 'email='+email,
            success: function(data) {
                $('#div-loading').hide();
                $('#div-email').hide();
                $('#div-codigo').show();
            }
        });

        return false;
	});
	
	$("#btn-enviar-codigo").click(function(){
		//var dados = $('#form-email').serialize();
		var id_enquete = $('#id_enquete').val();
		var codigo = $('#codigo').val();
		var opcao = $('input:checked').val();
		
		if(!opcao){
			itens = false;
			$('#pmsg').text('Você ainda não escolheu nenhuma opção.');
	        $('#pmsg').css('color','red');
	        $('#div-msg').slideDown();
		}else{

	    	$.ajax({
	            type: 'POST',
	            dataType: 'html',
	            url: 'registrar_voto.php',
	            async: true,
	            data: 'id_enquete='+id_enquete+'&codigo='+codigo+'&opcao='+opcao,
	            success: function(data) {
	                if(data == '1'){
	                	$('#div-codigo').hide();
	                	$('#pmsg').text('Obrigado. Seu voto foi registrado com sucesso.');
	                	$('#pmsg').css('color','green');
	                	
	                	status = email;
	                	chave = codigo;

	                	if($.inArray(id_enquete, cod_enq) == -1){
	                		cod_enq.push(id_enquete);
	                	}
	                	
	                	carrega_lista(id_enquete);
	                	//$(".div-qtd-votos").show();

	                };
	                if(data == '0'){
	                	$('#pmsg').text('O código digitado é inválido.');
	                	$('#pmsg').css('color','red');
	                };
					if(data == '2'){
	                	$('#pmsg').text('Desculpe, mas você já votou nessa enquete');
	                	$('#pmsg').css('color','red');
	                };
	                if(data == '-1'){
	                	$('#pmsg').text('Erro ao postar');
						$('#pmsg').css('color','red');
	                };

	                $('#div-msg').slideDown();
	            }
	        });
		}
        return false;
	});

	function carrega_lista(idenquete){
		$.ajax({
            type: 'POST',
            dataType: 'html',
            url: 'inc_enquete.php',
            beforeSend: function(){
				var itens = $("#lista-opcoes tr").remove();
            },
            async: true,
            data: 'id_enquete='+idenquete,
            success: function(data) {
            	$('#lista-opcoes').html(data);

            	if($.inArray(idenquete, cod_enq) != -1){
            		$(".div-qtd-votos").show();
            	}else
            		$(".div-qtd-votos").hide();

            }
        });
	}

	$('.div-enquetes').click(function(){
		var $idenq = $(this).find('#idenq');
		var $tituloenq = $(this).find('#tituloenq');
		var $dataenq = $(this).find('#dataenq');
		//var $autorenq = $(this).find('#autorenq');
		
		$('html, body').animate({scrollTop:0}, 'slow');
		$('#titulo-destaque').html($tituloenq.val());
		$('#spn-data').html($dataenq.val());
		$('#id_enquete').attr('value',$idenq.val());
		//$('#spn-autor').html($autorenq.val());
		
		carrega_lista($idenq.val());

            return false;
	
	});

	$('#btn-fechar').click(function(){
		$("#div-msg").hide();
		$("#div-loading").hide();
		$('#div-email').show();
		if(itens){
			$("#codigo").attr('value','');
			$("#div-codigo").hide();
		}
	});

	$('#btn-votar').click(function(){
		if(status == ''){
			$('[data-toggle="tooltip"]').tooltip();
		}else
			{
			var id_enquete = $('#id_enquete').val();
			var codigo = chave;
			var opcao = $('input:checked').val();
			
			if(!opcao){
				//alert('Você ainda não escolheu nenhuma opção.');
				itens = false;
				alert('Você ainda não escolheu nenhuma opção.');
			}else{

		    	$.ajax({
		            type: 'POST',
		            dataType: 'html',
		            url: 'registrar_voto.php',
		            async: true,
		            data: 'id_enquete='+id_enquete+'&codigo='+codigo+'&opcao='+opcao,
		            success: function(data) {
		            	
		                if(data == '1'){
		                	alert('Obrigado. Seu voto foi registrado com sucesso.');

		                	if($.inArray(id_enquete, cod_enq) == -1){
	                			cod_enq.push(id_enquete);
	                		}
		                	carrega_lista(id_enquete);
		                };
		                if(data == '0'){
		                	alert('O código digitado é inválido.');
		                };
						if(data == '2'){
							alert('Desculpe, mas você já votou nessa enquete');
		                	
		                };
		                if(data == '-1'){
		                	alert('Erro ao postar');
		             
		                };
						
		            }
		        });
			}
	        return false;
		}
	});

    
});
		