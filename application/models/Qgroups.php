<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 23/03/2018
 * Time: 14:37
 */
class Qgroups extends CI_Model
{
    public $tbl_name    = "qgroups";
    public $GROUP_ID   	= "GROUP_ID";
    public $GROUP_NAME  = "GROUP_NAME";
    public $CREATED_BY  = "CREATED_BY";
    public $CREATED_ON  = "CREATED_ON";
    public $CREATED_AT  = "CREATED_AT";
    public $EDITED_BY  = "EDITED_BY";
    public $EDITED_ON  = "EDITED_ON";
    public $EDITED_AT  = "EDITED_AT";
    public $STATUS      = "STATUS";
}