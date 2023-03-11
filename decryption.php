<?php
require_once 'EncryptionManager.php';
$upload_folder = "Uploads/Decryption/" . basename($_FILES["file_for_decryption"]["name"]);
$file_path = move_uploaded_file($_FILES['file_for_decryption']['tmp_name'], $upload_folder);
$file_contents = file_get_contents($upload_folder);
$alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$alphabets_apperance = [3312, 573, 1568, 1602, 6192, 966, 769, 1869, 2943, 119, 206, 1579, 1500, 2982, 3261, 1074, 116, 2716, 3072, 4358, 1329, 512, 748, 123, 727, 16];
$file_contents_array = str_split($file_contents);
$repeating_number = array_fill(0, 26, 0);
if (!empty($file_contents_array)){
    foreach ($file_contents_array as $character){
        $character_index = array_search(strtolower($character), $alphabets);
        if($character_index){
            $repeating_number[$character_index] = $repeating_number[$character_index] ? $repeating_number[$character_index] + 1 : 1;
        }
    }
}
$text_length = strlen(str_replace(' ', '', trim($file_contents)));
$array_percentege = array_map(function ($value){  global $text_length; return ($value * 100) /  $text_length;}, $repeating_number);
$encryption_manager = new EncryptionManager($alphabets_apperance, $array_percentege);
$key_value = $encryption_manager->get_key();
$result = '';
$content = str_split($file_contents);
if(trim($file_contents)){
    foreach ($content as $key => $value){
        $character_index = array_search(strtolower($value), $alphabets);
        if($character_index){
            $new_index = $character_index - $key_value;
            $new_index = $new_index < 0 ? $new_index + 26 : $new_index;
            $result .= $alphabets[$new_index];
        }else {
            $result .= $value;
        }

    }
}
unlink($upload_folder);

var_dump($result);
