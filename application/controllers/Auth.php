<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 08/02/2018
 * Time: 10:55
 */
class Auth extends CI_Controller
{
    public $shref = NULL;
    public $true_href = NULL;
    public $echs_content_type = NULL;
    public $echs_authorization = NULL;

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('users');
        $this->load->model('token');
        $this->load->model('branchs');
        $this->load->model('baseauth');
        $this->load->model('basemodel');
    }

    public function index()
    {
        include_once APPPATH.'libraries/REST_API/MainRest.php';
    }

    private function _key_rest($base_data='',$content_type='')
    {
        if(!is_null($base_data) && $content_type==$this->baseauth->appjson)
        {
            $data = array();
            $jodata = json_decode($base_data);
            $action = $jodata->action;

            if($action == 'Signup')
                $data = $this->_user_signup($jodata);
            else if($action == 'Login')
                $data = $this->_login_user_check($jodata);
            else if($action == 'validate_user')
                $data = $this->_validate_user($jodata);
            else if($action=="check_session_exists")
                $data = $this->check_session_exists();
            else if($action=="my_branch")
                $data = $this->my_branch();

            echo json_encode($data);
        }
    }


    public function _validate_user($input)
    {
        $data = array();
        $user_id = $input->userid;

        $res = $this->basemodel->num_of_res($this->users->tbl_name, array($this->users->USER_ID => $user_id));
        if($res == 0)
        {
            $data['response'] = SUCCESSDATA;
            $data['status'] = "Valid UserId";
        }
        else
        {
            $data['response'] = FAILEDDATA;
            $data['status'] = "UserId Already Exits";
        }
        return $data;
    }

    public function _user_signup($input)
    {
        $json = (object)array('userid'=> $input->email );
        $validate = $this->_validate_user($json);
        $data = array();

        if($validate['response'] == FAILEDDATA)
        {
            $data['response'] = FAILEDDATA;
            $data['status'] = "User Already Exists";
            return $data;
        }

        $insert = array();
        $insert['USER_ID'] = $input->email;
        $insert['USER_NAME'] = $input->uname;
        $insert['GENDER'] = $input->gender;
        $insert['QUALIFICATION'] = $input->qualify;
        $insert['EXPERIENCE'] = $input->exp;
        $insert['CREATED_BY'] = $input->email;
        $insert['CREATED_AT'] = date('H:i:s');
        $insert['CREATED_ON'] = date('Y-m-d');
        $insert['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
        $insert['BRANCH'] = $this->my_branch();

        $res = $this->basemodel->insert_into_table($this->users->tbl_name, $insert);
        if($res)
        {
            $data['response'] = SUCCESSDATA;
            $data['status'] = "Registraion Succuess";
        }
        else{
            $data['response'] = FAILEDDATA;
            $data['status'] = "Registraion Failed";
        }
        return $data;
    }

    public function my_branch()
    {
        $ip_add=$_SERVER['REMOTE_ADDR'];
        $fin_ip=substr($ip_add,6,2);

        $res = $this->basemodel->execute_qry("SELECT `UNIT_NAME`, `UNIT_ID` FROM `ipmaster` WHERE FIND_IN_SET('$fin_ip',`IP_SERIES`) ");
        if($res)
            return $res[0]['UNIT_ID'];
        else
            return '00';
    }


    public function _login_user_check($input)
    {
        $data = array();
        $res = $this->basemodel->fetch_single_row($this->users->tbl_name, array($this->users->USER_ID=>$input->user_id),array($this->users->IS_ADMIN,$this->users->USER_NAME, $this->users->BRANCH,  $this->users->EXAM_STATUS));

        if(empty($res))
        {
            $data['response'] = FAILEDDATA;
            $data['status'] = "Invalid UserId";
            return $data;
        }
        else
        {
            $is_admin = $res['IS_ADMIN'];
            $exam_stat = $res['EXAM_STATUS'];

            if($exam_stat == 'Y' && $is_admin != 'Y')
            {
                $data['response'] = FAILEDDATA;
                $data['status'] = "User already attended for exam";

                return $data;
            }

            $usersession['exam_uname'] = $res['USER_NAME'];
            $usersession['exam_uid'] = $input->user_id;
            $usersession['exam_qgroup'] = $input->qgroup;
            $usersession['exam_branch'] = $res['BRANCH'];
            $this->session->set_userdata($usersession);

            $data['response'] = SUCCESSDATA;
            $data['status'] = "Successful Login";
            $data['list'] = array("USER_NAME" => $res['USER_NAME'],
                "USER_ID" => $input->user_id,
                "IS_ADMIN" => $is_admin,
                "qgroup" => $input->qgroup,
                "UNIT_ID"=> $res['BRANCH']
            );

            return $data;
        }

    }


    public function _login_user_check2($input)
    {
        $user_id= $input->user_id;

        $corconc = odbc_connect("CORPDB","HIDDB","HIDDB");
        //$results = $this->erp_login($input);
        $results = 'Y';
		// return $results;

        if($results != 'Y')
        {
            $data['response'] = FAILEDDATA;
            $data['status'] = "Invalid UserID or Password";
            return $data;
        }

        $xx_query = "SELECT A.EMP_CODE,A.EMP_NAME,A.DESG_NAME,A.GENDER,B.UNITNAME, B.ORGN_CODE, B.UNITCODE, A.DEPT_NAME,A.MOBILE_PHONE,A.DATE_OF_BIRTH
 FROM EMPLOYEES A, UNITMASTER B WHERE A.UNIT_CODE = B.SHORTNAME(+) AND A.STATUS= 'A' AND A.EMP_CODE = '$user_id'";
        $eresult = odbc_exec($corconc,$xx_query);

        $is_admin = 'N';
        $exam_stat = 'N';
        $unit_code = '00';
        $insert = array();
        while($row = odbc_fetch_array($eresult))
        {
            $insert[$this->users->USER_ID] = $user_id;
            $insert[$this->users->USER_NAME] = $row['EMP_NAME'];
            $insert[$this->users->GENDER] = $row['GENDER'];
            $insert[$this->users->DEPT] = $row['DEPT_NAME'];
            $branch_code = (isset($row['ORGN_CODE']) && ($row['ORGN_CODE'] != null) ) ? trim($row['ORGN_CODE']) : '000';
            $unit_code = (isset($row['UNITCODE']) && ($row['UNITCODE'] != null) ) ? trim($row['UNITCODE']) : '00';
            $insert[$this->users->BRANCH] = $unit_code;

            $branch_val = $this->basemodel->num_of_res($this->branchs->tbl_name,array($this->branchs->BRANCH_CODE => $branch_code ));
            if($branch_val == 0)
            {
                // new branch insertion based on user
                $unit_name = (isset($row['UNITNAME']) && ($row['UNITNAME'] != null) ) ? trim($row['UNITNAME']) : '';


                $branch_code = ($branch_code == '') ? '000' : $branch_code;
                $unit_name = ($unit_name == '') ? '000' : $unit_name;
                $unit_code = ($unit_code == '') ? '00' : $unit_code;

                $binsert[$this->branchs->BRANCH_ID] = $unit_code;
                $binsert[$this->branchs->BRANCH_NAME] = $unit_name;
                $binsert[$this->branchs->BRANCH_CODE] = $branch_code;

                $this->basemodel->insert_into_table($this->branchs->tbl_name, $binsert);
            }


            $res = $this->basemodel->fetch_single_row($this->users->tbl_name, array($this->users->USER_ID=>$user_id),array($this->users->IS_ADMIN, $this->users->EXAM_STATUS));
            if(empty($res))
            {
                $insert[$this->users->CREATED_BY] = $user_id;
                $insert[$this->users->CREATED_ON] = date('Y-m-d');
                $insert[$this->users->CREATED_AT] = date('H:i:s');

                $this->basemodel->insert_into_table($this->users->tbl_name, $insert);
            }
            else
            {
                $is_admin = $res['IS_ADMIN'];
                $exam_stat = $res['EXAM_STATUS'];
            }

        }

        if($exam_stat == 'Y' && $is_admin != 'Y')
        {
            $data['response'] = FAILEDDATA;
            $data['status'] = "User already attended for exam";

            return $data;
        }

        $usersession['exam_uname'] = $insert[$this->users->USER_NAME];
        $usersession['exam_uid'] = $user_id;
        $usersession['exam_qgroup'] = $input->qgroup;
        $usersession['exam_branch'] = $unit_code;
        $this->session->set_userdata($usersession);

         $data['response'] = SUCCESSDATA;
         $data['status'] = "Successful Login";
         $data['list'] = array("USER_NAME" => $insert[$this->users->USER_NAME],
                            "USER_ID" => $insert[$this->users->USER_ID] ,
                            "IS_ADMIN" => $is_admin,
                            "UNIT_NAME" => $insert[$this->users->BRANCH],
                            "qgroup" => $input->qgroup,
                            "UNIT_ID"=> $unit_code
                        );

         return $data;
    }

    private function erp_login($input)
    {
        $user_id = trim($input->user_id);
        $pswd= trim($input->pswd);

        $corconc = odbc_connect("CORPDB","HIDDB","HIDDB");

        $au_qury = "SELECT * FROM APPSLOGIN where ID='I'";
        $result12 = odbc_exec($corconc,$au_qury);
        //echo $result12;
        while(odbc_fetch_row($result12)){
            $key = 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282';
            $uname12 = odbc_result($result12, 'USERNAME');
            $uname1 = $this->mc_decrypt($uname12,$key);
            $password12 = odbc_result($result12, 'PASSWORD');
            $password1 = $this->mc_decrypt($password12,$key);
        }

        $central = odbc_connect("PROD","$uname1","$password1");
        $centqry = "select APPS.fnd_web_sec.validate_login('".$user_id."','".$pswd."') as result from dual";
        $excene=odbc_exec($central,$centqry) or die("not exec");
        odbc_fetch_row($excene);
        $result = odbc_result($excene, 'result');
        $results = trim($result);

        return $results;
    }

    private function mc_encrypt($encrypt, $key){
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
        return $encoded;
    }
// Decrypt Function
    private function mc_decrypt($decrypt, $key){
        $decrypt = explode('|', $decrypt.'|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if($calcmac!==$mac){ return false; }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }


    public function logout()
    {
        $user_session_ary = array('exam_uname','exam_uid');
        $this->session->unset_userdata($user_session_ary);
        redirect(base_url(),'refresh');
    }

    public function check_session_exists()
    {
        $data = array();
        if(isset($this->session->exam_uid))
        {
            $data['response'] = SUCCESSDATA;
            $data['status'] = "Session Exists";
        }
        else
        {
            $data['response'] = FAILEDDATA;
            $data['status'] = "Session Failed";
        }
        return $data;
    }


}