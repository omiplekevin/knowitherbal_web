<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Username', 'username', array('class'=>'control-label')); ?>

				<?php echo Form::input('username', Input::post('username', isset($user) ? $user->username : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Username')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Password', 'password', array('class'=>'control-label')); ?>

				<?php echo Form::input('password', Input::post('password', isset($user) ? $user->password : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Password', 'type' => 'password')); ?>

		</div>
		<div class="form-group">
			<?php /*echo Form::label('Group', 'group', array('class'=>'control-label'));*/ ?>

				<?php echo Form::input('group', Input::post('group', isset($user) ? $user->group : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Group', 'type' => 'hidden')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Email', 'email', array('class'=>'control-label')); ?>

				<?php echo Form::input('email', Input::post('email', isset($user) ? $user->email : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Email')); ?>

		</div>
		<div class="form-group">
			<?php /*echo Form::label('Last login', 'last_login', array('class'=>'control-label'));*/ ?>

				<?php echo Form::input('last_login', Input::post('last_login', isset($user) ? $user->last_login : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Last login', 'type' => 'hidden')); ?>

		</div>
		<div class="form-group">
			<?php /*echo Form::label('Login hash', 'login_hash', array('class'=>'control-label'));*/ ?>

				<?php echo Form::input('login_hash', Input::post('login_hash', isset($user) ? $user->login_hash : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Login hash', 'type' => 'password', 'type' => 'hidden')); ?>

		</div>
		<div class="form-group">
			<?php /*echo Form::label('Profile fields', 'profile_fields', array('class'=>'control-label'));*/ ?>

				<?php echo Form::input('profile_fields', Input::post('profile_fields', isset($user) ? $user->profile_fields : ''), array('class' => 'col-md-8 from-control', 'rows' => 8, 'placeholder'=>'Profile fields', 'type' => 'hidden')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>