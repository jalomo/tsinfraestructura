<style>
.myButton {
	-moz-box-shadow: 0px 10px 14px -7px #276873;
	-webkit-box-shadow: 0px 10px 14px -7px #276873;
	box-shadow: 0px 10px 14px -7px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3498db), color-stop(1, #3498db));
	background:-moz-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:-webkit-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:-o-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:-ms-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:linear-gradient(to bottom, #3498db 5%, #3498db 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3498db', endColorstr='#3498db',GradientType=0);
	background-color:#3498db;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:20px;
	font-weight:bold;
	padding:13px 32px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3d768a;
}
.myButton1 {
	-moz-box-shadow: 0px 10px 14px -7px #bec6c9;
	-webkit-box-shadow: 0px 10px 14px -7px #bec6c9;
	box-shadow: 0px 10px 14px -7px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bec6c9), color-stop(1, #bec6c9));
	background:-moz-linear-gradient(top, #bec6c9 5%, #bec6c9 100%);
	background:-webkit-linear-gradient(top, #bec6c9 5%, #bec6c9 100%);
	background:-o-linear-gradient(top, #3498db 5%, #bec6c9 100%);
	background:-ms-linear-gradient(top, #bec6c9 5%, #bec6c9 100%);
	background:linear-gradient(to bottom, #bec6c9 5%, #bec6c9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3498db', endColorstr='#3498db',GradientType=0);
	background-color:#bec6c9;
	-moz-border-radius:8px;
	-webkit-border-radius:8px;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:arial;
	font-size:20px;
	font-weight:bold;
	padding:13px 32px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3d768a;
}

.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #3498db), color-stop(1, #3498db));
	background:-moz-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:-webkit-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:-o-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:-ms-linear-gradient(top, #3498db 5%, #3498db 100%);
	background:linear-gradient(to bottom, #3498db 5%, #3498db 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#3498db', endColorstr='#3498db',GradientType=0);
	background-color:#3498db;
}
.myButton:active {
	position:relative;
	top:1px;
}

.proyec{
	font-size:20px;
	color:#2c3e50;
	}
.pedido{
	font-size:15px;
	color:#7f8c8d;
	}	
	
.nombre{
	font-size:20px;
	color:#3498db;
	}	
	
	
	
.overlay{
     display: none;
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background: #000;
     z-index:1001;
     opacity:.50;
     -moz-opacity: 0.75;
     filter: alpha(opacity=75);
}

.modal {
     display: none;
     position: absolute;
     top: 25%;
     left: 25%;
     width: 50%;
     height: 50%;
     padding: 16px;
     background: #fff;
     color: #333;
     z-index:1002;
     overflow: auto;
}	


.label_p {
    
    font-size: 25pt;
	color:#bdc2c6;
}
.tamano_{
	font-size:20px;
	color:#7f8c8d;}	
</style>
<!--link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"-->
<?php echo link_tag('statics/css/jquery-ui.css'); ?>
        <script type="text/javascript" src="<?php echo base_url().'statics/js/libraries/jquery-ui.js'; ?>"></script>
  
  <!--script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script-->
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
						
						 $("#proyectoId").val(data.proyectoId);
						
							url = $("#get_rubro").attr('href');
							value_json = $.ajax({
								   type: "GET",
								   url:url+"/"+data.proyectoId,
								   async: false,
								   dataType: "html",
									success: function(data){
										if(data==0){
											
											}
											else{
											
											$("#carga_rubros").html(data);
											
											
																		 
																		 
												} 
									   }
								   }).responseText;
													 
													 
						} 
				   }
               }).responseText;
		
		
       document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'
    });

	
	$(".agregar_").click(function(event){
        event.preventDefault();
		aux_indice++;
		aux_radom=Math.floor((Math.random() * 1000) + 1);
        $( "#users tbody" ).append( '<tr id="prod_'+aux_indice+'">' +
								  '<td><input type="text"  placeholder="Nombre producto" name="productos[productoNombre][]"/></td>' +
								  ' <td><input type="text"  placeholder="Cantidad" name="productos[productoCantidad][]" onkeypress="return justNumbers(event);" id="productoCantidad'+aux_radom+'" onchange="genera_loteN2('+aux_radom+')"/></td>' +
								  '<td><input type="text"  placeholder="Medida" name="productos[productoMedida][]" id="productoMedida'+aux_radom+'"/></td>' +
								  '<td><input type="text"  placeholder="Precio" name="productos[productoPrecio][]" onkeypress="return justNumbers(event);" id="productoPrecio'+aux_radom+'" onchange="genera_loteN2('+aux_radom+')"/></td>' +
								  '<td><input type="text"  placeholder="Total" name="productos[productoTotal][]" onkeypress="return justNumbers(event);" id="productoTotal'+aux_radom+'"/></td>' +
								  '<td><img id="'+aux_indice+'"  class="delete_prod" alt="" style="cursor:pointer;" src="<?php echo base_url();?>/statics/img/bt_eliminar.png"></td>' +
								'</tr>' );
								
								$(".delete_prod").click(function(event){
									event.preventDefault();
									id = $(event.currentTarget).attr('id');
									 $('#prod_'+id).remove();
								});
    });
	aux_indice=1;
	
	
	
	
	
	$(".delete_prod").click(function(event){
        event.preventDefault();
		id = $(event.currentTarget).attr('id');
		 $('#prod_'+id).remove();
    });
	
	
	
  });
  
  
  
