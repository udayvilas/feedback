<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 19/03/2018
 * Time: 10:38
 */
?>

<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
	
<div layout='row' layout-padding layout-align='center center'>
<div flex>
	<md-content class="row">
	   <h3 class="wizard-title" style="color: #0f487f;text-shadow: 2px 4px 3px rgba(0,0,0,0.3);margin-top:0px;text-align:center">DASHBOARD</h3>
		 <md-card-content>
			  <div layout="row" layout-align="space-between center">
				<span></span>
				<md-select ng-model="mydept" placeholder="-- Department List --" class="md-no-underline" style="margin:0px 20px">
				  <md-option value="All" selected >ALL</md-option>
				  <md-option value="{{gp.GROUP_ID}}" ng-repeat="gp in qgroup_list" >{{gp.GROUP_NAME}}</md-option>
				</md-select>
			  </div>
		 </md-card-content>
	 </md-content>
	 
	 <md-content class="row">
		
		 <div class="flex-parent col s12 m12 l12 card">
			<div class="input-flex-container">
				<div class="input" ng-repeat="uts in units_list" ng-if="uts.BRANCH_ID != 'All'" >
					<span data-year="{{uts.count}}" data-info="{{uts.BRANCH_CODE}}"></span>
				</div>
			</div>	
		</div>					
	 </md-content>	
	 
	 <md-content>
	 <div class="col s12 m3 l3">
		<div class="card col s12 m12 l12">
		<ul class="nav style-3 nav-style">
			<li class="{{(uts.active) ? 'active' : ''}}" ng-repeat="uts in units_list"  style="cursor:pointer" ng-click="change_unit($index)">
                <a>{{uts.BRANCH_NAME}} - ({{uts.BRANCH_CODE}})</a>
            </li>
		</ul>
		</div>
	 </div>
	 <div class="col s12 m9 l9">
		 <div class="card col s12 m12 l12" ng-init="gender_reg_chart()">
			<div class="card-content col s12 m5 l5">
				 <div class="card-stats col s12 m12 l12 md-whiteframe-6dp" style="margin-top:10px">
					<div class="card-header" data-background-color="blue">
						<h3 class="card-title">{{total_reg}}</h3>
					</div>
					<div class="card-content">
						<h3 class="category">Total Registration</h3>					
					</div>
					<div class="card-footer">
						<div class="stats">							
							<a href="#pablo">{{current_unit}}</a>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col s12 m12 l12 md-whiteframe-6dp"  style="margin-top:10px">		<div id="gender" style="height: 300px"></div>
				</div>				
			</div>
			<div class="card-content col s12 m7 l7">
				<div class="col s12 m12 l12 md-whiteframe-6dp"  style="margin-top:10px">
					<div id="passed" style="height: 430px"></div>		
				</div>
			</div>
		</div>		
	 </div>
	 </md-content>
	 
</div>
</div>



