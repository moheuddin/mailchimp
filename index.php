<?php
function group_tree($value = NULL){
	$txt = "";
	
	foreach($value as $mykey => $myvalue) {
		if (is_array($myvalue)){
		foreach($myvalue as $val){
			extract($val);					
			$txt .=  '<li><input type="checkbox" name="arrsegmento[]" value="'.$name.'" /> '.$name."</li>";	
			}
		}
	}
	return $txt;	
}

?><!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Cadastro TNT Mail - Ana</title>
          <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png">
  
   
</head>
<body>
	<?php
	include_once 'MCAPI.php';
	//$api = new MCAPI('074ebbd1e075ebc0871e6fd1d2dac539-us3');//me
	$api = new MCAPI('a9aa65c50a15c1dc36eb43549c3eaff5-us2');
    $listid = '4bec16f145';
	$group = $api->listInterestGroupings($listid);
	?>
  <div class="container">
    <div class="row">
      <div id="container" class="twielve column" style="margin-top: 5%;margin-bottom:5%;">
		<h3 style="margin-bottom:0;">Cadastro TNT Mail - Ana</h3>
		<span><span class="required">*</span> Required</span><br>
		<div class="loader"></div>
		<form id="myform"  action="" method="post">
			<fieldset>
				<legend>Sign Up</legend>
				
				<div>
                    <label for="email">email <span class="required">*</span></label> <input name="email" id="email" type="text" /> <input type="button" name="check" id="check" value="Check">
				</div>
				<div>
					<label for="fname">primeiro nome <span class="required">*</span></label> <input name="fname" id="fname" type="text" />
				</div>
				<div>
					<label for="lname">sobrenome</label> <input name="lname" id="lname" type="text" />
				</div>
				<div>
					<label for="lname">celular xx xxxx-xxxx</label> <input name="celular" id="celular" type="tel" value="" />
				</div>
			</fieldset>
			
			<div class="segmento">
				<?php
					foreach($group as $key => $value) {
						echo '<h4>'.$value['name'] .'<span class="required">*</span></h4><span id="chk"></span>';
						echo '<input type="hidden" name="'.$value['name'] .'" value="'.$value['name'] .'" />';
						//echo nl2br(group_tree($value));
						echo group_tree($value);
					}
				?>		   
            </div>
			
			<div class="empresa">
			<label for="empresa">Empresa</label><input type="text" name="empresa"  id="empresa" value="" >
			</div>
                    <div class="cargo">
					<h4>cargo</h4>
						<input type="radio" name="cargo" value="agente"> agente<br>
						<input type="radio" name="cargo" value="operacoes/administrativo"> operacoes/administrativo<br>
						<input type="radio" name="cargo" value="marketing"> marketing<br>
						<input type="radio" name="cargo" value="supervisao/coordenacao"> supervisao/coordenacao<br>
						<input type="radio" name="cargo" value="comercial/vendas"> comercial/vendas<br>
						<input type="radio" name="cargo" value="gerencia"> gerencia<br>
						<input type="radio" name="cargo" value="socio/presidencia/diretoria"> socio/presidencia/diretoria<br>
						<input type="radio" name="cargo" value="nao informado"> nao informado<br>                      
                    </div>
                    <div class="estado">
			<h4>Estado</h4>
			<select name="estado" id="estado" ><option value=""></option>
			<option value="SP Capital">SP Capital</option> <option value="SP interior">SP interior</option> <option value="RJ">RJ</option> <option value="AC">AC</option> <option value="AL">AL</option> <option value="AP">AP</option> <option value="AM">AM</option> <option value="BA">BA</option> <option value="CE">CE</option> <option value="DF">DF</option> <option value="ES">ES</option> <option value="GO">GO</option> <option value="MA">MA</option> <option value="MG">MG</option> <option value="MS">MS</option> <option value="MT">MT</option> <option value="PA">PA</option> <option value="PB">PB</option> <option value="PE">PE</option> <option value="PI">PI</option> <option value="RN">RN</option> <option value="RO">RO</option> <option value="RS">RS</option> <option value="RR">RR</option> <option value="PR">PR</option> <option value="SC">SC</option> <option value="SE">SE</option> <option value="TO">TO</option> <option value="Exterior">Exterior</option></select>
                    </div>
                    <input id="submit"  type="button" title="Send" value="Send" />
		</form>
		<div id="response"></div>
	      </div>
    </div>
  </div>
   <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript">
$(document).ready(function() {
		$('.loader').hide();
		
        $("#myform").validate({
          rules: {
                email: {required: true},
                fname: {required: true},		 
                'arrsegmento[]': { required: true, minlength: 1 } 
                 },
                 message: {
                        'arrsegmento[]': "Please select at leat one."
                 }, 
                errorPlacement: function( error, element ) {
                        if( element.attr( "name" ) === "arrsegmento[]" ) {
                                error.appendTo("#chk");
                                //('#chk').text() = label.text(); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
                                
                        } else {
                                error.insertAfter( element ); // standard behaviour
                        }
                }
     });
		
		
	$("#submit").click(function(e) {
            e.preventDefault();
            var $form = $("#myform");
            var $mydata = $form.serialize();
			// check if the input is valid
            if(!$form.valid())return false;
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: $mydata,
                beforeSend: function(){
					$(".loader").show();
                },
                success: function(data){
                alert(data);

                },
                complete: function(){
                   $(".loader").hide();
                }
            });
        });
        
        $("#check").click(function(e) {
            e.preventDefault();
			var email = $('#email').val();
            $.ajax({
                type: 'POST',
				//dataType: 'json',
                url: 'get-user.php',
				data: 'email='+email,
                beforeSend: function(){
                $(".loader").show();
                },
                success: function(data){
                var json = $.parseJSON(data);
					//console.log(json.data[0].merges.FNAME);
					var arrGroup = (json.data[0].merges.GROUPINGS[0].groups).split(', ')
					var cargo = json.data[0].merges.CARGO
					var estado = json.data[0].merges.ESTADO //chk
					
					$('#fname').val(json.data[0].merges.FNAME);
					$('#lname').val(json.data[0].merges.LNAME);
					$('#empresa').val(json.data[0].merges.EMPRESA);
					$('#celular').val(json.data[0].merges.SELULAR);
					$("#estado").val(estado);
					$('input[name="cargo"][value="'+cargo+'"]').attr('checked', 'checked');
					console.log(json.data[0].merges);
					
					$(".segmento :checkbox").attr('checked', false);
					for (i = 0;i < arrGroup.length;i++){
						//console.log(arrGroup[i])+'\n';
						$('.segmento :checkbox').each(function(){
							 if( this.value == arrGroup[i] ){
								 
								 $(this).prop("checked", true);
							 }
						});
					}
                },
                complete: function(){
                   $(".loader").hide();
                }
            });
        });
			
	});
	
	function resetform(){
		$(':input','#myform')
		 .not(':button, :submit, :reset')
		 .val('')
		 .removeAttr('checked')
		 .removeAttr('selected');
	}
	</script>
</body>
</html>