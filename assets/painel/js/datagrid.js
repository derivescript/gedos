$(document).ready(function(){
	var controller;
	var id;
	var url = ajax_url.replace(/^#/,''); //remove /#/
	let request = ajax_url.split('/');
	controller = request[0];
	metodo = request[1];
	id = request[2];

	/**
	 * 
	 */
	$('#selectall').click(function(){
		if($(this).is(':checked'))
		{
			$('input[type="checkbox"]').attr('checked','checked');
		}else{
			
		}
	});
	/**
	 * Acao para o botao responder da datagrid
	 */	
	$('#ajax-content').on('click','.responder',function(e){
			e.preventDefault();
			var url = $(this).attr('href'); 
			sendAjax(url);
	});
	
	$('#ajax-content').on('click','.aceite',function(e){
			e.preventDefault();
			var url = $(this).attr('href'); 
			sendAjax(url);
	});

  	$('#ajax-content').on('click','.recusar',function(e){
		e.preventDefault();
		var url = $(this).attr('href'); 
		sendAjax(url);
	});
	
	$('.editable-field').each(function(){
		
	});
  
	$('#ajax-content').on('click','.lnk-editar',function(e){
		e.preventDefault();
		var url = $(this).attr('href'); 
		sendAjax(url,'#ajax-content');
	});


  $('#ajax-content').on('click','.lnk-verresumo',function(e){
	  e.preventDefault();
	  var telaW = window.screen.width;
	  var telaH = window.screen.height;
	  var link = $(this).attr('href');
	  var jan = window.open(link,'_blank',"width=telaW, height=telaH");
	  jan.focus();
  });

	$('#ajax-content').on('click','.excluir',function(e){
		var uri = new URI(url).getURI();
		controller = uri.controller;
		e.preventDefault();
		var id = $(this).attr('data');
		$.get('/'+controller+'/excluir/'+id,function(resposta){
			$('#resposta').html(resposta);
  			$('.modal').modal();
  		},'html')
  		$(this).parent('td').parent('tr').remove();
  	});

	var partes = ajax_url.replace(/^#/,'').split('/');  

	if(id=='' || id=='undefined'){
		id = 1;
	}else{
		id = partes[5];
	}	
	  
	$('#ajax-content').on('click','#primeira',function(){
		sendAjax(pasta+'/'+controller+'/listar/'+id+'/1','#ajax-content');
	});

	$('#ajax-content').on('click','#anterior',function(){
		sendAjax(pasta+'/'+controller+'/listar/'+id+'/'+$(this).attr('data-value'),'#ajax-content');
	});

	$('#ajax-content').on('click','.btpagina',function(){
		sendAjax(pasta+'/'+controller+'/listar/'+id+'/'+$(this).text(),'#ajax-content');
	});

	$('#ajax-content').on('click','#proxima',function(){
		sendAjax(pasta+'/'+controller+'/listar/'+id+'/'+$(this).attr('data-value'),'#ajax-content');
	});

	$('#ajax-content').on('click','#ultima',function(){
		sendAjax(pasta+'/'+controller+'/listar/'+id+'/'+$(this).attr('data-value'),'#ajax-content');
	});
  
	$('#ajax-content').on('click','.nomecoluna',function(){
		$(this).click(function(evento){
			evento.preventDefault();
			document.location.href='listar';	
		});
	});

	$('#ajax-content').on('mouseover','tr',function(){
		$(this).css({
			background:'#f1f1f1',
			color:'#999'
		})
	});

	$('#ajax-content').on('mouseout','tr',function(){
		$(this).css({
			background:'none',
			color:'#000'
		})
	});

	$('#ajax-content').on('click','.botao-certificado',function(e){
		e.preventDefault();
		$.post(path+'/certificado/lancarminicurso',{
			idminicurso:$(this).attr('dataminicurso'),
			idusuario:$(this).attr('dataid')			
		},function(resposta){
			alert(resposta);
		},'html');
	});


	$('#ajax-content').on('dblclick','.editable-field',function(){
		if($(this).attr('class')!=''){
			if($(this).index()>2){		
				//Id do registro que fica na quarta coluna
				var id = $(this).siblings('td:eq(0)').children('input').attr('value');				
				var valorid = $(this).siblings('td:eq(0)').children('input').attr('value');
				var campo = $(this).attr('data-nome');
				var valoratual = $(this).attr('data-valor');
				$nomecampo = campo+id;
				$(this).attr('id',campo+id);
				$(this).html(
				'<div>'+
				'<input type="text" class="live form-control input-xxlarge" name="'+$(this).attr('data-nome')+'" value="'+valoratual+'" id="live'+id+'">'+
				'</div>'+
				'<div class="edita-campo">'+  	
				'<button type="button" class="btn btn-primary gravar" id="gravar-'+id+'" data-id="'+id+'">Gravar</button>'+
				'<button type="button" class="btn btn-danger cancel-gravar">Cancelar</button>'
				+'</div>'
				);			
				
				var data = {};
				data['id'] = valorid;
				console.log("Id da linha:"+data['id']);
				$('.live').focus();
				$('.live').keypress(function(event){
					if ( event.keyCode == 13 ) {
						$(this).click(function(){
							data[campo]=$(this).parent().children('.live').val();
							$(this).parent('td').text($(this).next('.live').val('valor'));
							$.post('/'+controller+'/update',				 
								data,
								function(res){
								location.reload();
								},'html'
							);
						});
						//
					}
				});
				$btngravar = '#gravar-'+id;
				
				$($btngravar).click(function(){	
					console.clear();
					console.log(controller+'/editarcampo');
					data[campo]=$(this).parent().parent().children('div').children('.live').val();		
					$campo = $(this).parent().parent().attr('id');
						$.post(pasta+'/'+controller+'/editarcampo',				 
								data,
								function(res){
								$('#resposta').html(res);
								$('.modal').modal();	
								$('#fechar').click(function(){
									$('td#'+$nomecampo).attr('data-valor',$('.live').val());
									$('td#'+$nomecampo).text($('.live').val());
								});
								},'html'
							);
				});//Fim do gravar
				
				$('.cancel-gravar').click(function(){
					$(this).parent('div').parent('td').text(valoratual);
				});
			} 
		}
	});

	
	$('.login').each(function(){
		$(this).html('<a href="'+path+'"admin/email/escrever/'+$(this).text()+'">'+$(this).text()+'</a>');
	});
});