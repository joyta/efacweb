<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->load->model('producto_model');
        $this->load->model('entity_model');
        
        check_authenticated();
    }

    public function index() {
        //$this->data['productos'] = $this->producto_model->vw_lista_productos();        
        //$this->load->view('productos/index');
        $this->data['title'] = "Productos";
        $this->data['page_map'] = array("Inventario","Productos");        
        $this->data['view'] = 'productos/index';        
        $this->load->view('template/admin', $this->data);
        
    }
    
    public function index_handler() {
        //Parámetros        
        $sColumns = $this->input->post('sColumns');                 
        $iSortCol_0 = $this->input->post('iSortCol_0');
        $sSortDir_0 = $this->input->post('sSortDir_0');
        $iDisplayStart = $this->input->post('iDisplayStart');
        $iDisplayLength = $this->input->post('iDisplayLength');
        $sSearch = $this->input->post('sSearch');
        $sEcho = $this->input->post('sEcho');        
        $columns = explode(',', $sColumns);
        
        $where = "nombre like '%$sSearch%' or codigo like '%$sSearch%'";
        
        $iTotalRecords = $this->db->count_all_results('inventario.vw_productos');
        $this->db->where($where);
        $iTotalDisplayRecords = $this->db->count_all_results('inventario.vw_productos');
                
        $this->db->order_by($columns[$iSortCol_0 ? $iSortCol_0 : 1].' '.$sSortDir_0);        
        $this->db->where($where);
        $query = $this->db->get('inventario.vw_productos', $iDisplayLength, $iDisplayStart);        
        
        $productos = $query->result();
        
        $output = array(
		"sEcho" => $sEcho,
		"iTotalRecords" => $iTotalRecords,
		"iTotalDisplayRecords" => $iTotalDisplayRecords,
                "aaData" => array()
	);
        $baseUrl = base_url()."productos";
        foreach ($productos as $p) {
            $row = array();
            $disabled = $p->estado == 'Inactivo' ? 'disabled="disabled"' : '';
            $estado = $p->estado == 'Inactivo' ? 'danger':'info';            
            $row[]=
                "<a href='$baseUrl/edit/$p->id' class='btn btn-primary btn-xs' title='Editar'><i class='fa fa-edit'></i></a>
                <a href='$baseUrl/precios/$p->id' class='btn btn-success btn-xs' title='Precios por unidad'><i class='fa fa-usd'></i></a>
                <a href='javascript:void(0);' class='btn btn-danger btn-xs' $disabled title='Eliminar' onclick='EliminarProducto($p->id, &#39;$p->nombre&#39;, this);'><i class='fa fa-recycle'></i></a>";
            $row[]=$p->id;
            $row[]=$p->codigo;
            $row[]=$p->nombre;
            $row[]="<span class='label label-$estado'>$p->estado</span>";
            $row[]=$p->marca_nombre;
            $row[]=$p->categoria_nombre;
            $row[]=  number_format($p->cantidad_minima, 2);
            $row[]= number_format($p->cantidad_maxima, 2);
            $output['aaData'][] = $row;
        }
        
        echo json_encode($output);
    }
    
    public function create() {
        $this->data['producto'] = json_decode(json_encode(array('id'=>NULL,'codigo'=>'','nombre'=>'','marca_id'=>'','categoria_id'=>'','tipo'=>'','tipo_stock'=>'','estado'=>'','iva'=>'t','tipo_unidad'=>'Unidades','unidad_id'=>'','unidadcompra_id'=>'','cantidad_minima'=>5, 'cantidad_maxima'=>10)));
        $this->data['unidades'] = $this->entity_model->select_list_unidades('Unidades');
        $this->data['marcas'] = $this->entity_model->select_list_marcas('--Seleccione--');
        $this->data['categorias'] = $this->entity_model->select_list_categorias('--Seleccione--');               
        
        $this->data['title'] = "Nuevo producto";
        $this->data['page_map'] = array("Inventario", page_map("Productos", "productos/index"), "Nuevo");
        $this->data['view'] = 'productos/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    public function edit($id=NULL) {
        $this->data['producto'] = $producto = $this->producto_model->get($id);
        $this->data['unidades'] = $this->entity_model->select_list_unidades($producto->tipo_unidad);
        $this->data['marcas'] = $this->entity_model->select_list_marcas('--Seleccione--');
        $this->data['categorias'] = $this->entity_model->select_list_categorias('--Seleccione--');                
        
        $this->data['title'] = "Editar producto";
        $this->data['page_map'] = array("Inventario", page_map("Productos", "productos/index"), "Editar");
        $this->data['view'] = 'productos/edit';
        $this->load->view('template/admin', $this->data);
    }
    
    /**
     * ajax get: index
     * @param type $id EL id de la marca
     */
    public function delete($id=NULL) {        
        $del = $this->producto_model->delete($id);
        echo json_encode(array('status'=>$del ? 'ok' : 'integridad'));
    }
    
    public function precios($id=NULL) {
        $this->data['producto'] = $this->producto_model->get($id);        
        $this->data['precios'] = $this->producto_model->vw_lista_precios($id);                
        
        $this->data['title'] = "Precios producto";
        $this->data['page_map'] = array("Inventario", page_map("Productos", "productos/index"), "Precios");
        $this->data['view'] = 'productos/precios';
        $this->load->view('template/admin', $this->data);
    }
    
    public function get_unidades() {        
        $tipo = $this->input->post('tipo');        
        $unidades = $this->entity_model->select_list_unidades($tipo);
        $data = array(
            'unidad_inv'=> form_dropdown('unidad_id', $unidades, 0, 'id="unidad_id" class="form-control required"'),
            'unidad_cmp'=> form_dropdown('unidadcompra_id', $unidades, 0, 'id="unidadcompra_id" class="form-control required"')
        );
        echo json_encode($data);
    }   
    
    /**
     * ajax post: edit
     */
    public function save() {
        $data = array(
            'id'=>$this->input->post('id'),
            'codigo'=>$this->input->post('codigo'),
            'nombre'=>$this->input->post('nombre'),
            'marca_id' => $this->input->post('marca_id'),
            'categoria_id' => $this->input->post('categoria_id'),
            'tipo' => $this->input->post('tipo'),
            'tipo_stock' => $this->input->post('tipo_stock'),
            'estado' => $this->input->post('estado'),            
            'iva' => ($this->input->post('iva') == 'iva12' ? 'TRUE' : 'FALSE'),
            'tipo_unidad' => $this->input->post('tipo_unidad'),
            'unidad_id' => $this->input->post('unidad_id'),
            'unidadcompra_id' => $this->input->post('unidadcompra_id'),
            'cantidad_minima' => $this->input->post('cantidad_minima'),
            'cantidad_maxima' => $this->input->post('cantidad_maxima')
        );
        
        if($data['id']){
            $this->producto_model->update($data);
        }else{
            $this->producto_model->insert($data);
        }
        
        echo json_encode(array('status'=>'ok'));
    }  
    
    public function save_precios() {
        $producto = $this->input->post('producto_id');
        $precios = $this->input->post('precio');
        
        $this->producto_model->save_precios($producto, $precios);
        
        echo json_encode(array('status'=>'ok'));
    }  
    
    public function get_autocomplete_productos_venta($term='', $tarifa_id=0){
        $context = get_contexto();
        //print_r($context);
        $value = $this->db->escape_like_str(strtolower($term));
        $this->db->select("p.id, p.codigo, p.nombre, p.iva, p.tipo_stock, p.tipo, s.cantidad stock");
        $this->db->join("inventario.producto p", "s.producto_id = p.id", 'left');
        $this->db->where("(s.cantidad > 0 or p.tipo = 'Servicio')");
        $this->db->where("s.establecimiento_id", $context['establecimiento_id']);
        $this->db->where("(lower(p.codigo) like '%$value%' or lower(p.nombre) like '%$value%')");
        $this->db->where("(select count(c.*) from inventario.precio c where c.producto_id = p.id) > 0");
        $q = $this->db->get("inventario.stock s", 10);        
        $data = $q->result();
        
        $lista = array();
        
        foreach ($data as $d) {
            $this->db->select("p.unidad_id, u.nombre unidad_nombre, u.equivalencia, p.valor");
            $this->db->join("inventario.unidad u", "p.unidad_id = u.id", 'left');
            $this->db->where('p.producto_id', $d->id);
            $this->db->where('p.tarifa_id', $tarifa_id);
            $q1 = $this->db->get('inventario.precio p');
            $precios = $q1->result();
            foreach ($precios as $p) {
                $stock = $d->stock / $p->equivalencia;
                $lista[] = array(
                    'label' => $d->codigo.' - '.$d->nombre.' - Stock: '.$stock.' ('.$p->unidad_nombre.')'.' - Precio: '.$p->valor,
                    'value' => $d->codigo,
                    'id'=>$d->id, 
                    'codigo'=>$d->codigo, 
                    'nombre'=>$d->nombre,  
                    'tipo' => $d->tipo,
                    'precio' => $p->valor,
                    'stock' =>  $stock,
                    'tipo_stock' => $d->tipo_stock,
                    'unidad_id' => $p->unidad_id,
                    'unidad_nombre' => $p->unidad_nombre,
                    'equivalencia' => $p->equivalencia,
                    'iva' => $d->iva == 't' ? 1 : 0,
                    'cantidad' => 0,
                    'descuento' => 0,
                    'total' => 0
                );
            }
        }
        
        //echo $this->db->last_query();
        echo json_encode($lista);
    }
    
    public function get_autocomplete_productos_compra($term=''){
        $context = get_contexto();
        
        $value = $this->db->escape_like_str(strtolower($term));
        $this->db->select("p.id, p.codigo, p.nombre, p.iva, p.unidadcompra_id unidad_id, p.tipo_stock, uc.nombre unidad_nombre, uc.equivalencia");
        $this->db->join("inventario.unidad uc", "p.unidadcompra_id = uc.id", 'left');        
        $this->db->where("(lower(p.codigo) like '%$value%' or lower(p.nombre) like '%$value%')");
        //$this->db->where("(select count(c.*) from inventario.precio c where c.producto_id = p.id) > 0");
        $q = $this->db->get("inventario.producto p", 10);        
        $data = $q->result();
        
        $lista = array();
        
        foreach ($data as $d) {
            $this->db->select("p.valor");            
            $this->db->where('p.producto_id', $d->id);
            $this->db->where('p.unidad_id', $d->unidad_id);
            $q1 = $this->db->get('inventario.precio p');
            $p = $q1->row();
                        
            $lista[] = array(
                'label' => $d->codigo.' - '.$d->nombre,
                'value' => $d->codigo,
                'id'=>$d->id, 
                'codigo'=>$d->codigo, 
                'nombre'=>$d->nombre,      
                'tipo_stock' => $d->tipo_stock,
                'precio' => $p != null ? $p->valor : 0,                
                'unidad_id' => $d->unidad_id,
                'unidad_nombre' => $d->unidad_nombre,
                'equivalencia' => $d->equivalencia,
                'iva' => $d->iva == 't' ? 1 : 0,
                'cantidad' => 0,
                'descuento' => 0,
                'total' => 0
            );
            
        }
        
        //echo $this->db->last_query();
        echo json_encode($lista);
    }
    
    public function get_modal_series_venta($producto_id){
        $context = get_contexto();        
        $this->db->select("s.numero, s.numero");        
        $this->db->where("s.producto_id", $producto_id);
        $this->db->where("s.detalleventa_id is null");
        $q = $this->db->get("inventario.serie s");        
        $data = $q->result();
        
        $this->data['producto'] = $this->producto_model->get($producto_id);
        $this->data['series'] = $data;                
        
        $this->load->view('ventas/modal-series', $this->data);
    }
    
    public function get_modal_series_notacredito($detalleventa_id){
        $context = get_contexto();        
        $this->db->select("s.numero, s.numero");        
        $this->db->where("s.detalleventa_id", $detalleventa_id);        
        $q = $this->db->get("inventario.serie s");        
        $data = $q->result();
        
        $this->data['producto'] = $this->producto_model->get($data->producto_id);
        $this->data['series'] = $data;                
        
        $this->load->view('ventas/modal-series', $this->data);
    }

}