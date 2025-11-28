var baseurl = document.location.protocol + '//' + document.location.host;
var path = document.location.pathname;
var segmentos = '';
var selecao = '';
var valores = new Array();
var controller = '';
var metodo = '';
var id = '';
var pagina = '';

$(document).ready(function(){
     $('.ajax-link').each(function(){
      $(this).click(function(e){
        e.preventDefault();
        sendAjax($(this).attr('href'),'.content-wrapper')
      })
   });

class URI {
    constructor(url) {
        this.getURI = function() {
            var uri = url.replace(path, '').split('/');
            controller = uri[2];
            metodo = uri[3];
            id = uri[4];
            pagina = uri[5];
            var req = { controller: controller, metodo: metodo, id: id, pagina: pagina };
            return req;
        }
    }
}
/**
 * 
 * @param {*} url = Qual o endereco que esta sendo chamado 
 * @param {*} target = Onde devera ser inserida a resposta
 */
function sendAjax(url, target = '') {
    console.log(url);

    $.ajax({
        url: window.location.hash = url,
        async: true,
        type: 'GET',
        beforeSend: function() {
            $(target).html('<p align="center">Aguarde...</p>');
        },
        error: function(resposta) {
            $(target).html(resposta);
        },
        success: function(resposta) {
            $(target).html(resposta);
            var uri = new URI(url).getURI();
            $('.modal').modal();
            $('#fechar').click(function() {
                $('#resposta-modal').html();
                window.location.hash = '/' + uri.controller + '/listar';
            })
        }
    });
}
})