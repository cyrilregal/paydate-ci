
<div id="form-signin">
    <h2><?php echo $this->lang->line('form_login_title'); ?></h2>
    
<?php 
	echo form_open('connection/login'); 
    	
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
    	
   	echo form_label($this->lang->line('label_login_input'), 'inputLogin', array('class' => 'sr-only'));
   	echo form_input($login_attr);
    	
   	// Input password.
   	//----------------
   	$password_attr = array(
    	'name' => 'password_input',
    	'type' => 'password',
    	'id' => 'inputPassword',
    	'class' => 'form-control',
    	'placeholder' => $this->lang->line('label_password_input'),
    	'required' => true
   	);
   	
   	echo form_label($this->lang->line('label_password_input'), 'inputPassword', array('class' => 'sr-only'));
   	echo form_input($password_attr);
   	
?>
    <div class="row label_row">
        <div class="col-md-10">
            <?php echo form_label($this->lang->line('label_remember_me_checkbox'), 'checkboxRememberMe', 'class="vcenter"'); ?>
        </div>
        
        <div class="col-md-2 pull-right text-right">
	        <?php 
	        // Remember me.
	        //-------------
	        $remember_me_attr = array(
	        	'id' => 'checkboxRememberMe',
	            'name' => 'remember_me_checkbox',
	            'checked' => set_value('remember_me_checkbox', false)
	        );
	        
	        echo form_checkbox($remember_me_attr);
			?>
        </div>
    </div>

<?php    	
   	// Submit button.
   	//---------------
   	$submit_attr = array(
   		'type' => 'submit',
   		'class' => "btn btn-lg btn-primary btn-block"
   	);
   	
   	echo form_button($submit_attr, $this->lang->line('label_connexion_button'));
   	
   	echo form_close();
?>

</div>