<?php

session_start();

if(! isset($_SESSION['lang'])){
    $_SESSION['lang']='az';
}

// set the gloabal variables

if($_SESSION['lang']=='az'){
    define('CATEG',"Kateqoriyalar");
    define('ALLFILES','Bütün fayllar');
    define('VIDEOS','Videolar');
    define('DOCUMENTS','Sənədlər');
    define('LATEST','Ən yeni fayllar');
    define('BIGSiZE','Böyük ölçülü fayllar');
    define('SMALLSIZE','Kiçik ölçülü fayllar');
    define('SORT','Tipə görə');
    define('SEARCH_INPUT','Axtarış edin');  
    define('SEARCH_BTN','Axtar');
    define('TITLE','Fayl idarəetmə sistemi.');
    define('ADD','Əlavə et');
    define('FILE_NAME','Fayl');
    define('FILE_SIZE','Ölçü');
    define('FILE_DATE','Tarix');
    define('FILE_RENAME','Adını dəyiş');
    define('DOWNLOAD','Yüklə');
    define('DELETE','Sil');
    define('ALERT_ADD_SUCCESS','Fayl əlavə olundu.');
    define('ALERT_ADD_EXIST','Fayl artıq mövcuddur.');
    define('ALERT_ADD_FAIL','Fayl yüklənməsində problem yarandı.');
    define('ALERT_ADD_EMPTY','Faylı daxil etməlisiniz.');
    define('ALERT_DEL_SUCCESS','Fayl silindi.');
    define('ALERT_DEL_FAIL','Fayl silinməsində problem yaşandı.');
    define('ALERT_EMPTY','Heç bir məlumat tapılmadı.');
    define('POPUP_RENAME','Fayl adını dəyişin.');
    define('POPUP_RENAME_BTN','Dəyiş');
    define('POPUP_ADD','Yeni fayl əlavə edin.');
    define('POPUP_CHOOSE','Fayl seçin');
    define('POPUP_ADD_BTN','Əlavə edin');
    define('SEARCH_RESULT','Axtarış nəticəsi.');

}
else if($_SESSION['lang']=='en'){
    define('CATEG',"Categories");
    define('ALLFILES','All files');
    define('VIDEOS','Videos');
    define('DOCUMENTS','Documents');
    define('LATEST','Latest files');
    define('BIGSiZE','Large size files');
    define('SMALLSIZE','Small size files');
    define('SORT','By type');
    define('SEARCH_INPUT','Do a search');  
    define('SEARCH_BTN','Search');
    define('TITLE','File management system.');
    define('ADD','Add');
    define('FILE_NAME','File');
    define('FILE_SIZE','Size');
    define('FILE_DATE','Date');
    define('FILE_RENAME','Rename');
    define('DOWNLOAD','Download');
    define('DELETE','Delete');
    define('ALERT_ADD_SUCCESS','File has been added.');
    define('ALERT_ADD_EXIST','The file already exists.');
    define('ALERT_ADD_FAIL','There was a problem adding the file.');
    define('ALERT_ADD_EMPTY','You must enter the file.');
    define('ALERT_DEL_SUCCESS','File has been deleted.');
    define('ALERT_DEL_FAIL','There was a problem deleting the file.');
    define('ALERT_EMPTY','No information.');
    define('POPUP_RENAME','Rename the file.');
    define('POPUP_RENAME_BTN','Change');
    define('POPUP_ADD','Add a new file.');
    define('POPUP_CHOOSE','Choose the file');
    define('POPUP_ADD_BTN','Add');
    define('SEARCH_RESULT','The result of search.');
}

?>