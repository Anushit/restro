<?php require_once('config.php');

  if (isset($_POST['submit'])) {
        //print_r($_POST);die();
        session_start();
        $msg = '';
        $error = '';
        
        if($error==''){
            $data = $_POST;  
            $formdata = postData('savenewsletter', $data);  
            $msg = 'Your request received successfully';
        } 
                                
    }

    
?>