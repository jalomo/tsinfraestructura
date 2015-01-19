

<script>
$(function() {
	
	$("#crea_factura").submit(function(){
        var band = 0;

        if($("#facturaProveedor").val() == ''){
            $("#facturaProveedor").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaProveedor").css("border", "1px solid #ADA9A5");
        }

        if($("#facturaNo").val() == 0 || $("#sucursalNewsRes").val() == '0'){
            $("#facturaNo").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaNo").css("border", "1px solid #ADA9A5");
        }

        if($("#facturaFecha").val() == ''){
            $("#facturaFecha").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaFecha").css("border", "1px solid #ADA9A5");
        }

        
        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
            return false;
        }
        else{
           /* $("#errorMessage").hide();
            var opt = {
                success : factura_new
            }
            $(this).ajaxSubmit(opt);
            return false;*/
        }
    });
	
	
	
	
});

function factura_new(id_factura){
   
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
	$("#crea_factura").hide();
	$("#muestra_datos").show();
	 url = $("#get_id").attr('href');
		value_json = $.ajax({
               type: "GET",
               url:url+"/"+id_factura,
               async: false,
			   dataType: "json",
			    success: function(data){
					if(data==0){
						
					}else{
						
						$("#proveedor_").text(data.facturaProveedor);
						$("#nofa_").text(data.facturaNo);
						$("#fecha_").text(data.facturaFecha);
						$("#id_fac").text(data.facturaId);
											 
					} 
				 }
               }).responseText;
	
	
	
	
	
}
</script>

<?php echo anchor('companies/get_datos_factura/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
<div style="float:left;">
<div id="errorMessage" style="color: #FF0000; display: none"></div>
<div id="successMessage" style="color: #FF0000; display: none">datos guardados exitosamente.</div>
	<?php echo form_open('companies/agrega_factura_producto/', array('id'=>'crea_factura')); ?>	
        <input type="text" placeholder="proveedor" name="factura[facturaProveedor]" id="facturaProveedor"/>
        <br/>
        <input type="text" placeholder="no. factura" name="factura[facturaNo]" id="facturaNo"/>
        <br/>
        <input type="text" placeholder="fecha de compra" name="factura[facturaFecha]" id="facturaFecha"/>
        <br/>
        
        <div>
        <button type="submit">guardar</button>
        </div>
     <?php echo form_close(); ?>  
     
     


 </div>    

</div>
 