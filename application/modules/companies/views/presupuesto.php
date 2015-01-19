<!DOCTYPE html>
<html>
<head>
   <?php echo link_tag('statics/css/jquery-ui.css'); ?>
        <script type="text/javascript" src="<?php echo base_url().'statics/js/libraries/jquery-ui.js'; ?>"></script>
        
    <script type="text/javascript">
    $(document).ready(function(){
		
		$( "#datepicker" ).datepicker();
	$( "#datepicker1" ).datepicker();
		
		$("#save_presu").submit(function(){
        var band = 0;
	
       

        
        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
				
            return false;
        }
        else{
             $("#errorMessage1").hide();
            var opt = {
                success : guarda_
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });
	
		
		
        $('.editText').dblclick( function(event){
					event.preventDefault();
					id=$(event.currentTarget).attr('id');
					
                    var text = $(this).text();
                    $(this).empty().html('<input onkeypress="return justNumbers(event);" type="text" value="'+text.trim()+'" class="" style="font-size:12px; width:100px;  background:#CCC" >').find('input').focus();
                }).keypress( function(e){
                    if(e.keyCode == 13){
                        var text = $('input', this).val();
                        $(this).html( text );
						 if(text){
							 //alert(id);
							 //name_updata(text,id);
							  url = $("#get_id").attr('href');
							 value_json = $.ajax({
							   type: "GET",
							   url:url+"/"+id+"/"+text,
							   async: false,
							   dataType: "text",
								success: function(data){
									//alert(data);
									get_rubro_total(id);
								   }
							   }).responseText;
							 
							 
							 }
						
                    }
                });
    });
	
function guarda_(){
location.reload();	
}	
function get_rubro_total(id_rubro){
	
	var str = id_rubro;
    var res = str.split("/");
	//alert(res[0]);
	
	url = $("#get_id_rubro").attr('href');
							 value_json = $.ajax({
							   type: "GET",
							   url:url+'/'+id_rubro,
							   async: false,
							   dataType: "text",
								success: function(data){
									//alert(data);
									$("#total_"+res[0]).text(data);
								   }
							   }).responseText;	
}


function eliminar_rubro(id_rubro){
	
	
    var r = confirm("Eliminar rubro?!");
    if (r == true) {
        url = $("#delete_rubro").attr('href');
							 value_json = $.ajax({
							   type: "GET",
							   url:url+'/'+id_rubro,
							   async: false,
							   dataType: "text",
								success: function(data){
									//alert(data);
									location.reload();	
								   }
							   }).responseText;	
    } else {
       
    }
	
		
}	

function eliminar_periodo(id_periodo){
	
	
    var r = confirm("Eliminar periodo?!");
    if (r == true) {
       url = $("#delete_periodo").attr('href');
							 value_json = $.ajax({
							   type: "GET",
							   url:url+'/'+id_periodo,
							   async: false,
							   dataType: "text",
								success: function(data){
									//alert(data);
									location.reload();	
								   }
							   }).responseText;	
    } else {
       
    }
		
}	
	function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
}
    </script>
    
    <style>
    #add, #del  {cursor:pointer;text-decoration:underline;color:#00f;}
    </style>
</head>

<body>

