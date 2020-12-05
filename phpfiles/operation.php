<?php

require_once 'dbconfig.php';
require_once 'function.php';
require_once 'get_post.php';

if(isset($_POST['addfile'])){

    // add a new file
    $filename = $_FILES['file']['name'];

    if(empty($filename)){
        header("Location: ../index.php?add=empty");
        exit;
    }

    $filesize=$_FILES['file']['size'];

    $direction="../files/";
    $destination= $direction . basename($_FILES["file"]["name"]);
    $extension = strtolower(pathinfo($destination,PATHINFO_EXTENSION));

    if($extension=='mp4' || $extension=='webm'){
        $category="video";
    }else{
        $category="document";
    }

    

    if(file_exists($destination)){
        header("Location: ../index.php?add=exist");
        exit;
	}

    

    // upload to folder
    if(move_uploaded_file($_FILES['file']['tmp_name'], $destination)){

        // insert to the database
        $insert=$db->prepare("INSERT INTO files(file_name,file_size,file_categ,file_extension) 
        VALUES (:fname, :size, :categ, :extension)");
        $insert->execute([':fname'=>$filename, ':size'=>$filesize, ':categ'=>$category,':extension'=>$extension]);
        if($insert->rowCount()){
            header("Location: ../index.php?add=success");
        }
        
    }else{
        header("Location: ../index.php?add=fail");
    }

}


if(@POST('rename_info')){
    $info=trim($_POST['rename_info']);
    parse_str($info,$data);
    $new_fname = $data['new_fname'];
    $id  = $data['id'];

    if(! empty($new_fname)){
        $selectextesnion=$db->prepare("SELECT file_extension FROM files WHERE id=:id and file_deleted=0");
        $selectextesnion->execute([":id"=>$id]);
        $extension=$selectextesnion->fetch(PDO::FETCH_ASSOC);
        $exten=$extension['file_extension'];
        $update=$db->prepare("UPDATE files SET file_name=:fname WHERE id=:id and file_deleted=0");
        $update->execute([":fname"=>$new_fname.'.'.$exten,":id"=>$id]);
        if($update->rowCount())
            echo 'success';
        else{
            echo 'fail';
        }
            
    }else{
        echo 'empty';
    }

}

if(! empty($delete)){
    //$delete=GET('delete_id');
    $update=$db->prepare("UPDATE files SET file_deleted=1 WHERE id=:del");
    $update->execute([":del"=>$delete]);
    if($update->rowCount()){
        
        $file_name=$db->prepare("SELECT file_name FROM files WHERE id=:i");
        $file_name->execute([":i"=>$delete]);
        $fname=$file_name->fetch(PDO::FETCH_ASSOC);
        $fn=$fname['file_name'];
        $way=$_SERVER['DOCUMENT_ROOT']."/file_system/files";
        unlink($way.'/'.$fn);

        $url="http://localhost/file_system/index.php";
        header("Location: ".$url."?deleted=success");
    }else{
        header("Location: ".$url."?deleted=fail");
    }
}




?>