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
            <div class="info"><a>{{user_name}}</a></div>
        </div>

        <ul class="nav nav-mobile-menu style-3" style="height:100%;overflow:auto;margin:0px" ng-if="user_role == 'N'" >
            <li>
                <a style="padding: 10px;background: #ef0a58;margin: 6px;font-size: 16px;"> Question Navigator </a>
            </li>
            <li style="float: left" ng-repeat="item in quest_list">
                <a href="" ng-click="current_question($index)"><label ng-class="((exam_data[item.Q_ID] == undefined) ? 'label-box' : 'label-box1')"  >{{$index+1}} </label></a>
            </li>
            <!--<li style="float: left"><a><label class="label-box1">2</label></a></li>
            <li style="float: left"><a><label class="label-box2">3</label></a></li>-->
            <div class="clearfix"></div>
            <li>
                <a style="padding: 10px;background: #ef0a58;margin: 6px;font-size: 16px;"> Summary </a>
            </li>
            <li><a style="font-size: 19px;color: #FFC107;">Total Questions = {{quest_list.length}}</a></li>
            <li><a style="font-size: 18px;color: #b2f961;">Answered Questions = {{exam_data | objLength}}</a></li>
            <li><a style="font-size: 17px;color: #ff7b51;">Pending Questions = {{quest_list.length - (exam_data | objLength)}}</a></li>

        </ul>
        <ul class="nav nav-mobile-menu style-3" style="height:100%;overflow:auto;margin:0px" ng-if="user_role == 'Y'" >
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