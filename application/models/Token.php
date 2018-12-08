<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 08/02/2018
 * Time: 12:33
 */
class Token extends CI_Model
{
    public $tbl_name    = 'tknauth';
    public $TID         = 'TID';
    public $TNAME       = 'TNAME';
    public $TSTATUS     = 'TSTATUS';
    public $MA_TKN      = 'MA_TKN';
}