$(document).ready(function(){
    
   $("#facturaImporteIva").val($("#facturaCantidad").val()*$("#facturaImporte").val());
   
    $("#save_proyecto").submit(function(){
        var band = 0;
	
        if($("#proyectoNombreCliente").val() =='' ){
            $("#proyectoNombreCliente").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoNombreCliente").css("border", "1px solid #ADA9A5");
        }
		
		 if($("#proyectoNombre").val() =='' ){
            $("#proyectoNombre").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoNombre").css("border", "1px solid #ADA9A5");
        }
		
		if($("#datepicker").val() =='' ){
            $("#datepicker").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#datepicker").css("border", "1px solid #ADA9A5");
        }
		
		if($("#proyectoImporte").val() =='' ){
            $("#proyectoImporte").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoImporte").css("border", "1px solid #ADA9A5");
        }
		
		if($("#proyectoNo").val() =='' ){
            $("#proyectoNo").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoNo").css("border", "1px solid #ADA9A5");
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
	
	
	
	
	
	 $("#edita_proyecto").submit(function(){
        var band = 0;
	
        if($("#proyectoNombreCliente1").val() =='' ){
            $("#proyectoNombreCliente1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoNombreCliente1").css("border", "1px solid #ADA9A5");
        }
		
		 if($("#proyectoNombre1").val() =='' ){
            $("#proyectoNombre1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoNombre1").css("border", "1px solid #ADA9A5");
        }
		
		if($("#datepicker1").val() =='' ){
            $("#datepicker1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#datepicker1").css("border", "1px solid #ADA9A5");
        }
		
		if($("#proyectoImporte1").val() =='' ){
            $("#proyectoImporte1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoImporte").css("border", "1px solid #ADA9A5");
        }
		
		if($("#proyectoNo1").val() =='' ){
            $("#proyectoNo1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#proyectoNo1").css("border", "1px solid #ADA9A5");
        }
		
		

        
        if(band != 0){
            $("#errorMessage1").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage1").hide();
            var opt = {
                success : newNews1
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });

	
	
	 $(".eliminar").click(function(event){
        event.preventDefault();
        $.confirm({
                    'title'     : 'Eliminar proyecto',
                    'message'   : 'Desea eliminar el proyecto seleccionado?',
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
	
	
	
	
	
	
	$("#agregar_factura").submit(function(){
        var band = 0;
	
        if($("#facturaProveedor").val() =='' ){
            $("#facturaProveedor").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaProveedor").css("border", "1px solid #ADA9A5");
        }
		
		 if($("#facturaNo").val() =='' ){
            $("#facturaNo").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaNo").css("border", "1px solid #ADA9A5");
        }
		
		/*if($("#facturaDescripcion").val() =='' ){
            $("#facturaDescripcion").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaDescripcion").css("border", "1px solid #ADA9A5");
        }
		
		if($("#facturaCantidad").val() =='' ){
            $("#facturaCantidad").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaCantidad").css("border", "1px solid #ADA9A5");
        }
		
		if($("#facturaMedida").val() =='' ){
            $("#facturaMedida").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaMedida").css("border", "1px solid #ADA9A5");
        }
		
		if($("#facturaImporte").val() =='' ){
            $("#facturaImporte").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaImporte").css("border", "1px solid #ADA9A5");
        }
		*/
		if($("#datepicker").val() =='' ){
            $("#datepicker").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#datepicker").css("border", "1px solid #ADA9A5");
        }
		
		/*if($("#facturaImporteIva").val() =='' ){
            $("#facturaImporteIva").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaImporteIva").css("border", "1px solid #ADA9A5");
        }
		
		*/

        
        if(band != 0){
            $("#errorMessage1").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage1").hide();
            var opt = {
                success : newNews1
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });
	
	
   
});

/**
 *
 **/
function newNews(){
 
    
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
	location.reload();
}


function newNews1(){
 
    
    $("#successMessage1").fadeIn(1500);
    $("#successMessage1").fadeOut(3500);
	location.reload();
}

function editNews(){
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
}

function exito(opt){
	
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
}
