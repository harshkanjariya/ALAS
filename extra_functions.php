<?php
function send_notification($employee_id, $title, $body, $screen, $icon = 'ic_launcher_foreground')
{
	$fire = new Firebasetoken();
	$fire->data['id'] = $employee_id;
	$response = $fire->get();
	if ($response['status'] == 'success') {
		$realtime = $response['data'];
		$realTime_Url = "https://emplitrack.com/firebase/send_notification";
		$data = array();

		$data['token'] = $realtime;
		$data['body'] = $body;
		$data['title'] = $title;
		$data['screen'] = 'features.leave.LeaveListActivity';
		$data['icon'] = $icon;
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($realTime_Url, false, $context);
		if ($result != 'success')
			$response['error'] = $response['error'] . ',' . $result;
	}
	return $response;
}
function cout($str)
{
	print($str . "<br/>");
}
function emptyDir($dir)
{
	if (is_dir($dir)) {
		$scn = scandir($dir);
		foreach ($scn as $files) {
			if ($files !== '.') {
				if ($files !== '..') {
					if (!is_dir($dir . '/' . $files)) {
						unlink($dir . '/' . $files);
					} else {
						emptyDir($dir . '/' . $files);
						rmdir($dir . '/' . $files);
					}
				}
			}
		}
	}
}

function storage($company_id)
{ 
	$result = true;
	$company_plans = Company::selectPlans($company_id);
	$totalGB = intval($company_plans['available_gb']) + intval($company_plans['available_gb_plan']);
	$folder = new CompanyFolder($company_id);
	$folderSize = $folder->get_used_size();
	$temp = $totalGB * (1024 * 1024 * 1024);
	$percentage = number_format(($folderSize * 100) / $temp, 2);
	if ($percentage >= 99) $result = false;
	return $result;
}
function available_storage($company_id)
{ 
	$result = true;
	$company_plans = Company::selectPlans($company_id);
	$totalGB = intval($company_plans['available_gb']) + intval($company_plans['available_gb_plan']);
	$percentage=0;
	$folder = new CompanyFolder($company_id);
	$folderSize = $folder->get_used_size();
	$temp = $totalGB * (1024 * 1024 * 1024);
	$percentage = number_format(($folderSize * 100) / $temp, 2);
	return $percentage;
}
function myCurrentPlan($company_id)
{ 
	$company_plans = Company::selectPlans($company_id);
	return $company_plans;
}