<div class="subNav line-height">
		<span class="brand-logo" style="text-transform: none !important; margin: 0px;" id='editAccountInfo'></span>
		</div>
<main>
<!-- 	<div class="container" style="">
		<div id= class="subNav line-height" style="">		
			<span class="brand-logo" style="text-transform: none !important;">Settings</span>
		</div> -->
		<div class="container-div" style="margin-top: 2em;">
			<div class="row">
				<div class="col s12 m10 l10 offset-l1 offset-m1">
					<div class="card settings-page">
						<div class="card-content" style="width: 95%">
							<div class="section" style="width: 90%; margin: auto;">
								<h4 style="margin-left: -2.5%">CHANGE DETAILS</h4>
								<?php include BASEPATH.'views/change_account_settings.php';?>
							</div>
							<!-- <div class="divider"></div> -->
							<div class="section" style="width: 90%; margin: auto;">
								<h4 style="margin-left: -2.5%">CHANGE PASSWORD</h4>
								<form onsubmit="return validChange();" style="margin-left: -1%;">
									<div class="row" style="margin-left: 3.5% !important;">
										<center class="row">
											<center class="input-field">
												<input type="password" id="currpass" name="currpass" onfocus="emptyElement()" maxlength="88">
												<label for="currpass">Old Password</label>
											</center>
										</center>
										<center class="row">
											<center class="input-field">
												<input type="password" id="password" name="password" onfocus="emptyElement()" maxlength="100">
												<label for="password">New Password</label>
											</center>
										</center>
										<center class="row">
											<center class="input-field">
												<input type="password" id="repass" name="repass" onfocus="emptyElement()" maxlength="100">
												<label for="repass">Confirm Password</label>
											</center>
										</center>
										<center class="row">
											<button class="btn waves-effect waves-light right"  id="loginbtn" type="submit">SET</button>
										</center>
										<center class="error-message-bottom" id="status">
										</center>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</main>



<!-- 	<div class="nav-wrapper subNav">
		<span class="brand-logo">SETTINGS</span>
	</div>
	<div class="pageContent valign-wrapper">
		<div class="valign">
			<center class="contentWidth">
				<div class="cardContainer loginCard">
					<form class="card" onsubmit="return validChange();">
						<center class="card-content">
							<center class="row">
								<center class="input-field">
									<input type="password" id="currpass" name="currpass" onfocus="emptyElement()" maxlength="88">
									<label for="currpass">Old Password</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input type="password" id="password" name="password" onfocus="emptyElement()" maxlength="100">
									<label for="password">New Password</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input type="password" id="repass" name="repass" onfocus="emptyElement()" maxlength="100">
									<label for="repass">New Password</label>
								</center>
							</center>
							<center class="row">
								<button class="btn waves-effect waves-light right"  id="loginbtn" type="submit">SET</button>
							</center>
							<center id="status">
							</center>
						</center>
					</form>
				</div>
			</center>
		</div>
	</div>
 -->
