<?php
class Nodo{
 
  public function showNode($nid){
	if($nid > 0){
        // se carga el nodo
        $node = node_load($nid);
            if($node != null){
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

  public function showAll($todo){
	$index = (int)$todo;
        if($index == 1){
                $elementos = array();
                for($j = 1; $j <= 50; $j++){
                        // se carga el nodo
                        $nid = $j;
                        $node = node_load($nid);
                        if($node != null){
                        $title = $node->title;
                        $body = field_get_items('node',$node,'body');
                        $body_value = $body[0]['value'];
                        $img = field_get_items('node',$node,'field_image');
                        $filename = $img[0]['filename'];
                        $date = format_date($node->created, 'custom', 'D j M Y');
                        $dir_img ='http://45.55.135.205/drupal/sites/default/files/styles/large/public/field/image/'.$filename;
                        $elementos[$nid] = array(
                                'nid' => $nid,
                                'title' => $title,
                                'body' => $body_value,
                                'dir_imagen' => $dir_img,
                                'date_created' => $date,
                        );
                    }
                    else{
                        $j=50;
                    }
                }
                echo json_encode($elementos);
        }
        else{
                echo "Ya casi le atinas compa!!! XD  notes bad!";
		echo "valor index: ".$index;
        }
  }
}
?>

