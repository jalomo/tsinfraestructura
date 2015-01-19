<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**

 **/
class Companies extends MX_Controller {

    /**
     
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company', '', TRUE);
        $this->load->library(array('session'));
        $this->load->helper(array('form', 'html', 'companies', 'url'));
    }
	
	public function index(){

        $content = $this->load->view('companies/panel_menu', '', TRUE);
        $this->load->view('main/template', array('aside'=>'',
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/modules/login.js')));
		
	}
	
	/*
	*metodo para crear usuarios 
	*administradores
	*autor: jalomo <jalomo@hotmail.es>
	*/
	public function crear_admin(){
	
        $this->load->view('companies/registro_admin');
  
	}
	
	/**
     *metodo para guardar el registro del
	 *administrador
     * 
     **/
    public function guarda_admin()
    {
        $post = $this->input->post('Registro');
        if($post)
        {
            $pass = encrypt_password($post['userUsername'],
                                     $this->config->item('encryption_key'),
                                     $post['userPassword']);
            $post['usernPassword'] = $pass;
            $post['userStatus'] = 1;
			//$post['adminFecha']=date('Y-m-d');
            $id = $this->Company->save_admin($post);
            echo $id;
        }
        else{
        }
    }
	
	/*
	*metodo para checar el login y la contraseña
	*/
	public function checkDataLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if(isset($username) && isset($password) && !empty($password) && !empty($username))
        {
            $pass = encrypt_password($username,
                                     $this->config->item('encryption_key'),
                                     $password);
            $total = $this->Company->count_results_users($username, $pass);
            if($total == 1)
            {
                echo "1";
            }
            else{
                echo "0";
            }
        }
        else{
            redirect('companies');
        }
    }
	
	/*
	*metodo para inicio de session
	*/
	public function mainView()
    {
        $post = $this->input->post('Login');
        if(isset($post) && !empty($post))
        {
            $pass = encrypt_password($post['userUsername'],
                                     $this->config->item('encryption_key'),
                                     $post['userPassword']);
            $dataUser = $this->Company->get_all_data_users_specific($post['userUsername'], $pass);

            $array_session = array('id'=>$dataUser->userId);
            $this->session->set_userdata($array_session);

            if($this->session->userdata('id'))
            {
				
				$status=get_status($this->session->userdata('id'));
				if($status==3){
					redirect('companies/reportes');
				}else{
				redirect('companies/panelMenu');
				}
                /*$aside = $this->load->view('companies/left_menu', '', TRUE);
                $content = $this->load->view('companies/main_view', '', TRUE);
                $this->load->view('main/template', array('aside'=>$aside,
                                                         'content'=>'',
														 'included_js'=>array('statics/js/modules/menu.js')));*/
            }
            else{
            }
        }
        else{
        }
    }
	
	public function panelMenu($page=null){
		
		if($this->session->userdata('id'))
        {
		 if($page<0){
                $page=0;
            }
		$data['page']=$page;
		
		 $buscar = $this->input->post('buscar');
		 
		 if($buscar!=''){
			 $data['proyectos']=$this->Company->get_proyectos_buscar($page,$buscar);
		 }else{
			 $data['proyectos']=$this->Company->get_proyectos($page);
		 }
		
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/add_proyecto', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/proyecto.js','statics/js/modules/m_proyecto.js')));
		}else{
			redirect('companies/');
            }											   
		
	}
	
	/*
	* metoso para guardar un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_proyecto(){
		if($this->session->userdata('id'))
        {
		 $post = $this->input->post('proyecto');
		 $post['proyectoImporte']=str_replace(',','',$post['proyectoImporte']); 
		 
		 
		 $post['proyectoFechaCreacion']=date('Y-m-d');
		 $this->Company->save_proyecto($post);
		
		}else{
			redirect('companies/');
            }
	}
	
	/*
	* metodo para obtener la informacion de un proyecto.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function editar_proyecto($id){
	if($this->session->userdata('id'))
        {	
		$resultado=$this->Company->get_proyecto_id($id);	
		$resultado->proyectoImporte=number_format($resultado->proyectoImporte,2);
		echo json_encode($resultado);
	 }else{
			redirect('companies/');
            }	 
	}
	
	/*
	* metodo para obtener el rubro y el periodo de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_rubro_periodo($id_proyecto){
		
		$rubros=$this->Company->get_rubros($id_proyecto);
		//$periodos=$this->Company->get_periodos($id_proyecto);
		
		if($rubros!=0):
		$rubros_='Rubro:<select name="factura[facturaIdRubro]">';
		foreach($rubros as $rubro):
		$rubros_.='<option value="'.$rubro->rubroId.'">'.$this->Company->get_rubros_name($rubro->rubroId).'</option>';
		endforeach;
		$rubros_.='</select><br/>';
		else:
		
		$rubros_="carga rubros";
		endif;
		
		/*if($periodos!=0):
		$periodo_='Periodo:<select name="factura[facturaPreriodoId]">';
		foreach($periodos as $periodo):
		$periodo_.='<option value="'.$periodo->periodoId.'">'.$periodo->periodoNombre.'</option>';
		endforeach;	
		$periodo_.='</select>';
		else:
		$periodo_='Carga periodos';
		endif;*/
		
		echo $rubros_;
	}
	
	/*
	* metodo para editar un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function edita_proyecto(){
		if($this->session->userdata('id'))
        {
		$data = $this->input->post('proyectoE');
		$id = $this->input->post('proyectoId');
		
		$data['proyectoImporte']=str_replace(',','',$data['proyectoImporte']); 
		
		
		$this->Company->editar_proyecto($id,$data);
		}else{
			redirect('companies/');
            }	
	}
	
	/*
	* eliminar proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_proyecto($id){
		if($this->session->userdata('id'))
        {
		$this->Company->eliminar_proyecto($id);
		}else{
			redirect('companies/');
            }	
	}
	
	
	
	/*
	* metodo para agregar facturas al proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function add_facturas($page=null){
		if($this->session->userdata('id'))
        {
		
		if($page<0){
                $page=0;
            }
		$data['page']=$page;
		
		 $buscar = $this->input->post('buscar');
		 
		 if($buscar!=''){
			 $data['proyectos']=$this->Company->get_proyectos_buscar($page,$buscar);
		 }else{
			 $data['proyectos']=$this->Company->get_proyectos($page);
		 }
		 
		
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/add_facturas',$data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/proyecto.js','statics/js/modules/m_facturas.js')));
		}else{
			redirect('companies/');
            }												   
	}
	
	/*
	* metodo para agregar una factura a un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function agrega_factura(){
		if($this->session->userdata('id'))
        {
		 $post = $this->input->post('factura');
		 
		 $resultado=$this->Company->fecha_periodo($post['facturaFecha'],$post['facturaIdProyecto']);
		if($resultado!=0):
		
		$post['facturaPreriodoId']=$resultado;
		 
		 $post['facturaFechaCreacion']=date('Y-m-d');
		 
		 
		 
		 
		 $id=$this->Company->save_facturas($post);
		 
		 
		 
		 
		  $productos = $this->input->post('productos');
		 
		  $top=sizeof($productos['productoNombre']);
		  
		  for($i=0;$i<$top;$i++):
		  
		    $data['productoNombre']=$productos['productoNombre'][$i];
		    $data['productoCantidad']=$productos['productoCantidad'][$i];
		    $data['productoMedida']=$productos['productoMedida'][$i];
		    $data['productoPrecio']=$productos['productoPrecio'][$i];
		    $data['productoTotal']=$productos['productoTotal'][$i];
			$data['productoIdFactura']=$id;
			if($data['productoNombre']=='' && $data['productoCantidad']=='' && $data['productoMedida']=='' && $data['productoPrecio']=='' && $data['productoTotal']==''){
				
			}else{
				//print_r($data);	
				
				$this->Company->save_productos($data);
				
			}
			
		  	
		  endfor;
		  
		  echo 1;
		
		else:
		
			echo 0;
		endif;
		  
		}else{
			redirect('companies/');
            }	 
	}
	
	
	/*
	* metodo para guardar un producto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function guardar_producto_id(){
		if($this->session->userdata('id'))
        {
		$data['productoIdFactura'] = $this->input->post('productoIdFactura');
		$data['productoTotal'] = $this->input->post('productoTotal');
		$data['productoPrecio'] = $this->input->post('productoPrecio');
		$data['productoMedida'] = $this->input->post('productoMedida');
		$data['productoCantidad'] = $this->input->post('productoCantidad');
		$data['productoNombre'] = $this->input->post('productoNombre');
		
		
		
		$id=$this->Company->save_productos($data);
		echo $id;
		
		}else{
			echo 0;
            }	
		
	}
	
	/*
	* metodo para ver las facturas de un proyecto.
	* autor: jalomo@hotmail.es
	*/
	public function ver_facturas($idproyecto){
		
		if($this->session->userdata('id'))
        {
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));	
		$data['proyecto']=$this->Company->get_proyecto_id($idproyecto);
		$data['facturas']=$this->Company->get_facturas($idproyecto);
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/ver_facturas',$data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/m_facturas.js')));
		}else{
			redirect('companies/');
            }											   
	}
	
	/*
	* metodo para eliminar una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_factura($id){
		if($this->session->userdata('id'))
        {
		$this->Company->eliminar_factura($id);
		$this->Company->eliminar_productos($id);
		}else{
			redirect('companies/');
            }
	}
	
	/*
	* metodo para eliminar un producto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function elimina_pro($id){
		if($this->session->userdata('id'))
        {
			
		
		$resultado=$this->Company->eliminar_producto_id($id);	
		echo 1;
		}else{
			echo 0;
            }	
	}
	
	/*
	* metodo para extraer los datos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function edita_factura($id){
		if($this->session->userdata('id'))
        {
		$resultado=$this->Company->get_factura_id($id);	
		echo json_encode($resultado);
		}else{
			redirect('companies/');
            }
	}
	
	/*
	* metodo para editar un producto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function edita_prudcto($id){
		if($this->session->userdata('id'))
        {
			
		$data = $this->input->post('productos');	
		$resultado=$this->Company->editar_productos($id,$data);	
		echo 1;
		}else{
			echo 0;
            }
	}
	
	/*
	* metodo para editar un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function edita_factura_id(){
		if($this->session->userdata('id'))
        {
		$data = $this->input->post('factura');
		$id = $this->input->post('facturaId');
		$this->Company->editar_factura($id,$data);
		}else{
			redirect('companies/');
            }
	}
	
	
	/*
	* metodo para crear usuarios.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function usuarios(){
		
		if($this->session->userdata('id'))
        {
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));
		$data['usuarios']=$this->Company->get_usuarios();
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/usuarios',$data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/m_usuarios.js')));
		}else{
			redirect('companies/');
            }											   
	}
	
	/*
	* metodo para agregar un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function agregar_usuario(){
		if($this->session->userdata('id'))
        {
		 
		  $post = $this->input->post('user');
        if($post)
        {
            $pass = encrypt_password($post['userUsername'],
                                     $this->config->item('encryption_key'),
                                     $post['userPassword']);
            $post['userPassword'] = $pass;
           
			
            $id = $this->Company->save_usuarios($post);
            echo $id;
        }
        else{
        }
		
		}else{
			redirect('companies/');
            }
		 
		 
	}
	
	/*
	* metodo para obtener los datos de un cliente.
	* autor: jalomo <jalomo@htomail.es>
	*/
	public function edita_usuario($id){
		if($this->session->userdata('id'))
        {
		$resultado=$this->Company->get_user_id($id);	
		echo json_encode($resultado);
		}else{
			redirect('companies/');
            }
	}
	
	
	
	
	
	
	/*
	* metodo para editar un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function edita_usuario_id(){
		if($this->session->userdata('id'))
        {
		$data = $this->input->post('user1');
		$id = $this->input->post('userId');
		$pass = encrypt_password($data['userUsername'],
                                     $this->config->item('encryption_key'),
                                     $data['userPassword']);
			if($data['userPassword']){						 
            $data1['userPassword'] = $pass;
			$data1['userNombre'] = $data['userNombre'];
			$data1['userUsername'] =$data['userUsername'];
			$data1['userStatus'] = $data['userStatus'] ;
			}else{
				
			$data1['userNombre'] = $data['userNombre'];
			$data1['userUsername'] =$data['userUsername'];
			$data1['userStatus'] = $data['userStatus'] ;	
			}
		$this->Company->editar_usuario($id,$data1);
		}else{
			redirect('companies/');
            }
	}
	
	/*
	* eliminar usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eliminar_usuario($id){
		if($this->session->userdata('id'))
        {
		$this->Company->eliminar_usuario($id);
		}else{
			redirect('companies/');
            }
	}
	
	/*
	* metodo para cerrar sesion.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect('companies');
    }
	
	
	
	/*
	* metodo para los reportes.
	* autor: jalomo<jalomo@hotmail.es>
	*/
	public function reportes($page=null){
		
		
		if($this->session->userdata('id'))
        {
		 if($page<0){
                $page=0;
            }
		$data['page']=$page;
		
		 $buscar = $this->input->post('buscar');
		 
		 if($buscar!=''){
			 $data['proyectos']=$this->Company->get_proyectos_buscar($page,$buscar);
		 }else{
			 $data['proyectos']=$this->Company->get_proyectos($page);
		 }
		
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/reportes', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/proyecto.js','statics/js/modules/m_reportes.js')));
		}else{
			redirect('companies/');
            }											   
								   
	}
	
	/*
	* esta funcion exporta la informacion de 
	* todos losproyectos y todas las facturas.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	 public function excel_general()
    {
		ini_set('memory_limit', '300M');
		
		set_time_limit(240);
       
	   $proyectos=$this->Company->get_proyectos_excel();
	   //START THE EXCEL CLASS
        $this->load->library('Classes/PHPExcel');
        $phpexcel = new PHPExcel();
        $phpexcel->getActiveSheet()->setTitle('Reporte ');
        $phpexcel->setActiveSheetIndex(0);
		
		$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('My Image');
			$objDrawing->setDescription('impulsos');
			$objDrawing->setPath('statics/img/logo2.png');
			$objDrawing->setCoordinates('A1');
			$objDrawing->setWorksheet($phpexcel->getActiveSheet());

        $sheet = $phpexcel->getActiveSheet();
        $sheet->getDefaultStyle()->getFont()->setSize(10);
        //$sheet->getColumnDimension('A2:BI2')->setWidth(40);
       // $sheet->getRowDimension(2)->setRowHeight(35);
        if($proyectos!=0):
        //$sheet->mergeCells("D1:G1");
		$aux=3; 
		foreach($proyectos as $proyecto):
		
		$aux1=$aux;
		$aux2=$aux+1;
		$aux3=$aux2+1;
		$aux4=$aux3+1;
		$aux5=$aux4+1;
		$aux6=$aux5+1;
		$aux7=$aux6+1;
        $sheet->setCellValue("B".$aux1, 'Nombre proyecto:');
		$sheet->setCellValue("C".$aux1, $proyecto->proyectoNombre);
		$sheet->getStyle('C'.$aux1)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux1.':H'.$aux1.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux1.':H'.$aux1.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        $sheet->setCellValue("B".$aux2, 'proyecto No:');
		 $sheet->setCellValue("C".$aux2, $proyecto->proyectoNo);
		$sheet->getStyle('C'.$aux2)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux2.':H'.$aux2.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux2.':H'.$aux2.'')->getFill()->getStartColor()->setRGB('ffffff');
		
        $sheet->setCellValue("B".$aux3, 'Fecha liberacion:');
		$sheet->setCellValue("C".$aux3, $proyecto->proyectoLiberacion);
		$sheet->getStyle('C'.$aux3)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux3.':H'.$aux3.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux3.':H'.$aux3.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
		$sheet->setCellValue("B".$aux4, 'Nombre cliente:');
		$sheet->setCellValue("C".$aux4, $proyecto->proyectoNombreCliente);
		$sheet->getStyle('C'.$aux4)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux4.':H'.$aux4.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux4.':H'.$aux4.'')->getFill()->getStartColor()->setRGB('ffffff');
		
        $sheet->setCellValue("B".$aux5, 'Importe SIN IVA');
		$sheet->setCellValue("C".$aux5, "$".number_format($proyecto->proyectoImporte,2));
		$sheet->getStyle('C'.$aux5)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux5.':H'.$aux5.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux5.':H'.$aux5.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        
       $sheet->setCellValue("B".$aux6, 'Total facturas SIN IVA');
		$sheet->setCellValue("C".$aux6, "$". number_format($this->Company->total_facturas_iva($proyecto->proyectoId), 2));
		$sheet->getStyle('C'.$aux6)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux6.':H'.$aux6.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux6.':H'.$aux6.'')->getFill()->getStartColor()->setRGB('ffffff');
		
		
		$sheet->setCellValue("B".$aux7, ' Diferencia SIN IVA');
		$sheet->setCellValue("C".$aux7, "$".number_format($proyecto->proyectoImporte-$this->Company->total_facturas_iva($proyecto->proyectoId), 2));
		$sheet->getStyle('C'.$aux7)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux7.':H'.$aux7.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux7.':H'.$aux7.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        
        $sheet->getColumnDimension('B')->setWidth(20);
		$sheet->getColumnDimension('C')->setWidth(20);
        
		$sheet->getStyle('B'.$aux.':H'.$aux.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux.':H'.$aux.'')->getFill()->getStartColor()->setRGB('d7d5d2');
		
		
		$aux+=8;
		
		
			$facturas=$this->Company->get_facturas_excel($proyecto->proyectoId);
			if($facturas!=0):
			$fac=$aux;
			
			     
				$sheet->getColumnDimension('F')->setWidth(30);
				$sheet->getColumnDimension('D')->setWidth(20);
				$sheet->getColumnDimension('G')->setWidth(20);
				$sheet->getColumnDimension('J')->setWidth(20);
				$sheet->getColumnDimension('L')->setWidth(20);
			     
			     
			     
				
				 
			
			foreach($facturas as $factura):
				
				$fac++;
				
				
				$sheet->setCellValue("B".$fac,'Proyecto:'.get_nombre_proyecto( $factura->facturaIdProyecto));
				 $sheet->setCellValue("B".$fac++,'Proveedor:'. $factura->facturaProveedor);
			     $sheet->setCellValue("B".$fac++,'factura No:'. $factura->facturaNo);
				 $sheet->setCellValue("B".$fac++, 'Fecha:'.$factura->facturaFecha);
				
				
				 $productos=$this->Company->get_productos_id($factura->facturaId);
				 
				 if($productos!=0){
					 
					$pro=$fac;
					
					$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        	$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->getStartColor()->setRGB('d7d5d2');
			 
				 $sheet->setCellValue("B".$pro, 'Descripcion:');
				 $sheet->setCellValue("C".$pro, 'Costo unitario:');
				 $sheet->setCellValue("D".$pro, 'Cantidad:');
				 $sheet->setCellValue("E".$pro, 'Medida:');
			     $sheet->setCellValue("F".$pro, 'Total sin iva:');
				 $sheet->setCellValue("G".$pro, 'IVA:');
				 $sheet->setCellValue("H".$pro, 'Total con iva:');
			     
				$sheet->getColumnDimension('H')->setWidth(20);
					
					
					
					
					foreach($productos as $producto):
					$pro++;
					$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->getStartColor()->setRGB('f0ede8');
					
					$sheet->setCellValue("B".$pro, $producto->productoNombre);
					$sheet->setCellValue("C".$pro, $producto->productoPrecio);
				   $sheet->getStyle("C".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
				   $sheet->setCellValue("D".$pro, $producto->productoCantidad); 
				   $sheet->setCellValue("E".$pro, $producto->productoMedida);
				  
				   $sheet->setCellValue("F".$pro,$producto->productoTotal);
				   $sheet->getStyle("F".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
				   
				   $sheet->setCellValue("G".$pro,($producto->productoTotal)*.16);
				   $sheet->getStyle("G".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
				   
				    $sheet->setCellValue("H".$pro,$producto->productoTotal+(($producto->productoTotal)*.16));
				  $sheet->getStyle("H".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
						
					endforeach;
					$fac=$pro+1;	 
				 }
			     
			     
			     
				 
				 
			
			endforeach;
		
		$aux=$fac+1;
		    endif;
			$aux++;
        endforeach;
        endif;
       
        $name_report = 'reporte'.date('Ymd');
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$name_report.xls\"");
        header("Cache-Control: max-age=0");
        
        $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, "Excel5");
        $objWriter->save("php://output");
        exit;
    }
    
	/*
	* metodo para exportas solo los proyectos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	 public function excel_proyectos()
    {
		ini_set('memory_limit', '300M');
		
		set_time_limit(240);
       
	   $proyectos=$this->Company->get_proyectos_excel();
	   
        //START THE EXCEL CLASS
        $this->load->library('Classes/PHPExcel');
        $phpexcel = new PHPExcel();
        $phpexcel->getActiveSheet()->setTitle('Reporte ');
        $phpexcel->setActiveSheetIndex(0);
			
		$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('My Image');
			$objDrawing->setDescription('impulsos');
			$objDrawing->setPath('statics/img/logo2.png');
			$objDrawing->setCoordinates('A1');
			$objDrawing->setWorksheet($phpexcel->getActiveSheet());	
		
        $sheet = $phpexcel->getActiveSheet();
        $sheet->getDefaultStyle()->getFont()->setSize(10);
        //$sheet->getColumnDimension('A2:BI2')->setWidth(40);
       // $sheet->getRowDimension(2)->setRowHeight(35);
        if($proyectos!=0):
        //$sheet->mergeCells("D1:G1");
		$aux=3; 
		foreach($proyectos as $proyecto):
		
		$aux1=$aux;
		$aux2=$aux+1;
		$aux3=$aux2+1;
		$aux4=$aux3+1;
		$aux5=$aux4+1;
		$aux6=$aux5+1;
		$aux7=$aux6+1;
        $sheet->setCellValue("B".$aux1, 'Nombre proyecto:');
		$sheet->setCellValue("C".$aux1, $proyecto->proyectoNombre);
		$sheet->getStyle('C'.$aux1)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux1.':H'.$aux1.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux1.':H'.$aux1.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        $sheet->setCellValue("B".$aux2, 'proyecto No:');
		 $sheet->setCellValue("C".$aux2, $proyecto->proyectoNo);
		$sheet->getStyle('C'.$aux2)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux2.':H'.$aux2.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux2.':H'.$aux2.'')->getFill()->getStartColor()->setRGB('ffffff');
		
        $sheet->setCellValue("B".$aux3, 'Fecha liberacion:');
		$sheet->setCellValue("C".$aux3, $proyecto->proyectoLiberacion);
		$sheet->getStyle('C'.$aux3)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux3.':H'.$aux3.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux3.':H'.$aux3.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
		$sheet->setCellValue("B".$aux4, 'Nombre cliente:');
		$sheet->setCellValue("C".$aux4, $proyecto->proyectoNombreCliente);
		$sheet->getStyle('C'.$aux4)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux4.':H'.$aux4.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux4.':H'.$aux4.'')->getFill()->getStartColor()->setRGB('ffffff');
		
        $sheet->setCellValue("B".$aux5, 'Importe SIN IVA');
		$sheet->setCellValue("C".$aux5, "$".number_format($proyecto->proyectoImporte,2));
		$sheet->getStyle('C'.$aux5)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux5.':H'.$aux5.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux5.':H'.$aux5.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
       $sheet->setCellValue("B".$aux6, 'Total facturas SIN IVA');
		$sheet->setCellValue("C".$aux6, "$". number_format($this->Company->total_facturas_iva($proyecto->proyectoId), 2));
		$sheet->getStyle('C'.$aux6)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux6.':H'.$aux6.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux6.':H'.$aux6.'')->getFill()->getStartColor()->setRGB('ffffff');
		
		
		$sheet->setCellValue("B".$aux7, ' Diferencia SIN IVA');
		$sheet->setCellValue("C".$aux7, "$".number_format($proyecto->proyectoImporte-$this->Company->total_facturas_iva($proyecto->proyectoId), 2));
		$sheet->getStyle('C'.$aux7)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux7.':H'.$aux7.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux7.':H'.$aux7.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        
        $sheet->getColumnDimension('B')->setWidth(20);
		$sheet->getColumnDimension('C')->setWidth(20);
        
		$sheet->getStyle('B'.$aux.':H'.$aux.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux.':H'.$aux.'')->getFill()->getStartColor()->setRGB('d7d5d2');
		
		
		$aux+=9;
		
		
			
        endforeach;
        
       endif;
        $name_report = 'reporte'.date('Ymd');
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$name_report.xls\"");
        header("Cache-Control: max-age=0");
        
        $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, "Excel5");
        $objWriter->save("php://output");
        exit;
    }
	
	
	/*
	* metodo para obtener las facturas de un proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function excel_proyecto_facturas($idProyecto)
    {
		ini_set('memory_limit', '300M');
		
		set_time_limit(240);
       
	   $proyectos=$this->Company->get_proyectos__id_excel($idProyecto);
	   
        //START THE EXCEL CLASS
        $this->load->library('Classes/PHPExcel');
        $phpexcel = new PHPExcel();
        $phpexcel->getActiveSheet()->setTitle('Reporte ');
        $phpexcel->setActiveSheetIndex(0);
		
		$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('My Image');
			$objDrawing->setDescription('impulsos');
			$objDrawing->setPath('statics/img/logo2.png');
			$objDrawing->setCoordinates('A1');
			$objDrawing->setWorksheet($phpexcel->getActiveSheet());

        $sheet = $phpexcel->getActiveSheet();
        $sheet->getDefaultStyle()->getFont()->setSize(10);
        //$sheet->getColumnDimension('A2:BI2')->setWidth(40);
       // $sheet->getRowDimension(2)->setRowHeight(35);
        if($proyectos!=0):
        //$sheet->mergeCells("D1:G1");
		$aux=3; 
		foreach($proyectos as $proyecto):
		
		$aux1=$aux;
		$aux2=$aux+1;
		$aux3=$aux2+1;
		$aux4=$aux3+1;
		$aux5=$aux4+1;
		$aux6=$aux5+1;
		$aux7=$aux6+1;
        $sheet->setCellValue("B".$aux1, 'Nombre proyecto:');
		$sheet->setCellValue("C".$aux1, $proyecto->proyectoNombre);
		$sheet->getStyle('C'.$aux1)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux1.':H'.$aux1.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux1.':H'.$aux1.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        $sheet->setCellValue("B".$aux2, 'proyecto No:');
		 $sheet->setCellValue("C".$aux2, $proyecto->proyectoNo);
		$sheet->getStyle('C'.$aux2)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux2.':H'.$aux2.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux2.':H'.$aux2.'')->getFill()->getStartColor()->setRGB('ffffff');
		
        $sheet->setCellValue("B".$aux3, 'Fecha liberacion:');
		$sheet->setCellValue("C".$aux3, $proyecto->proyectoLiberacion);
		$sheet->getStyle('C'.$aux3)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux3.':H'.$aux3.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux3.':H'.$aux3.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
		$sheet->setCellValue("B".$aux4, 'Nombre cliente:');
		$sheet->setCellValue("C".$aux4, $proyecto->proyectoNombreCliente);
		$sheet->getStyle('C'.$aux4)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux4.':H'.$aux4.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux4.':H'.$aux4.'')->getFill()->getStartColor()->setRGB('ffffff');
		
        $sheet->setCellValue("B".$aux5, 'Importe SIN IVA');
		$sheet->setCellValue("C".$aux5, "$".number_format($proyecto->proyectoImporte,2));
		$sheet->getStyle('C'.$aux5)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux5.':H'.$aux5.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux5.':H'.$aux5.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        
       $sheet->setCellValue("B".$aux6, 'Total facturas SIN IVA');
		$sheet->setCellValue("C".$aux6, "$". number_format($this->Company->total_facturas_iva($proyecto->proyectoId), 2));
		$sheet->getStyle('C'.$aux6)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux6.':H'.$aux6.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux6.':H'.$aux6.'')->getFill()->getStartColor()->setRGB('ffffff');
		
		
		$sheet->setCellValue("B".$aux7, ' Diferencia SIN IVA');
		$sheet->setCellValue("C".$aux7, "$".number_format($proyecto->proyectoImporte-$this->Company->total_facturas_iva($proyecto->proyectoId), 2));
		$sheet->getStyle('C'.$aux7)->applyFromArray(array("font" => array("bold" => true)));
		$sheet->getStyle('B'.$aux7.':H'.$aux7.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux7.':H'.$aux7.'')->getFill()->getStartColor()->setRGB('d2ecf9');
		
        
        $sheet->getColumnDimension('B')->setWidth(20);
		$sheet->getColumnDimension('C')->setWidth(20);
        
		$sheet->getStyle('B'.$aux.':H'.$aux.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B'.$aux.':H'.$aux.'')->getFill()->getStartColor()->setRGB('d7d5d2');
		
		
		$aux+=8;
		
		
			$facturas=$this->Company->get_facturas_excel($proyecto->proyectoId);
			if($facturas!=0):
			$fac=$aux;
			
			     
				$sheet->getColumnDimension('F')->setWidth(30);
				$sheet->getColumnDimension('D')->setWidth(20);
				$sheet->getColumnDimension('G')->setWidth(20);
				$sheet->getColumnDimension('J')->setWidth(20);
				$sheet->getColumnDimension('L')->setWidth(20);
			     
			     
			     
				
				 
			
			foreach($facturas as $factura):
				
				$fac++;
				
				
				$sheet->setCellValue("B".$fac,'Proyecto:'.get_nombre_proyecto( $factura->facturaIdProyecto));
				 $sheet->setCellValue("B".$fac++,'Proveedor:'. $factura->facturaProveedor);
			     $sheet->setCellValue("B".$fac++,'factura No:'. $factura->facturaNo);
				 $sheet->setCellValue("B".$fac++, 'Fecha:'.$factura->facturaFecha);
				
				
				 $productos=$this->Company->get_productos_id($factura->facturaId);
				 
				 if($productos!=0){
					 
					$pro=$fac;
					
					$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        	       $sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->getStartColor()->setRGB('d7d5d2');
			 
				 $sheet->setCellValue("B".$pro, 'Descripcion:');
				 $sheet->setCellValue("C".$pro, 'Costo unitario:');
				 $sheet->setCellValue("D".$pro, 'Cantidad:');
				 $sheet->setCellValue("E".$pro, 'Medida:');
			     $sheet->setCellValue("F".$pro, 'Total sin iva:');
				 $sheet->setCellValue("G".$pro, 'IVA:');
				 $sheet->setCellValue("H".$pro, 'Total con iva:');
			     
				$sheet->getColumnDimension('H')->setWidth(20);
					
					
					
					
					foreach($productos as $producto):
					$pro++;
					$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
					$sheet->getStyle('B'.$pro.':H'.$pro.'')->getFill()->getStartColor()->setRGB('f0ede8');
					
					$sheet->setCellValue("B".$pro, $producto->productoNombre);
					$sheet->setCellValue("C".$pro, $producto->productoPrecio);
				   $sheet->getStyle("C".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
				   $sheet->setCellValue("D".$pro, $producto->productoCantidad); 
				   $sheet->setCellValue("E".$pro, $producto->productoMedida);
				  
				   $sheet->setCellValue("F".$pro,$producto->productoTotal);
				   $sheet->getStyle("F".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
				   
				   $sheet->setCellValue("G".$pro,($producto->productoTotal)*.16);
				   $sheet->getStyle("G".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
				   
				    $sheet->setCellValue("H".$pro,$producto->productoTotal+(($producto->productoTotal)*.16));
				  $sheet->getStyle("H".$pro)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
						
					endforeach;
					$fac=$pro+1;	 
				 }
			     
			     
			     
				 
				 
			
			endforeach;
		
		$aux=$fac+1;
		    endif;
			$aux++;
        endforeach;
        endif;
       
        $name_report = 'reporte'.date('Ymd');
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$name_report.xls\"");
        header("Cache-Control: max-age=0");
        
        $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, "Excel5");
        $objWriter->save("php://output");
        exit;
    }
	
	
	
	public function leer_excel(){
		
	   
        //START THE EXCEL CLASS
        $this->load->library('Classes/PHPExcel');
        $phpexcel = new PHPExcel();
        
        $phpexcel->setActiveSheetIndex(0);
		
		
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objReader->setReadDataOnly(true);
		 
		$objPHPExcel = $objReader->load(base_url()."statics/listadoproductosparaapp.xlsx");
		$objWorksheet = $objPHPExcel->getActiveSheet();
		 
		echo '<table>' . "\n";
		foreach ($objWorksheet->getRowIterator() as $row) {
		echo '<tr>' . "\n";
		 
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
		// even if it is not set.
		// By default, only cells
		// that are set will be
		// iterated.
		foreach ($cellIterator as $cell) {
		echo '<td>' . $cell->getValue() . '</td>' . "\n";
		}
		 
		echo '</tr>' . "\n";
		}
		echo '</table>' . "\n";
		
		
	}
	
	
	/*
	* agregar facturas
	*/
	public function agregar_facturas(){
			
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/agregar_facturas','', TRUE);
        $this->load->view('main/template', array(/*'aside'=>$aside,*/
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
		
	}
	
	public function agrega_factura_producto(){
		//if($this->session->userdata('id'))
       // {
		 $post = $this->input->post('factura');
		 $post['facturaFechaCreacion']=date('Y-m-d');
		$id= $this->Company->save_facturas($post);
		echo $id;
		redirect('companies/agregar_productos/'.$id.'');
		//}else{
			//redirect('companies/');
            //}	 
	}
	
	/*
	* metodo para obtener los datos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_datos_factura($id){
		$datos=$this->Company->get_factura_id($id);	
		echo json_encode($datos);
	}
	
	/*
	* metodo para agregar productos  a una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function agregar_productos($id){
		
		$data['productos']=$this->Company->get_productos_id($id);
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/agregar_productos',$data, TRUE);
        $this->load->view('main/template', array(/*'aside'=>$aside,*/
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
		
	}
	
	/*
	* metodo para obtener los datos de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_productos($id){
		$datos=$this->Company->get_productos_id($id);	
		echo json_encode($datos);
	}
	
	
	/*
	* metodo para crear un presupuesto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function presupuesto($id_proyecto){
		if($this->session->userdata('id'))
        {	
		
		$data['rubros']=$this->Company->get_rubros($id_proyecto);
		$data['id_proyecto']=$id_proyecto;
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/presupuesto',$data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/m_presupuesto.js')));
		}else{
			redirect('companies/');
            }											   
		
	}
	
	/*
	* metodo para guardar un rubro o un periodo.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function guarda_presupuesto($id_proyecto){
		//if($this->session->userdata('id'))
        //{
		$post= $this->input->post('presu');
				
		if(($post['prIdRubro'])!=''){
			$postR['prIdRubro']=$post['prIdRubro'];
			$postR['prIdProyecto']=$id_proyecto;
			$id=$this->Company->save_rubro_proyecto($postR);
			echo $id;
		}
		
		if(($post['periodoFechaInicio'])!='' &&  ($post['periodoFechaFinal'])!='' ){
			//$postP['periodoNombre']=$post['periodoNombre'];
			$postP['periodoFechaInicio']=$post['periodoFechaInicio'];
			$postP['periodoFechaFinal']=$post['periodoFechaFinal'];
			$postP['periodoIdProyecto']=$id_proyecto;
			$id=$this->Company->save_periodos($postP);
			echo $id;
		}
		
		
		
		//}else{
			//echo 0;
            //}	
		
	}
	
	/*
	* metodo para guardar cantidades.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_cantidades($id_rubro,$id_periodo,$precio){
		//if($this->session->userdata('id'))
        //{
			$data['cantidadPrecio']=$precio;
			$data['cantidadIdRubro']=$id_rubro;
			$data['cantidadIdPeriodo']=$id_periodo;
			$opt=$this->Company->cantidades_existentes($id_rubro,$id_periodo);
			if($opt==1){
				$this->Company->modifica_cantidades($id_rubro,$id_periodo,$data);
			}else{
				$id=$this->Company->save_cantidades($data);	
			}
			
			
			
		//}else{
			//echo 0;
        //}		
	}
	
	/*
	* metodo para obtener el total de un rubro .
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_total_rubro($id_rubro,$id_periodo){
		$res= $this->Company->get_rubro($id_rubro);
		echo $res;
	}
	
	/*
	* lista de presupuestos de cada proyecto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function list_presupuesto($page=null){
		
		if($this->session->userdata('id'))
        {
		 if($page<0){
                $page=0;
            }
		$data['page']=$page;
		
		 $buscar = $this->input->post('buscar');
		 
		 if($buscar!=''){
			 $data['proyectos']=$this->Company->get_proyectos_buscar($page,$buscar);
		 }else{
			 $data['proyectos']=$this->Company->get_proyectos($page);
		 }
		
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/lista_presupuesto', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/proyecto.js','statics/js/modules/m_presupuesto.js')));
		}else{
			redirect('companies/');
            }	
		
	}
	
	/*
	* metodo para editar el rubro y periodo de una factura.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function update_facturas($id_rubro,$id_periodo, $id_factura){
		
		$data['facturaIdRubro']=$id_rubro;
		$data['facturaPreriodoId']=$id_periodo;
		$this->Company->editar_factura($id_factura,$data);
		
	}
	
	/*
	* metodo para eliminar un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function delete_rubro($id_rubro){
		$this->Company->delete_rubro($id_rubro);
	}
	
	/*
	* metodo para eliminar un periodo.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function delete_periodo($ir_periodo){
		$this->Company->delete_periodo($ir_periodo);
	}
	
	
	/*
	* metodo para buscar un producto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function productos(){
		
		if($this->session->userdata('id'))
        {
			
		$id_rubro= $this->input->post('buscar');	
		if($id_rubro!=''):
		$data['productos']=$this->Company->get_productos_factura_rubro($id_rubro);
		else:
		$data['productos']=0;
		endif;
		
		$data['rubros']=$this->Company->get_all_rubros();
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/productos',$data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/m_producto.js')));
													   
		}else{
			redirect('companies/');
            }											   
		
	}
	
	
	/*
	* crea un rubro.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function crea_rubro(){
		
		if($this->session->userdata('id'))
        {
		$data['nombre_usuario']=get_name_user($this->session->userdata('id'));	
		
		$data['rubros']=$this->Company->get_all_rubros();
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/rubros',$data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/m_rubro.js')));
		}else{
			redirect('companies/');
            }											   
	}
	
	/*
	* guarda un rubro.
	+ autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_rubro(){
		$post= $this->input->post('save');	
		
		$this->Company->save_rubro($post);
		redirect('companies/crea_rubro');
		
	}
	
	/*
	* metodo para obtener el excel del presupuesto.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	 public function excel_presupuesto($id_proyecto)
    {
		ini_set('memory_limit', '300M');
		
		set_time_limit(240);
       
	   $proyectos=$this->Company->get_rubros_($id_proyecto);
	  
	   //START THE EXCEL CLASS
        $this->load->library('Classes/PHPExcel');
        $phpexcel = new PHPExcel();
        $phpexcel->getActiveSheet()->setTitle('Reporte ');
        $phpexcel->setActiveSheetIndex(0);
		
		$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('My Image');
			$objDrawing->setDescription('impulsos');
			$objDrawing->setPath('statics/img/logo2.png');
			$objDrawing->setCoordinates('A1');
			$objDrawing->setWorksheet($phpexcel->getActiveSheet());

        $sheet = $phpexcel->getActiveSheet();
        $sheet->getDefaultStyle()->getFont()->setSize(10);
        //$sheet->getColumnDimension('A2:BI2')->setWidth(40);
       // $sheet->getRowDimension(2)->setRowHeight(35);
        if($proyectos!=0):
        //$sheet->mergeCells("D1:G1");
		$aux=5; 
		
		$sheet->setCellValue("B4" ,'RUBROS');
		$sheet->getColumnDimension('B')->setWidth(40);
		$sheet->getStyle('B4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B4')->getFill()->getStartColor()->setRGB('d2ecf9');
		
		
		 $periodos=$this->Company->get_periodos($id_proyecto);
		 if($periodos !=0):
		 
		 
		 $Contador=4; 
         $Letra='C'; 
		 foreach($periodos as $periodo):
		 
		 $sheet->getColumnDimension($Letra)->setWidth(25);
		 $sheet->setCellValue($Letra. $Contador, $periodo->periodoFechaInicio.' a '.$periodo->periodoFechaFinal);
		 
		 $sheet->getStyle($Letra. $Contador)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
         $sheet->getStyle($Letra. $Contador)->getFill()->getStartColor()->setRGB('d2ecf9');
		 
		 $Letra++; 
		 
		 
		 endforeach;
		  $sheet->setCellValue($Letra. $Contador, 'Total');
		 endif;
		
		
		
		
		foreach($proyectos as $proyecto):
		
		$aux1=$aux;
		
		$sheet->setCellValue("B".$aux1, $this->Company->get_rubros_name($proyecto->prIdRubro));
		$sheet->getStyle("B".$aux1)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle("B".$aux1)->getFill()->getStartColor()->setRGB('cccccc');
		
		
		
		
		 if($periodos !=0):
		 
		 
		 $Contador=$aux1; 
		 
		 $con1=$Contador+1;
		 $con2=$con1+1;
		 
         $Letra='C'; 
		 
		 $p_estimado= $this->Company->get_rubro($proyecto->prIdRubro);
		 $p_real= $this->Company->get_facturas_rubro($proyecto->prIdRubro);  
		 $total_total=$p_estimado-$p_real;
		 foreach($periodos as $periodo):
		 
		 $estimado= trim($this->Company->get_cantidades($proyecto->prIdRubro,$periodo->periodoId));
		 $real= trim($this->Company->get_cantidades_facturas($proyecto->prIdRubro,$periodo->periodoId));
		 $total_=$estimado-$real;
		
		 $sheet->setCellValue($Letra. $Contador, 'Real:$'.number_format($this->Company->get_cantidades_facturas($proyecto->prIdRubro,$periodo->periodoId),2));
		 $sheet->setCellValue($Letra. $con1, 'Estimado:$'.number_format($this->Company->get_cantidades($proyecto->prIdRubro,$periodo->periodoId),2));
		 
		 $sheet->setCellValue($Letra. $con2, 'Total:$'.number_format($total_,2));
		 
		  $sheet->getStyle($Letra. $con2)->applyFromArray(array("font"=>array("color"=>array("rgb"=>"000000"),"bold" => true)));
		  //$sheet->getStyle('C'.$aux5)->applyFromArray(array("font" => array("bold" => true)));
		 
		 //$sheet->getStyle('F3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_DASHDOT);
		 
		 
		 
		 $Letra++; 
		 
		 $aux++;
		 
		 $sheet->setCellValue($Letra. $con2, 'Total:'."$".number_format($total_total,2));
		 $sheet->getStyle($Letra. $con2)->getNumberFormat()->applyFromArray( array( 'code' => PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1 ) );
		 $sheet->getColumnDimension($Letra)->setWidth(25);
		 endforeach;
		 
		  $sheet->getStyle('C'.$Contador.':'.$Letra.$con2)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		 
		 endif;
		
		
		
		
			
			
			$aux++;
        endforeach;
        endif;
       
        $name_report = 'reporte'.date('Ymd');
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$name_report.xls\"");
        header("Cache-Control: max-age=0");
        
        $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, "Excel5");
        $objWriter->save("php://output");
        exit;
    }
	
	public function letras(){
		$Cantidad_de_columnas_a_crear=34; 
$Contador=0; 
$Letra='A'; 
while($Contador<$Cantidad_de_columnas_a_crear) 
{ 
    echo    $Letra. "  "; 
    $Contador++; 
    $Letra++; 
} 	
	}
    
}
