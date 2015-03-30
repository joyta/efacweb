<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Producto_model extends CI_Model{
        
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
        
        function vw_lista_productos($search, $sort, $limit=NULL, $offset=NULL){
            $this->db->where("nombre like '%$search%'");
            $this->db->order_by($sort);
            $query = $this->db->get('inventario.vw_productos',$limit,$offset);            
            return $query->result();
        }
        
        function vw_lista_precios($id_producto){
            $this->db->select('c.id, u.id unidad_id, u.nombre unidad_nombre, c.valor');
            $this->db->join('inventario.unidad u', 'p.tipo_unidad = u.tipo');
            $this->db->join('inventario.precio c', 'c.producto_id =p.id and c.unidad_id = u.id', 'left');
            $this->db->where('p.id', $id_producto);
            $this->db->order_by('c.valor asc');
            $query = $this->db->get('inventario.producto p');
            
            return $query->result();
        }
        

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('inventario.producto', array('id'=>$id));
            return $query->row();
        }        

        function existe_by_codigo($codigo){
            $this->db->where('codigo', $codigo);
            $query = $this->db->get('inventario.producto');
            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        /*
            Agregar un usuario
        */
        function insert($producto){
            unset($producto['id']);
            $result = $this->db->insert("inventario.producto",$producto);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("inventario.producto",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->where('id', $id);
            $this->db->update("inventario.producto",array('estado'=>'Inactivo'));
            
            return TRUE;
        }
        
        function save_precios($producto, $precios=array()){
            foreach ($precios as $p) {
                $unidad = $p['unidad_id'];
                $valor = $p['valor'];
                $id = $p['id'];

                if($valor){
                    if($id){
                        $this->db->where('id', $id);
                        $this->db->update('inventario.precio', array('valor'=>$valor));
                    }else{                    
                        $this->db->insert('inventario.precio', array('producto_id'=>$producto, 'unidad_id'=>$unidad, 'valor'=>$valor));
                    }
                }else{
                    $this->db->where('producto_id', $producto);
                    $this->db->where('unidad_id', $unidad);                
                    $this->db->delete('inventario.precio');
                }
            }
        }

        
    }
?>