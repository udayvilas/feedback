<?php
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 08/02/2018
 * Time: 12:46
 */

$empty = "";
$base_data = $this->security->xss_clean($this->input->raw_input_stream);


if(!is_null($base_data))
{
    $this->input->raw_input_stream = "";
    $headers = apache_request_headers();

    if(isset($_SERVER['HTTP_REFERER']) && isset($headers['Content-Type']))
    {
        $this->shref = $_SERVER['HTTP_REFERER'];
        $this->echs_content_type = $headers['Content-Type'];
        $this->true_href = $this->baseauth->checkHttpReferer($this->shref);
        if($this->true_href==true && $this->echs_content_type==$this->baseauth->appjson)
        {
            $this->_key_rest($base_data,$this->echs_content_type);
            exit;
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized");
            exit;
        }
    }
    else if(isset($headers['Authorization']) && isset($headers['Content-Type']))
    {

        $this->echs_content_type = $headers['Content-Type'];
        $this->echs_authorization = $headers['Authorization'];
        $ha_array = explode('=',$this->echs_authorization);

        $where = array("mytoken" => $ha_array[1],"tname" => $ha_array[0],"status" => ACTIVESTS);
        $true_auth = $this->baseauth->checkAuthorization($this->token->tbl_name,$where);
        if($this->echs_content_type==$this->baseauth->appjson && $true_auth==true)
        {
            $this->_key_rest($base_data,$this->echs_content_type);
            exit;
        }
        else
        {
            header("HTTP/1.1 401 Unauthorized");
            echo $empty;
            exit;
        }

    }
    else
    {
        header("HTTP/1.1 401 Unauthorized");
        echo $empty;
        exit;
    }
}
else
{
    header("HTTP/1.0 404 Not Found");
    echo $empty;
    exit;
}
