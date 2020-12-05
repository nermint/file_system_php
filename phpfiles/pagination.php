<?php

/*

description

page = 1
LIMIT 0,4
page=2
LIMIT 4,4
page=3
LIMIT 8,4

umumi dustur
beginning = (page-1)*per_page

*/


$per_page_result=4;

$page=@GET('page');

if(! $page){
    $page=1;
}

?>