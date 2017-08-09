<div class="container">
    <h2 class="form-signin-heading"><?php echo $this->lang->line('form_login_title'); ?></h2>
    
<?php 
    	echo form_open('connection/login', array('class' => 'form-signin')); 
    	
    	// Input login.
    	//-------------
    	$login_attr = array(
    		'name' => 'login_input',
    		'id' => 'inputLogin',
    		'class' => 'form-control',
    		'placeholder' => $this->lang->line('label_login_input'),
    		'required' => true,
    		'autofocus' => true
    	);
    	
    	echo form_label($this->lang->line('label_login_input'), 'inputLogin');
    	echo form_input($login_attr);
    	
    	// Input password.
    	//----------------
    	$password_attr = array(
	    	'name' => 'password_input',
	    	'id' => 'inputPassword',
	    	'class' => 'form-control',
	    	'placeholder' => $this->lang->line('label_password_input'),
	    	'required' => true
    	);
    	
    	echo form_label($this->lang->line('label_password_input'), 'inputPassword');
    	echo form_input($password_attr);
    	
    	
    	// Remember me.
    	//-------------
    	$remember_me_attr = array(
    		'id' => 'radioRememberMe',
    		'name' => 'remember_me_radio',
    		'checked' => set_value('remember_me_radio', false)
    	);
    	
    	echo form_label($this->lang->line('label_remember_me_radio'), 'radioRememberMe');
    	echo form_radio($remember_me_attr);
    	
    	
    	// Submit button.
    	//---------------
    	$submit_attr = array(
    		'type' => 'submit',
    		'class' => "btn btn-lg btn-primary btn-block"
    	);
    	
    	echo form_button($submit_attr);
    	
    	
    	echo form_close();
    	
?>
      
</div> <!-- /container -->
