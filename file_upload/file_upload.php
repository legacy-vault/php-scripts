<?php

    // file_upload.php

    // Uploads the HTTP POST File to an upload Directory and returns Path to it.
    //
    // Input: 
    //   1. Name of an HTML Form's <input>;
    //   2. Path to upload Directory.
    //
    // Output:
    //   Path to the uploaded File or '' if Error.

function file_upload($input_form_name, $upload_dir)
{
    $nl = "<br>\r\n";
    $file_tmp_path = $_FILES[$input_form_name]['tmp_name'];
    $file_remote_name = $_FILES[$input_form_name]['name'];
    $ext_allowed = ['jpg', 'jpeg', 'png', 'gif'];
    
    $file_local_name = basename($file_tmp_path);
    $file_local_ext = pathinfo($file_local_name, PATHINFO_EXTENSION);
    $file_remote_ext = pathinfo($file_remote_name, PATHINFO_EXTENSION);
    
    // Check Extension
    $file_ext = strtolower($file_remote_ext);
    if ( !in_array($file_ext, $ext_allowed) )
    {
        echo 'Unsupported File Extension!' . $nl;
        return '';
    }
    
    
    $file_local_name_woext = pathinfo($file_local_name,  PATHINFO_FILENAME);
    $file_local_new_path = $upload_dir . '/' . $file_local_name_woext . '.' . $file_remote_ext;

    // Already exists?
    if ( file_exists($file_local_new_path) )
    {
        $file_rnd_bytes = random_bytes(6); // Each 3 Bytes are 4 Symbols in base64
        $file_rnd_name_woext = base64_encode($file_rnd_bytes);
        $file_rnd_path = $upload_dir . '/' . $file_rnd_name_woext . '.' . $file_remote_ext;
        while ( file_exists($file_rnd_path) )
        {
            $file_rnd_bytes = random_bytes(6); // Each 3 Bytes are 4 Symbols in base64
            $file_rnd_name_woext = base64_encode($file_rnd_bytes);
            $file_rnd_path = $upload_dir . '/' . $file_rnd_name_woext . '.' . $file_remote_ext;
        }
        $file_local_new_path = $file_rnd_path;
    }

    if ( is_uploaded_file($file_tmp_path) )
    {
        move_uploaded_file($file_tmp_path, $file_local_new_path);
        return $file_local_new_path;
    }
    else
    {
        return '';
    }
}

?>
