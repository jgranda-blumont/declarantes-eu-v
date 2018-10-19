<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formula_model extends CI_Model {

    
	public $Q2;
	public $Z4;
	public $I6;
	public $B5;
	public $A7;
	public $EP;
	public $NOZ4;
	public $NOEP;
	

	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
		
		$this->Q2=array();
		$this->Z4=array();
		$this->I6=array();
		$this->B5=array();
		$this->A7=array();
		$this->EP=array();
		$this->NOZ4=array();
		$this->NOEP=array();
		$this->EP2=array();
		$this->L=array();
		
		
	}
	
	public function calcular_formula(){
		
		//if($this->calcular_Q2() OR ($this->calcular_Z4() AND ($this->calcular_I6() OR $this->calcular_B5() OR $this->calcular_A7() or $this->calcular_EP())) OR (($this->calcular_NOZ4() AND $this->calcular_NOEP() ) OR $this->calcular_EP() )){//AND $this->calcular_I6()
		//$this->calcular_L() AND
		if($this->calcular_L() AND ($this->calcular_Q2() OR ($this->calcular_Z4() AND ($this->calcular_I6() OR $this->calcular_B5() OR $this->calcular_A7() OR $this->calcular_EP())) OR ($this->calcular_NOZ4() AND ($this->calcular_NOEP()  OR $this->calcular_EP2()) ))){//AND $this->calcular_I6()			
			return 1;
			}
		else{
			return 0;
		}
		
		
		}
	
	public function calcular_Q2(){
		if($this->Q2==1){
			return true;
		}
		else{
			return false;
		}
		}
	
	public function calcular_Z4(){
		if($this->Z4==1){
			return true;
		}
		else{
			return false;
		}
		}
		
	public function calcular_I6(){
		if($this->I6==1){
			return true;
		}
		else{
			return false;
		}
		}	
		
	public function calcular_B5(){
		if($this->B5==1){
			return true;
		}
		else{
			return false;
		}
		}	
		
	public function calcular_A7(){
		if($this->A7==1){
			return true;
		}
		else{
			return false;
		}
		}
		
	public function calcular_EP(){
		if($this->EP==1){
			return true;
		}
		else{
			return false;
		}
		}
		
	public function calcular_NOZ4(){
		
		
		if($this->NOZ4==1){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function calcular_NOEP(){
		
		
		if($this->NOEP==1){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	public function calcular_EP2(){
		
		
		if($this->EP2==1){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function calcular_L(){
		
		
		if($this->L==1){
			return true;
		}
		else{
			return false;
		}
	}
	


	
	
		
	
	public function setQ2($dato){
		$this->Q2=$dato;
	}
	
	public function getQ2(){
		return $this->Q2;
	}
	
	public function setZ4($dato){
		$this->Z4=$dato;
	}
	
	public function getZ4(){
		return $this->Z4;
	}
	
	public function setI6($dato){
		$this->I6=$dato;
	}
	
	public function getI6(){
		return $this->I6;
	}
	
	public function setB5($dato){
		$this->B5=$dato;
	}
	
	public function getB5(){
		return $this->B5;
	}
	
	
	//A7: edad cumplida de la persona
	
	public function setA7($dato){
		$this->A7=$dato;
	}
	
	public function getA7(){
		return $this->A7;
	}
	
	//EP: persona con edad productiva a cargo de más de 5 dependientes
	
	public function setEP($dato){
		$this->EP=$dato;
	}
	
	public function getEP(){
		return $this->EP;
	}
	
	
	//NOZ4 no se reconoce como comunidad en enfoque diferencial
	
	public function setNOZ4($dato){
		$this->NOZ4=$dato;
	}
	
	public function getNOZ4(){
		return $this->NOZ4;
	}
	
	//NOEP no se reconoce como comunidad en enfoque diferencial
	
	public function setNOEP($dato){
		$this->NOEP=$dato;
	}
	
	public function getNOEP(){
		return $this->NOEP;
	}
	
	//EP: persona con edad productiva a cargo de más de 5 dependientes
	
	public function setEP2($dato){
		$this->EP2=$dato;
	}
	
	public function getEP2(){
		return $this->EP2;
	}
	
	//L: Fuente de ingreso
	
	public function setL($dato){
		$this->L=$dato;
	}
	
	public function getL(){
		return $this->L;
	}
	
	
	
	
	
	
}
