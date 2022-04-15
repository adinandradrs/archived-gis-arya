<?php

	class GISModel extends CI_Model{
		
		function __construct(){
			parent::__construct();
		}
		
		/**************************************
		*ORM CLASS
		**************************************/
		
		function getListOfData($table,$field, $limit = 0, $offset = 0, $where = "", $orWhere = "", $like = "", $orLike = "", $orderBy = "", $groupBy = ""){
			if($field == "")
				$this->db->select("*");
			else 
				$this->db->select($field);
			$this->db->from($table);
			if($limit != 0)
				$this->db->limit($limit, $offset);
			if($where != "")
				$this->db->where($where);
			if($orWhere != "")
				$this->db->or_where($orWhere);
			if($like != "")
				$this->db->like($like);
			if($orLike != "")
				$this->db->or_like($orLike);
			if($orderBy != "")
				$this->db->order_by($orderBy);
			if($groupBy != "")
				$this->db->group_by($groupBy);
			return $this->db->get();
		}
    
		function getDetailOfData($table, $field, $where = "", $like = ""){
			$this->db->select($field);
			$this->db->from($table);
			if ($where != "")
				$this->db->where($where);
			if ($like != "")
				$this->db->like($like);
			$resultSet = $this->db->get();
			$totalRow = $resultSet ? $resultSet->num_rows() : 0;
			if ($totalRow > 0)
				foreach($resultSet->result() as $row)
					return $row->$field;
			else
				return false;
		}
		
		function saveData($table, $data = ""){
			if ($this->db->insert($table, $data)){
				$this->db->insert_id();
				return true;
			}
			else
				return false;
		}
		
		function updateData($table, $where = "", $data = ""){
			if ($where != "")
			{
				$this->db->where($where);
				if ($this->db->update($table, $data))
					return true;
				else
					return false;
			}
			else
				return false;
		}
    
		function deleteData($table, $where){
			if($where != ""){
				$this->db->where($where);
				if($this->db->delete($table))
					return true;
				else 
					return false;
			}
			else 
				return false;
		}
		
		/**************************************
		*OTHER FUNCTION
		**************************************/
		
		function validateData($table, $where){
			$result_set = $this->db->get_where($table, $where);
			if ($result_set->num_rows() > 0)
				return true;
			else
				return false;
		}
    
		function countData($table, $where = "", $orWhere = "", $like = "", $orLike = ""){
			if ($where != "")
				$this->db->where($where);
			if ($orWhere != "")
				$this->db->or_where($orWhere);
			if ($like != "")
				$this->db->like($like);
			if ($orLike != "")
				$this->db->or_like($orLike);
			return $this->db->count_all_results($table);
		}
    
		function joinData($table, $field, $tableJoin = array(), $on = array(), $where = "", $groupBy = "", $orderBy = "", $limit = 0){
			$this->db->select($field);
			$this->db->from($table);
			for($i=0; $i<count($tableJoin); $i++)
				$this->db->join($tableJoin[$i], $on[$i]);
			if($where != "")
				$this->db->where($where);
			if($groupBy != "")
				$this->db->group_by($groupBy);
			if($orderBy != "")
				$this->db->order_by($orderBy);
			if($limit != 0)
				$this->db->limit($limit);
			return $this->db->get();
		}
		
	}

?>