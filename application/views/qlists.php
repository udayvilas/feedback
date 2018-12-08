<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 23/03/2018
 * Time: 15:34
 */
?>

<div layout='row' layout-padding layout-align='center center'>
    <div flex>

        <md-content>
            <div class="panel">
				<h3 class="wizard-title" style="color: #0f487f;text-shadow: 2px 4px 3px rgba(0,0,0,0.3);margin-top:0px;text-align:center"> List of Questions</h3>
                <div class="hide-gt-md hide-lg" style="text-align:right;margin-bottom: 10px;">

                    <button data-parent="#accordion" class="btn btn-info collapsed1 btn-round btn-fab-mini"
                            type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        Search
                    </button>
                </div>

                <div layout-align='center center' id="collapse1" class="div-collapse1 collapse" aria-expanded="false" style="height: 1px;text-align:center">
                    <div flex-xs='80' flex-sm='70' flex--gt-sm='100' class="card" layout-gt-xs="row">
                        <div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 77px;margin-bottom: 10px;margin-top: -10px;">
                            <!--<i class="fa fa-stethoscope" aria-hidden="true" style="font-size: 25px;"></i>-->Search
                        </div><div class="clearfix"></div>

                        <div class="card-content row">
                            <div class="col s12 m3 l3" style="border-right:1px dotted #777070">
                            <div class="col s12 m12 l12">
                                <md-input-container class="col s10 m10 l10" md-no-float>
                                    <md-select ng-model="group_code" >
                                        <md-option ng-repeat="gp in qgroup_list" ng-value="gp.GROUP_ID" ng-selected="gp.GROUP_ID == qgroup" placeholder="Q-Group List" >
                                            {{gp.GROUP_NAME}}
                                        </md-option>
                                    </md-select>
                                </md-input-container>

                                <md-input-container class="col s2 m2 l2">
                                    <button class="btn btn-cream btn-round btn-fab btn-fab-mini" ng-click="qgroup_data_list(group_code)"><i class="material-icons">search</i></button>
                                </md-input-container>
                            </div>
                            </div>
                            <div class="col s12 m9 l9">

                                <ul class="nav" >
                                    <li style="float: left" ng-repeat="item in quest_list">
                                        <a href="" ng-click="current_question($index)" style="padding: 0px 3px;"><label ng-class="((current_index == $index) ? 'label-box1' : 'label-box')"  >{{$index+1}} </label></a>
                                    </li>
                                </ul>
                            </div>
                                <!--
                                <md-input-container>
                                    <button class="btn btn-primary btn-round visible-lg" type="button" ng-click="export_reg_list()" ng-disabled="member_list.length == 0" > Export</button>
                                </md-input-container>
                                -->

                            </div>
                        </div>
                    </div>
                </div>
        </md-content>

        <md-content>
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 50px;margin-bottom: 10px;margin-top: -10px;">
                    <!--<i class="material-icons">assignment</i>--> List Of Questions
                </div>
                <div class="card-header card-header-icon" data-background-color="orange" style="float: right" ng-click="addQuestion($event)">
                  Add New
                </div>
                <div class="clearfix"></div>
                <div class="card-content">

                    <div class="card-content row" ng-if="current_quest.length != 0" >
                        <div class="col s11 m11 l11" style="margin-top: 20px;color: #9C27B0;">
                            <B>{{current_index + 1}}. {{current_quest.Q_DESC}}</B>
                        </div>

                        <div class="col s1 m1 l1" style="margin-top: 20px;">
                            <i class="material-icons green-text" ng-click="editQuestion(current_quest, $event)">mode_edit</i>
                            <i class="material-icons red-text" ng-click="showConfirm(current_quest, $event)">delete</i>
                        </div>

                        <div class="col s12 m12 l12">
                                <div class="col s12 m12 l12" style="margin-top: 5px;" ng-repeat="opt in current_quest.OPT_ARR" >
                                    {{($index + 1)}}. {{opt}}
                                </div>
                        </div>
                        <div class="col s12 m12 l12" style="margin-top: 20px;color: #9C27B0;">
                            <B>Answer: {{current_quest.ANS}}</B>
                        </div>
                    </div>
                    <div class="card-content row" ng-if="current_quest.length == 0">
                        <div class="col s12 m12 l12" style="margin-top: 20px;color: #9C27B0;">
                            <B>No Records</B>
                        </div>
                    </div>



                    <!------------------------------ pagination -------------------------------------->

                    <div layout='row'  layout-align='end center' style="height: 45px;" ng-if="current_quest.length != 0">
                        <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                            <ul class="pagination">
                                <li class="paginate_button first {{current_index == 0 ? 'disabled' : ''}}" id="datatables_first">
                                    <a href="" ng-click="current_question(0)" aria-controls="datatables" data-dt-idx="0" tabindex="0"><i class="material-icons">first_page</i></a>
                                </li>
                                <li class="paginate_button previous {{current_index == 0 ? 'disabled' : ''}}" id="datatables_previous">
                                    <a href="" ng-click="current_question((current_index != 0) ? (current_index - 1) : current_index)"  aria-controls="datatables" data-dt-idx="1" tabindex="0"><i class="material-icons">navigate_before</i></a>
                                </li>
                                <li class="paginate_button active">
                                    <a href="" aria-controls="datatables" data-dt-idx="2" tabindex="0">{{current_index + 1}}</a>
                                </li>
                                <li class="paginate_button next {{((quest_list.length - 1) == current_index) ? 'disabled' : ''}} " id="datatables_next">
                                    <a href="" ng-click="current_question(((quest_list.length -1) > current_index ) ? (current_index + 1) : (quest_list.length -1) )"  aria-controls="datatables" data-dt-idx="6" tabindex="0"><i class="material-icons">navigate_next</i></a>
                                </li>
                                <li class="paginate_button last {{((quest_list.length - 1) == current_index) ? 'disabled' : ''}} " id="datatables_last">
                                    <a href="" ng-click="current_question((quest_list.length - 1))" aria-controls="datatables" data-dt-idx="7" tabindex="0"><i class="material-icons">last_page</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>



            </div>
        </md-content>
    </div>
</div>


