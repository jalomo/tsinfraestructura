<?php //echo link_tag('statics/css/menu_evento.css'); ?>

<?php echo link_tag('statics/css/menu.css'); ?>





<div class="menu- float-">
		<div align="center" style="margin-top:5px;" >
         
            	<?php echo img(array('src'=>'statics/img/logo_login.png','width'=>'130px')); ?>
		
		</div>
		<div class="margen-top"></div>
        
		<div class="menus-" id="eventos_m"><span class="span-top font-nexa">  <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/panelMenu';?>" class="menus-texto">Proyectos</a>
                      <?php endif;?> </span></div>
        
        <div class="margen-top"></div>
        
		<div class="menus-" id="usuarios_m"><span class="span-top font-nexa"> <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/add_facturas';?>" class="menus-texto">Facturas</a>
                        <?php endif;?>  </span></div>
        
        <div class="margen-top"></div>
        
		<div class="menus-" id="servicios_m"><span class="span-top font-nexa"> <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/usuarios';?>" class="menus-texto">Usuarios</a>
                      <?php endif;?>   </span></div>
        
        <div class="margen-top"></div>
        
		<div class="menus-" id="mensajes_m"><span class="span-top font-nexa"> <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/reportes';?>" class="menus-texto">Reportes</a>
                     <?php endif;?>  </span></div>
                     
         <div class="margen-top"></div>
        
		<div class="menus-" id="productos_m"><span class="span-top font-nexa"> <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/productos';?>" class="menus-texto">Buscar productos</a>
                     <?php endif;?>  </span></div> 
                     
                     
         <div class="margen-top"></div>
        
		<div class="menus-" id="rubro_m"><span class="span-top font-nexa"> <?php if(get_status($this->session->userdata('id'))!=3):?>
                    	<a href="<?php echo base_url().'/index.php/companies/crea_rubro';?>" class="menus-texto">Rubros</a>
                     <?php endif;?>  </span></div>                          
        
        <div class="margen-top"></div>
        
		<div class="menus-" id="banner_m"><span class="span-top font-nexa">
        <?php if(get_status($this->session->userdata('id'))!=3):?>
         <a href="<?php echo base_url().'/index.php/companies/list_presupuesto';?>" class="menus-texto">Presupuestos</a>
         <?php endif;?>
         </span></div>

        
        <div class="margen-top"></div>
        
		<div class="menus-"><span class="span-top font-nexa"> <a href="<?php echo base_url().'/index.php/companies/logout'?>" class="menus-texto"> Salir</a></span></div>


</div>

