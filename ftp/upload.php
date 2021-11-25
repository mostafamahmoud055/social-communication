<?php
$upload_path='uploads/';
if (!empty($_FILES['file'])) {
if ($_FILES['file']['error'] == 0) {

$_FILES['file']['name']= file_newname($upload_path,$_FILES['file']['name']);

move_uploaded_file($_FILES['file']['tmp_name'], $upload_path.$_FILES['file']['name']);
}
}
function file_newname($path, $filename){
//pos is the location of the dot in the file name  
    if ($pos = strrpos($filename, '.')) {
//if there is extension
//put the filename in the $name variable		
           $name = substr($filename, 0, $pos);
//put the extension in $ext variable		   
           $ext = substr($filename, $pos);
	} else {
           $name = $filename;
    }
$newpath = $path.'/'.$filename;
$newname = $filename;
$counter = 1;
    while (file_exists($newpath)) {
           $newname = $name .'_'. $counter . $ext;
           $newpath = $path.'/'.$newname;
           $counter++;
     }
    return $newname;

}
header("Location: uploads/.index.php");
exit();
?>