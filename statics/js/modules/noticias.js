/**
 * FILE WHERE WILL BE ALL THE FUNCTIONALITY
 * OF THE MODULE OF THE ACTION WHERE THE USER
 * CAN SEE THE INFORMATION DATA
 **/

/**
 * Event where can execute all the information about the 
 * interaction the system with the user can check the events
 * like form, and anymore
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
$(document).ready(function(){
    
    //Load the library and the functionality of news
    $("#options_news").show();
    baseUrl = getBaseUrl();
    //$.getScript(baseUrl+'/statics/js/libraries/form.js');

    /**
     * Event where the system will check the information value
     * about the data will save for then can show the information
     * in the admin panel and the mobile app
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $("#save_news").submit(function(){
        var band = 0;

        if($("#sucursalNews").val() == 0 || $("#sucursalNews").val() == '0'){
            $("#sucursalNews").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#sucursalNews").css("border", "1px solid #ADA9A5");
        }

        if($("#sucursalNewsRes").val() == 0 || $("#sucursalNewsRes").val() == '0'){
            $("#sucursalNewsRes").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#sucursalNewsRes").css("border", "1px solid #ADA9A5");
        }

        if($("#newsTitle").val() == ''){
            $("#newsTitle").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#newsTitle").css("border", "1px solid #ADA9A5");
        }

        if($("#imagenNews").val() == ''){
            $("#imagenNews").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#imagenNews").css("border", "1px solid #ADA9A5");
        }

        if($("#textNews").val() == ''){
            $("#textNews").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#textNews").css("border", "1px solid #ADA9A5");
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

    $("#edit_news").submit(function(){
        var band = 0;

        if($("#newsTitle").val() == ''){
            $("#newsTitle").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#newsTitle").css("border", "1px solid #ADA9A5");
        }

        if($("#imagenNews").val() == '' && $("#imagen_news_data").html().trim() == ''){
            $("#imagenNews").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#imagenNews").css("border", "1px solid #ADA9A5");
        }

        if($("#textNews").val() == ''){
            $("#textNews").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#textNews").css("border", "1px solid #ADA9A5");
        }

        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : editNews
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
