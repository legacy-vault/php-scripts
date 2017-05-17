<?php

include("file_upload.php");

$nl = "<br>\r\n";
$input_file_param = 'file'; // <input name='...'>
$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads';

// Upload File
$upload_result = file_upload($input_file_param, $uploads_dir);
if ($upload_result !== '')
{
    echo "Uploaded to $upload_result" . $nl;
}
else
{
    echo 'Error during Upload!' . $nl;
    return;
}

?>
