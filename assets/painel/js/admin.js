/**
 * Arquivo geral do administracao
 */
var pasta = '/gedos';
var baseurl = document.location.protocol + '//' + document.location.host;
var path = document.location.pathname;
var segmentos = '';
var selecao = '';
var valores = new Array();
var controller = '';
var metodo = '';
var id = '';
var pagina = '';
var ajax_url = location.hash.replace(/^#/, '');
if (ajax_url < 1) {
    sendAjax(pasta + '/home/dashboard', '#ajax-content');
} else {
    sendAjax(ajax_url, '#ajax-content');
}
class URI {
    constructor(url) {
        this.getURI = function() {
            var uri = location.hash.replace(/^#/, '').split('/');
            controller = uri[0];
            metodo = uri[1];
            id = uri[2];
            pagina = uri[3];
            var req = { controller: controller, metodo: metodo, id: id, pagina: pagina };
            return req;
        }
    }
}

setTimeout(function() {
    $.get("home/session", function(data, status) {
        // Code to execute after the $.get request completes
        var ajax_url = location.hash.replace(/^#/, '');
        if(data=='Usuario nao logado')
        {
            document.location.href=ajax_url;
        }else{
           
        }
        
    });
}, 1000); // 1000 milliseconds delay

/* function renova_ckeditor() {
    if (CKEDITOR != undefined) {
        for (name in CKEDITOR.instances) {
            CKEDITOR.instances[name].destroy(true);
        }
    }
} */
/**
 * 
 * @param {*} url = Qual o endereco que esta sendo chamado 
 * @param {*} target = Onde devera ser inserida a resposta
 */
function sendAjax(url, target = '', data='') {

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
            $('.select2').select2();
            $(target).html(resposta);
            var uri = new URI(url).getURI();
            $('#titulo-painel').text(uri.controller).css('text-transform', 'capitalize');
            $('.titulo-controller').text(uri.controller);
            $('.nomecontroller').text(uri.controller);
            $('.nomecontroller').attr('data-controller', uri.controller);
            $('.nomemetodo').text(uri.metodo);
            $('.modal').modal();
            $('#fechar').click(function() {
                $('#resposta-modal').html();
                window.location.hash = '/painel/' + uri.controller + '/listar';
            })
        }
    });
}

function sendPostAjax(url, valores, target = '') {
    $.ajax({
        url: url,
        async: true,
        type: 'POST',
        data: { valores: valores },
        beforeSend: function() {
            $(target).html('<p align="center">Aguarde...</p>');
        },
        error: function(resposta) {
            $(target).html(resposta);
        },
        success: function(resposta) {
            $(target).html(resposta);
            $('.modal').modal();
            //Flat red color scheme for iCheck
           
        }
    });
}

function retiraAcento(palavra) {

    var com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ ´`^¨~:\?",';
    var sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC-          ';
    for (l in palavra) {
        for (l2 in com_acento) {
            if (palavra[l] == com_acento[l2]) {
                palavra = palavra.replace(palavra[l], sem_acento[l2]);
            }
        }
    }
    return palavra.toLowerCase();
}

$(document).ready(function() {
    //Para imperir erro ao var c = document.location.href;
    //renova_ckeditor();
    //Atualiza o menu a cada 3 segundos

    /* Para 
     *
     */
    $('.ajax-link').each(function() {
            $(this).click(function(e) {
                e.preventDefault();
                sendAjax($(this).attr('href'), '#ajax-content');
            })
        })
        /**
         * Para os links com a classe ajax-link apos uma requisicao
         */
    $('#ajax-content').on('click', '.ajax-link', function(e) {
        e.preventDefault();
        sendAjax($(this).attr('href'), $(this).attr('data-target'));
        $('form').submit(function() {
            return false;
        })
    });

    $('#resposta-modal').on('click', 'a', function(e) {
            e.preventDefault();
            alert($('a').text());
        })
        /**
         * Submissao de formularios
         */
   
    /**
         * Submissao de formularios
         */
    $('#ajax-content').on('submit', 'form', function() {
        $(this).ajaxSubmit({
            beforeSend: function() {
                $('.progress-bar').width(0);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentval = percentComplete + '%';
                $('.progress-bar').width(percentval);
                $('.sr-only').html(percentval);
            },
            success: function(resposta) {
                $('#ajax-content').html(resposta);
                $('.modal').modal();

            }
        });
        return false;
    });
    /**
     * Forms em janelas modais
     */
    $(document).on('click', '.btn-save', function() {
        var form = $(this).parent().prev().prev().children('form');
        form.ajaxSubmit(function(resposta) {
            sendAjax(baseurl + '/' + pasta + '/#' + $('#url_atual').val());
            alert(resposta);
        });

    });
});