<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 08/02/2018
 * Time: 12:36
 */
class Users extends CI_Model
{
    public $tbl_name    = "users";
    public $sno         = 'SNO';
    public $USER_ID   	= "USER_ID";
    public $USER_NAME   = "USER_NAME";
    public $GENDER      = "GENDER";
    public $DEPT   	    = "DEPT";
    public $BRANCH      = "BRANCH";
    public $EXAM_STATUS = "EXAM_STATUS";
    public $QUALIFICATION = "QUALIFICATION";
    public $EXPERIENCE  = "EXPERIENCE";
    public $IS_ADMIN    = "IS_ADMIN";
    public $REMOTE_ADDR = "REMOTE_ADDR";
    public $CREATED_BY  = "CREATED_BY";
    public $CREATED_ON  = "CREATED_ON";
    public $CREATED_AT  = "CREATED_AT";
    public $EDITED_BY   = "EDITED_BY";
    public $EDITED_ON   = "EDITED_ON";
    public $EDITED_AT   = "EDITED_AT";
    public $STATUS      = "STATUS";
}