/*  function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;

return /\d/.test(String.fromCharCode(keynum));



}
*/



var nav4 = window.Event ? true : false;
function justNumbers(evt){
// Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
var key = nav4 ? evt.which : evt.keyCode;
//alert(key);
return (key <= 13 || (key >= 48 && key <= 57) || key == 46  || key == 0);
}


/*function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;


if (((keynum < 48) || (keynum> 57))  ) 
return false;
else
return true;

//return /\d/.test(String.fromCharCode(keynum));



}
*/
function genera_lote(){
	cantidad=$('#facturaCantidad').val();
	precio=$('#facturaImporte').val();
	$('#facturaImporteIva').val(cantidad*precio);
	
}


function genera_loteN1(){
	cantidad=$('#productoCantidadN1').val();
	precio=$('#productoPrecioN1').val();
	$('#productoTotalN1').val(cantidad*precio);
	
}

function genera_loteN2(id){
	cantidad=$('#productoCantidad'+id).val();
	precio=$('#productoPrecio'+id).val();
	$('#productoTotal'+id).val(cantidad*precio);
	
}
</script>
<div style="float:left; " >
 <?php echo anchor('companies/editar_proyecto/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
 <?php echo anchor('companies/get_rubro_periodo/', '', array('id'=>'get_rubro', 'style'=>'display: none')); ?>
 <div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	TECNOLOGIA & SOLUCIONES</div>
 <div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	DE INFRAESTRUCTURA</div>
 <hr/>
<table width="100%" border="0">
  <tr>
    <td>
    
    	<!--table width="100%" border="0">
          <tr>
            <td>
            	<?php echo img(array('src'=>'statics/img/logo.png',
                                 'width'=>'100px',)); ?>
            </td>
            <td>
            	<table width="100%" border="0">
                  <tr>
                    <td>
                     <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/panelMenu';?>"><button class="myButton">Proyectos</button></a>
                      <?php endif;?>  
                    </td>
                    <td>
                     <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/add_facturas';?>"><button class="myButton1">Facturas</button></a>
                        <?php endif;?>    
                    </td>
                    <td>
                    <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/usuarios';?>"><button class="myButton">Usuarios</button></a>
                      <?php endif;?>   
                    </td>
                    <td>
                    <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/reportes';?>"><button class="myButton">Reportes</button></a>
                     <?php endif;?>       
                    </td>
                  </tr>
                  <tr>
                    <td>
                    	
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table-->

            </td>
            <td>
            	<div style="width:100px;">Usuario:<?php echo $nombre_usuario;?><br/></div>
            </td>
          </tr>
        </table>

    </td>
  </tr>
  <tr>
    <td>
     
    		<table width="100%" border="0" style="background:#ecf0f1;">
              <tr>
                <td align="center" width="25%">
                	<?php echo img(array('src'=>'statics/img/icon-facturas.png',
                                 'width'=>'150px',)); ?>
                </td>
                <td style="">
                <?php echo form_open('companies/add_facturas', array('id'=>'')); ?>
                	<input type="text"  style="width:400px; height:40px;" placeholder="Buscar proyecto..." name="buscar" onkeypress="return justNumbers(event);"/> <button type="submit" style="background:#3498db; color:#fff; font-size:15px; width:100px; height:40px;">buscar</button>
                 <?php echo form_close(); ?>    
                </td>
                <td align="center" width="25%">
                	<!--button class="myButton" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Agregar proyecto</button-->
                </td>
              </tr>
            </table>
                 

    	
    </td>
  </tr>
  <tr>
    <td>
    
    	<div id="load_proyectos" align="center">
        <?php if($proyectos!=0):?>
        <?php foreach($proyectos as $proyecto):?>
            <div id="eliminar<?php echo $proyecto->proyectoId; ?>">
            <table width="900" border="0">
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
                     <?php if($proyecto->proyectoImporte-$this->Company->total_facturas_iva($proyecto->proyectoId)<0){?>
                    <div class="font-helvetica pedido" style="color:#F00">DIFERENCIA SIN IVA:$<?php echo number_format($proyecto->proyectoImporte-$this->Company->total_facturas_iva($proyecto->proyectoId), 2);?></div>
                    <?php }else{?>
                    <div class="font-helvetica pedido">DIFERENCIA SIN IVA:$<?php echo number_format($proyecto->proyectoImporte-$this->Company->total_facturas_iva($proyecto->proyectoId), 2);?></div>
                    <?php }?>
                </td>
                <td>
                   <?php if(get_status($this->session->userdata('id'))!=2):?>
                   <?php echo anchor('companies/editar/',
                                      img(array('src'=>'statics/img/add.png',
                                     'width'=>'50px',)),
                                      array('class'=>'font-helvetica proyec edita_','id'=>$proyecto->proyectoId,'style'=>'text-decoration:none;',)); ?>
                                       
                        <?php endif;?>               
                    
                     <?php echo anchor('companies/ver_facturas/'.$proyecto->proyectoId,
                                      img(array('src'=>'statics/img/ver.png',
                                     'width'=>'50px',)),
                                      array('class'=>'','id'=>$proyecto->proyectoId,'style'=>'text-decoration:none;',)); ?>
                                                          
                                               
                </td>
              </tr>
              <tr>
                <td colspan="3">
                    <?php echo img(array('src'=>'statics/img/linea.png')); ?>   
                </td>
                </tr>
            </table>
            </div>
            
            
            
      
            
            
          <?php endforeach;?> 
          <?php endif;?> 
        </div>	
        
    </td>
  </tr>
  <tr>
  	<td>
    	<div align="center">
        <?php $page=$page+10;?>
            <?php echo anchor('companies/add_facturas/'.$page,
                                      'Siguiente>>',
                                      array('class'=>'font-helvetica proyec','id'=>'','style'=>'text-decoration:none;')); ?>
            
            <?php $page=$page-20;?>
            |
            <?php echo anchor('companies/add_facturas/'.$page,
                                      htmlentities(utf8_decode('<<atras')),
                                      array('class'=>'font-helvetica proyec','id'=>'','style'=>'text-decoration:none;')); ?> 
        
        </div>
    
    </td>
  </tr>
</table>


  

      
            

   <!-- base semi-transparente -->
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
       	Agregar factura
       </div> 
       
        <?php echo form_open('companies/agrega_factura/', array('id'=>'agregar_factura')); ?>
        <div id="errorMessage1" style="color: #FF0000; display: none"></div>
        <div id="successMessage1" style="color: #FF0000; display: none">datos guardados exitosamente.</div>
       <table width="70%" border="0" align="center">
          <tr>
            <td align="center">
            	<div class="font-helvetica tamano_" align="left">Proveedor</div>
                <div align="left"><input type="text" style="width:300px; height:30px;" name="factura[facturaProveedor]" id="facturaProveedor"  tabindex="2"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">No. Factura</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaNo]" id="facturaNo"  tabindex="3"/></div>
            </td>
          </tr>
          <tr>
            <td>
            
            <div class="font-helvetica tamano_">Fecha de compra</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaFecha]" id="datepicker"  tabindex="7"/></div>
                
            	<!--div class="font-helvetica tamano_">Descripción</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaDescripcion]" id="facturaDescripcion"  tabindex="4"/></div-->
            </td>
            <td>
            
            <div id="carga_rubros"></div>
            	<!--div class="font-helvetica tamano_">Cantidad</div>
                <div><input type="text" style="width:300px; height:30px;"  name="factura[facturaCantidad]" id="facturaCantidad"  onchange="genera_lote()" onkeypress="return justNumbers(event);"  tabindex="5"/></div-->
            </td>
          </tr>
           <tr>
            <td>
            	<!--div class="font-helvetica tamano_">Unidad de medida</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaMedida]" id="facturaMedida"   tabindex="5"/></div-->
                
                <input type="hidden"  id="proyectoId" name="factura[facturaIdProyecto]"/>
                
            </td>
            <td>
            	
            </td>
          </tr>
          
          
          
          <tr>
            <td>
            	<!--div class="font-helvetica tamano_">Importe sin IVA</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaImporte]" id="facturaImporte" onkeypress="return justNumbers(event);"  onchange="genera_lote()"  tabindex="6"/></div-->
            </td>
            <td>
            	
            </td>
          </tr>
          
          <tr>
            <td>
            	<!--div class="font-helvetica tamano_">Importe</div>
                <div><input type="text" style="width:300px; height:30px;" name="factura[facturaImporteIva]" id="facturaImporteIva" onkeypress="return justNumbers(event);"/></div-->
            </td>
            <td>
            	
            </td>
          </tr>
          
          <tr>
          
            <td colspan="2">
            	
                <table id="users" class="ui-widget ui-widget-content">
                    <thead>
                      <tr class="ui-widget-header ">
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Medida</th>
                        <th>productoPrecio sin IVA</th>
                        <th>Total sin IVA</th>
                         <th>
                         	<?php echo img(array('src'=>'statics/img/bt_agregar.png',
                                     'id'=>'','class'=>'agregar_','style'=>'cursor:pointer;')); ?>
                         
                         </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr id="prod_1">
                        <td><input type="text"  placeholder="Nombre producto" name="productos[productoNombre][]" id="productoNombreN1"/></td>
                        <td><input type="text"  placeholder="Cantidad" name="productos[productoCantidad][]" onkeypress="return justNumbers(event);" id="productoCantidadN1" onchange="genera_loteN1()"/></td>
                        <td><input type="text"  placeholder="Medida" name="productos[productoMedida][]" id="productoMedidaN1"/></td>
                        <td><input type="text"  placeholder="Precio" name="productos[productoPrecio][]" onkeypress="return justNumbers(event);" id="productoPrecioN1" onchange="genera_loteN1()"/></td>
                        <td><input type="text"  placeholder="Total" name="productos[productoTotal][]" onkeypress="return justNumbers(event);" id="productoTotalN1" /></td>
                        <td><?php echo img(array('src'=>'statics/img/bt_eliminar.png',
                                     'id'=>'1','style'=>'cursor:pointer;','class'=>'delete_prod')); ?></td>
                       
                       
                      </tr>
                    </tbody>
                  </table>
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