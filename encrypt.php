<?php
$upload_folder = "Uploads/Encryption/" . basename($_FILES["file_for_encryption"]["name"]);
$key_value = $_POST['key_value'] ?? 0;
$alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$new_array = [];
$file_path = move_uploaded_file($_FILES['file_for_encryption']['tmp_name'], $upload_folder);
$file_contents = file_get_contents($upload_folder);
foreach ($alphabets as $key => $value){
    $new_key = ($key + $key_value) % 26;
    $new_array[$new_key] = $value;
}
$result = '';
$content = str_split($file_contents);
if(trim($file_contents)){
    foreach ($content as $key => $value){
        $new_character_index = array_search(strtolower($value), $new_array);
        if($new_character_index){
            $result .= $alphabets[$new_character_index];
        }else {
            $result .= $value;
        }

    }
}
echo $result;
