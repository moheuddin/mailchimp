<?php
	
	//print_r($_POST);
	foreach ($_POST['arrsegmento'] as $key => $val) {
	 $groups .= $_POST['arrsegmento'][$key].", ";
	  // Do stuff
	}
	$groups= rtrim($groups,', ');
	  
	$post = new stdClass;	
	foreach ($_POST as $key => $val)
		$post->$key = trim(strip_tags($_POST[$key]));
	//print_r($_POST);	
	$merge_vars = array(
                'FNAME' => $post->fname,
                'LNAME' => $post->lname,
                'cargo' => $post->cargo,
                'estado' => $post->estado,
                'empresa' => $post->empresa,
                'celular' => $post->celular,
				'GROUPINGS' => array(
                  array('name' => $post->segmento, 'groups' =>  $groups)
              )
        );
	
	include_once 'MCAPI.php';
	$api = new MCAPI('a9aa65c50a15c1dc36eb43549c3eaff5-us2');
    $listid = '4bec16f145';
	$result = $api->listSubscribe($listid,$post->email,$merge_vars,false,false,true,false);
	//echo $result;
	if($result){	
		echo "Your request has been send successfully.";
	}else{
		echo "Sorry! We are not able to send your request just now. Please try it latter.";
	}

	//var_dump($merge_vars);
