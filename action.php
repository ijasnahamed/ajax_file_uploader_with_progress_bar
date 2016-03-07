<?php

set_time_limit(0);

if(count($_FILES["files"])>0)
{
	$success = 0;
	$failed = 0;

	foreach ($_FILES["files"]["error"] as $key => $value)
	{
		if(empty($value))
		{
			if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], __DIR__."/uploads/".uniqid()."_".$_FILES["files"]["name"][$key]))
			{
				$success++;
			}
			else
			{
				$failed++;
			}
		}
		else
		{
			$failed++;
		}
	}

	$data = "";

	if($success>0)
		$data .= $success." files uploaded. ";

	if($failed>0)
		$data .= $failed." files failed to upload";

	$response = array("status" => true, "data" => $data );

	echo json_encode($response);
}

?>