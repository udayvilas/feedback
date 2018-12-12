<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: venkat
 * Date: 07/02/2018
 * Time: 17:43
 */
?>

<div layout="column" flex>
    <nav class="navbar navbar-transparent navbar-absolute md-whiteframe-2dp">
        <div class="container-fluid">
            <div class="navbar-header" hide-xs>
                <img src="<?php echo base_url(); ?>assets/images/fav.png" style="padding-right:14px"><span style="font-size:1.3em;text-shadow: 2px 2px 2px #060a0f;">CARE::FEEDBACK</span>
            </div>

            <div class="navbar-header" hide-lg hide-md hide-sm hide-xl>
                <span style="font-size:1.3em">NURSE EXAM</span><br>
                <div style="font-size: 11px;color: #cccbcb;margin-top: -3px;">CARE Hospitals</div>
            </div>

            <span flex></span>

            <ul class="nav navbar-nav navbar-right">
                <li hide-xs>
                    <p style="font-size: 14px !important;text-transform: uppercase;margin-top:15px">Welcome : Uday </p>
                </li>
                <li>
                    <a class="dropdown-toggle" title="Home">
                        <i class="material-icons">home</i>
                    </a>
                </li>
                <li>
                    <a href="" ng-click="logout()" title="Logout">
                        <i class="material-icons">exit_to_app</i>
                    </a>
                </li>
                <li>
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
</div>

