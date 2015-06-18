<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Stock_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('nombre asc');
            $query = $this->db->get('inventario.producto',$limit,$offset);            
            return $query->result();
        }
        
        
        
        function lista_stock_view_model($establecimiento, $limit=NULL, $offset=NULL){
            $sql = "
                select 
                s.id, 
                (case when s.establecimiento_id is null then $establecimiento else s.establecimiento_id end) establecimiento_id,
                s.cantidad,
                p.id producto_id, p.codigo, p.nombre, p.tipo_stock
                from inventario.stock s right join inventario.producto p on s.producto_id = p.id and s.establecimiento_id = $establecimiento
                ";
            $q = $this->db->query($sql);            
            return $q->result();
        }
        
        function get_or_create($id_est, $id_prod){
            $data = array('establecimiento_id'=>$id_est,'producto_id'=>$id_prod);
            $query = $this->db->get_where('inventario.stock', $data);
            $s = $query->row();
            if($s){
                return $s;
            }else{
                $this->db->insert("inventario.stock",array('establecimiento_id'=>$id_est,'producto_id'=>$id_prod,'cantidad'=>0));
                return $this->db->get_where('inventario.stock', $data)->row();
            }
        }
        

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('inventario.producto', array('id'=>$id));
            return $query->row();
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('producto_id',$data['producto_id']);
            $this->db->where('establecimiento_id',$data['establecimiento_id']);
            $this->db->update("inventario.stock",$data);
            return;
        }
        
        /*function incrementar_stock($id_est, $id_prod, $cantidad){
            $this->get_or_create($id_est, $id_prod);
            $sql = "update inventario.stock set cantidad = cantidad + $cantidad where establecimiento_id=$id_est and producto_id=$id_prod";
            $this->db->query($sql);
        } 
        
        function decrementar_stock($id_est, $id_prod, $cantidad){            
            $sql = "update inventario.stock set cantidad = cantidad - $cantidad where establecimiento_id=$id_est and producto_id=$id_prod";
            $this->db->query($sql);
        }*/ 

        
    }
?>