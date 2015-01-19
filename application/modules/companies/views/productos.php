<?php echo form_open('companies/productos/', array('id'=>'')); ?>
<div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	TECNOLOGIA & SOLUCIONES</div>
 <div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	DE INFRAESTRUCTURA</div>
<hr/>
<br/>
<br/>
<select name="buscar">
<option value="0">Selecciona rubro</option>
<?php foreach($rubros as $rubro):?>
	<option value="<?php echo $rubro->rubroId?>"><?php echo $rubro->rubroNombre;?></option>
<?php endforeach;?>
</select>
<button type="submit">consultar</button>
<br/>
<br/>
<?php if($productos!=0):?>

<table width="500" border="1">
  <tr>
    <td align="center">Nombre</td>
    <td align="center">Precio</td>
    <td align="center">Medida</td>
  </tr>
  
   <?php foreach($productos as $producto):?>
  <tr>
 
    <td><?php echo $producto->productoNombre?></td>
    <td>$<?php echo $producto->productoPrecio?></td>
    <td><?php echo $producto->productoMedida?></td>
  </tr>
  <?php endforeach;?>
</table>

<?php else:?>

Sin productos
<?php endif;?>




 <?php echo form_close(); ?>      
