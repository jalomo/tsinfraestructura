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
						
						$("#proyectoId").val(data.proyectoId);
						
						
													 
													 
							} 
				   }
               }).responseText;
		
		
       document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'
    });
  });
  
  function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
}
</script>
<div style="float:left">
 <?php echo anchor('companies/editar_proyecto/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
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
                    	<a href="<?php echo base_url().'/index.php/companies/add_facturas';?>"><button class="myButton">Facturas</button></a>
                        <?php endif;?>    
                    </td>
                    <td>
                    <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/usuarios';?>"><button class="myButton">Usuarios</button></a>
                      <?php endif;?>   
                    </td>
                    <td>
                    <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/reportes';?>"><button class="myButton1">Reportes</button></a>
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
                	<?php echo img(array('src'=>'statics/img/icon-reportes.png',
                                 'width'=>'150px',)); ?>
                </td>
                <td style="">
                <?php echo form_open('companies/reportes', array('id'=>'')); ?>
                	<input type="text"  style="width:400px; height:40px;" placeholder="Buscar proyecto..." name="buscar"/> <button type="submit" style="background:#3498db; color:#fff; font-size:15px; width:100px; height:40px;">buscar</button>
                 <?php echo form_close(); ?> 
                
                 <?php echo anchor('companies/excel_general/', img(array('src'=>'statics/img/icono_excel.jpg',
                                 'width'=>'50px',)).'Reporte general', array('id'=>'', 'style'=>'')); ?>
                 <br/>
                 <br/>
                 <?php echo anchor('companies/excel_proyectos/',img(array('src'=>'statics/img/icono_excel.jpg',
                                 'width'=>'50px',)). 'Reporte proyectos', array('id'=>'', 'style'=>'')); ?>
                 
                    
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
                </td>
                <td>
                        
                    
                     <?php echo anchor('companies/ver_facturas/'.$proyecto->proyectoId,
                                      img(array('src'=>'statics/img/ver.png',
                                     'width'=>'50px',)),
                                      array('class'=>'','id'=>$proyecto->proyectoId,'style'=>'text-decoration:none;',)); ?>
                                       <?php echo anchor('companies/excel_proyecto_facturas/'.$proyecto->proyectoId, img(array('src'=>'statics/img/icono_excel.jpg',
                                 'width'=>'50px',)), array('id'=>'', 'style'=>'')); ?>
                                                          
                                               
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
            <?php echo anchor('companies/reportes/'.$page,
                                      'Siguiente>>',
                                      array('class'=>'font-helvetica proyec','id'=>'','style'=>'text-decoration:none;')); ?>
            
            <?php $page=$page-20;?>
            |
            <?php echo anchor('companies/reportes/'.$page,
                                      htmlentities(utf8_decode('<<atras')),
                                      array('class'=>'font-helvetica proyec','id'=>'','style'=>'text-decoration:none;')); ?> 
        
        </div>
    
    </td>
  </tr>
</table>


  
</div>
  