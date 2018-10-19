		<div class="row">
		<h2>3. Resultado</h2> 
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de familias
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Num</th>
<th width="10%">Familia</th>
<th width="5%">Familia en Extrema vulnerabilidad?</th>
<th width="20%">L - La familia no tiene ningún fuente de ingreso</th>
<th width="20%">Q2 - Algún miembro del hogar tiene medidas de protección por evaluación de riesgo de la Unidad de Protección</th>
<th width="20%">Z4 - El hogar es integrante de un pueblo o comunidad étnica </th>
<th width="20%">I6 - En el hogar hay miembros con discapacidad</th>
<th width="20%">B5 - En el hogar hay miembros trans</th>
<th width="20%">A7 - En el hogar hay personas mayores</th>
<th width="20%">En el hogar solo hay una persona en edad productiva al cuidado de más de 5 dependientes (menores, mayores o personas con discapacidad)</th>
<th width="20%">El hogar no se auto-reconoce como étnico</th>
<th width="20%">No hay miembros en edad productiva</th>
<th width="20%">en el hogar hay una persona en edad productiva al cuidado de más de 4 dependientes</th>




                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
                                        $i=0;
	for($i=0;$i<$objFamilia->numFamilias;$i++){?>
		<tr>
		<td >
			<?php 
			print $i+1;?>
		</td>
		<td>
		<?php
			print $objFamilia->arrayFamilias[$i];?>
		</td>
		<td>
			<?php
			$resultado="";
			if($objFamilia->arrayResultado[$i]==1){
				$resultado="SI";
			}
			else{
				$resultado="NO";
			}
			print $resultado;?>
		</td>
		<td title="L: La familia no tiene fuente de ingreso">
			<?php
			print $objFamilia->arrayL[$i];?>
		</td>
		<td title="Q2: Algún miembro del hogar tiene medidas de protección por evaluación de riesgo de la Unidad de Protección">
			<?php
			print $objFamilia->arrayQ2[$i];?>
		</td>
		<td title="Z4: El hogar es integrante de un pueblo o comunidad étnica">
			<?php
			print $objFamilia->arrayZ4[$i];?>
		</td>
		<td title="I6: En el hogar hay miembros con discapacidad">
			<?php
			print $objFamilia->arrayI6[$i];?>
		</td>
		<td title="B5: En el hogar hay miembros trans">
			<?php
			print $objFamilia->arrayB5[$i];	?>
		</td>
		<td title="A7: En el hogar hay personas mayores">
			<?php
			print $objFamilia->arrayA7[$i];	?>
		</td>
		<td title="EP: En el hogar solo hay una persona en edad productiva al cuidado de más de 5 dependientes (menores, mayores o personas con discapacidad)">
			<?php
			print $objFamilia->arrayEP[$i];	?>
		</td>
		<td title="Z4: 3. El hogar no se auto-reconoce como étnico">
			<?php
			print $objFamilia->arrayNoZ4[$i];	?>
		</td>
		<td title="No hay miembro en edad productiva">
			<?php
			print $objFamilia->arrayNoEP[$i];	?>
		</td>
		<td title="EP: en el hogar hay una persona en edad productiva al cuidado de más de 4 dependientes">
			<?php
			print $objFamilia->arrayEP[$i];	?>
		</td>
		
		
		</tr>
		<?php
	}?>
	
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
               
            </div>
			
 


 	

 

 
 


