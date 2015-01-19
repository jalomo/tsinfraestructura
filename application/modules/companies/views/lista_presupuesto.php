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

<div style="float:left">
 <?php echo anchor('companies/editar_proyecto/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
<div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	TECNOLOGIA & SOLUCIONES</div>
 <div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	DE INFRAESTRUCTURA</div>
<hr/>
<table width="100%" border="0">
  <tr>
    <td>
    
    	
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
                  
                   <?php echo anchor('companies/presupuesto/'.$proyecto->proyectoId,
                                      img(array('src'=>'statics/img/ver.png',
                                     'width'=>'50px',)),
                                      array('class'=>'font-helvetica proyec edita_','id'=>$proyecto->proyectoId,'style'=>'text-decoration:none;',)); ?>
                                       
                                                                       
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
            <?php echo anchor('companies/list_presupuesto/'.$page,
                                      'Siguiente>>',
                                      array('class'=>'font-helvetica proyec','id'=>'','style'=>'text-decoration:none;')); ?>
            
            <?php $page=$page-20;?>
            |
            <?php echo anchor('companies/list_presupuesto/'.$page,
                                      htmlentities(utf8_decode('<<atras')),
                                      array('class'=>'font-helvetica proyec','id'=>'','style'=>'text-decoration:none;')); ?> 
        
        </div>
    
    </td>
  </tr>
</table>


  







      
    


</div>
            