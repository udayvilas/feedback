<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 17/03/2018
 * Time: 11:21
 */
class Results extends CI_Model
{
    public $tbl_name    = "results";
    public $USER_ID   	= "USER_ID";
    public $Q_GROUP     = "Q_GROUP";
    public $Q_ID        = "Q_ID";
    public $Q_TYPE      = "Q_TYPE";
    public $ANS         = "ANS";
    public $STATUS      = "STATUS";
}
