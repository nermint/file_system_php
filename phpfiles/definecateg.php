<?php

switch($categ){
    case 'video':
        $info= $db-> prepare("SELECT * FROM files WHERE file_categ='video' and file_deleted=0 ORDER BY id DESC LIMIT ".$beginning.",".$per_page_result);
    break;
    case 'doc':
        $info= $db-> prepare("SELECT * FROM files WHERE file_categ='document' and file_deleted=0 ORDER BY id DESC LIMIT ".$beginning.",".$per_page_result);
    break;
    case 'latest':
        $info= $db-> prepare("SELECT * FROM files WHERE file_deleted=0 ORDER BY file_datetime DESC LIMIT ".$beginning.",".$per_page_result);
    break;
    case 'smallsize':
        $info= $db-> prepare("SELECT * FROM files WHERE file_deleted=0 ORDER BY file_size ASC LIMIT ".$beginning.",".$per_page_result);
    break;
    case 'bigsize':
        $info= $db-> prepare("SELECT * FROM files WHERE file_deleted=0  ORDER BY file_size DESC  LIMIT ".$beginning.",".$per_page_result);
    break;
    default:
        $info= $db-> prepare("SELECT * FROM files WHERE file_deleted=0  LIMIT ".$beginning.",".$per_page_result);
    break;
}

?>