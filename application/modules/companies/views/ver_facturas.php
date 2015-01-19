<style>
.oculta_prod{
	 display: none;	
}
</style>

<?php echo link_tag('statics/css/ver_facturas.css'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>

$(function() {
    $( "#datepicker" ).datepicker();
	$( "#datepicker1" ).datepicker();
	$(".edita_").click(function(event){
        event.preventDefault();
		id = $(event.currentTarget).attr('id');
		
		 url = $("#get_id").attr('href');
		value_json = $.ajax({
               type: "GET",
               url:url+"/"+id,
               async: false,
			   dataType: "json",
			    success: function(data){
					if(data==0){
						
						}
						else{
						
						$("#facturaId").val(data.facturaId);
						$("#facturaProveedor").val(data.facturaProveedor);
						$("#facturaNo").val(data.facturaNo);
						$("#facturaDescripcion").val(data.facturaDescripcion);
						$("#facturaCantidad").val(data.facturaCantidad);
						$("#facturaMedida").val(data.facturaMedida);
						$("#facturaImporte").val(data.facturaImporte);
						$("#datepicker").val(data.facturaFecha);
						$("#facturaImporteIva").val(data.facturaImporteIva);
						
						
													 
													 
							} 
				   }
               }).responseText;
			   
			   function genera_lote(){
					cantidad=$('#facturaCantidad').val();
					precio=$('#facturaImporte').val();
					$('#facturaImporteIva').val(cantidad*precio);
					
				}
		
		
       document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'
    });
	
	
	 $(".eliminar").click(function(event){
        event.preventDefault();
        $.confirm({
                    'title'     : 'Eliminar factura',
                    'message'   : 'Desea eliminar la factura seleccionada?',
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
		
		if($("#facturaDescripcion").val() =='' ){
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
		
		if($("#datepicker").val() =='' ){
            $("#datepicker").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#datepicker").css("border", "1px solid #ADA9A5");
        }
		
		if($("#facturaImporteIva").val() =='' ){
            $("#facturaImporteIva").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#facturaImporteIva").css("border", "1px solid #ADA9A5");
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
	
	
	 $(".ver_productos").click(function(event){
        event.preventDefault();
       id = $(event.currentTarget).attr('id');
        $("#ver_prod"+id).toggle('slow');
    });
	
	
	
	$(".agregar_").click(function(event){
        event.preventDefault();
		aux_indice++;
		
		id = $(event.currentTarget).attr('id');
        $( "#users"+id+" tbody" ).append( '<tr id="prod_'+aux_indice+'">' +
								  ' '+
								  '<td><input type="text"  placeholder="Nombre producto" name="productos[productoNombre]" id="productoNombre'+id+''+aux_indice+'" /></td>' +
								  ' <td><input type="text"  placeholder="Cantidad" name="productos[productoCantidad]" onkeypress="return justNumbers(event);" onchange="genera_loteN2('+id+''+aux_indice+')" id="productoCantidad'+id+''+aux_indice+'"/></td>' +
								  '<td><input type="text"  placeholder="Medida" name="productos[productoMedida]" id="productoMedida'+id+''+aux_indice+'" /></td>' +
								  '<td><input type="text"  placeholder="Precio" name="productos[productoPrecio]" onchange="genera_loteN2('+id+''+aux_indice+')" onkeypress="return justNumbers(event);" id="productoPrecio'+id+''+aux_indice+'"/></td>' +
								  '<td><input type="text"  placeholder="Total" name="productos[productoTotal]" onkeypress="return justNumbers(event);" id="productoTotal'+id+''+aux_indice+'"/></td>' +
								  '<td><img id="'+aux_indice+'"  class="delete_prod" alt="" style="cursor:pointer;" src="<?php echo base_url();?>/statics/img/bt_eliminar.png">| <a href="#" onclick="agrega_producto('+id+','+aux_indice+')" id="'+id+'">guardar</a></td>' +
								  
								  '<input type="hidden" value="'+id+'" name="productos[productoIdFactura]" id="productoIdFactura'+id+''+aux_indice+'"  />'+
								  ''+
								'</tr>' );
								
								$(".delete_prod").click(function(event){
									event.preventDefault();
									id = $(event.currentTarget).attr('id');
									 $('#prod_'+id).remove();
								});
    });
	aux_indice=1;
	
	
	
  });
  
 function  agrega_producto(id,indice){
		url = $("#add_prod_id").attr('href');
	value_json = $.ajax({
               type: "POST",
               url:url,
               async: false,
			  data:{
				productoIdFactura:$("#productoIdFactura"+id+indice).val(),
			   productoTotal:$("#productoTotal"+id+indice).val(),
			   productoPrecio:$("#productoPrecio"+id+indice).val(),
			   productoMedida:$("#productoMedida"+id+indice).val(),
			   productoCantidad:$("#productoCantidad"+id+indice).val(),
			   productoNombre:$("#productoNombre"+id+indice).val()
			},
        	   dataTypeString:'html',
			    success: function(data){
					
					if(data!=0){
						alert("producto agregado correctamente.");
						}
						else{
						} 
				   }
               }).responseText;	
			   
			   
			   alert();
	}
  
  function newNews1(){
 
    
    $("#successMessage1").fadeIn(1500);
    $("#successMessage1").fadeOut(3500);
	location.reload();
}
  
/*  function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
}*/

var nav4 = window.Event ? true : false;
function justNumbers(evt){
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav4 ? evt.which : evt.keyCode;
//alert(key);
return (key <= 13 || (key >= 48 && key <= 57) || key == 46  || key == 0);
}

function genera_lote(){
	cantidad=$('#facturaCantidad').val();
	precio=$('#facturaImporte').val();
	$('#facturaImporteIva').val(cantidad*precio);
	
}

function genera_loteN2(id){
	cantidad=$('#productoCantidad'+id).val();
	precio=$('#productoPrecio'+id).val();
	$('#productoTotal'+id).val(cantidad*precio);
	
}

function edita_producto(idPoducto,ifactura){

	url = $("#edita_producto_").attr('href');
	value_json = $.ajax({
               type: "POST",
               url:url+"/"+idPoducto,
               async: false,
			  data:$('#form_'+idPoducto+ifactura).serialize(),
        	   dataTypeString:'html',
			    success: function(data){
					
					if(data!=0){
						alert('producto editado correctamente.');
						}
						else{
						} 
				   }
               }).responseText;	
	
	
}

function elimina_producto(idPoducto){

	url = $("#elim_producto_").attr('href');
	value_json = $.ajax({
               type: "GET",
               url:url+"/"+idPoducto,
               async: false,
			  //data:$('#form_'+idPoducto+ifactura).serialize(),
        	   dataTypeString:'html',
			    success: function(data){
					
					if(data!=0){
						$("#prod_1"+idPoducto).hide();
						}
						else{
						} 
				   }
               }).responseText;	
	
	
}


function save_rubro(id_factura){
	
	
	rubro=$("#rubro_"+id_factura).val();
	periodo=$("#periodo_"+id_factura).val();
	
	url = $("#edita_rubros").attr('href');
	value_json = $.ajax({
               type: "GET",
               url:url+"/"+rubro+'/'+periodo+'/'+id_factura,
               async: false,
			  //data:$('#form_'+idPoducto+ifactura).serialize(),
        	   dataTypeString:'html',
			    success: function(data){
					alert('Rubro y periodo actualizado.');
					
				   }
               }).responseText;	
	
}
</script>
<div style="float:left">
 <?php echo anchor('companies/update_facturas/', '', array('id'=>'edita_rubros', 'style'=>'display: none')); ?>
 <?php echo anchor('companies/edita_factura/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
 <?php echo anchor('companies/edita_prudcto/', '', array('id'=>'edita_producto_', 'style'=>'display: none')); ?>
  <?php echo anchor('companies/elimina_pro/', '', array('id'=>'elim_producto_', 'style'=>'display: none')); ?>
   <?php echo anchor('companies/guardar_producto_id/', '', array('id'=>'add_prod_id', 'style'=>'display: none')); ?>
 
<table width="100%" border="0">
  <tr>
    <td>
    

            </td>
            <td>
            	<div style="width:100px;"><?php echo $nombre_usuario;?><br/></div>
            </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td>
     <div align="center" style="background:#e7ebed">
    		<table width="900" border="0" bgcolor="#e7ebed">
              <tr>
                <td width="400">
                    <div class="font-helvetica proyec"><?php echo $proyecto->proyectoNombreCliente?></div>
                    <div class="font-helvetica pedido">Pedido:<?php echo $proyecto->proyectoNo?></div>
                    <div class="font-helvetica nombre"><?php echo $proyecto->proyectoNombre?></div>
                </td>
                <td>
                    <div class="font-helvetica pedido">Fecha de liberacion:<?php echo $proyecto->proyectoLiberacion?></div>
                    <div class="font-helvetica pedido">Importe sin iva:$<?php echo number_format($proyecto->proyectoImporte, 2);?></div>
                    
                    <div class="font-helvetica pedido">TOTAL FACTURAS SIN IVA:$<?php echo number_format($this->Company->total_facturas_iva($proyecto->proyectoId), 2);?></div>
                </td>
                <td>
                   
                 <?php echo anchor('companies/excel_proyecto_facturas/'.$proyecto->proyectoId, img(array('src'=>'statics/img/icono_excel.jpg',
                                 'width'=>'50px',)), array('id'=>'', 'style'=>'')); ?>
                                                          
                                               
                </td>
              </tr>
              
            </table>
                 
	</div>
    <br/>
    	
    </td>
  </tr>
  <tr>
    <td>
    
    	<div id="load_proyectos" align="center">
         <div class="font-helvetica label_p" align="center">
       	 Facturas:
       </div> 
        
        <?php if($facturas!=0):?>
         <?php $i = 1; ?>
        <?php foreach($facturas as $factura):?>
        <?php if($i%2 != 0): ?>
        		
              <div id="eliminar<?php echo $factura->facturaId; ?>" style="background:#EAEAEA">
            <table width="900" border="0">
              <tr>
                <td width="400">
                    <div class="font-helvetica proyec">Proveedor:<?php echo $factura->facturaProveedor?></div>
                    
                </td>
                <td>
                    
                </td>
                <td>
                <div class="font-helvetica pedido">Factura:<?php echo $factura->facturaNo?></div>
              
                    <div class="font-helvetica nombre">Fecha:<?php echo $factura->facturaFecha?></div>
                
                
                                            
                </td>
              </tr>
              <tr>
              	<td colspan="3" align="right">
                <?php 
					$rubros=$this->Company->get_rubros($proyecto->proyectoId);
					$periodos=$this->Company->get_periodos($proyecto->proyectoId);
				?>
                Rubro: <?php echo $this->Company->get_name_rubro($factura->facturaIdRubro);?>
                <?php /*if($rubros!=0):?>
                <select id="rubro_<?php echo $factura->facturaId;?>">
                	<option value="0">sin rubro</option>
                	<?php foreach($rubros as $rubro):?>
                    	<?php if($rubro->rubroId==$factura->facturaIdRubro):?>
                        <option value="<?php echo $rubro->rubroId;?>" selected="selected"><?php echo $rubro->rubroNombre;?></option>
                        <?php else:?>
                        <option value="<?php echo $rubro->rubroId;?>"><?php echo $rubro->rubroNombre;?></option>
                        <?php endif;?>
                    	
                    <?php endforeach;?>    
                </select>
                <?php else:?>
                sin rubros
                <?php endif;*/?>	
                
                Periodo: <?php echo $this->Company->get_name_periodo($factura->facturaPreriodoId);?>
                <?php /*if($periodos!=0):?>
                <select id="periodo_<?php echo $factura->facturaId;?>">
                <option value="0">sin periodo</option>
                	<?php foreach($periodos as $periodo):?>
                    <?php if($periodo->periodoId==$factura->facturaPreriodoId):?>
                    	<option value="<?php echo $periodo->periodoId;?>" selected="selected"><?php echo $periodo->periodoNombre;?></option>
                        <?php else:?>
                        <option value="<?php echo $periodo->periodoId;?>"><?php echo $periodo->periodoNombre;?></option>
                        <?php endif;?>
                    	
                    <?php endforeach;?>    
                </select>
                 <?php else:?>
                sin periodos
                <?php endif;*/?>	
                
                <?php /*if(($rubros!=0) && ($periodos!=0)):?>
                	<button type="button" onclick="save_rubro(<?php echo $factura->facturaId;?>)">guarda rubro/periodo</button>
                <?php endif;*/?>
                
                </td>
              </tr>
              
              <tr>
                <td colspan="3">
                 <?php if(get_status($this->session->userdata('id'))!=2 &&get_status($this->session->userdata('id'))!=3 ):?>
                   <?php /*echo anchor('companies/editar/',
                                      img(array('src'=>'statics/img/editar.png',
                                     'width'=>'50px',)),
                                      array('class'=>'font-helvetica proyec edita_','id'=>$factura->facturaId,'style'=>'text-decoration:none;',)); */?>
                                       
                       <a href="#" id="<?php echo $factura->facturaId;?>" class="ver_productos">ver productos</a>                
                    
                     <?php echo anchor('companies/eliminar_factura/'.$factura->facturaId,
                                      /*img(array('src'=>'statics/img/eliminar.png',
                                     'width'=>'30px',)),*/
									 'eliminar factura',
                                      array('class'=>'eliminar','id'=>'delete'.$factura->facturaId,'style'=>'text-decoration:none; color:RED' ,'flag'=>$factura->facturaId,)); ?>
                                                          
                  <?php endif;?>   
                   
                </td>
                </tr>
            </table>
            
            
            <div id="ver_prod<?php echo $factura->facturaId;?>" class="oculta_prod">
            
            	<table id="users<?php echo $factura->facturaId;?>" class="ui-widget ui-widget-content">
                    <thead>
                      <tr class="ui-widget-header ">
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>Precio sin IVA</th>
                        <th>Total sin IVA</th>
                         <th>
                         	<?php echo img(array('src'=>'statics/img/bt_agregar.png',
                                     'id'=>$factura->facturaId,'style'=>'cursor:pointer;', 'class'=>'agregar_')); ?>
                         
                         </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $facturas=$this->Company->get_productos_factura($factura->facturaId); ?>
                    <?php if($facturas!=0):?>
                    <?php foreach($facturas as $producto):?>
                    <form id="form_<?php echo $producto->productoId.$factura->facturaId?>" method="post" >
                      <tr id="prod_1<?php echo $producto->productoId?>">
                        <td><input type="text"  placeholder="Nombre producto" name="productos[productoNombre]" value="<?php echo $producto->productoNombre?>"/></td>
                        <td><input type="text"  placeholder="Cantidad" name="productos[productoCantidad]" value="<?php echo $producto->productoCantidad?>" onkeypress="return justNumbers(event);" /></td>
                        <td><input type="text"  placeholder="Medida" name="productos[productoMedida]" value="<?php echo $producto->productoMedida?>"/></td>
                        <td><input type="text"  placeholder="Precio" name="productos[productoPrecio]" value="<?php echo $producto->productoPrecio?>"onkeypress="return justNumbers(event);"/></td>
                        <td><input type="text"  placeholder="Total" name="productos[productoTotal]"  value="<?php echo $producto->productoTotal?>"onkeypress="return justNumbers(event);"/></td>
                        <input type="hidden" value="<?php echo $producto->productoId?>" name="idproducto" />
                        <td><a href="#" onclick="edita_producto(<?php echo $producto->productoId?>,<?php echo $factura->facturaId;?>)">editar</a>| <a href="#" onclick="elimina_producto(<?php echo $producto->productoId?>)">eliminar</a></td>
                       
                       
                      </tr>
                      
                      </form>
                     <?php endforeach;?>
                    <?php endif;?>  
                    </tbody>
                  </table>
            </div>
            
            
            
            
             <hr/>
            
            
            
            </div>
        	
        
        
            <!--div id="eliminar<?php echo $factura->facturaId; ?>">
            <table width="900" border="0">
              <tr>
                <td width="400">
                    <div class="font-helvetica proyec">Proveedor:<?php echo $factura->facturaProveedor?></div>
                    <div class="font-helvetica pedido">Factura:<?php echo $factura->facturaNo?></div>
                    <div class="font-helvetica nombre">Cantidad:<?php echo $factura->facturaCantidad?></div>
                    <div class="font-helvetica nombre">Medida:<?php echo $factura->facturaMedida?></div>
                    <div class="font-helvetica nombre">Fecha:<?php echo $factura->facturaFecha?></div>
                </td>
                <td>
                    <div class="font-helvetica pedido">Importe:<?php echo number_format($factura->facturaImporteIva, 2);?></div>
                    <div class="font-helvetica pedido">Importe sin iva:$<?php echo number_format($factura->facturaImporte, 2);?></div>
                    
                    <div class="font-helvetica pedido">Descripcion:<?php echo $factura->facturaDescripcion;?></div>
                </td>
                <td>
                   <?php if(get_status($this->session->userdata('id'))!=2 &&get_status($this->session->userdata('id'))!=3 ):?>
                   <?php echo anchor('companies/editar/',
                                      img(array('src'=>'statics/img/editar.png',
                                     'width'=>'50px',)),
                                      array('class'=>'font-helvetica proyec edita_','id'=>$factura->facturaId,'style'=>'text-decoration:none;',)); ?>
                                       
                                       
                    
                     <?php echo anchor('companies/eliminar_factura/'.$factura->facturaId,
                                      img(array('src'=>'statics/img/eliminar.png',
                                     'width'=>'50px',)),
                                      array('class'=>'eliminar','id'=>'delete'.$factura->facturaId,'style'=>'text-decoration:none;' ,'flag'=>$factura->facturaId,)); ?>
                                                          
                  <?php endif;?>                             
                </td>
              </tr>
              <tr>
                <td colspan="3">
                    <?php echo img(array('src'=>'statics/img/linea.png')); ?>   
                </td>
                </tr>
            </table>
            </div-->
            
            
            
      
             <?php else: ?>
             
             
             			  <div id="eliminar<?php echo $factura->facturaId; ?>" style="background:#FFF">
             <table width="900" border="0">
              <tr>
                <td width="400">
                    <div class="font-helvetica proyec">Proveedor:<?php echo $factura->facturaProveedor?></div>
                    
                </td>
                <td>
                    
                </td>
                <td>
                <div class="font-helvetica pedido">Factura:<?php echo $factura->facturaNo?></div>
              
                    <div class="font-helvetica nombre">Fecha:<?php echo $factura->facturaFecha?></div>
                
                
                                            
                </td>
              </tr>
              <tr>
                <td colspan="3" align="right">
                <?php 
          $rubros=$this->Company->get_rubros($proyecto->proyectoId);
          $periodos=$this->Company->get_periodos($proyecto->proyectoId);
        ?>
                Rubro: <?php echo $this->Company->get_name_rubro($factura->facturaIdRubro);?>
                <?php /*if($rubros!=0):?>
                <select id="rubro_<?php echo $factura->facturaId;?>">
                  <option value="0">sin rubro</option>
                  <?php foreach($rubros as $rubro):?>
                      <?php if($rubro->rubroId==$factura->facturaIdRubro):?>
                        <option value="<?php echo $rubro->rubroId;?>" selected="selected"><?php echo $rubro->rubroNombre;?></option>
                        <?php else:?>
                        <option value="<?php echo $rubro->rubroId;?>"><?php echo $rubro->rubroNombre;?></option>
                        <?php endif;?>
                      
                    <?php endforeach;?>    
                </select>
                <?php else:?>
                sin rubros
                <?php endif;*/?>  
                
                Periodo: <?php echo $this->Company->get_name_periodo($factura->facturaPreriodoId);?>
                <?php /*if($periodos!=0):?>
                <select id="periodo_<?php echo $factura->facturaId;?>">
                <option value="0">sin periodo</option>
                  <?php foreach($periodos as $periodo):?>
                    <?php if($periodo->periodoId==$factura->facturaPreriodoId):?>
                      <option value="<?php echo $periodo->periodoId;?>" selected="selected"><?php echo $periodo->periodoNombre;?></option>
                        <?php else:?>
                        <option value="<?php echo $periodo->periodoId;?>"><?php echo $periodo->periodoNombre;?></option>
                        <?php endif;?>
                      
                    <?php endforeach;?>    
                </select>
                 <?php else:?>
                sin periodos
                <?php endif;*/?>  
                
                <?php /*if(($rubros!=0) && ($periodos!=0)):?>
                  <button type="button" onclick="save_rubro(<?php echo $factura->facturaId;?>)">guarda rubro/periodo</button>
                <?php endif;*/?>
                
                </td>
              </tr>
              
              <tr>
                <td colspan="3">
                 <?php if(get_status($this->session->userdata('id'))!=2 &&get_status($this->session->userdata('id'))!=3 ):?>
                   <?php /*echo anchor('companies/editar/',
                                      img(array('src'=>'statics/img/editar.png',
                                     'width'=>'50px',)),
                                      array('class'=>'font-helvetica proyec edita_','id'=>$factura->facturaId,'style'=>'text-decoration:none;',)); */?>
                                       
                       <a href="#" id="<?php echo $factura->facturaId;?>" class="ver_productos">ver productos</a>                
                    
                     <?php echo anchor('companies/eliminar_factura/'.$factura->facturaId,
                                      /*img(array('src'=>'statics/img/eliminar.png',
                                     'width'=>'30px',)),*/
                   'eliminar factura',
                                      array('class'=>'eliminar','id'=>'delete'.$factura->facturaId,'style'=>'text-decoration:none; color:RED' ,'flag'=>$factura->facturaId,)); ?>
                                                          
                  <?php endif;?>   
                   
                </td>
                </tr>
            </table>
            
            
            <div id="ver_prod<?php echo $factura->facturaId;?>" class="oculta_prod">
            
            	<table id="users<?php echo $factura->facturaId;?>" class="ui-widget ui-widget-content">
                    <thead>
                      <tr class="ui-widget-header ">
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>Precio sin IVA</th>
                        <th>Total sin IVA</th>
                         <th>
                         	<?php echo img(array('src'=>'statics/img/bt_agregar.png',
                                     'id'=>$factura->facturaId,'style'=>'cursor:pointer;', 'class'=>'agregar_')); ?>
                         
                         </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $facturas=$this->Company->get_productos_factura($factura->facturaId); ?>
                    <?php if($facturas!=0):?>
                    <?php foreach($facturas as $producto):?>
                    <form id="form_<?php echo $producto->productoId.$factura->facturaId?>" method="post" >
                      <tr id="prod_1<?php echo $producto->productoId?>">
                        <td><input type="text"  placeholder="Nombre producto" name="productos[productoNombre]" value="<?php echo $producto->productoNombre?>"/></td>
                        <td><input type="text"  placeholder="Cantidad" name="productos[productoCantidad]" value="<?php echo $producto->productoCantidad?>" onkeypress="return justNumbers(event);" /></td>
                        <td><input type="text"  placeholder="Medida" name="productos[productoMedida]" value="<?php echo $producto->productoMedida?>"/></td>
                        <td><input type="text"  placeholder="Precio" name="productos[productoPrecio]" value="<?php echo $producto->productoPrecio?>"onkeypress="return justNumbers(event);"/></td>
                        <td><input type="text"  placeholder="Total" name="productos[productoTotal]"  value="<?php echo $producto->productoTotal?>"onkeypress="return justNumbers(event);"/></td>
                        <input type="hidden" value="<?php echo $producto->productoId?>" name="idproducto" />
                        <td><a href="#" onclick="edita_producto(<?php echo $producto->productoId?>,<?php echo $factura->facturaId;?>)">editar</a>| <a href="#" onclick="elimina_producto(<?php echo $producto->productoId?>)">eliminar</a></td>
                       
                       
                      </tr>
                      
                      </form>
                     <?php endforeach;?>
                    <?php endif;?>  
                    </tbody>
                  </table>
            </div>
            
            
            
            
             <hr/>
            
            
            
            </div>
        	
             
             
             
             
             
             
             
             
             
             
             <?php endif; ?>
             <?php $i++; ?>
            
          <?php endforeach;?> 
          <?php endif;?> 
        </div>	
        
    </td>
  </tr>
 
</table>



 <div id="fade1" class="overlay" onclick = "document.getElementById('editar1').style.display='none';document.getElementById('fade1').style.display='none'"></div>
<!-- fin base semi-transparente -->
 
<!-- ventana modal -->  
	<div id="light1" class="modal" style=" background:#ecf0f1;">
    	<!--a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">cerrar</a-->
       <div align="center"> 
	   	<?php echo img(array('src'=>'statics/img/icono_proyecto.png',
                                     'width'=>'100px',)); ?>
       </div> 
       <div class="font-helvetica label_p" align="center">
       	Editar factura
       </div> 
       
        <?php echo form_open('companies/edita_factura_id/', array('id'=>'agregar_factura')); ?>
        <div id="errorMessage1" style="color: #FF0000; display: none"></div>
        <div id="successMessage1" style="color: #FF0000; display: none">datos guardados exitosamente.</div>
       <table width="70%" border="0" align="center">
          <tr>
            <td align="center">
            	<div class="font-helvetica tamano_" align="left">Proveedor</div>
                <div align="left"><input type="text" style="width:300px; height:30px;" name="factura[facturaProveedor]" id="facturaProveedor"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">No. Factura</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaNo]" id="facturaNo"/></div>
            </td>
          </tr>
          <tr>
            <td>
            	<div class="font-helvetica tamano_">Descripción</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaDescripcion]" id="facturaDescripcion"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">Cantidad</div>
                <div><input type="text" style="width:300px; height:30px;"  name="factura[facturaCantidad]" id="facturaCantidad" onkeypress="return justNumbers(event);" onchange="genera_lote()"/></div>
            </td>
          </tr>
           <tr>
            <td>
            	<div class="font-helvetica tamano_">Unidad de medida</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaMedida]" id="facturaMedida" /></div>
                
                <input type="hidden"  id="facturaId" name="facturaId"/>
                
            </td>
            <td>
            	
            </td>
          </tr>
          
          
          
          <tr>
            <td>
            	<div class="font-helvetica tamano_">Importe sin IVA</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaImporte]" id="facturaImporte" onkeypress="return justNumbers(event);" onchange="genera_lote()" /></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">Fecha de compra</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaFecha]" id="datepicker"/></div>
            </td>
          </tr>
          
          <tr>
            <td>
            	<div class="font-helvetica tamano_">Importe</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaImporteIva]" id="facturaImporteIva" onkeypress="return justNumbers(event);"/></div>
            </td>
            <td>
            	
            </td>
          </tr>
          
          
          
          
          
         
          <tr>
            <td align="center">
            	<a href = "javascript:void(0)" onclick = "document.getElementById('light1').style.display='none';document.getElementById('fade1').style.display='none'"><button style="background:#bdc3c7; color:#fff; font-size:15px; width:200px; height:30px;" type="button">Cancelar</button></a>
            </td>
            <td align="center">
            	<button style="background:#3498db; color:#fff; font-size:15px; width:200px; height:30px;" type="submit">Guardar</button>
            </td>
          </tr>
        </table>
       <?php echo form_close(); ?>                     
    </div>
<!-- fin ventana modal -->
            
</div>