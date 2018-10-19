<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FamiliasVulnerables extends CI_Controller {

	

	function __construct() {
        parent::__construct();
        $this->load->library('Spreadsheet_Excel_Reader');
		$this->load->model('Familia_model', 'Familia');
		$this->load->model('Excell_model', 'Excell');
		$this->load->model('Formula_model', 'Formula');
		
    }

	public function index()
	{

		$this->load->view('inicio_view');
		
	}
	
	
	public function identificar_familias(){
		
		//Apertura del archivo Excel e instancia en la clase Excell el archivo plano
		$arrayExcell=$this->crear_fuente_datos();
		
		//Instancia en la clase Familia todos los registros únicos de la vivienda
		$arrayFamilias=$this->crear_array_codigo_familias($arrayExcell);
		$this->recorrer_familias();
		
		$this->calcular_vulnerabilidad();
		
		$data["objFamilia"]=$this->Familia;
		$this->load->view('Familias_view',$data);
		
		
	}
	
	public function calcular_vulnerabilidad(){
		
		for($i=0;$i<$this->Familia->getNumFamilias();$i++){
			
			$this->Formula->setQ2($this->Familia->getQ2($i));
			$this->Formula->setZ4($this->Familia->getZ4($i));
			$this->Formula->setI6($this->Familia->getI6($i));
			$this->Formula->setB5($this->Familia->getB5($i));
			$this->Formula->setA7($this->Familia->getA7($i));
			$this->Formula->setEP($this->Familia->getEP($i));
			$this->Formula->setNOZ4($this->Familia->getNoZ4($i));
			$this->Formula->setNOEP($this->Familia->getNoEP($i));
			$this->Formula->setEP2($this->Familia->getEP2($i));
			$this->Formula->setL($this->Familia->getL($i));
			
			$this->Familia->setResultado($i,$this->Formula->calcular_formula());
			
		}
		
			
		
	}
	
	
	
	//Recorre las familias contenidas en la clase
	public function recorrer_familias(){
		
		$indice=0;
			
		
		//Recorre las familias identificadas en el plano
		foreach($this->Familia->getArrayFamilias() as $codfamilia){
					
			//1. Algún miembro del hogar tiene medidas de protección por evaluación de riesgo de la Unidad de Protección
			$cumple_q2=$this->validar_q2($codfamilia,$this->Excell->getArrayExcellMin());
			if($cumple_q2==1){
				$this->Familia->setQ2($indice,1);
				}
			else{
				$this->Familia->setQ2($indice,0);
				}
		
			//2. El hogar es integrante de un pueblo o comunidad étnica 
			$cumple_z4=$this->validar_z4($codfamilia,$this->Excell->getArrayExcellMin());
			if($cumple_z4==1){
				$this->Familia->setZ4($indice,1);
				}
			else{
				$this->Familia->setZ4($indice,0);
				}
			
			
			//2. en el hogar hay miembros con discapacidad
			$cumple_i6=$this->validar_I6($codfamilia,$this->Excell->getArrayExcellMin());
			if($cumple_i6==1){
				$this->Familia->setI6($indice,1);
				}
			else{
				$this->Familia->setI6($indice,0);
				}
				
			//2. en el hogar hay miembros trans
			$cumple_b5=$this->validar_B5($codfamilia,$this->Excell->getArrayExcellMin());
			if($cumple_b5==1){
				$this->Familia->setB5($indice,1);
				}
			else{
				$this->Familia->setB5($indice,0);
				}
				
			//2. personas mayores
			$cumple_a7=$this->personas_mayores_A7($codfamilia,$this->Excell->getArrayExcellMin());
			if($cumple_a7==1){
				$this->Familia->setA7($indice,1);
				}
			else{
				$this->Familia->setA7($indice,0);
				}
				
			//2. personas en edad productiva a cargo de más de cinco dependientes
			$cumple_ep=$this->validar_edad_productiva_EP($codfamilia,$this->Excell->getArrayExcellMin());			
			if($cumple_ep==1){			
				$this->Familia->setEP($indice,1);
				}
			else{
				$this->Familia->setEP($indice,0);			
				}
				
				
			//2. El hogar es integrante de un pueblo o comunidad étnica. Se utiliza la misma funcion pero se invierten los valores
			//Nota: utilizar la misma función de pertenecer a comunidad étnica. La diferencia es que el valor que asigna es invertido
			$cumple_Noz4=$this->validar_z4($codfamilia,$this->Excell->getArrayExcellMin());
			if($cumple_Noz4==1){
				$this->Familia->setNoZ4($indice,0);
				}
			else{
				$this->Familia->setNoZ4($indice,1);				
				}
				
			
			//Nadie en edad productiva
			$cumple_Noep=$this->validar_edad_productiva_NOEP($codfamilia,$this->Excell->getArrayExcellMin());			
			if($cumple_Noep==1){
				$this->Familia->setNoEP($indice,1);
				}
			else{
				$this->Familia->setNoEP($indice,0);			
				}
			
			//2. personas en edad productiva a cargo de más de cinco dependientes
			$cumple_ep2=$this->validar_edad_productiva_EP2($codfamilia,$this->Excell->getArrayExcellMin());	
			if($cumple_ep2==1){
				$this->Familia->setEP2($indice,1);
				}
			else{
				$this->Familia->setEP2($indice,0);
				}
				
			$cumple_l=$this->validar_l($codfamilia,$this->Excell->getArrayExcellMin());	
			if($cumple_l==1){
				$this->Familia->setL($indice,1);
				}
			else{
				$this->Familia->setL($indice,0);
				}

			
				
				
			$indice++;
			}
		//$this->seguimiento_rutinas();
		
	}
	
	
	public function reducir_array($filas){
		
		if($filas){
		
			$arrayFilas=explode(",",$filas);
			foreach($arrayFilas as $dato){
				
				
				$this->Excell->reducir_array($dato);
				
				
				
				}
		$this->Excell->setFilas("");
		}
				
	}
	
	//Lee la fuente de datos y la instancia en el modelo Excell_model
	public function crear_fuente_datos(){
		
		$excel = new Spreadsheet_Excel_Reader();
		$excel->read('public/microdatos_04-10-2018.xls'); // set the excel file name here   
		$data['data_excell']=$excel->sheets[0]['cells'];
		$this->Excell->setArrayExcell($excel->sheets[0]['cells']);
		$this->Excell->setArrayExcellMin($excel->sheets[0]['cells']);
		return $this->Excell->getArrayExcell();
			
		
	}
	
	
	//Extrae de la fuente de datos los codigos de las familias y las instancia en el modelo Familia_model
	public function crear_array_codigo_familias($arrayExcell){
		
		$arrayFamilias=$this->Familia->getArrayFamilias();
		$contador=0;
		$i=0;
		foreach($arrayExcell as $key){
			if($contador>0){
				$codfamilia=$key[2];
				if(!$this->Familia->buscar_dato($codfamilia)){
					$this->Familia->setArrayFamilias($codfamilia);
					$i++;
					}
				}
			$contador=1;
			
			}
			
			$this->Familia->setNumFamilias($i);
		
		return $this->Familia->getArrayFamilias();
		
	}
	
	
	
	//El hogar no tiene ninguna fuente de ingresos
	public function validar_l($codfamilia,$arrayExcell){
		
		$cumple_l=0;
		$i=1;
		foreach($arrayExcell as $dato){
			
			//Posición 18:Q2 || valores 1:'Si'
			if((@$dato[18]!=1 and @$dato[19]!=1 and @$dato[20]==2) and $dato[2]==$codfamilia){
			//if((@$dato[18]!=1 and @$dato[19]!=1 and @$dato[20]==2 and @$dato[22]==0 and @$dato[23]!=1 and @$dato[24]!=1 and @$dato[25]!=1 and @$dato[26]!=1 and @$dato[27]!=1 and @$dato[28]!=1 and @$dato[29]==0 and @$dato[30]==0 and @$dato[31]!=1 and @$dato[32]!=1 and @$dato[33]!=1 and @$dato[34]!=1 and @$dato[35]!=1 and @$dato[36]!=1 and @$dato[37]!=1 and @$dato[38]!=1 and @$dato[39]!=1 and @$dato[40]!=1 and @$dato[41]!=1) and $dato[2]==$codfamilia){
				$cumple_l=1;
				}
			$i++;
		}
		
		return $cumple_l;
	}
	
	
	//1. Algún miembro del hogar tiene medidas de protección por evaluación de riesgo de la Unidad de Protección
	public function validar_q2($codfamilia,$arrayExcell){
		
		$cumple_q2=0;
		$i=1;
		foreach($arrayExcell as $dato){
			
			//Posición 17:Q2 || valores 1:'Si'
			if(@$dato[17]==1 and $dato[2]==$codfamilia){
				$cumple_q2=1;
				}
			$i++;
		}
		
		return $cumple_q2;
	}
	
	//2. El hogar es integrante de un pueblo o comunidad étnica 
	public function validar_z4($codfamilia,$arrayExcell){
		
		$cumple_z4=0;
		$i=1;
		foreach($arrayExcell as $dato){
			
			//Posición 13:Z4 || valores: 6:'Ninguna'  || Observaciones: cualquiera diferente a ninguna
			if(@$dato[13]!=6 and $dato[2]==$codfamilia){
					$cumple_z4=1;
					
				}
			$i++;
		}
		
		return $cumple_z4;
	}
	
	//A causa de la(s) dificultad(es) mencionada(s), ¿… considera que tiene una discapacidad?
	public function validar_I6($codfamilia,$arrayExcell){
		
		$cumple_i6=0;
		$i=1;
		foreach($arrayExcell as $dato){
			
			//Posición 16: I6 || valores: 1:'Si'
			if(@$dato[16]==1 and $dato[2]==$codfamilia){
					$cumple_i6=1;
					
				}
			$i++;
		}
		
		return $cumple_i6;
	}
	
	//Con qué género se siente identificada(o):
	public function validar_B5($codfamilia,$arrayExcell){
		
		$cumple_b5=0;
		$i=1;
		foreach($arrayExcell as $dato){
			
			//Posición 15:B5 || valores: 3:'Otro' 4:'Ninguno' 5:'No sabe no responde'
			if((@$dato[15]==3 or @$dato[15]==4 or @$dato[15]==5) and $dato[2]==$codfamilia){
					$cumple_b5=1;
					
				}
			$i++;
		}
		
		return $cumple_b5;
	}
	
	//¿Cuántos años cumplidos tiene …?
	//Con qué género se siente identificada(o):
	public function personas_mayores_A7($codfamilia,$arrayExcell){
		
		
		$cumple_a7=0;
		$i=1;
		foreach($arrayExcell as $dato){
			
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
			//if(((@$dato[14]>62 and @$dato[15]==2) or (@$dato[14]>57 and @$dato[15]==1)) and $dato[2]==$codfamilia){
			if(((@$dato[14]>62)) and $dato[2]==$codfamilia){
					$cumple_a7=1;
				}
			$i++;
			}
		
		return $cumple_a7;
		
		}
		
	public function validar_edad_productiva_EP($codfamilia,$arrayExcell){

		
		
		
		$cumple_ep=0;
		$i=1;
		$personas_edad_productiva=0;
		$personas_menores=0;
		$personas_mayores=0;
		$personas_discapacidad=0;
		foreach($arrayExcell as $dato){
			
			
			
			
			//Persona edad productiva
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
						
			//if(((@$dato[14]>=18 and @$dato[14]<=61 and @$dato[15]==2) or (@$dato[14]>=18 and @$dato[14]<=56 and @$dato[15]==1)) and $dato[2]==$codfamilia){
			if(((@$dato[14]>=18 and @$dato[14]<=61)) and $dato[2]==$codfamilia){
				$personas_edad_productiva++;
				}
				
			//Personas menores de 18
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
			if(@$dato[14]<18 and $dato[2]==$codfamilia){
				$personas_menores++;
				}
			
			//Personas mayores
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
			//if(((@$dato[14]>62 and @$dato[15]==2) or (@$dato[14]>57 and @$dato[15]==1)) and $dato[2]==$codfamilia){
			if(((@$dato[14]>62)) and $dato[2]==$codfamilia){
				$personas_mayores++;
				}
			
			//Personas con discapacidad
			//Posición 16: I6 || valores: 1:'Si'
			if(@$dato[16]==1 and $dato[2]==$codfamilia){
				$personas_discapacidad++;
				}
			
			$i++;
			}
			
		
			
		//Si tiene más de un integrante en edad productiva ya no cumple el criterio
		if($personas_edad_productiva>1){
			$cumple_ep=0;
			
			
		}
		//Si solo hay una persona en edad productiva o si no existe persona en edad productiva
		else{
			//captura el total de dependientes
			$dependientes=$personas_menores+$personas_mayores+$personas_discapacidad;
			
			//Si existe solo una persona en edad productiva
			if($personas_edad_productiva==1){		
				
				//Si este núcleo tiene más de cinco dependientes
				if($dependientes>5){
					$cumple_ep=1;
				}
				//Si no tiene más de cinco dependientes
				else{
					$cumple_ep=0;
				}
			}
			//Si en el núcleo no existe persona en edad productiva
			//Nota: en las reglas enviadas por la unidad no está este criterio, sin embargo se está incluyendo
			//en caso que el núcleo familiar esté compuesto solo por personas dependientes
			/*
			else{
				//Si en el núcleo existen al menos una pesona dependiente
				if($dependientes>0){
					$cumple_ep=1;
				}
				//Si no existe personas dependientes
				else{
					$cumple_ep=0;
				}
			}*/
		}
		
		
		
		
		return $cumple_ep;
		
	
		}
		
		
		public function validar_edad_productiva_EP2($codfamilia,$arrayExcell){

		
		
		
		$cumple_ep2=0;
		$i=1;
		$personas_edad_productiva=0;
		$personas_menores=0;
		$personas_mayores=0;
		$personas_discapacidad=0;
		foreach($arrayExcell as $dato){
			
			
			
			
			//Persona edad productiva
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
						
			//if(((@$dato[14]>=18 and @$dato[14]<=61 and @$dato[15]==2) or (@$dato[14]>=18 and @$dato[14]<=56 and @$dato[15]==1)) and $dato[2]==$codfamilia){
			if(((@$dato[14]>=18 and @$dato[14]<=61)) and $dato[2]==$codfamilia){
				$personas_edad_productiva++;
				}
				
			//Personas menores de 18
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
			if(@$dato[14]<18 and $dato[2]==$codfamilia){
				$personas_menores++;
				}
			
			//Personas mayores
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
			//if(((@$dato[14]>62 and @$dato[15]==2) or (@$dato[14]>57 and @$dato[15]==1)) and $dato[2]==$codfamilia){
			if(((@$dato[14]>62)) and $dato[2]==$codfamilia){
				$personas_mayores++;
				}
			
			//Personas con discapacidad
			//Posición 16: I6 || valores: 1:'Si'
			if(@$dato[16]==1 and $dato[2]==$codfamilia){
				$personas_discapacidad++;
				}
			
			$i++;
			}
			
		
			
		//Si tiene más de un integrante en edad productiva ya no cumple el criterio
		if($personas_edad_productiva>1){
			$cumple_ep2=0;
			
			
		}
		//Si solo hay una persona en edad productiva o si no existe persona en edad productiva
		else{
			//captura el total de dependientes
			$dependientes=$personas_menores+$personas_mayores+$personas_discapacidad;
			
			//Si existe solo una persona en edad productiva
			if($personas_edad_productiva==1){		
				
				//Si este núcleo tiene más de cinco dependientes
				if($dependientes>=5){
					$cumple_ep2=1;
				}
				//Si no tiene más de cinco dependientes
				else{
					$cumple_ep2=0;
				}
			}
			//Si en el núcleo no existe persona en edad productiva
			//Nota: en las reglas enviadas por la unidad no está este criterio, sin embargo se está incluyendo
			//en caso que el núcleo familiar esté compuesto solo por personas dependientes
			/*
			else{
				//Si en el núcleo existen al menos una pesona dependiente
				if($dependientes>0){
					$cumple_ep=1;
				}
				//Si no existe personas dependientes
				else{
					$cumple_ep=0;
				}
			}*/
		}
		
		
		
		
		return $cumple_ep2;
		
	
		}
		
	
	
	public function validar_edad_productiva_NOEP($codfamilia,$arrayExcell){

		
		
		
		$cumple_noep=0;
		$i=1;
		$personas_edad_productiva=0;
		
		foreach($arrayExcell as $dato){
					
			//Persona edad productiva
			//Posición 14:A7 15:B5 || valores: 14:A7 campo abierto, para 15:B5 1:'Femenino' 2:'Masculino'
			//if(((@$dato[14]>=18 and @$dato[14]<=61 and @$dato[15]==2) or (@$dato[14]>=18 and @$dato[14]<=56 and @$dato[15]==1)) and $dato[2]==$codfamilia){
			if((@$dato[14]>=18 and @$dato[14]<=61 and @$dato[16]!=1) and $dato[2]==$codfamilia){
				$personas_edad_productiva++;
				}
			
			$i++;
			}
			
		
			
		//Si tiene uno o más de un integrante en edad productiva ya no cumple el criterio
		if($personas_edad_productiva>=1){
			$cumple_noep=0;	
			}
		//Si no hay nadie en edad productiva
		else{
			$cumple_noep=1;
		}
		
		
		
		
		return $cumple_noep;
		
	
		}
	
	
	
	public function quitar_familia_excell($codfamilia,$arrayExcell){
		
		
		$cadenafilas="";
		$coma="";
		
		$i=1;
		foreach($arrayExcell as $dato){
			
			if(trim($dato[2])==trim($codfamilia)){
				$cadenafilas=$cadenafilas.$coma.$i;
				$coma=",";
				}
			$i++;
		}
		$this->Excell->setFilas($cadenafilas);
	}
	
	
	
	
	
	
	
	
	
	public function  seguimiento_rutinas(){
		
		
		print "<br>--inicio familias<br>";
		print_r($this->Familia->getArrayFamilias());
		print "<br>--fin familias<br>";
		
		
		print "<br>-----Inicial------<br>";
		print_r ($this->Excell->getArrayExcellMin());
		print "<br>-----Fin Inicial------<br>";
		PRINT "<br>".sizeof($this->Excell->getArrayExcellMin())."<br>";
		print "<br>***************************************************<br>";
		print "<br>***************************************************<br>";
		print "<div style='color:red'>";
		print "<br>-----Final------<br>";
		print_r ($this->Excell->getArrayExcell());
		print "<br>-----Fin Final------<br>";
		PRINT "<br>".sizeof($this->Excell->getArrayExcell())."<br>";
		print "<div>";
		
	}
	
	
	
	
}
