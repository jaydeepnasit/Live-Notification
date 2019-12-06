<?php

require_once '../Config/UFunction.php';
$UDF_call = new UFunction();

$json_parr = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['subject']) && isset($_POST['comment'])){

        $subject = $UDF_call->validate($_POST['subject']);
        $comment = $UDF_call->validate($_POST['comment']);

        if(!empty(trim($subject)) && !empty(trim($comment))){

            $fields['n_sub'] = $subject;
            $fields['n_msg'] = $comment;

            $insert = $UDF_call->insert('notification', $fields);
            if($insert){

                $json_parr['status'] = 101;
                $json_parr['msg'] = 'Notification Is Inserted';

            }
            else{
                $json_parr['status'] = 102;
                $json_parr['msg'] = 'Notification Is Not Inserted';
            }

        }
        else{

            if(empty(trim($subject))){

                $json_parr['status'] = 103;
                $json_parr['msg'] = 'Null Subject Not Allow';

            }
            if(empty(trim($comment))){

                $json_parr['status'] = 104;
                $json_parr['msg'] = 'Null Comment Not Allow';

            }

        }

    }
    else{

        $json_parr['status'] = 105;
        $json_parr['msg'] = 'Invalid Value Not Allow';

    }

}
else{
               
    $json_parr['status'] = 106;
    $json_parr['msg'] = 'Invalid Request Not Allow';

}

echo json_encode($json_parr);

?>