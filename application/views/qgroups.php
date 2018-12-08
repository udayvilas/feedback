<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 23/03/2018
 * Time: 14:22
 */
?>

<div layout='row' layout-padding layout-align='center center'>
    <div flex class="row">

        <md-content>
            <div class="panel">
                <h3 class="wizard-title" style="color: #0f487f;text-shadow: 2px 4px 3px rgba(0,0,0,0.3);margin-top:0px;text-align:center"> Departments
                    <div class="hide-gt-md hide-lg" style="text-align:right;margin-top:-30px">
                        <button data-parent="#accordion" class="btn btn-info collapsed1 btn-round btn-fab-mini"
                                type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1" ng-Click="reset('user')"> ADD </button>
                    </div>
                </h3>

                <div id="collapse1" class="div-collapse1 collapse" aria-expanded="false" style="height: 1px;text-align:center">
                    <div class="col x12 s12 m12 l4" style="margin-top:10px">
                        <div class="col x12 s12 m6 l12 pull-m3 push-m3 card card-pricing card-raised">
                           <form method="POST" name="qgroup" >
                            <div class="content">
                                <h5 style="color: #4bb04f;">{{add_edit}} Department</h5>
                                <div class="icon row">
                                    <md-input-container class="col s12 m12 l12 padding">
                                        <input type="text"  placeholder="Department Name" ng-model="group.name" required >
                                    </md-input-container>

                                    <md-switch ng-model="group.status" ng-change="onChange(group.status)" class="col s12 m12 l12" ng-true-value="'A'" ng-false-value="'I'">
                                        Status : {{((group.sts=='A')?'Active':'InActive')}}
                                    </md-switch>

                                </div>
                                <a class="btn btn-success btn-round" ng-Click="add_qgroup(group)" ng-disabled="qgroup.$invalid" >Submit</a>
                                <a class="btn btn-danger btn-round" ng-Click="reset('qgroup')">Cancel</a>
                            </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </md-content>


        <div class="col x12 s12 m12 l8 style-3" style="height:350px;overflow:auto;margin-top:10px">
            <ul class="timeline timeline-simple" style="">
                <li class="timeline-inverted" ng-repeat="item in qgroup_list" ng-show="qgroup_list.length > 0">
                    <div class="timeline-badge {{((($index + 1) % 2 == 0)?'success':'info')}}">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="timeline-panel">
                        <span class="label label-{{((($index + 1) % 2 == 0)?'success':'info')}}">{{item.GROUP_ID}}</span>
                        <span class="label label-{{((($index + 1) % 2 == 0)?'success':'info')}}">{{item.GROUP_NAME}}</span>
                        <span class="label label-{{((($index + 1) % 2 == 0)?'success':'info')}}">{{(item.STATUS == 'A')?'Active':'Inactive'}}</span>

						 <a class=""><i class="material-icons" style="float: right;margin-top: 4px;color: #FF5722;" ng-click="edit_qgroup(item);">delete</i></a>
						<a class="hide-xs hide-sm hide-md"><i class="material-icons" style="float: right;margin-top: 4px;" ng-click="edit_qgroup(item);">mode_edit</i></a>


                        <a data-parent="#accordion" class="collapsed hide-lg"
                           data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1" ng-click="edit_user(item);"><i class="material-icons" style="float: right;margin-top: 4px;cursor: pointer;">mode_edit</i>
                        </a>
                    </div>
                </li>
            </ul>
        </div>


    </div>
</div>

