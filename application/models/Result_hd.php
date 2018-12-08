<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 17/03/2018
 * Time: 11:15
 */
class Result_hd extends CI_Model
{
    public $tbl_name    = "result_hd";
    public $USER_ID   	= "USER_ID";
    public $BRANCH   	= "BRANCH";
    public $USER_NAME   = "USER_NAME";
    public $Q_GROUP     = "Q_GROUP";
    public $TOTAL_QUEST = "TOTAL_QUEST";
    public $ANS_QUS     = "ANS_QUS";
    public $LEFT_QUS    = "LEFT_QUS";
    public $CUR_ANS     = "CUR_ANS";
    public $WRG_ANS     = "WRG_ANS";
    public $MARKS       = "MARKS";
    public $PERCENT     = "PERCENT";
    public $CREATED_ON  = "CREATED_ON";
    public $CREATED_AT  = "CREATED_AT";
    public $STATUS      = "STATUS";
}
