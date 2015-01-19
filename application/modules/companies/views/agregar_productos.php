


<div style="color: #ccc; " id="muestra_datos">
     
     	<div id="proveedor_"></div>
        <div id="nofa_"></div>
        <div id="fecha_"></div>
        <input type="hidden" id="id_fac"/>
        
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>       
        
     	

<script>
$(function() {
	
	
	//////////////////////////////////////
	var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      productoNombre = $( "#productoNombre" ),
	  productoCantidad = $( "#productoCantidad" ),
	  productoMedida = $( "#productoMedida" ),
	  productoPrecio = $( "#productoPrecio" ),
	  productoTotal = $( "#productoTotal" ),
     // email = $( "#email" ),
      //password = $( "#password" ),
      allFields = $( [] ).add( productoNombre ).add( productoCantidad ).add( productoMedida ).add( productoPrecio ).add( productoTotal ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    function addUser() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( productoNombre, "productoNombre", 3, 16 );
	  valid = valid && checkLength( productoCantidad, "productoCantidad", 3, 16 );
	  valid = valid && checkLength( productoMedida, "productoMedida", 3, 16 );
	  valid = valid && checkLength( productoPrecio, "productoPrecio", 3, 16 );
	  valid = valid && checkLength( productoTotal, "productoTotal", 3, 16 );
     // valid = valid && checkLength( email, "email", 6, 80 );
      //valid = valid && checkLength( password, "password", 5, 16 );
 
      valid = valid && checkRegexp( productoNombre, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
	  valid = valid && checkRegexp( productoCantidad, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
	  valid = valid && checkRegexp( productoMedida, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
	  valid = valid && checkRegexp( productoPrecio, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
	  valid = valid && checkRegexp( productoTotal, /^[a-z]([0-9a-z_\s])+$/i, "Username may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      //valid = valid && checkRegexp( email, emailRegex, "eg. ui@jquery.com" );
      //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
	  
 
      if ( valid ) {
        $( "#users tbody" ).append( "<tr>" +
          "<td>" + productoNombre.val() + "</td>" +
          "<td>" + productoCantidad.val() + "</td>" +
          "<td>" + productoMedida.val() + "</td>" +
		  "<td>" + productoPrecio.val() + "</td>" +
		  "<td>" + productoTotal.val() + "</td>" +
        "</tr>" );
        dialog.dialog( "close" );
      }
      return valid;
    }
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": addUser,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
        allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addUser();
    });
 
    $( "#create-user" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });
	
	get_productos();
	
});	
	
	
function get_productos(){
   
   
	 url = $("#get_id").attr('href');
		value_json = $.ajax({
               type: "GET",
               url:url+"/1",
               async: false,
			   dataType: "json",
			    success: function(data){
					if(data==0){
						
					}else{
						
						//
						$.each(data, function(k,v){
								
								$("#componentePacom").val(v.equipoComponente);
								
								 $( "#users tbody" ).append( "<tr>" +
								  "<td>" + v.productoNombre+ "</td>" +
								  "<td>" + v.productoCantidad+ "</td>" +
								  "<td>" + v.productoMedida+ "</td>" +
								  "<td>" + v.productoPrecio + "</td>" +
								  "<td>" + v.productoTotal + "</td>" +
								"</tr>" );
													  
						});
							
						//
											 
					} 
				 }
               }).responseText;
	
	
	
	
	
}	

</script>	    
 

 
 
 <?php echo anchor('companies/get_productos/', '', array('id'=>'get_id', 'style'=>'display: none')); ?>
 
<div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">productoNombre</label>
      <input type="text" name="name" id="productoNombre" value="" class="text ui-widget-content ui-corner-all">
      <label for="email">productoCantidad</label>
      <input type="text" name="email" id="productoCantidad" value="" class="text ui-widget-content ui-corner-all">
      <label for="password">productoMedida</label>
      <input type="password" name="password" id="productoMedida" value="" class="text ui-widget-content ui-corner-all">
      <label for="password">productoPrecio</label>
      <input type="password" name="password" id="productoPrecio" value="" class="text ui-widget-content ui-corner-all">
      <label for="password">productoTotal</label>
      <input type="password" name="password" id="productoTotal" value="" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 
 
<div id="users-contain" class="ui-widget">
  <h1>Agregar productos</h1>
  <table id="users" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>productoNombre</th>
        <th>productoCantidad</th>
        <th>productoMedida</th>
        <th>productoPrecio</th>
        <th>productoTotal</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>john.doe@example.com</td>
        <td>johndoe1</td>
        <td>johndoe1</td>
        <td>johndoe1</td>
       
        
      </tr>
    </tbody>
  </table>
</div>
<button id="create-user">Create new user</button>
