<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 07/02/2018
 * Time: 17:40
 */
?>
<div class="wrapper row">

    <div ui-view="header"></div>
    <div ui-view="sidebar"></div>

    <div class="main-panel" id="top" style="padding-top:45px !important">

        <div class="page page-contact" ui-view="main-content"></div>

    </div>

    <div ui-view='footer'></div>
</div>
