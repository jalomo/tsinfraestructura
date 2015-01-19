<?php
/**

 **/
class Company extends CI_Model{

    /**

     **/
    public function __construct()
    {
        parent::__construct();
    }
	
	/*
	* metodo para obtener el nombre de un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_name_rubro($id_rubro){
		$this->db->where('rubroId',$id_rubro);
		$query=$this->db->get('rubros');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res->rubroNombre;
		}else{
			return 'sin rubro';	
		}	
	}
	
	/*
	* metodo para obtener el nombre de un periodo
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_name_periodo($id_periodo){
		$this->db->where('periodoId',$id_periodo);
		$query=$this->db->get('periodos');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res->periodoNombre;
		}else{
			return 'sin rubro';	
		}	
	}
	
	/*
	* metodo para obtener el nombre de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_name_proyecto($id_proyecto){
		$this->db->where('proyectoId',$id_proyecto);	
		$query=$this->db->get('proyectos');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res->proyectoNombre;
		}else{
			return 'sin nombre';	
		}
	}
	
	/*
	* metodo para guardar un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_proyecto($data){
		$this->db->insert('proyectos', $data);
        return $this->db->insert_id();
	}
	
	public function save_rubro($data){
		$this->db->insert('rubros', $data);
        return $this->db->insert_id();
	}
	
	public function save_rubro_proyecto($data){
		$this->db->insert('proyectorubro', $data);
        return $this->db->insert_id();
	}
	
	public function save_periodos($data){
		$this->db->insert('periodos', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para obtener el total de un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_rubro($id_rubro){
		$this->db->select_sum('cantidadPrecio');
		$this->db->where('cantidadIdRubro',$id_rubro);	
		$query=$this->db->get('cantidades');
		if($query->num_rows()>0){
			$res= $query->row();
			return $res->cantidadPrecio;
		}else{
			return 0;	
		}
	}
	
	public function get_periodo_sumas($id_rubro){
		$this->db->select_sum('cantidadPrecio');
		$this->db->where('cantidadIdPeriodo',$id_rubro);	
		$query=$this->db->get('cantidades');
		if($query->num_rows()>0){
			$res= $query->row();
			return $res->cantidadPrecio;
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para obtener la fechas de los periodos de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_fechas_periodos($id_proyecto){
		$this->db->where('periodoIdProyecto',$id_proyecto);
		$query=$this->db->get('periodos');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
	}
	
	/*
	* recorrer los periodos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function fecha_periodo($fecha, $id_proyecto){
		$periodos=$this->get_fechas_periodos($id_proyecto);
		if($periodos!=0):
		foreach($periodos as $periodo):
			$fecha_inicio=trim($periodo->periodoFechaInicio);
			$fecha_fin=trim($periodo->periodoFechaFinal);
			
			 
			if ($this->check_in_range($fecha_inicio, $fecha_fin, trim($fecha))) {
				return $periodo->periodoId;
			} else {
				return 0;
			}
			
		
		endforeach;	
		else:
			return  0;
		endif;	
	}
	
	/*
	* funcion para comprarar fechas.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
	}
	
	
	
	/*
	* metodo para obtener todos los rubros.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_rubros($id_proyecto){
		//$this->db->where('rubroIdProyecto',$id_proyecto);	
		$query=$this->db->get('rubros');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	/*
	* get rubro tabla proyectorubro.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_rubros_($id_proyecto){
		$this->db->where('prIdProyecto',$id_proyecto);	
		$query=$this->db->get('proyectorubro');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	/*
	* nombre de un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_rubros_name($id_rubro){
		$this->db->where('rubroId',$id_rubro);	
		$query=$this->db->get('rubros');
		if($query->num_rows()>0){
			$res= $query->row();
			return $res->rubroNombre;
		}else{
			return 'sin nombre';	
		}
	}
	
	
	
	/*
	* metodo para obtener el volcado de los rubros.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_all_rubros(){
		
		$query=$this->db->get('rubros');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	
	/*
	* metodo para obtener las facturas de un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_factura_rubro($id_rubro){
		$this->db->where('facturaIdRubro',$id_rubro);	
		$query=$this->db->get('facturas');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
	}
	
	
	/*
	* metodo para obtener los productos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_productos_factura_rubro($id_rubro){
		$query=$this->db->query('SELECT * FROM productos INNER JOIN facturas ON productos.productoIdFactura = facturas.facturaId where facturaIdRubro='.$id_rubro.'');
		//$query=$this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
							
	}
	
	
	/*
	* metodo para obtener los periodos de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_periodos($id_proyecto){
		$this->db->where('periodoIdProyecto',$id_proyecto);	
		$query=$this->db->get('periodos');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para obtener las cantidades.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_cantidades($id_rubro,$id_periodo){
		$this->db->where('cantidadIdRubro',$id_rubro);	
		$this->db->where('cantidadIdPeriodo',$id_periodo);	
		$query=$this->db->get('cantidades');
		if($query->num_rows()>0){
			$res= $query->row();
			return $res->cantidadPrecio;
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para guardar cantiades.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_cantidades($data){
		$this->db->insert('cantidades', $data);
        return $this->db->insert_id();
	}
	
	
	/*
	* metodo para modificar una cantidad.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function modifica_cantidades($id_rubro,$id_periodo,$data){
		$this->db->update('cantidades ', $data, array('cantidadIdRubro'=>$id_rubro,'cantidadIdPeriodo'=>$id_periodo));	
	}
	
	/*
	* metodo para revisar si existe una cantidad.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function cantidades_existentes($id_rubro,$id_periodo){
		$this->db->where('cantidadIdRubro',$id_rubro);	
		$this->db->where('cantidadIdPeriodo',$id_periodo);	
		$query=$this->db->get('cantidades');
		if($query->num_rows()>0){
			$res= $query->row();
			return 1;
		}else{
			return 0;	
		}	
	}
	
	
	/*
	* metodo para obtener las cantidades de los rubros y de los periodos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_cantidades_facturas($id_rubro, $id_periodo){
		
		$this->db->where('facturaIdRubro',$id_rubro);
		$this->db->where('facturaPreriodoId',$id_periodo);
		$query=$this->db->get('facturas');
		if($query->num_rows()>0){
			$res=$query->result();
			$suma=0;
			foreach($res as $pro):
				$suma+=$this->get_producto_importe($pro->facturaId);
			endforeach;
			return $suma;
		}else{
			return 0;	
		}	
	}
	
	/*
	* metodo para obtener la cantidad de productos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_producto_importe($id_factura){
		$this->db->select_sum('productoTotal');
		$this->db->where('productoIdFactura',$id_factura);
		$query=$this->db->get('productos');
		if($query->num_rows()>0){
			$res= $query->row();
			return $res->productoTotal;
		}else{
			return 0;	
		}	
	}
	
	/*
	* metodp ára obtener las suma de las facturas de un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_facturas_rubro($id_rubro){
		$this->db->where('facturaIdRubro',$id_rubro);
		
		$query=$this->db->get('facturas');
		if($query->num_rows()>0){
			$res=$query->result();
			$suma=0;
			foreach($res as $pro):
				$suma+=$this->get_producto_importe($pro->facturaId);
			endforeach;
			return $suma;
		}else{
			return 0;	
		}	
	}
	
	/*
	* metodo para insertar los productos de las facturas.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_productos($data){
		$this->db->insert('productos', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para obtener los productos 
	*/
	public function get_productos_factura($idFactura){
		$this->db->where('productoIdFactura',$idFactura);
		$query=$this->db->get('productos');	
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para obtener todos los proyectos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_proyectos($page){
		$this->db->order_by("proyectoId", "desc"); 
		$this->db->limit(10,$page);
		$data = $this->db->get('proyectos');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* buscar unproyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_proyectos_buscar($page,$busqueda){
		$this->db->where('proyectoNo',$busqueda);
		$this->db->order_by("proyectoId", "desc"); 
		$this->db->limit(10,$page);
		$data = $this->db->get('proyectos');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para obtener la informacion de in proyecto.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_proyecto_id($id){
		$this->db->where("proyectoId", $id); 
		
		$data = $this->db->get('proyectos');
		if ($data->num_rows() > 0){
        	return $data->row();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para editar un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function editar_proyecto($id,$data){
		$this->db->update('proyectos ', $data, array('proyectoId'=>$id));	
	}
	
	/*
	* metodo para eliminar un poryecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_proyecto($id){
	 $this->db->delete('proyectos', array('proyectoId'=>$id));	
	}
	
	public function delete_rubro($id){
	 //$this->db->delete('rubros', array('rubroId'=>$id));
	 $this->db->delete('proyectorubro', array('prIdRubro'=>$id));
	 $this->db->update('facturas ', array('facturaIdRubro'=>0), array('facturaIdRubro'=>$id));		
	}
	
	public function delete_periodo($id){
	 $this->db->delete('periodos', array('periodoId'=>$id));
	 $this->db->update('facturas ', array('facturaPreriodoId'=>0), array('facturaPreriodoId'=>$id));		
	}
	
	/*
	* metodo para eliminar los productos de una factura.
	* autor:jalomo@hotail.es
	*/
	public function eliminar_productos($idFactura){
	 $this->db->delete('productos', array('productoIdFactura'=>$idFactura));	
	}
	
	/*
	* metodo para eliminar un producto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_producto_id($id_producto){
	 $this->db->delete('productos', array('productoId'=>$id_producto));	
	}
	
	
	/*
	* metodo para agregar una factura a un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_facturas($data){
		$this->db->insert('facturas', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para obtener volcado de productos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_productos_id($id){
		$this->db->where("productoIdFactura", $id); 
		
		$data = $this->db->get('productos');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para sacar la suma de las facturas de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function total_facturas($idproyecto){
		$total=0;
		$this->db->where("facturaIdProyecto", $idproyecto); 
		
		$data = $this->db->get('facturas');
		if ($data->num_rows() > 0){
        	$resultado= $data->result();
			foreach($resultado as $resul):
				
				$total= $resul->facturaImporte;
			endforeach;
			
			return $total;
		} else {
			return 0;
		}	
			
	}
	
	/*
	* metodo para sacar la suma de las facturas de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function total_facturas_iva($idproyecto){
		$total=0;
		$this->db->where("facturaIdProyecto", $idproyecto); 
		
		$data = $this->db->get('facturas');
		if ($data->num_rows() > 0){
        	$resultado= $data->result();
			foreach($resultado as $resul):
				
				$total+=(float) $this->total_producto_factura($resul->facturaId);
			endforeach;
			return $total;
		} else {
			return 0;
		}	
			
	}
	
	
	/*
	* metoso para obtener el total de los productos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function total_producto_factura($idFactura){
		$total=0;
		$this->db->where('productoIdFactura',$idFactura);	
		$query=$this->db->get('productos');
		if ($query->num_rows() > 0){
        	$resultado= $query->result();
			foreach($resultado as $resul):
				
				$total+= (float)$resul->productoTotal;
			endforeach;
			return $total;
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para obtener las facturas de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_facturas($idproyecto){
		$this->db->where('facturaIdProyecto',$idproyecto);	
		$query=$this->db->get('facturas');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	
	/*
	* metodo para obtener volcado de usuarios.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_usuarios(){
			
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para guardar usuarios.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_usuarios($data){
		$this->db->insert('usuarios', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para obtener los datos de un usuario.
	* autor. jalomo <jalomo@hotmail.es>
	*/
	public function get_user_id($id){
		$this->db->where('userId',$id);	
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para editar un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function editar_usuario($id,$data){
		$this->db->update('usuarios ', $data, array('userId'=>$id));	
	}
	
	/*
	* metodo para eliminar un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_usuario($id){
	 $this->db->delete('usuarios', array('userId'=>$id));	
	}
	
	/*
	* metodo para eliminar una factura.
	* autor. jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_factura($id){
	 $this->db->delete('facturas', array('facturaId'=>$id));	
	}
	
	/*
	* metodo para editar una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function editar_factura($id,$data){
		$this->db->update('facturas ', $data, array('facturaId'=>$id));	
	}
	
	/*
	* metodo para editar un producto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function editar_productos($id,$data){
		$this->db->update('productos ', $data, array('productoId'=>$id));	
	}
	
	/*
	* metodo para obtener los datos de la factura.
	* autor. jalomo <jalomo@hotmail.es>
	*/
	public function get_factura_id($id){
		$this->db->where('facturaId',$id);	
		$query=$this->db->get('facturas');
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para obtener volcado de proyectos.
	* autor: jalomo<jalomo@hotmail.es>
	*/public function get_proyectos_excel(){
		
		$data = $this->db->get('proyectos');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para obtener un proyecto .
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_proyectos__id_excel($id){
		$this->db->where('proyectoId',$id);
		$data = $this->db->get('proyectos');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para obtener el volcado de las facturas por proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_facturas_excel($idProyecto){
		$this->db->where('facturaIdProyecto',$idProyecto);
		$query=$this->db->get('facturas');
		if($query->num_rows()>0){
			return $query->result();	
		}else{
			return 0;	
		}
			
	}
	
	
	
	
	
	
	
	
	
	
	/*
	*Metodo para obtener la informacion
	*de las notificaciones
	*autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_notificaciones(){
		$data = $this->db->get('notificaciones');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	*Metodo para guardar la informacion
	*de las notificaciones
	*autor jalomo <jalomo@hotmail.es>
	*/
	public function save_notificacion($data){
		$this->db->insert('notificaciones', $data);
        return $this->db->insert_id();
	}
	
	/*
	*Metodo para obtener la informacion
	* de las noticias
	autor: jalomo <jalmo@hotmail.es>
	*/
	public function get_noticias(){
		$data = $this->db->get('noticias');
		if ($data->num_rows()>0){
			return $data->result();
		} else {
			return 0;
		}		
	}
	
	/*
	*Metodo para guardar la informacion
	* del registro del administrador
	*autor jalomo <jalomo@hotmail.es>
	*/
	public function save_admin($data){
		$this->db->insert('admin', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para guardar en la tabla de encuestas
	*autor jalomo <jalomo@hotmail.es>
	*/
	public function save_encuesta($data){
		$this->db->insert('encuestas', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para guardar en la tabla de preguntas
	* autor: jalomo<jalomo@hotmail.es>
	*/
	public function save_pregunta($data){
		$this->db->insert('preguntas', $data);
        return $this->db->insert_id();
	}
	
	
	/*
	* metodo para guardar las opciones de la pregunta
	* autor: jalomo<jalomo@hotmail.es>
	*/
	public function save_opciones($data){
		$this->db->insert('opciones', $data);
        return $this->db->insert_id();
	}
	
	/*
	* metodo para eliminar una encuesta
	*/
	public function delete_encuesta($id)
    {
        $this->db->delete('encuestas', array('encuestaId'=>$id));
		$this->db->delete('preguntas', array('preguntaIdEncuesta'=>$id));
		$this->delete_opciones($id);
    }
	
	/*
	* eliminar opciones de una pregunta
	*/
	public function delete_opciones($idEncuesta){
		$this->db->where('preguntaId',$idEncuesta);	
		$query=$this->db->get('preguntas');
		$resultado=$query->row();
		$id=$resultado->preguntaId;
		$this->db->delete('opciones', array('opcionIdPregunta'=>$id));
	}
	/*
	* metodo para obtener el volcado de las encuestas
	* que se encuetran en la base de datos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_all_encuestas()
    {
        $data = $this->db->get('encuestas');
        return $data->result();
    }
	
	/*
	* metodo para obtener la fila de la tabla encuesta
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_encueta_id($id)
    {
        $this->db->where('encuestaId',$id);
		$data = $this->db->get('encuestas');
        return $data->row();
    }
	
	/*
	* metodo para obtener las preguntas de una encuesta
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_preguntas($idencuesta)
    {
        $this->db->where('preguntaIdEncuesta',$idencuesta);
		$data = $this->db->get('preguntas');
        return $data->result();
    }
	
	/**
     * Method for take all the notifications and the user can
     * see the information that was sent before ago.
	 *
     **/
    public function get_all_list_notifications()
    {
        $data = $this->db->get('notificaciones');
        return $data->result();
    }
	
	
	 /**
     * Method for get the specific data of the notifications
     * and can show all the information for the user 
     * and know what is the message to sent
     *
     * @params int idNotification
     * @return array mixedData
     *
     **/
    public function get_specific_notification($id)
    {
        $this->db->where('notificacionId', $id);
        $data = $this->db->get('notificaciones');
        return $data->row();
    }
	
	/**
     * Method for load all the information about the news and can
     * show then in the mobile app, this for can show in the list
     * to the user admin as well.
     *
     * @params mixed arrayData
     * @return int id
     **/
    public function save_news($data){
        $this->db->insert('noticias', $data);
        return $this->db->insert_id();
    }
	
	/*
	* metodo para guardar en la tabla de eventos
	*/
	public function save_eventos($data){
        $this->db->insert('eventos', $data);
        return $this->db->insert_id();
    }

	/**
     * Method to use for get all the information 
     * of the news will be added to a list for show the
     * information to the admin panel
     *
     * @return array mixedData
     **/
    public function get_all_news(){
        $data = $this->db->get('noticias');
        return $data->result();
    }
	
	/*
	* metodo para obtener un volcado de 
	* todos los eventos
	*/
	public function get_all_eventos(){
        $data = $this->db->get('eventos');
        return $data->result();
    }
	
	
	
	/**
     * Method for get the specific data of the specific
     * news and can show to users for edit or just know
     * what is the information to share the mobile app's users
     *
     * @params int idNews
     * @return array mixedData
     **/
    public function get_specific_news($id){
        $this->db->where('noticiasId', $id);
        $data = $this->db->get('noticias');
        return $data->row();
    }
	
	
	/*
	* funcion para obtener los datos de 
	* un reguistro de la tabla eventos
	*/
	public function get_specific_eventos($id){
        $this->db->where('eventosId', $id);
        $data = $this->db->get('eventos');
        return $data->row();
    }
	
	/**
     * Method for load all the information for can see the data
     * will be update by the user admin and then can show the
     * updates in the mobile app
     *
     * @params array mixedData
     * @params int idNews
     *
     * @return void
     **/
    public function update_news($data, $id){
        $this->db->update('noticias', $data, array('noticiasId'=>$id));
    }
	
	
	/*
	* funcion para editar un registro de la tabla eventos
	*/
	public function update_eventos($data, $id){
        $this->db->update('eventos', $data, array('eventosId'=>$id));
    }
	
	 /**
     * Method for delete the specific notification and the user can
     * see how drop or how to hide the information wants to delete
     * once confirm the dialog box
     *
     * @params int idNotification
     * @return void
     **/
    public function delete_specific_notification($id)
    {
        $this->db->delete('notificaciones', array('notificacionId'=>$id));
    }
	
	/**
     * Method for know the data if exists the banners
     * of the system and know if need to delete or not
     * all is by the system
     *
     * @params int status
     * @return void
     **/
    public function count_banners_exists($status)
    {
        $this->db->where('bannerStatus', $status);
        $total = $this->db->count_all_results('banners');
        return $total;
    }
	
	/**
     * Method for get all the information about the data
     * of the banners and need to take all the information
     * for can give them data
     *
     * @return array mixedData
     **/
    public function get_values_banner($restaurante,$sucursal)
    {
        $this->db->where('bannerRestaurante',$restaurante);
		$this->db->where('bannerSucursal',$sucursal);
		$this->db->where('bannerStatus', 1);
        $data = $this->db->get('banners');
        return $data->result();
    }
	
	/**
     * Method used for delete all the exists banners and
     * used for know whats the meaning the values and can 
     * update for the new banners
     *
     * @params int idBanner
     * @return void
     **/
    public function delete_banners_exists($id)
    {
        $this->db->delete('banners', array('bannerId'=>$id));
    }
	
	/**
     * Method for save all the information about the banners and
     * the system can laod this data in the mobil app. This information
     * is important because the user admin need to load the images in the
     * app for the final user can see it
     *
     * @params array mixed
     * @return int id
     **/
    public function save_new_banners($data)
    {
        $this->db->insert('banners', $data);
        return $this->db->insert_id();
    }
	
	/**
     * Method to delete the information selected by the user
     * and can know what won't show to final user anymore
     *
     * @params int idNews
     * @return void
     **/
    public function remove_data_news($id){
        $this->db->delete('noticias', array('noticiasId'=>$id));
    }
	
	/*
	* metodo para eliminar un registro de la tabla
	* eventos.
	*/
	 public function remove_data_evento($id){
        $this->db->delete('eventos', array('eventosId'=>$id));
    }
	
	/*
	* 
	*/
	public function count_results_users($user, $pass)
    {
        $this->db->where('userUsername', $user);
        $this->db->where('userPassword', $pass);
        $total = $this->db->count_all_results('usuarios');
        return $total;
    }
	
	/*
	*
	*/
	public function get_all_data_users_specific($username, $pass)
    {
        $this->db->where('userUsername', $username);
        $this->db->where('userPassword', $pass);
        $data = $this->db->get('usuarios');
        return $data->row();
    }
	
	
	
	/*
	* metodo para guardar en la tabla de eventos_images
	* autor: jalomo <jalomo@hotmail.es>
	*/
	 public function save_eventos_image($data){
        $this->db->insert('eventos_images', $data);
		return $this->db->insert_id();
    }
	
	/*
	* funcion para obtener las imagenes de un evento.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_images_evento($idEvento){
		$this->db->where('imaIdEvento',$idEvento);
		$query=$this->db->get('eventos_images');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	/*
	* metodopara eliminar una imagen de eventos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function deleteImageEvento($idimage){
		$this->db->delete('eventos_images', array('imaId'=>$idimage));
	}
	
	/*
	* metodo para obtener la informacion de unaimagen de un evento.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function getImageEvento($idImage){
		$this->db->where('imaId',$idImage);
		$query=$this->db->get('eventos_images');
		if($query->num_rows()>0){
			$result=$query->row();
			return $result->imaPath;
		}else{
			return 0;
		}
	}
	
}
