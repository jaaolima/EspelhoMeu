$("body").on('click', 'a', function(event){

  if($(this).attr('href') == '#' || $(this).attr('target') == '_blank' || $(this).data('ajax') == false){
    return true;
  }
  if ($(this).attr('href') == 'appUsuario/logout.php')
  {
    location.href='appUsuario/logout.php';
    return false;
  }
  if ($(this).attr('href') == 'principal.php')
  { 
    location.href='principal.php';
    return false;
  }

  if ($(this).attr('href').startsWith('paciente.php'))
  {
    var url = new URL($(this).attr('href').val());
    var id_paciente = url.searchParams.get("id_paciente");
    var ds_nome = url.searchParams.get("id_paciente");
    location.href='paciente.php?id_paciente='+id_paciente+'&ds_nome='+ds_nome;
    return false;
  }

  if ($(this).attr('href').startsWith('#kt_portlet_base_demo') )
  {
    return true;
  }


  event.preventDefault();
  redirectTo($(this).attr('href'));
});



function redirectTo(url, successCallback){
  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'html',
  })
  .done(function(data) {
    $('#conteudo').html(data);
    /*if(!$("#kt_subheader").length)
    {
      $('#conteudo').css("margin-top", "-55px");  
    }
    $('#conteudo').css("margin-top", "-55px");*/


    
      if (typeof(successCallback) === "function") {
        successCallback();
      }
  })
  .fail(function(data) {
    
    if (data.status ==401)
    {
      window.location.href = "/index.php"; 
    }

    if (data.status ==500)
    {
      swal.fire("Erro", data.responseText, "error");
    }       
   
  });
  
}
var slide_wrp 		= ".side-menu-wrapper"; //Menu Wrapper
var open_button 	= ".menu-open"; //Menu Open Button
var close_button 	= ".menu-close"; //Menu Close Button
var overlay 		= ".menu-overlay"; //Overlay

//Initial menu position
$(slide_wrp).hide().css( {"right": -$(slide_wrp).outerWidth()+'px'}).delay(50).queue(function(){$(slide_wrp).show()}); 

$(open_button).click(function(e){ //On menu open button click
	e.preventDefault();
	$(slide_wrp).css( {"right": "0px"}); //move menu right position to 0
	setTimeout(function(){
		$(slide_wrp).addClass('active'); //add active class
	},50);
	$(overlay).css({"opacity":"1", "width":"100%"});
});

$(close_button).click(function(e){ //on menu close button click
	e.preventDefault();
	$(slide_wrp).css( {"right": -$(slide_wrp).outerWidth()+'px'}); //hide menu by setting right position 
	setTimeout(function(){
		$(slide_wrp).removeClass('active'); // remove active class
	},50);
	$(overlay).css({"opacity":"0", "width":"0"});
});

$(document).on('click', function(e) { //Hide menu when clicked outside menu area
	if (!e.target.closest(slide_wrp) && $(slide_wrp).hasClass("active")){ // check menu condition
		$(slide_wrp).css( {"right": -$(slide_wrp).outerWidth()+'px'}).removeClass('active');
		$(overlay).css({"opacity":"0", "width":"0"});
	}
});





