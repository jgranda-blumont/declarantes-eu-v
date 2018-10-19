<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excell_model extends CI_Model {

    public $arrayExcell;
	public $arrayExcellMin;
	public $filas;
        
	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->arrayExcell=array();
		$this->arrayExcellMin=array();
		$this->filas="";
	}
	
	
	public function reducir_array($indice){
		
		unset($this->arrayExcellMin[$indice]);
		//$nuevo_array=array_diff_key($this->arrayExcellMin,$this->arrayExcellMin[$indice]);
		//return $this->$nuevo_array;
		//print $this->arrayExcell[$indice];
		
		}
	
	public function imprimir_elemento(){
		//print_r ($this->arrayExcell[1]);
		print_r ($this->arrayExcellMin[1]);
		print "<br>$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$<br>";
	}
	
	
	public function setArrayExcell($data){
		$this->arrayExcell=$data;
	}
	
	public function getArrayExcell(){
		return $this->arrayExcell;
	}
	
	public function setArrayExcellMin($data){
		$this->arrayExcellMin=$data;
	}
	
	public function getArrayExcellMin(){
		return $this->arrayExcellMin;
	}
	
	public function setFilas($data){
		$this->filas=$data;
	}
	
	public function getFilas(){
		return $this->filas;
	}
	
}