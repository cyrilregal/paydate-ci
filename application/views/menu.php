<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-full">
		<div class="navbar-header">
		  <a class="navbar-brand nopad" href="#"><img alt="logo" src="<?php echo base_url().IMG_FOLDER; ?>logo-base.png" height="50px"></a>
		</div>
		<div class="navbar-collapse collapse">
        
			<ul id="main-menu" class="nav navbar-nav">
                <li><?php echo anchor('home', $this->lang->line('menu_home')); ?></li>
                <li><?php echo anchor('compte', $this->lang->line('menu_bank_account')); ?></li>
                <li><?php echo anchor('comptabilite', $this->lang->line('menu_compatibility')); ?></li>
                
                <?php if($this->user_lib->isAdmin == 1) : ?>
	                <li><?php echo anchor('tresorerie', $this->lang->line('menu_treasury')); ?></li>
	                <li><?php echo anchor('exceptionnel', '<span class="glyphicon glyphicon-star-empty"></span>&nbsp;'.$this->lang->line('menu_exceptional_regulations')); ?></li>
                <?php endif; ?>
                
                <li><?php echo anchor('user', $this->lang->line('menu_users')); ?></li>
			</ul>
            
			<div class="navbar-collapse collapse navbar-right">
				<ul class="nav navbar-nav">
                    <li><?php echo anchor('connection/logout', $this->lang->line('menu_logout')); ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>