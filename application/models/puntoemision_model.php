<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Puntoemision_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }

        /*
            Obtener una Lista de todos los usuarios
        */
        function all($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('codigo asc');
            $query = $this->db->get('tributario.puntoemision',$limit,$offset);            
            return $query->result();
        }           
        
        function vw_lista_puntosemision($limit=NULL, $offset=NULL){                                    
            $this->db->order_by('codigo asc');
            $query = $this->db->get('tributario.vw_puntosemision',$limit,$offset);            
            return $query->result();
        }

        /*
            Obtener un usuario por el id
        */
        function get($id){
            $query = $this->db->get_where('tributario.puntoemision', array('id'=>$id));
            return $query->row();
        }       

        /*
            Agregar un usuario
        */
        function insert($producto){
            unset($producto['id']);
            $result = $this->db->insert("tributario.puntoemision",$producto);
            return $result;
        }

        /*
            Modificar un usuario del sistema
        */
        function update($data){
            $this->db->where('id',$data['id']);
            $this->db->update("tributario.puntoemision",$data);
            return;
        }

        /*
            Eliminar el usuario
        */
        function delete($id){
            $this->db->where('id',$id);
            $this->db->update("tributario.puntoemision",array('estado'=>'FALSE'));
        }
        
        function get_secuencial($tipo_documento){
            $user = get_contexto();
            $this->db->where('tipo_documento',$tipo_documento);
            $this->db->where('usuario_id',$user['id']);
            $this->db->where('estado = TRUE');
            $query = $this->db->get('tributario.puntoemision');
            $secuencial = $query->row();
            
            if($secuencial == null){
                throw new Exception("No existe secuencial. Documento: ".$tipo_documento.', Usuario: '.$user['id']);
            }
            
            return $secuencial;
        }
        
        function generar_numero(&$comprobante){ 
            $tipo = is_array($comprobante) ? $comprobante['tipo'] : $comprobante->tipo;
            
            $secuencial = $this->get_secuencial($tipo);
            
            if(is_array($comprobante)){
                $comprobante['establecimiento_id'] = $secuencial->establecimiento_id;
                $comprobante['puntoemision_id'] = $secuencial->id;
            }else{
                $comprobante->establecimiento_id = $secuencial->establecimiento_id;
                $comprobante->puntoemision_id = $secuencial->id;
            }
                        
            $numero =  $secuencial->codigo.'-'.str_pad($secuencial->secuencial, 9, '0', STR_PAD_LEFT);            
            
            $secuencial->secuencial = $secuencial->secuencial * 1 + 1;
            
            $this->db->where('id', $secuencial->id);
            $this->db->update("tributario.puntoemision",array('secuencial'=>$secuencial->secuencial));
            
            return $numero;
        }

        
    }
?>