<?php
/**
 
 **/
class Mobile extends CI_Model {

    /**
     
     **/
    public function __construct(){
        parent::__construct();
    }
	
	
	/*
	* metodo para obtener las noticias existentes.
	* autor: jalomo <jalomo@hotmal.es>
	*/
	public function getNotificaciones(){
		$data = $this->db->get('noticias');
		if ($data->num_rows()>0){
			return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para obtener una noticia por 
	* medio de su id.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function getNoticiaId($id){
		$this->db->where('noticiasId',$id);
		$data= $this->db->get('noticias');
		if($data->num_rows()>0){
			return $data->result();
		}else{
			return 0;
		}
	}
	
	/*
	* metodo para obtener un evento por 
	* medio de su id.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function getEventosId($idevento){
		$this->db->where('eventosId',$idevento);
		$data=$this->db->get('eventos');
		if($data->num_rows()>0){
			return $data->result();
		}else{
			return 0;
		}
	}
	
	/*
	* metodo para obtener un volcado de todos
	* los enventos que existen.
	* autor:jalomo <jalomo@hotmail.es>
	*/
	public function getEventos(){
		$data=$this->db->get('eventos');
		if($data->num_rows()){
			return $data->result();
		}else{
			return 0;
		}
	}
	
	/*
	* metodo para obtener un volcado de todas
	* las entrevistas.
	* autor:jalomo <jalomo@hotmail.es>
	*/
	public function getEncuestas(){
		$data=$this->db->get('encuestas');
		if($data->num_rows()){
			return $data->result();
		}else{
			return 0;
		}
	}
	
	/*
	* mtodo para obtener las preguntas de una encuesta.
	`* autor : jalomo <jalomo@hotmail.es>
	*/
	public function get_question($idencuesta){
		$this->db->where('preguntaIdEncuesta',$idencuesta);
		$data=$this->db->get('preguntas');
		if($data->num_rows()){
			$resultado=$data->result();
				
				$response=array();
				foreach($resultado as $pregunta):
					$res=array();
					$res['preguntaId']=$pregunta->preguntaId;
					$res['preguntaTitulo']=$pregunta->preguntaTitulo;
					$res['preguntaFechaCreacion']=$pregunta->preguntaFechaCreacion;
					$res['preguntaOpciones']=$this->getOpciones($pregunta->preguntaId);
					array_push($response, $res);
					
				endforeach;
				return json_encode($response);
			
		}else{
			return 0;
		}
	}
	
	/*
	* metodo para obtener un volcado de todas
	* las opciones de una pregunta.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function getOpciones($idpregunta){
		$this->db->where('opcionIdPregunta',$idpregunta);
		$data=$this->db->get('opciones');
		if($data->num_rows()){
			return $data->result();
		}else{
			return 0;
		}
	}
	
	/*
	* metodo para votar una opcion de una pregunta.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function votar_opcion($idOpcion){
		$this->db->select('opcionValor');
		$this->db->where('opcionId',$idOpcion);
		$query=$this->db->get('opciones');
		if($query->num_rows()>0){
			$result=$query->row();
			$suma=$result->opcionValor+1;
			$this->db->update('opciones', array('opcionValor'=>$suma), array('opcionId'=>$idOpcion));
			return 1;
		}else{
			return 0;	
		}
	}
	
	/*
	* funcion para guardar las citas de las familias
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_citas($data){
		$this->db->insert('citas', $data);
        return $this->db->insert_id();
	}
	
	/*
	* volcado de las citas de un usuario
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function getcitas($idMaestro){
		$this->db->where('citaIdMaestro',$idMaestro);
		$data=$this->db->get('citas');
		if($data->num_rows()){
			return $data->result();
		}else{
			return 0;
		}
	}
	
	/*
	* funcion para eliminar un registro de la
	* tabla citas.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function delete_cita($idCita){
		 $this->db->delete('citas', array('citaId'=>$idCita));
	}
	
	/*
	* metodo para obtener las imagenes de un evento.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_images_evento($idevento){
		$this->db->where('imaIdEvento',$idevento);
		$query=$this->db->get('eventos_images');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;
		}
	}
}
