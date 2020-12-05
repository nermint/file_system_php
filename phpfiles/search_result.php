<?php

$select=$db->prepare("SELECT * FROM files WHERE file_name LIKE :f LIMIT ".$beginning.",".$per_page_result);
$select->execute([":f"=>"%".$search."%"]);

if($select->rowCount()){ ?>
  <div class="clearfix alert alert-success"><?=SEARCH_RESULT?></div>
   <?php foreach($select as $row){
        ?>
        <tr>
          <td><?=$row['file_name']; ?></td>                            
          <td><?=formatSizeUnits($row['file_size']); ?></td>
          <td><?=date("d/m/Y",strtotime($row['file_datetime']))?></td>
          <td><a href="files/ilk.txt" class="btn btn-secondary"><i class="fa fa-eye"></i></a></td>                 
          <td><a href="javascript:void(0);" class="btn btn-info rename"><i class="fas fa-pen-square"></i></a></td>
          <td><a href="#" class="btn btn-primary"><i class="fas fa-file-download"></i></a></td>
          <td><a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
   <?php }
}
else{
    ?>
    <tr>
      <td><div class="alert alert-danger"><?=ALERT_EMPTY?></div></td>
    </tr>
<?php
}

?>