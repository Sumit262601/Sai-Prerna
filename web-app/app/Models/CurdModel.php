<?php
namespace App\Models;
use CodeIgniter\Model;

    class CurdModel extends Model
    {
        public function get_1($select = true, $table = true, $where =1)
        {
            $builder = $this->db->table($table);
            $builder->where($where);
            $builder->select($select);
            $query  = $builder->get();
            return $query->getRow();
        }

        public function insert($table = true, $data = null){
            $q = $this->db->table($table)->insert($data);
            if($q){ return $this->db->insertID(); }
        }

        public function jointable($select, $table, $join, $where, $row = false, $orderby = false, $order=false, $start =0, $limit=100)
        {    
            $builder = $this->db->table($table);
            $builder->select($select);
            foreach($join as $jn){
                $builder->join($jn['table'], $jn['condition'], $jn['type']);
            }
            if($orderby){
                $builder->orderBy($orderby, $order);
            }
            if(isset($where) && count($where) > 0)
            {
                $builder->where($where);
            }
            $builder->limit($limit, $start);
            $query = $builder->get();
            if($row){
                return $query->getResult();
            }else{
                return $query ->getRow();
            }
        }


        public function get_all($select, $table, $where, $orderby, $order = null){
            $builder = $this->db->table($table);
            $builder->select($select);
            if(isset($where) && count($where) > 0)
            {
                $builder->where($where);
            }
            $builder->orderBy($orderby,$order);
            $query  = $builder->get();
            return $query->getResult();   
        }

        public function update_table($table = true, $data = null, $where = 1)
        {
            $q = $this->db->table($table)->where($where)->set($data)->update();
            if($q){ 
                return true;
            }
            else {
                return false;
            }
        }

        public function update_menu_table($table = true, $data = null, $where = 1)
        {
            $q = $this->db->table($table)->where($where)->set($data)->update();
            if($q){ 
                return true;
            }
            else {
                return false;
            }
        }

        public function customquery($qyery){
            $q = $this->db->simpleQuery($qyery);
            if($q){
                return true;
            }else{
                return false;
            }
        }

        public function update_session(){
            $session = session()->get('adminlogin');
            $q = $this->db->table('login_history')->where(array('id'=>$session['login_id']))->set(array('last_activity_time'=>date('Y-m-d H:i:s')))->update();
            if($q){ return true;}
        }

        public function ben_update_session(){
            $session = session()->get('adminlogin');
            $q = $this->db->table('login_history')->where(array('id'=>$session['login_id']))->set(array('last_activity_time'=>date('Y-m-d H:i:s')))->update();
            if($q){ return true;}
        }
        
        public function count_where($table, $where){
            $builder = $this->db->table($table);
            $builder->where($where);
            return $builder->countAll();
        }
  }
?>