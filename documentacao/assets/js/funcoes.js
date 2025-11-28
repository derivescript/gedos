window.onload = function()
{
    var inicio = document.getElementById('inicio');
    loadDoc(inicio.getAttribute('href'));
    var todos = document.querySelectorAll('.ajax-link');
    todos.forEach(function(elemento)
    {       
        //
        elemento.onclick = function(evento)
        {
          evento.preventDefault();
          loadDoc(elemento.getAttribute('href'));
        }
    })
    {

    }
    /**
     * Requisicao AJAX 
     */
    function loadDoc(link) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("code").innerHTML = '<pre>'+this.responseText+'</p>';
            var todos_os_a = document.querySelectorAll('.link')+'</pre>';
            todos_os_a.forEach(function(elemento)
            {
                elemento.onclick = function(evento)
                {
                  evento.preventDefault();                  
                }
            })
          }else{
            document.getElementById("code").innerHTML = 'nao encontrado';
          }
        };
        xhttp.open("GET", link, true);
        xhttp.send(); 
      }

      function togglehide()
      {
        menu.style.display="none";                    
      } 
}

