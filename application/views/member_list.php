<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: uday
 * Date: 19/03/2018
 * Time: 10:38
 */
?>

<div layout='row' layout-padding layout-align='center center'>
    <div flex>

        <md-content style="margin-top:10px">
            <div class="panel">
				<h3 class="wizard-title" style="color: #9C27B0;text-shadow: 2px 4px 3px rgba(0,0,0,0.3);margin-top:0px"></h3>


                <div class="hide-gt-md hide-lg" style="text-align:right;margin-bottom: 10px;">
                    <!--<button type="button" class="btn btn-primary navbar-toggle" data-toggle="collapse" style="padding:10px;" hide-xs hide-sm hide-md hide-lg>
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>-->

                    <button data-parent="#accordion" class="btn btn-info collapsed1 btn-round btn-fab-mini"
                            type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                        Search
                    </button>
					<button class="btn btn-primary btn-round" type="button" ng-click="export_reg_list()" ng-disabled="member_list.length == 0" > Export</button>
                </div>

                <div layout-align='center center' id="collapse1" class="div-collapse1 collapse" aria-expanded="false" style="height: 1px;text-align:center">
                    <div flex-xs='80' flex-sm='70' flex--gt-sm='100' class="card" layout-gt-xs="row">
                        <div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 77px;margin-bottom: 10px;margin-top: -10px;">
                            <!--<i class="fa fa-stethoscope" aria-hidden="true" style="font-size: 25px;"></i>-->Search
                        </div><div class="clearfix"></div>

                        <div class="card-content">
                            <div layout-gt-sm="row">
                                <md-input-container>
                                    <label>From Date</label>
                                    <md-datepicker ng-model="home_src.fromdt"></md-datepicker>
                                </md-input-container>

                                <md-input-container>
                                    <label>To Date</label>
                                    <md-datepicker ng-model="home_src.todt"></md-datepicker>
                                </md-input-container>

                                <md-input-container>
                                    <label>Department List</label>
                                    <md-select ng-model="home_src.qgroup" >
                                        <md-option ng-repeat="gp in qgroup_list" ng-value="gp.GROUP_ID" ng-selected="gp.GROUP_ID == qgroup" >
                                            {{gp.GROUP_NAME}}
                                        </md-option>
                                    </md-select>
                                </md-input-container>

                                <md-input-container>
                                    <label>Branch List</label>
                                    <md-select ng-model="home_src.branch" >
                                        <md-option ng-repeat="uts in units_list" ng-value="uts.BRANCH_ID" ng-selected="uts.BRANCH_ID == 'All'" >
                                            {{uts.BRANCH_NAME}}
                                        </md-option>
                                    </md-select>
                                </md-input-container>

                                <md-input-container>
                                    <button class="btn btn-cream btn-round btn-fab btn-fab-mini" ng-click="exam_reg_list()"><i class="material-icons">search</i></button>
                                </md-input-container>

                                <md-input-container>
                                    <button class="btn btn-primary btn-round visible-lg" type="button" ng-click="export_reg_list()" ng-disabled="member_list.length == 0" > Export</button>
                                </md-input-container>

                            </div>
                        </div>
                    </div>
                </div>
        </md-content>

        <md-content style="margin-top:10px">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 50px;margin-bottom: 10px;margin-top: -10px;">
                    <!--<i class="material-icons">assignment</i>--> List Of Candidates
                </div><div class="clearfix"></div>
                <div class="card-content">
                    <div class="table-responsive-vertical">
                        <table id="table" class="table table-hover table-mc-light-blue">
                            <thead class="text-primary">
                            <tr>
                                <th>SNO.</th>
                                <th>Employee ID.</th>
                                <th>Employee Name</th>
                                <th>Gender</th>
                                <th>Marks</th>
                                <th>Percentage</th>
                                <th>Exam Date</th>
                            </tr>
                            </thead>
                            <tbody   >
                            <tr ng-repeat="itm in page_items" ng-if="page_items.length > 0" ng-init="myindex = ((paging.current - 1) * paging.limit)"  >
                                <td data-title="SNO.">{{ $index + myindex + 1 }}</td>
                                <td data-title="Employee ID.">{{ itm.USER_ID }}</td>
                                <td data-title="Employee Name">{{ itm.USER_NAME }}</td>
                                <td data-title="Gender">{{(itm.GENDER == 'F') ? 'Female' : 'Male'}}</td>
                                <td data-title="Marks">{{itm.MARKS}}</td>
                                <td data-title="Percentage">{{itm.PERCENT}}%</td>
                                <td data-title="Reg. Date">{{itm.CREATED_ON}}</td>
                            </tr>
                            <tr ng-if="page_items.length == 0" >
                                <td colspan="8">No Records Found</td>
                            </tr>


                            </tbody>
                        </table>
                    </div>


                    <!------------------------------ pagination -------------------------------------->

                    <div flex layout="row" class="marginb-10">
                        <div flex-xs="100" flex="20" layout-align="start start" flex layout="column">
                            <md-button class="md-icon-button md-primary md-raised" aria-label="Total">
                                <md-tooltip md-direction="top">Total Records</md-tooltip>
                                {{no_of_recs}}
                            </md-button>
                        </div>
                        <div flex="20" hide-xs hide-sm><!-- Space --></div>
                        <div flex-xs="100" flex="60" layout="column" layout-align="end end">
                            <!--<cl-paging flex cl-pages="paging.total" , cl-steps="5" , cl-page-changed="getDepartDevices(paging.current)"
                                       cl-align="end end" , cl-current-page="paging.current"></cl-paging>-->
                            <cl-paging flex cl-pages="paging.total" cl-steps="paging.limit" cl-page-changed="my_pages()"
                                       cl-align="start start" cl-current-page="paging.current"></cl-paging>
                        </div>
                    </div>

                <!--

                    <div layout='row'  layout-align='end center' style="height: 45px;">
                        <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                            <ul class="pagination">
                                <li class="paginate_button first disabled"  id="datatables_first">
                                    <a aria-controls="datatables" data-dt-idx="0" tabindex="0"><i class="material-icons">first_page</i></a>
                                </li>
                                <li class="paginate_button previous disabled" id="datatables_previous">
                                    <a href="" aria-controls="datatables" data-dt-idx="1" tabindex="0"><i class="material-icons">navigate_before</i></a>
                                </li>
                                <li class="paginate_button active">
                                    <a href="" aria-controls="datatables" data-dt-idx="2" tabindex="0">1</a>
                                </li>
                                <li class="paginate_button">
                                    <a href="" aria-controls="datatables" data-dt-idx="2" tabindex="0">2</a>
                                </li>
                                <li class="paginate_button next" id="datatables_next">
                                    <a href="" aria-controls="datatables" data-dt-idx="6" tabindex="0"><i class="material-icons">navigate_next</i></a>
                                </li>
                                <li class="paginate_button last" id="datatables_last">
                                    <a href="" aria-controls="datatables" data-dt-idx="7" tabindex="0"><i class="material-icons">last_page</i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
-->

                </div>



            </div>
        </md-content>
    </div>
</div>


