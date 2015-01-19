
$(document).ready(function(){
    
    //Load the library and the functionality of news
    $("#options_eventos").show();
    baseUrl = getBaseUrl();
    //$.getScript(baseUrl+'/statics/js/libraries/form.js');

   
    $("#save_eventos").submit(function(){
        var band = 0;
	
        if($("#eventoTitulo").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoTitulo").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoTitulo").css("border", "1px solid #ADA9A5");
        }
		
		/*if($("#eventoFecha").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoFecha").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoFecha").css("border", "1px solid #ADA9A5");
        }
		*/
		/*if($("#eventoHora").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoHora").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoHora").css("border", "1px solid #ADA9A5");
        }
		*/
		if($("#imagenNews").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#imagenNews").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#imagenNews").css("border", "1px solid #ADA9A5");
        }


		if($("#eventoDescripcion").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoDescripcion").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoDescripcion").css("border", "1px solid #ADA9A5");
        }
		
		if($("#eventoDescripcion").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoDescripcion").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoDescripcion").css("border", "1px solid #ADA9A5");
        }

        
        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : newNews
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });

     $("#editar_eventos").submit(function(){
        var band = 0;
	
        if($("#eventoTitulo").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoTitulo").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoTitulo").css("border", "1px solid #ADA9A5");
        }
		
		/*if($("#eventoFecha").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoFecha").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoFecha").css("border", "1px solid #ADA9A5");
        }
		*/
		/*
		if($("#eventoHora").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoHora").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoHora").css("border", "1px solid #ADA9A5");
        }
		*/
		


		if($("#eventoDescripcion").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoDescripcion").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoDescripcion").css("border", "1px solid #ADA9A5");
        }
		
		if($("#eventoDescripcion").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#eventoDescripcion").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#eventoDescripcion").css("border", "1px solid #ADA9A5");
        }

        
        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : newNews
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });


    /**
     * Event will load all the tournaments every time the
     * user admin will select the sport
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $("#deporteNews").change(function(){
        url = $("#torneosOpciones").attr('href');
        id = $(this).val();
        url_complete = url +'/'+ id;
        html_response = $.ajax({
                                url : url_complete,
                                type: "GET",
                                dataType: "html",
                                async: false
                               }).responseText;
        $("#torneosId").html(html_response);
    });
	
	
	$("#sucursalNewsRes").change(function(){
        url = $("#sucursalOpciones").attr('href');
        id = $(this).val();
        url_complete = url +'/'+ id;
        html_response = $.ajax({
                                url : url_complete,
                                type: "GET",
                                dataType: "html",
                                async: false
                               }).responseText;
        $("#sucursalId").html(html_response);
    });

    /**
     * Event to show the confirm dialog for know
     * if the user really want to delete the information 
     * and need to confirm for the user delete it
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $(".eliminar").click(function(event){
        event.preventDefault();
        $.confirm({
                    'title'     : 'Eliminar Noticia',
                    'message'   : 'Desea eliminar la noticia seleccionada?',
                    'buttons'   : {
                                    'Eliminar' : {
                                        'class' : 'blue',
                                        'action': function(){
                                            id = $(event.currentTarget).attr('flag');
                                            url = $("#delete"+id).attr('href');
                                            $("#eliminar"+id).slideUp();
                                            $.get(url);
                                        }
                                    },
                                    'Cancelar' : {
                                        'class' : 'gray',
                                        'action': function(){}//do nothing
                                    }
                                  }
                  });
    });

    /**
     * Event to use the data for delete the images and
     * can delete from the view of the users, for can
     * upload another image
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $("#borrar_img").click(function(event){
        event.preventDefault();
        url = $(this).attr('href');
        $.get(url);
        $("#imagen_data_news").remove();
    });
	
	
	
	
	/*
	* metodo para validar la imagen a subir
	* autor: jalomo <jalomo@hotmail.es>
	*/
	 $("#subir_foto").submit(function(){
        var band = 0;
	
        /*if($("#image").val() == '')
            {
                $("#image").css({'border':'1px solid #FF0000'});
                band++;
				
            }
            else
            {
                $("#image").css({'border':'1px solid #ADA9A5'});
				
            }
              
        */
        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : exito
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });

	
	/*
	* metodo para eliminar una imagen 
	* autor: jalomo <jalomo@hotmail.es>
	*/
	$(".eliminar_image").click(function(event){
        event.preventDefault();
        $.confirm({
                    'title'     : 'Eliminar imagen',
                    'message'   : 'Desea eliminar foto?',
                    'buttons'   : {
                                    'Eliminar' : {
                                        'class' : 'blue',
                                        'action': function(){
                                            id = $(event.currentTarget).attr('flag');
                                            url = $("#delete"+id).attr('href');
                                            $("#eliminar"+id).slideUp();
                                            $.get(url);
                                        }
                                    },
                                    'Cancelar' : {
                                        'class' : 'gray',
                                        'action': function(){}//do nothing
                                    }
                                  }
                  });
    });
	
	
	/*
	* metodo para restringir el tamaño de una imagen
	* que suba el cliente.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	$(".image").bind('change', function(){
        var data =new FormData();
       
       $.each($("#image")[0].files, function(i, files){
            data.append('image', files);
        });

        values = $.ajax({
                            url : $("#banners_dinamic").attr('href'),
                            data: data,
                            cache : false,
                            contentType: false,
                            processData: false,
                            type : 'POST',
                            async : false
                        }).responseText;

        if(values == 1 || values == '1')
        {
            $("#add_images").show();
            $("#error_multiple").hide();
            $("#button_save_section").show();
        }
        else
        {
            $("#error_multiple").text('Por favor, verifique las medidas de las imagenes.').show();
            $("#button_save_section").hide();
        }
    });
	
});

/**
 * Function will execute once type the result of the
 * new and can show the success message for can notify
 * to the admin the data will save correctly
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function newNews(){
    $("#newsTitle").val('');
    $("#imagenNews").val('');
    $("#textNews").val('');
    $("#deporteNews").val('0');
    $("#select_torneo").remove();
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
}

function editNews(){
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
}

function exito(opt){
	
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
}
