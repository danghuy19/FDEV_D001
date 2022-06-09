<?php
$dir = opendir('data');
while(($file = readdir($dir)) !== false){
    if($file != '.' && $file != '..'){
        if(is_file('data/' . $file)){
            echo 'file ' . $file . '<br/>';
        }
        else{
            echo 'folder ' . $file . '<br/>';
        }
    }
}
closedir($dir);

//mkdir('data/test_folder_2');
?>