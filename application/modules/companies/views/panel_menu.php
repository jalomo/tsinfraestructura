<style>
.font_login {
    font-family: "Helvetica-ExtraCompressed";
    font-size: 40pt;
	color:#5f97d8;
}

.font_login1 {
    font-family: "Helvetica-ExtraCompressed";
    font-size: 25pt;
	color:#bdc2c6;
}
.div_login{
	background:#edf0f1;
	height:250px;
	width:300px;
	padding: 10px;
	box-shadow: 4px 4px 4px #c2c6c7;
   -webkit-box-shadow: 4px 4px 4px #c2c6c7;
   -moz-box-shadow: 2px 2px 2px #c2c6c7;}
   
.texto_login{ font-family: "Helvetica-ExtraCompressed";
    font-size: 20pt;
	color:#7f8c8d;
	
	width:200px;
	margin-left:10px;}  
	
.textos_{ width:280px; margin-left:10px; height:30px;}	 


.myButton {
	margin-top:50px;
	background:#3498db;
	color:#fff;
	width:280px;
	margin-left:10px;
	height:35px;
	font-size:18px;
	
}

body{
	/* IE10 Consumer Preview */ 
background-image: -ms-radial-gradient(center, circle closest-corner, #FFFFFF 0%, #ECF0F1 100%);

/* Mozilla Firefox */ 
background-image: -moz-radial-gradient(center, circle closest-corner, #FFFFFF 0%, #ECF0F1 100%);

/* Opera */ 
background-image: -o-radial-gradient(center, circle closest-corner, #FFFFFF 0%, #ECF0F1 100%);

/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(radial, center center, 0, center center, 506, color-stop(0, #FFFFFF), color-stop(1, #ECF0F1));

/* Webkit (Chrome 11+) */ 
background-image: -webkit-radial-gradient(center, circle closest-corner, #FFFFFF 0%, #ECF0F1 100%);

/* W3C Markup, IE10 Release Preview */ 
background-image: radial-gradient(circle closest-corner at center, #FFFFFF 0%, #ECF0F1 100%);
	}

</style>
<?php echo anchor('companies/checkDataLogin', '', array('id'=>'checkValues', 'style'=>'display: none')); ?>
 <?php echo form_open('companies/mainView', array('onsubmit'=>'return login();')); ?>
<table width="500" border="0" align="center">
  <tr>
    <td align="center">
    
    	 <?php echo img(array('src'=>'statics/img/logo_login.png',
                                 'width'=>'200px',)); ?>
    </td>
  </tr>
  <tr>
    <td align="center">
    	<span class="font_login">Bienvenido</span>
    </td>
  </tr>
  <tr>
    <td align="center">
    	<span class="font_login1">Por favor ingresa con tu cuenta</span>
    </td>
  </tr>
  <tr>
    <td align="center">
    <div id="errorMessageLogin" style="color: #FF0000; display: none"></div>
            <div id="errorLoginData" style="color: #FF0000; display: none"></div>
    
    	<div class="div_login" align="left">
        	
        	<div class="texto_login" align="left" style="margin-top:20px;">Usuario</div>
            <div><input type="text" class="textos_"  name="Login[userUsername]" id="userUsername"/></div>
            <div class="texto_login">Contraseña</div>
            <div><input type="password" class="textos_" name="Login[userPassword]" id="userPassword"/></div>
            <div> 
           
            <button class="myButton" type="submit">Ingresar</button>
            
            </div>
        </div>
    </td>
  </tr>
</table>
 <?php echo form_close(); ?>
