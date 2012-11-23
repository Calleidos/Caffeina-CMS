<div style="width:100%;height:100%;position:absolute;">
	<div id="login-holder" class="main">
		<!--  start loginbox ................................................................................. -->
		<div id="loginbox">
			<!--  start login-inner -->
			<div id="login-inner">
				<?php echo $this->Form->create('User', array('action' => 'login')); ?>
				<table border="0" cellpadding="0" cellspacing="0" class="login_table">
				<tr>
					<th>Username</th>
					<td><?php echo $this->Form->input("username", array("type" => "text", "value" => "Username", "class" => "login-inp", "onblur" => "if (this.value == '') {this.value = 'Username';}", "onfocus" => "if (this.value == 'Username') {this.value = '';}")); ?></td>
				</tr>
				<tr>
					<th>Password</th>
					<td><?php echo $this->Form->input("password", array("type" => "password", "class" => "login-inp", "onblur" => "if (this.value == '') {this.value = 'password';}", "onfocus" => "if (this.value == 'password') {this.value = '';}", "value" => "password")); ?></td>
				</tr>
				<tr>
					<th></th>
					<td valign="top"><?php echo $this->Form->input("login-check", array("type" => "checkbox", "class" => "checkbox-size"))?></td>
				</tr>
				<tr>
					<th></th>
					<td><input type="submit" class="submit-login"  />
				<?php echo $this->Form->end(); ?></td>
				</tr>
				</table>
			</div>
		 	<!--  end login-inner -->
			<div class="clear"></div>
			<a href="" class="forgot-pwd">Forgot Password?</a>
		</div>
		<!--  end loginbox -->
	 
		<!--  start forgotbox ................................................................................... -->
		<div id="forgotbox">
			<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
			<!--  start forgot-inner -->
			<div id="forgot-inner">
			<table border="0" cellpadding="0" cellspacing="0" class="login_table">
			<?php echo $this->Form->create('User', array('action' => 'login-psw'));?>
			<tr>
				<th>Email address:</th>
				<td>
					<?php echo $this->Form->input("email", array("type" => "text", "class" => "login-inp", "onblur" => "if (this.value == '') {this.value = 'Your Email';}", "onfocus" => "if (this.value == 'Your Email') {this.value = '';}", "value" => "Your Email")); ?>
					
				</td>
			</tr>
			<tr>
				<th> </th>
				<td>
					<?php echo $this->Form->end(); ?>
					<input type="button" class="submit-login"  />
				</td>
			</tr>
			</table>
			</div>
			<!--  end forgot-inner -->
			<div class="clear"></div>
			<a href="" class="back-login">Back to login</a>
		</div>
		<!--  end forgotbox -->
	</div>
</div>