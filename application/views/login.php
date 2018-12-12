<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 07/02/2018
 * Time: 14:23
 */
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login_style.css">

<div layout = 'row' layout-align='center center' class="content">
<div flex-xs = "90" flex-sm = '40' flex-md='35' flex-lg='60' flex-xl='40' hide-xs hide-sm hide-md>
	<img src="<?php echo base_url(); ?>assets/images/nurse_bg.jpg" class="img-responsive" style="height:570px">
</div>

<div flex-xs = "90" flex-sm = '60' flex-gt-sm = '30' flex-md='30' flex-xl='20' flex-lg='25' layout-align='center center' class="card card-bg content1">
	<div flex='90' flex-offset='5' layout-padding>
		<img src='<?php echo base_url(); ?>assets/images/da_care_logo.png' class="text-center center-block"  hide-xs hide-md hide-sm style="margin-bottom: 25px;">
		<div  class="md-whiteframe-24dp" style="background:#fff;border-radius: 15px;">
			<div class="card-header text-center"  data-background-color="blue" style="padding:18px;margin:-30px 25px 5px" hide-xs hide-md hide-sm>
				<h4 style="text-transform: uppercase">LOGIN</h4>
			</div>

			<div class="card-header text-center"  data-background-color="blue" hide-lg hide-xl style="margin-top: -50px;">
				<img src='<?php echo base_url(); ?>assets/images/da_care_logo.png' class="text-center center-block">
			</div>
			<p hide-lg class="category text-center" style="padding:20px 0px 0px;font-size: 16px;color: #795548;">Login</p>
            <form method="POST" name="loginForm" class="mylayout-padding" autocomplete="off" >

                <div class="card-content" style="padding: 5px 20px;">
                <md-input-container md-no-float class="input-group">
                    <span class="input-group-addon"><i class="material-icons">face</i></span>
                    <input placeholder = "USER ID"  required name="user_id" ng-model="auth.user_id" style="height:30px" >
                    <div ng-messages="loginForm.user_id.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>


            <md-input-container md-no-float class="input-group" >
                <span class="input-group-addon"> <i class="material-icons">lock_outline</i></span>
                <input type="password"  placeholder="Password" name="pswd" ng-model="auth.pswd" required style="height:30px">
                <div ng-messages="loginForm.pswd.$error">
                    <div ng-message="required">Required.</div>
                </div>
            </md-input-container>


                <md-input-container md-no-float class="input-group">
                    <span class="input-group-addon"><i class="material-icons">location_on</i></span>
                    <label></label>
                    <md-select ng-model="auth.qgroup" name="qgroup" required placeholder="-- Select Branch --" style="height:30px">
                        <md-option ng-repeat="gp in qgroup_list" value="{{gp.GROUP_ID}}" >{{gp.GROUP_NAME}}</md-option>
                    </md-select>
                    <div ng-messages="loginForm.qgroup.$error">
                        <div ng-message="required">Required.</div>
                    </div>
                </md-input-container>

                </div>
                <div class="footer text-center">
                    <button type="submit" data-background-color="blue" class="btn btn-round" style="padding:13px 25px;margin:10px" ng-click="logincheck()" ng-disabled="loginForm.$invalid"  >LOGIN</button>

                </div>

            </form>

            </div>
        </div>
        <p class="text-center" style="color:white;margin-top:20px"> © Powered by CARE IT </p>
    </div>
</div>

