<?php echo form_open('companies/save_rubro/', array('id'=>'')); ?>
<div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	TECNOLOGIA & SOLUCIONES</div>
 <div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	DE INFRAESTRUCTURA</div>
<hr/>
<br/>
<br/>
Rubro:
<input type="text" name="save[rubroNombre]"/>
<button type="submit">Guardar</button>
<br/>
<br/>
<?php if($rubros!=0):?>

<table width="500" border="1">
  <tr>
    <td align="center">Nombre</td>
   
  </tr>
  
   <?php foreach($rubros as $rubro):?>
  <tr>
 
    <td><?php echo $rubro->rubroNombre;?></td>
   
  </tr>
  <?php endforeach;?>
</table>

<?php else:?>

Sin rubros
<?php endif;?>




 <?php echo form_close(); ?>      
