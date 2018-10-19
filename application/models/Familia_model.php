<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Familia_model extends CI_Model {

    public $arrayFamilias;
	public $arrayQ2;
	public $arrayZ4;
	public $arrayI6;
	public $arrayB5;
	public $arrayA7;
	public $arrayEP;
	public $arrayNoZ4;
	public $arrayNoEP;
	public $arrayEP2;
	public $arrayResultado;
	public $numFamilias;
	
        
	  
	
	
	

	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		$this->arrayFamilias=array();
		$this->arrayQ2=array();
		$this->arrayZ4=array();
		$this->arrayI6=array();
		$this->arrayB5=array();
		$this->arrayA7=array();
		$this->arrayEP=array();
		$this->arrayNoZ4=array();
		$this->arrayNoEP=array();
		$this->arrayEP2=array();
		$this->arrayL=array();
		
		$this->arrayResultado=array();
		$this->numFamilias=0;
		
	}
	
	public function buscar_dato($codfamilia){
		
		$existe=0;
		foreach($this->arrayFamilias as $dato){
			
			if($codfamilia==$dato){
				$existe=1;
				}			
			}
		return $existe;
		
	}
	
	
	public function setArrayFamilias($dato){
		$this->arrayFamilias[]=$dato;
	}
	
	public function getArrayFamilias(){
		return $this->arrayFamilias;
	}
	
	public function setQ2($indice,$dato){
		$this->arrayQ2[$indice]=$dato;
	}
	
	public function getQ2($indice){
		return $this->arrayQ2[$indice];
	}
	
	public function setZ4($indice,$dato){
		$this->arrayZ4[$indice]=$dato;
	}
	
	public function getZ4($indice){
		return $this->arrayZ4[$indice];
	}
	
	public function setI6($indice,$dato){
		$this->arrayI6[$indice]=$dato;
	}
	
	public function getI6($indice){
		return $this->arrayI6[$indice];
	}
	
	public function setB5($indice,$dato){
		$this->arrayB5[$indice]=$dato;
	}
	
	public function getB5($indice){
		return $this->arrayB5[$indice];
	}
	
	
	//Campo edad
	
	public function setA7($indice,$dato){
		$this->arrayA7[$indice]=$dato;
	}
	
	public function getA7($indice){
		return $this->arrayA7[$indice];
	}
	
	//Campo edad productiva a cargo de más de cinco dependientes
	
	public function setEP($indice,$dato){
		$this->arrayEP[$indice]=$dato;
	}
	
	public function getEP($indice){
		return $this->arrayEP[$indice];
	}
	
	//Campo para identificar los que NO son con enfoque diferencial
	
	public function setNoZ4($indice,$dato){
		$this->arrayNoZ4[$indice]=$dato;
	}
	
	public function getNoZ4($indice){
		return $this->arrayNoZ4[$indice];
	}
	
	//Campo para identificar que NO hay miembros en edad productiva
	
	public function setNoEP($indice,$dato){
		$this->arrayNoEP[$indice]=$dato;
	}
	
	public function getNoEP($indice){
		return $this->arrayNoEP[$indice];
	}
	
	//Campo edad productiva a cargo de más de cuatro dependientes
	
	public function setEP2($indice,$dato){
		$this->arrayEP2[$indice]=$dato;
	}
	
	public function getEP2($indice){
		return $this->arrayEP2[$indice];
	}
	
	//Campo de fuente de ingresos
	
	public function setL($indice,$dato){
		$this->arrayL[$indice]=$dato;
	}
	
	public function getL($indice){
		return $this->arrayL[$indice];
	}
	
	
	public function setResultado($indice,$dato){
		$this->arrayResultado[$indice]=$dato;
	}
	
	public function getResultado($indice){
		return $this->arrayResultado[$indice];
	}
	
	
	public function setNumFamilias($dato){
		$this->numFamilias=$dato;
	}
	
	public function getNumFamilias(){
		return $this->numFamilias;;
	}
	
}
