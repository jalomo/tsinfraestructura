<?php if(! defined('BASEPATH')) exit('No script access allowed');

class Mobiles extends MX_Controller {

    /**
     * Construct where can declare all the files will
     * be used in all the class
     **/
    public function __construct(){
        parent::__construct();
        $this->load->model('Mobile', '', TRUE);
        $this->load->helper(array('mobiles'));
    }

  
	
	/*
	* Metodo para generar el 
	* json para obtener el volcado de todas
	* las noticias
	* autor:jalomo<jalomo@hotmail.es>
	*/
	public function get_noticias()
    {	
		$data = $this->Mobile->getNotificaciones();
        echo json_encode($data);
		
    }
	
	/*
	* Funcion para obtener una noticia
	* por medio de su id.
	* autor:jalomo<jalomo@hotmail.es>
	*/
	public function get_noticias_id($idnoticia=null){
		if(isset($idnoticia)){
			$data =$this->Mobile->getNoticiaId($idnoticia);
			echo json_encode($data);
		}else{
			echo 0;
		}
	}
	
	/*
	* funcion para obtener el volcado 
	* de json de los eventos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_eventos(){
		$data=$this->Mobile->getEventos();
		echo json_encode($data);
	}
	
	/*
	* funcion para obtener un evento
	* mediante su id.
	* autor: jalomo<jalomo@hotmail.es>
	*/
	public function get_evento_id($idevento=null){
		if(isset($idevento)){
			$data=$this->Mobile->getEventosId($idevento);
			echo json_encode($data);
		}else{
			echo 0;
		}
	}
	
	/*
	* funcion para obtener el volcado de las
	* encuestas.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_encuesta(){
		$data=$this->Mobile->getEncuestas();
		echo json_encode($data);
		
	}
	
	/*
	* funcion para obtener las preguntas de
	* una encuesta.
	* autor: jalomo<jalomo@hotmail.es>
	*/
	public function get_question($idencuesta= null){
		if(isset($idencuesta)){
			echo $this->Mobile->get_question($idencuesta);
		}else{
			echo 0;	
		}
		
	}
	
	
	/*
	* funcion para botar por una opcion de una pregunta
	* de la encuesta.
	* parametro: id de la opcion de la pregunta
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function vote_question($idOpcion=null){
		if(isset($idOpcion)){
				echo $this->Mobile->votar_opcion($idOpcion);
		}
			
	}
	
	
	/*
	* funcion para guardar una cita.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function savecita(){
        $nombre = $this->input->post('nombre');
        $tel = $this->input->post('telefono');
        $idfamilia = $this->input->post('idfamilia');
		$idmaestro = $this->input->post('idmaestro');
        $hora = $this->input->post('hora');
        $fecha = $this->input->post('fecha');
        $dispositivo = $this->input->post('dispositivo');
        $token = $this->input->post('token');
        if(isset($nombre) && isset($tel) && isset($hora) && isset($fecha) && isset($dispositivo) && isset($token) && isset($idfamilia) && isset($idmaestro)){
            $array = array('citaIdFamilia'=>$idfamilia,
                           'citaIdMaestro'=>$idmaestro,
                           'citaNombre'=>$nombre,
                           'citaTokenUsuario'=>$token,
                           'citaDispositivo'=>$dispositivo,
                           'citaTelefono'=>$tel,
                           'citaFecha'=>$fecha,
						   'citaHora'=>$hora);
            $id = $this->Mobile->save_citas($array);
            echo $id;
        }
        else{
            echo "-1";
        }
    }
	
	
	/*
	* funcion para mostrar las citas de un maestro
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_citas($idMaestro=null){
		if(isset($idMaestro)){
			$data=$this->Mobile->getcitas($idMaestro);
			echo json_encode($data);	
		}
	}	
	
	/*
	* funcion para eliminar una cita
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function deleteCita($idCita=null){
		if(isset($idCita)){
			$this->Mobile->delete_cita($idCita);
			echo 1;	
		}else{
			echo 0;	
		}	
	}
	
	/*
	* funcion de login para los maestor
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function loginMaestro(){
		$nombre = $this->input->post('nombre');
		$contrasena = $this->input->post('contrasena');
		if(isset($nombre) && isset($contrasena)){
			$aux=explode(" ",$nombre);
			$total=strlen($aux[0]);
			$contra=$aux[0].'.'.$total;
			
			if($contra==$contrasena){
				echo '1';	
			}else{
				echo '0';	
			}
		}else{
			echo '0';	
		}
	}
	
	/*
	* metodo para obtener las imagenes de un evento.
	* autor: jalomo@hotmail.es
	*/
	public function getImagesEvento($idEvento=null){
		if(isset($idEvento)){
			$imagenes=$this->Mobile->get_images_evento($idEvento);
			echo json_encode($imagenes);
		}else{
			echo 0;
		}	
	}
	
   
}
