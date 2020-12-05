
<?php

require_once 'phpfiles/dbconfig.php';
require_once 'phpfiles/operation.php';
require_once 'phpfiles/pagination.php';
require_once 'phpfiles/get_post.php';
require_once 'phpfiles/definelang.php';


?>

<!DOCTYPE html>
 <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=TITLE?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
       
      <!-- main side starts -->
       <div class="container-fluid">
           <div class="row">
               <div class="col-12 col-md-2 pt-3 pt-md-5 categ-left">
                   <h5><?=CATEG?></h5>
                   <div class="row">

                     <div class="col-6 col-md-12">
                      <div class="categ-type">
                        <div >
                            <a href="index.php"><?=ALLFILES?></a>
                        </div>
                        <div >
                            <a href="index.php?categ=video"><?=VIDEOS?></a>
                        </div>
                        <div>
                            <a href="index.php?categ=doc"><?=DOCUMENTS?></a>
                        </div>
                     </div> 
                   
                     <br>
                
                     </div>

                     <div class="col-6 col-md-12">
                      <div class="clearfix">
                        <div>
                            <a href="index.php?categ=latest"><?=LATEST?></a>
                        </div>
                        <div>
                            <a href="index.php?categ=bigsize"><?=BIGSiZE;?></a>    
                        </div>
                        <div>
                            <a href="index.php?categ=smallsize"><?=SMALLSIZE?></a>    
                        </div>
                       </div>
                     </div>
                     
                   </div>

                   <hr>

                  <div class="dropdown float-right mb-3 mb-md-0">
                    <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Sort
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        
                        <?php
                         $extension=$db->prepare("SELECT DISTINCT file_extension FROM files WHERE file_deleted=0");
                         $extension->execute();
                         if($extension->rowCount()){
                           foreach($extension as $row){
                             ?>
                             <a class="dropdown-item" href="index.php?extension=<?=$row['file_extension']; ?>"><?=$row['file_extension'];?></a>
                          <?php }
                         }
                        ?>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="javascript:void(0); "><b><?=SORT?></b></a>
                        </div>
                    </div>
                    <div class="search-side">
                      <form class="form-inline mb-4 clearfix" action="" method="GET">
                          <input class="form-control mt-3" type="text" name="search" placeholder="<?=SEARCH_INPUT?>..">
                          <button class="btn btn-success btn-sm"><?=SEARCH_BTN?></button>
                      </form>
                    </div>

               </div>



               <div class="col-12 col-md-10 mt-5 mt-md-0 pt-md-5 pl-md-5 pr-md-5">
               <div>
                  
                  <?php
                      
                      // for add alert
                      if($add=='success'){
                        ?>
                        <div class="clearfix alert alert-success"><?=ALERT_ADD_SUCCESS?></div>
                      <?php }
                      else if($add=='exist'){
                        ?>
                        <div class="clearfix alert alert-warning"><?=ALERT_ADD_EXIST?></div>
                     <?php }
                     else if($add=='fail'){
                       ?>
                       <div class="clearfix alert alert-danger"><?=ALERT_ADD_FAIL?></div>
                    <?php }
                    else if($add=='empty'){
                      ?>
                      <div class="clearfix alert alert-warning"><?=ALERT_ADD_EMPTY?></div>
                   <?php }

                    // for delete alert

                    $deleted=@GET('deleted');
                    if($deleted=='success'){
                      ?>
                      <div class="clearfix alert alert-success"><?=ALERT_DEL_SUCCESS?></div>
                    <?php }
                    else if($deleted=='fail'){
                      ?>
                      <div class="clearfix alert alert-danger"><?=ALERT_DEL_FAIL?></div>
                   <?php }
                   


                  ?>
                  
                </div>

                <!-- rename result -->
                <div id="update_rename"></div>


                  <!-- mains side -->
                  <div class="row">
                    <div class="col-md-11">
                          <h4 class="mb-4 main-header"><?=TITLE?></h4>
                    </div>

                    <div class="col-md-1">
                    <div class="lang-side">
                            <select name="lang" onchange="location = this.value;">
                                <option value="phpfiles/language.php?lang=az" <?php if(($_SESSION['lang'])=='az') { ?> selected <?php } ?> >AZ</option>
                                <option value="phpfiles/language.php?lang=en" <?php if(($_SESSION['lang'])=='en') { ?> selected <?php } ?> >EN</option>
                            </select>
                    </div>
                    </div>
                  </div>
                   
                    

                    <a class="btn btn-success float-right mb-3 add-btn" href="javascript:void(0);"><i class="fa fa-plus"></i>  <?=ADD?></a>
                    
                   

                    <table class="table table-dark table-hover table-responsive-md">
                        <thead>
                          <tr>
                            <th scope="col"><?=FILE_NAME?></th>
                            <th scope="col"><?=FILE_SIZE?></th>
                            <th scope="col"><?=FILE_DATE?></th>
                            <th scope="col"><?=FILE_RENAME?></th>
                            <th scope="col"><?=DOWNLOAD?></th>
                            <th scope="col"><?=DELETE?></th>                      
                          </tr>
                        </thead>
                        <tbody>
                        
                        <?php

                            // beginning of the limit
                            $beginning=($page-1)*$per_page_result;

                            if(! empty($exten)){
                              require_once 'phpfiles/defineextension.php';

                            }
                            else if(! empty($search)){
                              require_once 'phpfiles/search_result.php';
                            }
                            else{
                            require_once 'phpfiles/definecateg.php';
                            
                            $info->execute();
                            if($info->rowCount()){
                              foreach($info as $row){
                                ?>

                              <tr>
                                <td><?=$row['file_name']; ?></td>                            
                                <td><?=formatSizeUnits($row['file_size']); ?></td>
                                <td><?=date("d.m.Y",strtotime($row['file_datetime']))?></td>               
                                <td><a href="index.php?rename_id=<?=$row['id'];?>" class="btn btn-info rename"><i class="fas fa-pen-square"></i></a></td>
                                <td><a href="phpfiles/download.php?file_name=<?=$row['file_name']; ?>" class="btn btn-primary"><i class="fas fa-file-download"></i></a></td>
                                <td><a href="index.php?delete_id=<?=$row['id'];?>" class="btn btn-danger delete_file"><i class="fas fa-trash-alt"></i></a></td>
                              </tr>

                              <?php }
                            }
                            else{ ?>
                              <tr>
                                <td><div class="alert alert-warning"><?=ALERT_EMPTY?></div></td>
                              </tr>
                          <?php  }
                            }
                        ?>                         

                        </tbody>
                      </table>

                      <nav class="mt-5">
                        <ul class="pagination justify-content-center">
                          <li>
                          <a class="page-link prev" href="#" aria-label="Previous">
                            &laquo;
                          </a>
                          </li>

                          <?php

                          // count of records
                            
                            if(! empty($exten)){
                              $selectall=$db -> prepare("SELECT * FROM files WHERE file_extension=:e and file_deleted=0");
                              $selectall->execute([":e"=>$exten]);
                            }
                            else if(! empty($search)){
                              $selectall=$db->prepare("SELECT * FROM files WHERE file_name LIKE :f");
                              $selectall->execute([":f"=>"%".$search."%"]);
                            }
                            else{
                            switch($categ){
                              case 'video':
                                $selectall=$db -> prepare("SELECT * FROM files WHERE file_categ='video' and file_deleted=0");
                              break;
                              case 'doc':
                                $selectall=$db -> prepare("SELECT * FROM files WHERE file_categ='document' and file_deleted=0");
                              break;
                              case 'latest':
                                $selectall=$db -> prepare("SELECT * FROM files WHERE file_deleted=0 ORDER BY file_datetime DESC ");
                              break;
                              default:
                                $selectall=$db -> prepare("SELECT * FROM files WHERE file_deleted=0");
                              break;
                            }
                            $selectall->execute();
                            }
                          
                          
                          $count=$selectall->rowCount();
                          $countofpage=ceil($count/$per_page_result);
                          for($i=1;$i<=$countofpage;$i++){
                            ?>
                            <li class="page-item" id="elem"><a class="page-link" href="<?="index.php?page=$i&categ=$categ&extension=$exten&search=$search"?>"><?=$i?></a></li>
                          <?php }
                          
                          ?>
                          
                          <li>
                          <a class="page-link next" href="#" aria-label="Next">
                            &raquo;
                          </a>
                          </li>
                        </ul>
                      </nav>

                   </div>
               </div>

       </div>
        <!-- main side ends -->

        <?php

          if(! empty($rename)){
            ?>
             <!-- rename popup starts -->
            <div class="rename-popup-wrapper target">
              <div class="show-popup">
                <h4 class="text-center"><?=POPUP_RENAME?>.</h4>
                <form action="" method="POST" id="rename">
                  <input type="text" placeholder="Yeni ad.." class="form-control" name="new_fname">
                  <input type="text" value="<?=$rename;?>" class="form-control" name="id">
                  <div class="text-center">
                  <button class="close-popup btn btn-danger m-2" onclick="return false;"><span class="fa fa-close"></span></button>
                  <button class="btn btn-outline-success m-2 change-name" onclick="return false;"><?=POPUP_RENAME_BTN?></span></button>
                  </div>
                </form>
              </div>
            </div>

      <!--rename popup ends -->
         <?php }

      ?>
       

     <!-- add popup starts -->
     <div class="add-popup-wrapper">
      <div class="show-popup">
        <h4 class="text-center"><?=POPUP_ADD?></h4>

        <form action="phpfiles/operation.php" method="POST" enctype="multipart/form-data">
          <div class="input-group mb-3 mt-4">
            <div class="custom-file">
              <label class="custom-file-label"><?=POPUP_CHOOSE?></label>
              <input type="file" class="custom-file-input file-side" name="file">
            </div>
          </div>
          <button class="close-popup btn btn-danger m-2" onclick="return false;"><span class="fa fa-close"></span></button>
          <button class="btn btn-outline-success m-2 add-info-btn" name="addfile"><?=POPUP_ADD_BTN?></button>
        </form>
        
        
      </div>
    </div>
      
      <!--add popup ends-->

     
      
       <!-- jquery and bootstrap js -->
       <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
       <!-- font awesome -->
       <script src="https://kit.fontawesome.com/ec27f98106.js" crossorigin="anonymous"></script>
      
       <!-- sweet alert js -->
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
       
        <!-- main.js -->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/ajax.js"></script>
       

    </body>
</html>