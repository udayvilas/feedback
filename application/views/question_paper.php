<?php
/**
 * Created by PhpStorm.
 * User: HID
 * Date: 14/03/2018
 * Time: 3:45 PM
 */
?>

<div layout='row' layout-padding layout-align='center center'>
<div flex>

<div class="card" >
	<h3 style="margin:0px;color: #9C27B0;text-shadow: 0px 3px 3px rgba(0,0,0,0.3);text-align: center;margin-top: 5px;font-size: 25px;"><center>CARE HOSPITALS GROUP</center></h3>
	<h4><center>{{group_name}}</center></h4>

	<div style="font-size:30px;float:right;margin-top:-60px;background: linear-gradient(60deg, #e91e63, #e91e63);
    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(233, 30, 99, 0.4);
    border-radius: 3px;color: #fff;
    padding: 15px;margin-right: 10px;">
		{{stop_watch | timer }}
	</div>


<md-content ng-if="exam_stat != 'C'">
	<div class="">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin:0px"ew>
			<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="headingOne" style="border:0px !important;padding:0px !important">
				<a>
					<!--<div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 50px;margin-top: -15px;">
						Exam Instructions
					 </div>-->
					 <!--<div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 50px;margin-top: -15px;float:right;font-size: 30px;">
						{{stop_watch | timer }}
					 </div>-->
				</a>
			  </div><div class="clearfix"></div>

			  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
				 <div class="panel-body">
					<div class="card-content row">
						<div class="col s12 m12 l12">
							<p><strong>NOTE: Total marks: 25</strong> <strong><em> Max time: 30mins</em></strong></p>
							<ul style="font-style: italic;font-weight: 600;">
                                <li>Answer all questions</li>
                                <li>Each question carries 1 mark</li>
                                <li>Candidates found copying or consulting others will be disqualified.</li>
                                <li>Don&rsquo;t close or reload the browser after starting of exam.</li>
                                <li>Click Start button to start Exam at the bottom of the Instructions.</li>
                                <li>Question numbers available on left sidebar, gives the navigation for questions, click on those buttons to navigate questions.</li>
                                <li>After going to the last question you will get submit button to <strong>submit</strong> the exam.</li>
                                <li>Exam will automatically close at the end of 30 min.</li>
                                <li>After answering all the questions please click on submit button to complete your exam.</li>
                            </ul>
						</div>
					 </div>
				   </div>
				</div>
				
				<div class="panel-heading" role="tab" id="headingOne" style="border:0px !important;padding:0px !important">
					<a role="button" data-toggle="collapse" data-parent="#accordion" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<h4 class="panel-title" style="text-align:center;font-size:16px" ng-click="(exam_stat == '') ? start_exam() : ''" > <label ng-if="exam_stat == ''" >
                                <button class="btn btn-primary"><i class="material-icons" style="float:none">keyboard_tab</i> Start Exam</button></label>
							<div class="panel-title1 drop-arrow" ng-if="exam_stat != ''">
								<i class="material-icons" style="float: none;">keyboard_arrow_down</i>
							</div>
						 </h4>
					   </a>
				</div>
			 </div>
          </div>
	</div>
</md-content>
</div>

<md-content ng-if="exam_stat == 'S' || exam_stat == 'P'" style="margin-top:15px;">
	<div class="card">
		<div class="card-header card-header-icon" data-background-color="rose" style="padding: 10px 50px;margin-bottom: -10px;margin-top: -10px;">
			List Of Questions
		</div><div class="clearfix"></div>
		<div class="card-content row">
			<div >
				<div class="col s12 m12 l12" style="margin-top: 20px;color: #9C27B0;">
					<B>{{current_index + 1}}. {{current_quest.Q_DESC}}</B>
				</div>
				<div class="col s12 m12 l12">
				   <md-radio-group ng-model="exam_data[current_quest.Q_ID]" ng-disabled="exam_stat == 'P'">
					  <div class="col s12 m12 l12" style="margin-top: 5px;" ng-repeat="opt in current_quest.OPT_ARR" >
						  <md-radio-button ng-value="{{($index + 1)}}"> {{opt}} </md-radio-button>
					  </div>
				   </md-radio-group>
				</div>
			</div>
		</div>



        <div layout='row'  layout-align='center' style="height: 45px;">
            <div class="dataTables_paginate paging_full_numbers" id="datatables_paginate">
                <ul class="pagination">
                    <li class="paginate_button first {{current_index == 0 ? 'disabled' : ''}}" id="datatables_first">
                        <a href=""  ng-click="current_question(0)" aria-controls="datatables" data-dt-idx="0" tabindex="0"><i class="material-icons">first_page</i></a>
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
        <br>

        <div class="col s12 m12 l12 text-center" style="margin-bottom:10px" ng-if="current_index == (quest_list.length - 1)">
            <button class="btn btn-success" ng-click="submit_exam('Y')" ng-disabled="(exam_data | objLength) == 0" >Submit</button>
        </div>


    </div>
</md-content>



<md-content ng-if="exam_stat == 'C'">
<div class="row" style="margin-top:15px">
   <div class="card col s12 m8 l6 offset-l3 offset-m2">
	<div class="card-content">
		<h3 style="text-align: center;color: #ef0b57;">Thanks for Your Participation</h3>
		<div class="col s6 m6 l6">
			<img src="./assets/images/green-tick-with-man.png" class="img-responsive">
		</div>
		<div class="col s6 m6 l6 center-align">
			<h3 style="text-align: center;margin:40px 0px 0px">Your Score </h3>
			<h2 style="margin-top: 0px;color: #62c226;"><b>{{results.currect_ans}}</b></h2>
		</div><div class="clearfix"></div>

		<div class="col s10 m6 l6" style="font-size:16px;color: #795548;">
			<p>Total No. Of Questions</p>
			<p>Correct Answers</p>
			<p>Wrong Answers</p>
			<p>Questions Attempted</p>
			<p>Questions Not Attempted </p>
            <p>Percentage</p>
		</div>
		<div class="col s1 m6 l6 center-align" style="font-size:16px;    color: #795548;">
			<p>{{quest_list.length}}</p>
			<p>{{results.currect_ans}}</p>
			<p>{{results.wrong_ans}}</p>			
			<p>{{exam_data | objLength}}</p>
			<p>{{quest_list.length - (exam_data | objLength)}}</p>			
            <p>{{results.percent}} %</p>
		</div>
	 </div>
	</div>
</div>
</md-content>

</div>
</div>