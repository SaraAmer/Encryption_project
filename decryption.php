<?php
$upload_folder = "Uploads/Decryption/" . basename($_FILES["file_for_decryption"]["name"]);
$file_path = move_uploaded_file($_FILES['file_for_decryption']['tmp_name'], $upload_folder);
$file_contents = file_get_contents($upload_folder);
