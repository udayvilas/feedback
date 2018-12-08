<div layout='row' layout-padding layout-align='center center'>
    <div flex>
        <div class="col-sm-8 col-sm-offset-2">
            <div class="wizard-container">
                <div class="card wizard-card active" data-color="rose" id="wizardProfile">
                    <div class="wizard-header">
                        <h3 class="wizard-title" style="color: #00BCD4;font-weight: 300;">Change Password </h3>
                    </div>
                    <div class="wizard-navigation">
                        <ul class="nav nav-pills">
                            <li class="active" style="width: 33.3333%;">
                                <a href="#about" data-toggle="tab" aria-expanded="true">Change Password</a>
                            </li>
                        </ul>
                        <div class="moving-tab" style="width: 203.328px; transform: translate3d(-8px, 0px, 0px); transition: all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1);">Change Password</div></div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="about">
                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-1">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="../Diacare/assets/images/default-avatar.png" class="picture-src" id="wizardPicturePreview">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">lock_open</i></span>
                                        <md-input-container md-no-float style="width:100%">
                                            <input type="text" placeholder="Enter Old Password" ng-model="chgpwd.oldpwd">
                                        </md-input-container>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="material-icons">lock_open</i></span>
                                        <md-input-container md-no-float style="width:100%">
                                            <input type="text" placeholder="Enter New Password" ng-model="chgpwd.newpwd">
                                        </md-input-container>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"> <i class="material-icons">lock_open</i></span>
                                        <md-input-container md-no-float style="width:100%">
                                            <input type="text" placeholder="Confirm Password" ng-model="chgpwd.conpwd">
                                        </md-input-container>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
							<a class="btn btn-success btn-round" ng-Click="change_pwd(chgpwd)">Submit</a>
                            <a class="btn btn-danger btn-round" ui-sref="home">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
