//FILE WHERE THE SYSTEM GOING TO USE
//FOR CAN MANIPULATE THE INFORMATION ABOUT
//THE BANNERS MODULE

/**
 * Event that need the system for can load the information
 * and can make the process about the forms library and
 * can make another events required in the system
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
$(document).ready(function(){

    //LOAD THE LIBRARY FORM
   // $.getScript('../../statics/js/libraries/form.js');
   
    $("#options_tournament").show();

    /**
     * Event created for know about the images that 
     * try to show the information for add more images 
     * once the user click in the add button
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $("#add_more_images").click(function(event){
        event.preventDefault();
        parcial = $("#total").val();
        total = parseInt(parcial) + 1;
		if(total==3){$("#add_more_images").hide();}
        $("#total").val(total);
        html = "<span style='padding-left: 185px' class='dinamicas'>" +
                    "<input type='file' name='imagen_multiples"+total+"' id='image"+total+"' class='images' onchange='return image_values();' />" +
               "</span><br />";
        $("#addImagesDinamic").append(html);
        $("#add_images").hide();
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
     * Event that need to for check all the values and can
     * know whats the div will show and appear once click in
     * the radio button specific, for the value
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $(".radios_banners").change(function(event){
        event.preventDefault();
        val = $(event.currentTarget).val();

        if(val == 1)
        {
            $("#secciones_form").slideUp('slow');
            $("#secciones_banners").slideDown('slow');
            $("#radios_values").val(1);
            $("#image_single").val('');
        }
        else{
            $("#secciones_banners").slideUp('slow');
            $("#secciones_form").slideDown('slow');
            $("#radios_values").val(0);
            $("#image1").val('');
            $(".dinamicas").remove();
            $("#total").val(1);
        }
    });

    /**
     * Event for check the values of the images once click in the values
     * and can know if the system accept the transaction of the
     * image or need to change for can upload
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $(".images").bind('change', function(){
        var data = new FormData();
        total = $("#total").val();
        $.each($("#image"+total)[0].files, function(i, files){
            data.append('imagen'+i, files);
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

    /**
     * Event for check the data of the image but in this
     * case need to check just the single image and can know
     * if the value is correct or not
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $("#image_single").bind('change', function(){
        var data = new FormData();
        $.each($("#image_single")[0].files, function(i, file){
            data.append('imagen'+i, file);
        });

        values = $.ajax({
                    url : $("#url_second").attr('href'),
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    async: false
                 }).responseText;
        if(values == 1 || values == '1')
        {
            $("#error_single").hide();
            $(".boton_section_two").show();
        }
        else{
            $(".boton_section_two").hide();
            $("#error_single").text('Por favor, verifique las medidas de las imagenes.').show();
        }
    });

    /**
     * Event that send the data to the server for can
     * check what is the form that need to validate and can know
     * waht is the images to send to the server
     *
     * @return void
     * @author blackfoxgdl <ruben.alonso21@gmail.com>
     **/
    $("#createBanners").submit(function(){
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

        if($("#radios_values").val() == 1 || $("#radios_values").val() == '1'){
            if($("#image1").val() == '')
            {
                $("#image1").css({'border':'1px solid #FF0000'});
                band++;
            }
            else
            {
                $("#image1").css({'border':'1px solid #ADA9A5'});
            }
        }
        else{
            if($("#image_single").val() == '')
            {
                $("#image_single").css({'border':'1px solid #FF0000'});
                band++;
            }
            else
            {
                $("#image_single").css({'border':'1px solid #ADA9A5'});
            }
        }

        if(band != 0)
        {
            $("#errorMessage").text('Por favor verifique los campos marcados').show();
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : saveBanners
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });
});

/**
 * Function that execute once press the button
 * and pass the first step correctly, so just executes
 * this function for finish the process
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function saveBanners()
{
    $("#image1").val('');
    $("#addImagesDinamic").remove();
    $("#image_single").val('');
    $("#successMessage").fadeIn(1000);
    $("#successMessage").fadeOut(2500);
}

/**
 * Function that executes all the values once click in
 * the button that try to send the information to server
 * for check all the values and can know if really the image
 * going to be acepted or not
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function image_values()
{
    var data = new FormData();
        total = $("#total").val();
        $.each($("#image"+total)[0].files, function(i, files){
            data.append('imagen'+i, files);
        });

        values = $.ajax({
                            url : $("#banners_dinamic").attr('href'),
                            data : data,
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
        $("#error_multiple").text('Por favor verifique las medidas de la imagen.').show();
        $("#button_save_section").hide();
    }
}
