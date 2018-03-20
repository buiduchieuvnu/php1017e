<?php
define('AREA','A');
require '../../../init.php';
require_once ('../sms_danhba.php');
$act = isset($_POST['act']) ? substr(trim($_POST['act']),0,10) : "";
switch ($act) {
    // Load table
    case 'add':
        $p_ho_ten = isset($_POST['ho_ten']) ? $_POST['ho_ten'] : "";
		$p_so_dien_thoai = isset($_POST['so_dien_thoai']) ? $_POST['so_dien_thoai'] : "";
		$p_email = isset($_POST['email']) ? $_POST['email'] : "";
		$p_diachi = isset($_POST['diachi']) ? $_POST['diachi'] : "";
		$p_id_nhom_danhba = isset($_POST['id_nhom_danhba']) ? $_POST['id_nhom_danhba'] : "0";
        $status="success";
        $message="success";
        $returndata = "success";
        $items = Sms_danhbaApp::addDanhBa($p_ho_ten, $p_so_dien_thoai, $p_email, $p_diachi, $p_id_nhom_danhba);
        
        echo json_encode(array('status' => $status, 'message' => $message, 'returndata' => $returndata));
        break;
    
	case 'import':
		$response['status'] = 'danger';
		if(isset($_FILES['file'])){
			if ($_FILES['file']['error'] == 0) {
				# Khong co loi
				$file = $_FILES['file'];
				if (checkXLSFile($file)){
					if ($file['type'] == 'application/vnd.ms-excel') {
						$file_ext = '.xls';
					} else {
						$file_ext = '.xlsx';
					}
					$file_name = time();
					move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$file_name.$file_ext);
					$response['status'] = 'success';
					$response['uploaded_file'] = $file_name.$file_ext;
					$import_data = readXLSFileContent('upload/'.$file_name.$file_ext);
					//print_r($import_data) ;
					for($i=0; $i < count($import_data); $i++){
						//print_r($import_data[$i]) ;
						Sms_danhbaApp::addDanhBa($import_data[$i]['ho_ten'],$import_data[$i]['so_dien_thoai'],$import_data[$i]['email'],$import_data[$i]['diachi'],'0');
					}

					$response['message'] = 'Import thanh cong!';
				} else {
					$response['message'] = 'Error: File không đúng định dạng. Chỉ sử dụng file Excel (.xsl hoặc .xlsx) để import danh sách!';
				}
			}
			else{
				$response['status'] = 'error';
				$response['message'] = 'Error: Có lỗi. Vui lòng tải lại trang và thử lại';
			}
		}
		else{
			$response['status'] = 'error';
			$response['message'] = 'Phải chọn file để Import!!!';
		}
		echo json_encode($response);
		break;
	
    default:
        break;
}



function checkXLSFile($file){
    // Check mime type
    $xlsfile = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if (in_array($file['type'], $xlsfile))
        return true;
    return false;
}

function readXLSFileContent($file){
    require(DIR_ROOT.DS.'libs/phpexcel/PHPExcel.php');
    $inputFileType = PHPExcel_IOFactory::identify($file);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($file);
    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();

    // Process data
    $returndata = array();
    $num = 0;
    for ($i=2; $i <= $highestRow ; $i++) {
        $ho_ten = $objWorksheet->getCell('A'. $i)->getValue();
        $so_dien_thoai = $objWorksheet->getCell('B'. $i)->getValue();
        $email = $objWorksheet->getCell('C'. $i)->getValue();
        $diachi = $objWorksheet->getCell('D'. $i)->getValue();
        
        $returndata[$num] = array('ho_ten'=>$ho_ten, 'so_dien_thoai'=>$so_dien_thoai, 'email'=>$email, 'diachi'=>$diachi);
        $num++;
    }
    return $returndata;
}

