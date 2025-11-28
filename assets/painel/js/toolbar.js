// JavaScript Document
$(document).ready(function(){
	var requisicao = location.hash.replace(/^#/, '');
	console.log(requisicao);
	function Toolbar(){
		
		segmentos = requisicao.split('/');
		var controller  = segmentos[0];
		var id = segmentos[1];
		//alert(segmentos);
		this.AcessarComo = function()
		{

		}

		/**
		 * Metodo Ativar
		 */
		this.Ativar = function(){
		  	url = '/'+pasta+'/usuarios/ativar/';
		  	sendAjax(url);
		};

		/**
		 * Metodo Ativar
		 */
		this.Assinar = function(){
		  	url = '/'+pasta+'/usuarios/ativar/';
		  	sendAjax(url);
		};

		/**
		 * Metodo Cancelar
		 */
		this.Cancelar = function(){

		  	url = '/'+controller+'/listar';
		  	sendAjax(url,"#ajax-content");
		};
		
		/**
		 * Metodo Ativar
		 */
		this.Compartilhar = function(){
		  	url = '/'+pasta+'/usuarios/ativar/';
		  	sendAjax(url);
		};

		/**
		 * Metodo Ativar
		 */
		this.Clonar = function(){
		  	url = '/'+pasta+'/usuarios/ativar/';
		  	sendAjax(url);
		};
		this.ExportarPaisagem = function()
		{
		
		}
		/**
		 * Metodo Ativar
		 */
		this.Concluir = function(){
			let id = $('#id').val();
		  	url = 'documentos/concluir/'+id;
		  	sendAjax(url,'#ajax-content');		  	
		};	

		/**
		 * Metodo Desativar
		 */
		this.Desativar = function(){
		  	url ='/'+pasta+'/usuarios/desativar/';
		  	sendAjax(url,'#ajax-content');
		};
		/**
		 * Metodo Despublicar
		 */
		this.Despublicar = function(){
			selecao = $(document).find(':checkbox:checked');
			var valores = new Array();
			if(selecao.length<1){
				alert('Selecione um registro para despublicar!');
				
			}else{
				selecao = $(document).find(':checkbox:checked').not('#selectall');	
				selecao.each(function(){
					valores.push($(this).val());
				});
				
				sendPostAjax('/'+controller+'/despublicar/',valores,'#resposta');	
			}
	  	};
		
		/**
		 * Metodo Editar
		 */
		this.Editar = function(){
			selecao = $(document).find(':checkbox:checked');
			
			if(selecao.length<1){
				alert('Selecione um registro para editar!');
				
			}else{
				//Se selecionou mais de um registro, aviso para selecionar apenas 1
				if(selecao.length>1){
					alert('Selecione apenas um registro para editar!');
				}else{
					selecao = $(document).find(':checkbox:checked').not('#selectall');	
					selecao.each(function(){
						valores = $(this).val();
					});
					sendAjax('/'+controller+'/editar/'+valores,'#ajax-content');	
				}
			}	
		};
		/**
		 * 
		 */
		this.Excluir = function(){

			if(window.confirm('Deseja excluir os registros selecionados?')){
				//Se selecionou mais de um registro, aviso para selecionar apenas 1
				selecao = $(document).find(':checkbox:checked').not('#selectall');	
				var valores = new Array();
				selecao.each(function(){
					valores.push($(this).val());
					$(this).parent('td').parent('tr').remove();
				})
				sendPostAjax('/'+controller+'/excluir',valores,'#resposta');
			}			
		}
		/**
		 * 
		 */
		this.ExportarPaisagem = function()
		{
			
		}
		/**
		 * 
		 */
		this.ExportarRetrato = function()
		{

		}
		/**
		 * 
		 */
		this.Imprimir = function()
		{
			
		}
			/**
		 * Metodo novo
		 */
		this.Novo = function(){
			url = controller+'/add';
		  	sendAjax(url,'#ajax-content');
		};
		/**
		 * Metodo Publicar
		 */
		this.Publicar = function(){
			selecao = $(document).find(':checkbox:checked');
			var valores = new Array();
			if(selecao.length<1){
				alert('Selecione um registro para publicar!');
				
			}else{
				selecao = $(document).find(':checkbox:checked').not('#selectall');	
				selecao.each(function(){
					valores.push($(this).val());
				});
				sendPostAjax('/'+controller+'/publicar/',valores,'#resposta');	
			}
	  	};
		/**
		 * 
		 */
		this.Salvar = function(){
			$('form').submit(function(){
				$(this).ajaxSubimt(function(resposta){
					alert(resposta);
				})
				return false;
			})			
		}
		
		this.SolicitarAssinatura = function(){
			let id = $('#id').val();
		  	url = 'documentos/solicitarassinatura/'+id;
		  	sendAjax(url,'#ajax-content');		  	
		};

		this.SolicitarRevisao = function(){
			let id = $('#id').val();
		  	url = 'documentos/solicitarevisao/'+id;
		  	sendAjax(url,'#ajax-content');		  	
		};
		this.Assinar = function(){
			let id = $('#id').val();
		  	url = 'documentos/assinar/'+id;
		  	sendAjax(url,'#ajax-content');		  	
		};
		/**
		 * Metodo responder: responde para o autor de um resumo
		 */
		this.Responder = function(){
		  	url = baseurl+'/resumo/responder/';
		  	var linhas = $('.datagrid > tbody > tr').not('.datagrid > tbody > tr:first-child');
		  	var ids = new Array();
		  	$(linhas).each(function(){
		  		var id = $(this).children('td:first-child').children('input[type="checkbox"]');
		  			
		  	});
		  	//sendAjax(url);
		};

		/**
		 * Metodo Remover
		 */
		this.Remover = function(){
			
	  	};	
				
	};
	var requisicao = location.hash.replace(/^#/, '');
	segmentos = requisicao.split('/');
	var controller = segmentos[2];
  	
	$('#mudar').click(function(){
		
	});
	
	$(document).keyup(function(e){
		if(e.keyCode=='27'){
			$('.fundomodal').hide();
			$('.jan-modal').hide();	
		}
	});
	/*----------------------------------------------
	 *Lista de variaveis usadas na toolbar
	 *----------------------------------------------  
	 */
	
	var selecao ='';
	var valores = new Array();
	var boxes = '';
	/*******Fim******/
	
	$('#ajax-content').on('click',"#novo",function(e){
		e.preventDefault();
		new Toolbar().Novo();
	});
	$('#ajax-content').on('click',"#concluir",function(e){
		e.preventDefault();
		new Toolbar().Concluir();
	});
	$('#ajax-content').on('click',"#editar",function(e){
		e.preventDefault();
		new Toolbar().Editar();
	});
	
	$('#ajax-content').on('click',"#cancelar",function(e){
		e.preventDefault();
		new Toolbar().Cancelar();
	});
	
	$('#ajax-content').on('click',"#excluir",function(e){
		e.preventDefault();
		new Toolbar().Excluir();
	});
	
	$('#ajax-content').on('click',"#ativar",function(e){
		e.preventDefault();
		new Toolbar().Ativar();
	});
	
	$('#ajax-content').on('click',"#responder",function(e){
		e.preventDefault();
		new Toolbar().Responder();
	});
	
	$('#ajax-content').on('click',"#salvar",function(e){
		e.preventDefault();
		new Toolbar().Salvar();
	});
	
	$('#ajax-content').on('click',"#publicar",function(e){
		e.preventDefault();
		new Toolbar().Publicar();
	});
	$('#ajax-content').on('click',"#despublicar",function(e){
		e.preventDefault();
		new Toolbar().Despublicar();
	});
	$('#ajax-content').on('click',"#solicitarassinatura",function(e){
		e.preventDefault();
		new Toolbar().SolicitarAssinatura();
	});
	$('#ajax-content').on('click',"#solicitarevisao",function(e){
		e.preventDefault();
		new Toolbar().SolicitarRevisao();
	});
	$('#ajax-content').on('click',"#assinar",function(e){
		e.preventDefault();
		new Toolbar().Assinar();
	});
});
