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
    
	/*
	* metodo que abre una ventana para abrir un usuario
	*/
	$(".agregar_").click(function(event){
        event.preventDefault();
		
		
		
       document.getElementById('light1').style.display='block';document.getElementById('fade1').style.display='block'
    });
	
	
	/*
	* metodo para validar un usuario
	*/
	 $("#guarda_usuario").submit(function(){
        var band = 0;
	
        if($("#userNombre").val() =='' ){
            $("#userNombre").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#userNombre").css("border", "1px solid #ADA9A5");
        }
		
		 if($("#userUsername").val() =='' ){
            $("#userUsername").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#userUsername").css("border", "1px solid #ADA9A5");
        }
		
		if($("#userPassword").val() =='' ){
            $("#userPassword").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#userPassword").css("border", "1px solid #ADA9A5");
        }
		
		
		

        
        if(band != 0){
            $("#errorMessage1").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage1").hide();
            var opt = {
                success : newUser
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });
	
	$("#modifica_usuario").submit(function(){
        var band = 0;
	
        if($("#userNombre1").val() =='' ){
            $("#userNombre1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#userNombre1").css("border", "1px solid #ADA9A5");
        }
		
		 if($("#userUsername1").val() =='' ){
            $("#userUsername1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#userUsername1").css("border", "1px solid #ADA9A5");
        }
		
		/*if($("#userPassword1").val() =='' ){
            $("#userPassword1").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#userPassword1").css("border", "1px solid #ADA9A5");
        }
		*/
		
		
		

        
        if(band != 0){
            $("#errorMessage1").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
            $("#errorMessage1").hide();
            var opt = {
                success : newUser
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });
	
	
	
	
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
						
						$("#userId").val(data.userId);
						$("#userNombre1").val(data.userNombre);
						$("#userUsername1").val(data.userUsername);
						//$("#userPassword1").val(data.userPassword);
						//$("#userStatus1").val(data.userStatus);
						
						
						 $("#userStatus1 option[value="+data.userStatus+"]").attr("selected",true);
													 
													 
							} 
				   }
               }).responseText;
		
		
       document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'
    });
	
	/*
	* metodo para eliminar
	*/
	
	 $(".eliminar").click(function(event){
        event.preventDefault();
        $.confirm({
                    'title'     : 'Eliminar usuario',
                    'message'   : 'Desea eliminar el usuario seleccionado?',
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
  });
  
  function newUser(){
 
    
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
	location.reload();
}
</script>
<div style="float:left">
 <?php echo anchor('companies/edita_usuario/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
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
                    	<a href="<?php echo base_url().'/index.php/companies/usuarios';?>"><button class="myButton1">Usuarios</button></a>
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
                	<?php echo img(array('src'=>'statics/img/icon-user.png',
                                 'width'=>'150px',)); ?>
                </td>
                <td style="">
                 <?php if(get_status($this->session->userdata('id'))!=2):?>
               <button  type="button" style="background:#3498db; color:#fff; font-size:15px; width:200px; height:40px;" class="agregar_">Agregar Usuario</button>
               <?php endif;?>
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
        <?php if($usuarios!=0):?>
        <?php foreach($usuarios as $usuario):?>
            <div id="eliminar<?php echo $usuario->userId; ?>">
            <table width="900" border="0">
              <tr>
                <td width="400">
                    <div class="font-helvetica proyec"><?php echo $usuario->userNombre?></div>
                    <div class="font-helvetica pedido">Pedido:<?php echo $usuario->userUsername?></div>
                    
                </td>
                <td width="300"> 
                    <div class="font-helvetica pedido">Tipo de usuario:<?php
						if($usuario->userStatus==1){
							echo 'Usuario Administrador';
						}elseif($usuario->userStatus==2){
							echo ' Usuario de consulta';
							
						}elseif($usuario->userStatus==3){
							echo 'Usuario de impresión';
						}
					
					?></div>
                   
                </td>
                <td>
                   <?php if(get_status($this->session->userdata('id'))!=2):?>
                   <?php echo anchor('companies/editar/',
                                      img(array('src'=>'statics/img/ver.png',
                                     'width'=>'50px',)),
                                      array('class'=>'font-helvetica proyec edita_','id'=>$usuario->userId,'style'=>'text-decoration:none;',)); ?>
                                       
                                       
                    
                     <?php echo anchor('companies/eliminar_usuario/'.$usuario->userId,
                                      img(array('src'=>'statics/img/eliminar.png',
                                     'width'=>'50px',)),
                                      array('class'=>'eliminar','id'=>'delete'.$usuario->userId,'style'=>'text-decoration:none;' ,'flag'=>$usuario->userId,)); ?>
                      <?php endif;?>                
                                                          
                                               
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
       	Agregar usuario
       </div> 
       
        <?php echo form_open('companies/agregar_usuario/', array('id'=>'guarda_usuario')); ?>
        
        <div id="errorMessage1" style="color: #FF0000; display: none"></div>
        <div id="successMessage1" style="color: #FF0000; display: none">datos guardados exitosamente.</div>
       <table width="70%" border="0" align="center">
          <tr>
            <td align="center">
            	<div class="font-helvetica tamano_" align="left">Nmobre</div>
                <div align="left"><input type="text" style="width:300px; height:30px;" name="user[userNombre]" id="userNombre"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">Username</div>
                <div><input type="text" style="width:300px; height:30px;" name="user[userUsername]" id="userUsername"/></div>
            </td>
          </tr>
          <tr>
            <td>
            	<div class="font-helvetica tamano_">Contraseña</div>
                <div><input type="text" style="width:300px; height:30px;" name="user[userPassword]" id="userPassword"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">Tipo:</div>
                <div>
                
                	<select name="user[userStatus]" id="userStatus">
                    	<option value="1" >Usuario Administrador</option>
                        <option value="2"> Usuario de consulta </option>
                        <option value="3"> Usuario de impresión</option>
                    </select>
                </div>
            </td>
          </tr>
           <tr>
            <td>
            	
                
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
            
            
            
            
            
            
              
            

   <!-- base semi-transparente -->
    <div id="fade" class="overlay" onclick = "document.getElementById('editar').style.display='none';document.getElementById('fade').style.display='none'"></div>
<!-- fin base semi-transparente -->
 
<!-- ventana modal -->  
	<div id="light" class="modal" style=" background:#ecf0f1;">
    	<!--a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">cerrar</a-->
       <div align="center"> 
	   	<?php echo img(array('src'=>'statics/img/icono_proyecto.png',
                                     'width'=>'100px',)); ?>
       </div> 
       <div class="font-helvetica label_p" align="center">
       	Edita usuario
       </div> 
       
        <?php echo form_open('companies/edita_usuario_id/', array('id'=>'modifica_usuario')); ?>
        <input type="hidden"  id="userId" name="userId"/>
        <div id="errorMessage1" style="color: #FF0000; display: none"></div>
        <div id="successMessage1" style="color: #FF0000; display: none">datos guardados exitosamente.</div>
       <table width="70%" border="0" align="center">
          <tr>
            <td align="center">
            	<div class="font-helvetica tamano_" align="left">Nmobre</div>
                <div align="left"><input type="text" style="width:300px; height:30px;" name="user1[userNombre]" id="userNombre1"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">Username</div>
                <div><input type="text" style="width:300px; height:30px;" name="user1[userUsername]" id="userUsername1"/></div>
            </td>
          </tr>
          <tr>
            <td>
            	<div class="font-helvetica tamano_">Contraseña</div>
                <div><input type="password" style="width:300px; height:30px;" name="user1[userPassword]" id="userPassword1"/></div>
            </td>
            <td>
            	<div class="font-helvetica tamano_">Tipo:</div>
                <div>
                
                	<select name="user1[userStatus]" id="userStatus1">
                    	<option value="1">Usuario Administrador</option>
                        <option value="2"> Usuario de consulta </option>
                        <option value="3"> Usuario de impresión</option>
                    </select>
                </div>
            </td>
          </tr>
           <tr>
            <td>
            	
                
            </td>
            <td>
            	
            </td>
          </tr>
         
          <tr>
            <td align="center">
            	<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><button style="background:#bdc3c7; color:#fff; font-size:15px; width:200px; height:30px;" type="button">Cancelar</button></a>
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
            