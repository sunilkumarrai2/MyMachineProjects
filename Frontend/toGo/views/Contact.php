<div class="row">
    <div class="col-lg-1">

    </div>

    <div class="col-lg-4">
                <img src="images/IMG_5453.JPG" class="img-responsive" />
                <!--<img src="http://placehold.it/400x400" />-->
    </div>

    <div class="col-lg-1">

    </div>

    <div  class="col-lg-6">
<!--
                <h4>My contact info</h4>
                <p><a href="mailto:harshitasinghal@gmail.com">harshitasinghal.mua@gmail.com</a>
                </p>
                <p><a>503-453-3489</a></p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://www.facebook.com/makeupbyharshita/" class="btn btn-default btn-lg"><i class="fa fa-facebook-square"></i> <span class="network-name">Facebook</span></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/harshitasinghal/" class="btn btn-default btn-lg"><i class="fa fa-instagram"></i> <span class="network-name">Instagram</span></a>
                    </li>
                    
                    <li>
                        <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                    
                </ul>
-->
<!--        <h1 class="page-header text-center"></h1>-->
				<form class="form-horizontal" name="myForm" novalidate>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="user" ng-model="name" placeholder="First & Last Name" ng-blur="showHi= false" ng-focus="showHi= true" ng-init="showHi= true"  required>
<!--
                            <span style="color:red" ng-show="myForm.user.$dirty && myForm.user.$invalid">
                                    <span ng-show="myForm.user.$error.required">Username is required.</span>
                            </span>
-->
                            <span style="color:green" ng-hide="myForm.user.$dirty && myForm.user.$invalid">
                                <span ng-hide="showHi">hi <b>{{name}}</b>, how was your day today?</span>
                            </span>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" name="email" placeholder="example@domain.com" ng-model="email" required>
                            <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
                                    <span ng-show="myForm.email.$error.required">Email is required.</span>
                                    <span ng-show="myForm.email.$error.email">Invalid email address.</span>
                            </span>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="Message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
                            <textarea  class="form-control" rows="4" name="message" ng-model="message" placeholder="Your message" required> </textarea>
						</div>
					</div>
                    
					
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
                            <input type="submit" ng-disabled="(myForm.email.$error.required) || ( myForm.email.$dirty && myForm.email.$invalid)" class="btn btn-primary" ng-click="sendEmail()" value="send">							
						</div>
					</div>
                    <h1 class="page-header text-center"></h1>
					<div class="form-group">
						<div ng-show="showEmailStatus" class="col-sm-10 col-sm-offset-2 {{emailSentStatusDiv}}">
							<span>{{emailStatus}}</span>
						</div>    
					</div>
				</form>

    </div>
 
</div>
