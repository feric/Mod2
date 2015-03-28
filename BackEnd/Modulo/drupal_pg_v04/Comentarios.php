<?php
class Comentarios{
 
  public function putComment($nid, $body){
	if($nid > 0){
        $node = node_load($nid);//se carga el nodo
            if($node != null){	//Validamos que el nodo exista
        	$title = $node->title;
                $body = field_get_items('node',$node,'body');
                $body_value = $body[0]['value'];
                $img = field_get_items('node',$node,'field_image');
                $filename = $img[0]['filename'];
                $dir_img ='http://45.55.135.205/drupal/sites/default/files/styles/large/public/field/image/'.$filename;
                $date = format_date($node->created, 'custom', 'D j M Y');

                $datos_nodo = array(
                	'nid' => $nid,
                        'title' => $title,
                        'body' => $body_value,
                        'dir_imagen' => $dir_img,
                        'date_created' => $date,
                        );
               	echo json_encode($datos_nodo);
    	    }
     	    else{
       			echo "Esa nota aun no se escribe compa! pon una que YA EXISTA! XD ";
   	    }
 	}
        else{
        	echo "Id inconrrecto XD !! Esa nota nunca se pudo escribir!";
        }
  }
  
  public function showAllComments($nid){
	if($nid > 0){
                        // se carga el nodo
                        $node = node_load($nid);
                        if($node != null){ //validamos si el nodo existe
                                $cids = comment_get_thread($node, COMMENT_MODE_FLAT, 100);
                                $entities = comment_load_multiple($cids);

                                $consulta = db_select('comment', 'c');
                                $consulta->join('field_data_comment_body', 'f', 'c.cid=f.entity_id');
                                $consulta->fields('c', array('cid','created'))
                                        ->fields('b', array('comment_body_value'))
                                        ->condition('nid', $nid);
                                $resultado = $consulta->execute();
                                $comentarios = array();
                                while ($comentario = $resultado->fetchAssoc()) {
                                        $cid = $comentario['cid'];
                                        $date = format_date($comentario['created'],'custom','D j M Y');
                                        $body = $comentario['comment_body_value'];
                                        $comentarios[$cid] =  array(
                                                'cid' => $cid,
                                                'body' => $body,
                                                'date_created' => $date,
                                        );
        			}
                                echo json_encode($comentarios);
                        }
			else{
				echo "elagos say: Mijo tas bien morro, esa nota aun ni se escribe!";
			}
	}
  }

  public function getAllComments($nid){
	if($nid > 0){
		$consulta = db_select('comment', 'c');
		$consulta->fields('c', array('cid'))
               		->condition('nid', $nid, '=');
               	$resultado = $consulta->execute();
		$comentarios = array();
			#echo json_encode($resultado);
			foreach ($resultado as $id_comment){
				$cid = $id_comment->cid;
				#echo $cid."\n \n";
                		$comentario = comment_load($cid,false); //se carga el comentario
				#echo json_encode($comentario)."\n \n";
          			if($comentario != null){	//se valida que el comantio exista
               				$body = field_get_items('comment',$comentario,'comment_body');
                     			$body_value = $body[0]['value'];
                     			$date = format_date($comentario->created, 'custom', 'D j M Y');
                                	$comentarios[$cid] = array(
                                        	'cid' => $cid,
                                        	'body' => $body_value,
                                        	'date_created' => $date,
                                	);
                                	#echo json_encode($body_value);
                        	}
                		else{
                			echo "elagos say: comentario fallido XD ";
             			}
			}
			echo json_encode($comentarios);
    	}
        else{
        	echo "Id inconrrecto XD !! Esa nota nunca se pudo escribir!";
	}
  }

}
?>

