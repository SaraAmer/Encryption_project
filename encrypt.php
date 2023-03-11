<?php
$upload_folder = "Uploads/Encryption/" . basename($_FILES["file_for_encryption"]["name"]);
$key_value = $_POST['key_value'] ?? 0;
$alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$new_array = [];
$file_path = move_uploaded_file($_FILES['file_for_encryption']['tmp_name'], $upload_folder);
$file_contents = file_get_contents($upload_folder);
$result = '';
$content = str_split($file_contents);
if(trim($file_contents)){
    foreach ($content as $key => $value){
        $new_character_index = ((array_search(strtolower($value), $alphabets)) + $key_value) % 26;
        if($new_character_index){
            $result .= $alphabets[$new_character_index];
        }else {
            $result .= $value;
        }

    }
}
unlink($upload_folder);
echo $result;
