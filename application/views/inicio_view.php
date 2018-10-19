<!DOCTYPE html>
<html>
<head>
	<title>Identificación familias extrema vulnerabilidad</title>
	
	<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	
	
	<!-- Bootstrap Core CSS -->
    <link href="<?php print base_url(); ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php print base_url(); ?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php print base_url(); ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php print base_url(); ?>bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php print base_url(); ?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php print base_url(); ?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
</head>
<body style="padding: 25px 25px 25px 25px">

           

   


		<div class="row">
		<h1>Identificación de familias en extrema vulnerabilidad</h1>
		</div>
		
		
		<div class="row">
		<h2>1.Subir fuente de datos</h2> Seleccione fuente de datos:
		<input type="file" name="" id="" /><br>
		<input type="button" name="btn_subir" id="btn_subir" value="Subir archivo"/>
		
		
		</div>
		<div class="row">
		<h2>2. Identificar familias vulnerables</h2>
		<input type="button" name="btn_procesar" id="btn_procesar" value="Procesar archivo"/>
		</div>
	
		
		<div class="row">
			<div id="contenido_principal" style="padding: 25px 25px 25px 25px"></div>
		</div>
 
	<input type="hidden" name="ruta_url" id="ruta_url" value="<?php print base_url(); ?>">

 	

 

 
 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
 <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
 
 
  <!-- jQuery -->
    <script src="<?php print base_url(); ?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php print base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php print base_url(); ?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php print base_url(); ?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php print base_url(); ?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php print base_url(); ?>dist/js/sb-admin-2.js"></script>
	
</body>
</html>

<script language="JavaScript">

$(document).ready(function () {
    $("#btn_procesar").click(function (event) {
              
        
        event.preventDefault();
        //$(".progress").css('visibility','visible');
        /*
         $("#notificacion_operacion").dialog({
                height:200,
                width:200,
                resize:true,
                title:"Progreso...",
                close: function( event, ui ) {
                    
                    }
                
                });
		xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.myprogress').text(percentComplete + '%');
                            $('.myprogress').css('width', percentComplete + '%');
                            }
                        }, false);
                    return xhr;
                    },
        
		*/
        $.ajax({
            url: $("#ruta_url").val()+"index.php/FamiliasVulnerables/identificar_familias",
            type: 'post',
            dataType: 'html',            
            
            success: function (response) {
                //$('.myprogress').css("background-color", "green");
				 $("#contenido_principal").html(response);
                
                //$("#notificacion_operacion").dialog('close');       
                
                
            }
        });
        
        
    
    

    });



  });

</script>