function uConvert($input){
	$maps = array(
		'À' => 'Az1', 'Á' => 'Az2', 'Ả' => 'Az3', 'Ã' => 'Az4', 'Ạ' => 'Az5',
		'Ă' => 'Azz0', 'Ằ' => 'Azz1', 'Ắ' => 'Azz2', 'Ẳ' => 'Azz3', 'Ẵ' => 'Azz4', 'Ặ' => 'Azz5',
		'Â' => 'Azzz0', 'Ầ' => 'Azzz1', 'Ấ' => 'Azzz2', 'Ẩ' => 'Azzz3', 'Ẫ' => 'Azzz4', 'Ậ' => 'Azzz5',
		'à' => 'az1', 'á' => 'az2', 'ả' => 'az3', 'ã' => 'az4', 'ạ' => 'az5',
		'ă' => 'az0', 'ằ' => 'az1', 'ắ' => 'az2', 'ẳ' => 'az3', 'ẵ' => 'az4', 'ặ' => 'az5',
		'â' => 'azz0', 'ầ' => 'azz1', 'ấ' => 'azz2', 'ẩ' => 'azz3', 'ẫ' => 'azz4', 'ậ' => 'azz5',
		'Đ' => 'Dz1',
		'đ' => 'dz1',
		'È' => 'Ez1', 'É' => 'Ez2', 'Ẻ' => 'Ez3', 'Ẽ' => 'Ez4', 'Ẹ' => 'Ez5',
		'Ê' => 'Ezz0', 'Ề' => 'Ezz1', 'Ế' => 'Ezz2', 'Ể' => 'Ezz3', 'Ễ' => 'Ezz4', 'Ệ' => 'Ezz5',
		'è' => 'ez1', 'é' => 'ez2', 'ẻ' => 'ez3', 'ẽ' => 'ez4', 'ẹ' => 'ez5',
		'ê' => 'ezz0', 'ề' => 'ezz1', 'ế' => 'ezz2', 'ể' => 'ezz3', 'ễ' => 'ezz4', 'ệ' => 'ezz5',
		'Ò' => 'Oz1', 'Ó' => 'Oz2', 'Ỏ' => 'Oz3', 'Õ' => 'Oz4', 'Ọ' => 'Oz5',
		'Ô' => 'Ozz0', 'Ồ' => 'Ozz1', 'Ố' => 'Ozz2', 'Ổ' => 'Ozz3', 'Ỗ' => 'Ozz4', 'Ộ' => 'Ozz5',
		'Ơ' => 'Ozzz0', 'Ờ' => 'Ozzz1', 'Ớ' => 'Ozzz2', 'Ở' => 'Ozzz1', 'Ỡ' => 'Ozzz4', 'Ợ' => 'Ozzz5',
		'ò' => 'oz1', 'ó' => 'oz2', 'ỏ' => 'oz3', 'õ' => 'oz4', 'ọ' => 'oz5',
		'ô' => 'ozz0', 'ồ' => 'ozz1', 'ố' => 'ozz2', 'ổ' => 'ozz3', 'ỗ' => 'ozz4', 'ộ' => 'ozz5',
		'ơ' => 'ozzz0', 'ờ' => 'ozzz1', 'ớ' => 'ozzz2', 'ở' => 'ozzz1', 'ỡ' => 'ozzz4', 'ợ' => 'ozzz5',
		'Ù' => 'Uz1', 'Ú' => 'Uz2', 'Ủ' => 'Uz3', 'Ũ' => 'Uz4', 'Ụ' => 'Uz5',
		'Ư' => 'Uzz0', 'Ừ' => 'Uzz1', 'Ứ' => 'Uzz2', 'Ử' => 'Uzz3', 'Ữ' => 'Uzz4', 'Ự' => 'Uzz5',
		'ù' => 'uz1', 'ú' => 'uz2', 'ủ' => 'uz3', 'ũ' => 'uz4', 'ụ' => 'uz5',
		'ư' => 'uzz0', 'ừ' => 'uzz1', 'ứ' => 'uzz2', 'ử' => 'uzz3', 'ữ' => 'uzz4', 'ự' => 'uzz5'
	);

	$keys = array_keys($maps);
	$vals = array_values($maps);
	$output = str_replace($keys, $vals, $input);
	return $output;
}
?>