<?php echo anchor('companies/delete_periodo/', '', array('id'=>'delete_periodo', 'style'=>'display: none')); ?>
<?php echo anchor('companies/delete_rubro/', '', array('id'=>'delete_rubro', 'style'=>'display: none')); ?>
<?php echo anchor('companies/save_cantidades/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
<?php echo anchor('companies/get_total_rubro/', '', array('id'=>'get_id_rubro', 'style'=>'display: none')); ?>

<?php echo form_open('companies/guarda_presupuesto/'.$id_proyecto, array('id'=>'save_presu')); ?>
<div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	TECNOLOGIA & SOLUCIONES</div>
 <div align="center" style="color:#00016a; font-weight:bold;" class="font-nexa">	DE INFRAESTRUCTURA</div>
<hr/>
<div class="font-helvetica" style="font-size:18px;">Proyecto:<?php echo $this->Company->get_name_proyecto($id_proyecto);?></div>
<br/><br/>




Agregar rubro:<!--input type="text" name="presu[rubroNombre]" style="width:200px; height:20px;"/-->

<?php if($rubros!=0):?>
<select name="presu[prIdRubro]">
<option></option>
<?php foreach($rubros as $rubro):?>
<option value="<?php echo $rubro->rubroId;?>"><?php echo $rubro->rubroNombre;?></option>
<?php endforeach;?>
</select>
<?php else:?>
no tienes rubros
<?php endif;?>


Agregar periodo <!--input type="text" name="presu[periodoNombre]" style="width:200px; height:20px;"/--> 
del 
<input type="text" style="width:100px; height:30px;" name="presu[periodoFechaInicio]" id="datepicker"  /> 
al 
<input type="text" style="width:100px; height:30px;" name="presu[periodoFechaFinal]" id="datepicker1"  />

<br/>
<br/>
<button type="submit">guardar</button>
<?php echo form_close(); ?>   
<br/>
<?php $rubros=$this->Company->get_rubros_($id_proyecto);?>
<?php $periodos=$this->Company->get_periodos($id_proyecto);?>
<?php $suma_proyecto=0;?>

<?php $presupuesto_real=0;?>




<table width=""  border="2" style="border-collapse: collapse;border-style: solid;border-color: #0000ff #0000ff;">

  <tr>
    <td style="font-size:18px; background:#E6E6E8;border-style: solid;border-color: #0000ff #0000ff;" class="font-helvetica">Rubro \ Periodo</td>
    <?php if($periodos !=0):?>
    
    <?php foreach($periodos as $periodo):?>
    <!--td style="background:#E6E6E8;"> <div style="margin:5px; width:200px; font-size:18px; "><?php echo $rubro->rubroNombre;?></div>
     <div style="text-decoration:underline; cursor:pointer;" title="eliminar" onClick="eliminar_rubro(<?php echo $rubro->rubroId;?>)">eliminar</div></td-->

		 <td style="" class="font-helvetica" style="border-style: solid;border-color: #0000ff #0000ff;">
         <div style="margin:5px; width:100px;font-size:18px;"> <?php echo $periodo->periodoNombre;?></div>
         
         <div>
         	<?php echo $periodo->periodoFechaInicio;?> a  <?php echo $periodo->periodoFechaFinal;?>
         </div>
         
         
    	<div style="text-decoration:underline; cursor:pointer;" title="eliminar" onClick="eliminar_periodo(<?php echo $periodo->periodoId;?>)">eliminar</div><br/>
    </td>
            
    
     <?php endforeach;?>
     
     <td class="font-helvetica" style="border-style: solid;border-color: #0000ff #0000ff;"><div style="margin:5px; width:100px;font-size:18px;">Total</td>
     
     
     <?php endif;?>
  </tr>
  
  
   <?php if($rubros !=0):?>
 <?php foreach($rubros as $rubro):?>
  <tr>
    <!--td style="" class="font-helvetica"><div style="margin:5px; width:100px;font-size:18px;"> <?php echo $periodo->periodoNombre;?></div>
    	<div style="text-decoration:underline; cursor:pointer;" title="eliminar" onClick="eliminar_periodo(<?php echo $periodo->periodoId;?>)">eliminar</div><br/>
    </td-->
    <td style="background:#E6E6E8;border-style: solid;border-color: #0000ff #0000ff;"> <div style="margin:5px; width:200px; font-size:18px; "><?php echo $this->Company->get_rubros_name($rubro->prIdRubro);?></div>
     <div style="text-decoration:underline; cursor:pointer;" title="eliminar" onClick="eliminar_rubro(<?php echo $rubro->prIdRubro;?>)">eliminar</div></td>
    
    
    
    <?php if($periodos !=0):?>
     <?php foreach($periodos as $periodo):?>
    <td style=" border:2px;border-style: solid;border-color: #0000ff #0000ff;">
    Estimado:
    $
    <?php $estimado= trim($this->Company->get_cantidades($rubro->prIdRubro,$periodo->periodoId));?>
    <span class="editText " id="<?php echo $rubro->prIdRubro.'/'.$periodo->periodoId;?>" style=" width:100px;font-size:18px">
    	<?php echo number_format(trim($this->Company->get_cantidades($rubro->prIdRubro,$periodo->periodoId)),2);?>
    </span>
    <br/>
   
    Real:
    $
    <?php $real= trim($this->Company->get_cantidades_facturas($rubro->prIdRubro,$periodo->periodoId));?>
    <span  style=" width:100px;font-size:18px">
	<?php echo number_format(trim($this->Company->get_cantidades_facturas($rubro->prIdRubro,$periodo->periodoId)),2);?>
    </span>
    <br/>
    <hr/>
    Total:
    $
	<?php if(($estimado-$real)<0):?>
    <span style="color:#F00;">
	<?php echo number_format($estimado-$real,2);?>
    </span>
    <?php else:?>
    <?php echo number_format($estimado-$real,2);?>
    <?php endif;?>
    
    </td>
     <?php endforeach;?>
     <?php endif;?>
     
     <td style=" background:#E6E6E8;color:#000;border:2px;margin:5px; font-size:18px;border-style: solid;border-color: #0000ff #0000ff;" class="font-helvetica" >
     	Estimado:$
    	<span id="total_<?php echo $rubro->prIdRubro;?>">
        <?php $p_estimado= $this->Company->get_rubro($rubro->prIdRubro);  ?>
        	<?php echo number_format($this->Company->get_rubro($rubro->prIdRubro),2);  ?>
            <?php $suma_proyecto+=$this->Company->get_rubro($rubro->prIdRubro);?>
        </span>
        
        
    <br/>Real:
        
         $
    	<span id="total_<?php echo $rubro->prIdRubro;?>">
        <?php $p_real= $this->Company->get_facturas_rubro($rubro->prIdRubro);?>
        	<?php echo number_format($this->Company->get_facturas_rubro($rubro->prIdRubro),2);?>
            <?php $presupuesto_real+=$this->Company->get_facturas_rubro($rubro->prIdRubro);?>
        </span>
        <br/>
        <hr/>
        Total:
        $
        <?php if(($p_estimado-$p_real)<0):?>
    <span style="color:#F00;">
	<?php echo number_format($p_estimado-$p_real,2);?>
    </span>
    <?php else:?>
    <?php echo number_format($p_estimado-$p_real,2);?>
    <?php endif;?>
        
     </td>
     
     
  </tr>
  
  
  
  
  
   <?php endforeach;?>
   <!--tr>
   	<td height="30px" style=" background:#E6E6E8;color:#000;margin:5px; font-size:18px;" class="font-helvetica">TOTAL:</td>
     
    <?php if($rubros !=0):?>
   
     <?php foreach($rubros as $rubro):?>
    <td style=" background:#E6E6E8;color:#000;margin:5px; font-size:18px" class="font-helvetica"  >
    $
    	<span id="total_<?php echo $rubro->rubroId;?>">
        
        	<?php echo number_format($this->Company->get_rubro($rubro->rubroId),2);  ?>
            <?php $suma_proyecto+=$this->Company->get_rubro($rubro->rubroId);?>
        </span>
    </td>
    <?php endforeach;;?>
    <?php endif;?>
   </tr-->
   
  <?php endif;?>
  
   
  
</table>

PRESUPUESTO ESTIMADO: 
 <?php if($rubros !=0):?>
$<?php echo number_format($suma_proyecto,2);?>
 <?php endif;?>


<br/>
PRESUPUESTO REAL:
<?php if($rubros !=0):?>
<?php if($suma_proyecto<$presupuesto_real):?>
 <span style="color:#F00;">$<?php echo number_format($presupuesto_real,2);?></span>
<?php else:?>
 <span style="color:#000;">$<?php echo number_format($presupuesto_real,2);?></span>
<?php endif;?>
<?php endif;?>


<br/>

  <?php echo anchor('companies/excel_presupuesto/'.$id_proyecto, img(array('src'=>'statics/img/icono_excel.jpg',
                                 'width'=>'50px',)).'Reporte ', array('id'=>'', 'style'=>'')); ?>

</body>
</html>





