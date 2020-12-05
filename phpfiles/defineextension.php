<?php

$extension=@GET('extension');
$count=0;

$selectextension=$db->prepare("SELECT * FROM files WHERE file_deleted=0");
$selectextension->execute();
if($selectextension->rowCount()){
    foreach($selectextension as $row){
        if($row['file_extension']==$extension){  
                $count++;
                 ?>
                <tr>
                <td><?=$row['file_name']; ?></td>
                <td><?=formatSizeUnits($row['file_size']); ?></td>
                <td><a href="files/ilk.txt" class="btn btn-secondary"><i class="fa fa-eye"></i></a></td>                 
                <td><a href="javascript:void(0);" class="btn btn-info rename"><i class="fas fa-pen-square"></i></a></td>
                <td><a href="#" class="btn btn-primary"><i class="fas fa-file-download"></i></a></td>
                <td><a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
             <?php }
             
              
        
    }

}
if($count==0){
    ?>
      <tr>
        <td><div class="alert alert-warning"><?=ALERT_EMPTY?></div></td>
      </tr>
    <?php
}


?>