<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 07/02/2018
 * Time: 17:45
 */
?>

<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="<?php echo base_url(); ?>assets/images/sidebar1.jpg">
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo"><img src="<?php echo base_url(); ?>assets/images/person-flat.png"></div>
            <div class="info"><a>Uday</a></div>
        </div>


        <ul class="nav nav-mobile-menu style-3" style="height:100%;overflow:auto;margin:0px"  >
            <!--
            <li>
                <a ng-class="{active1:isActive('/collection')}" style="padding: 10px;margin:13px;" ui-sref="collection" >
                    <span class="sidebar-mini"> DS </span>
                    <span class="sidebar-normal"> Daily Stats </span>
                </a>
            </li>
            <li>
                <a ng-class="{active1:isActive('/collection/fbvoice')}" style="padding: 10px;margin:13px;" ui-sref="fbvoice" >
                    <span class="sidebar-mini"> VF </span>
                    <span class="sidebar-normal"> Voice Feedback </span>
                </a>
            </li>

            <li>
                <a ng-class="{active1:isActive('/collection/fbvoice')}"
                   style="padding: 10px;margin:13px;" ui-sref="fbvoice" style="padding: 10px;margin:13px;"><i class="material-icons">dashboard</i> Voice Feedback 2 </a>
            </li>

            -->
            <li>
                <a ng-class="{active1:isActive('/collection/fbvoice')}" style="padding: 10px;margin:13px;" ui-sref="fbvoice" style="padding: 10px;margin:13px;"> <i class="material-icons">dashboard</i> Feed one </a>
            </li>

            <li>
                <a ng-class="{active1:isActive('/results/dashboard')}" style="padding: 10px;margin:13px;" ui-sref="dashboard" style="padding: 10px;margin:13px;"> <i class="material-icons">dashboard</i> Dashboard </a>
            </li>
			<li>
                <a ng-class="{active1:isActive('/results')}" style="padding: 10px;margin:13px;" ui-sref="results" >
					<span class="sidebar-mini"> RP </span>
					<span class="sidebar-normal"> Reports </span>  
				</a>
            </li>
            <li>
                <a ng-class="{active1:isActive('/results/qgroups')}" style="padding: 10px;margin: 13px;" ui-sref="qgroups" > 
					<span class="sidebar-mini"> DP </span>
					<span class="sidebar-normal"> Departments </span>  
				</a>
            </li>
            <li>
                <a ng-class="{active1:isActive('/results/qlists')}" style="padding: 10px;margin: 13px;" ui-sref="qlists" >
					<span class="sidebar-mini"> LQ </span>
					<span class="sidebar-normal"> List of Questions</span>  
				</a>
            </li>
        </ul>
    </div>
    <div class="sidebar-background" style="background-image: url(<?php echo base_url(); ?>assets/images/sidebar1.jpg)"></div>
</div>

<style>
.active1{
	background:#e91e63;
}
</style>