<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 26/03/2018
 * Time: 16:59
 */
?>

<md-dialog aria-label="Add Question">
<form ng-cloak name="addquest" method="POST">
	<md-toolbar>
		<div class="md-toolbar-tools">
			<h2>Add Question </h2>
			<span flex></span>
			<md-button class="md-icon-button" ng-click="cancel()">
				<i class="material-icons">cancel</i>
			</md-button>
		</div>
	</md-toolbar>

	<md-dialog-content>
		<div class="md-dialog-content row">
			<div class="col s12 112 m12 padding">
				<div class="col s4 m4 l5 padding">Select Depratment</div>
				<div class="col s8 m8 l7">
					<md-input-container class="col s10 m10 l10" md-no-float>
						<md-select ng-model="quest.group" ng-disabled="quest.q_id != ''" >
							<md-option ng-repeat="gp in qgroup_list" ng-value="gp.GROUP_ID" placeholder="Q-Group List" required >
								{{gp.GROUP_NAME}}
							</md-option>
						</md-select>
					</md-input-container>
				</div>
			</div>

			<div class="col s12 112 m12 padding">
				<div class="col s4 m4 l5 padding">Question Description</div>
				<div class="col s8 m8 l7">
					<md-input-container class="md-block">
						<label>Question Text Here</label>
						<textarea ng-model="quest.qst_desc" md-maxlength="150" rows="1" md-select-on-focus required ></textarea>
					</md-input-container>
				</div>
			</div>

			<br>
			<div class="col s12 112 m12 padding">
				<div class="col s4 m4 l5 padding">No. Of Options</div>
				<div class="col s8 m8 l7">
					<md-input-container class="md-block">
						<label>No. Of Options</label>
						<input type="number" ng-model="quest.optlength" min="{{quest.optlength}}" max="8" md-select-on-focus required >
					</md-input-container>
				</div>
			</div>

			<br>
			<div ng-repeat="n in [].constructor(quest.optlength) track by $index" >
			<div class="col s12 112 m12 padding"  >
				<div class="col s4 m4 l5 padding">Option {{$index+1}}</div>
				<div class="col s8 m8 l7">
					<md-input-container class="md-block">
						<label>Option</label>
						<textarea ng-model="quest.opt_arr[$index]" md-maxlength="150" rows="3" md-select-on-focus required ></textarea>
					</md-input-container>
				</div>
			</div>
			
			<br>
			</div>
			<div class="col s12 112 m12 padding">
				<div class="col s4 m4 l5 padding">Answer For Question</div>
				<div class="col s8 m8 l7">
					<md-input-container class="md-block" >
						<label>Answer For Question</label>
						<input type="number" ng-model="quest.answer" min="1" max="{{quest.optlength}}" md-select-on-focus required >
					</md-input-container>
				</div>
			</div>

		</div>
	</md-dialog-content>

	<md-dialog-actions layout="row">
		<md-button class="btn btn-danger" ng-click="answer('not useful')">
			Not Useful
		</md-button>            
		<md-button class="btn btn-success" ng-click="addQuest()" class="md-primary" ng-disabled="addquest.$invalid" >
			Useful
		</md-button>

	</md-dialog-actions>
</form>
</md-dialog>

