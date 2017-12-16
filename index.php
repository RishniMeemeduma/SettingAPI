<?php
/*
Plugin name:Plugin Settings
Plugin URI:http://wordpress.org/plugins/testplugin/
Description:this is a test plugin
Author:RishniMeemeduma
Author URI:http://rish.tt/
*/


add_action( 'admin_menu', 'tp_add_admin_menu' ); 
add_action( 'admin_init', 'tp_settings_init' );


function tp_add_admin_menu(  ) { 

	add_options_page( 'Plugin Setting', 'Plugin Setting', 'manage_options', 'Plugin Setting', 'tp_options_page' );

}


function tp_settings_init(  ) { 

	//register_setting( 'pluginPage', 'tp_settings' );
	/*add_settings_section(
		'tp_pluginPage_section', 
		__( 'SETTING', 'wordpress' ), 
		'tp_settings_section_callback', 
		'pluginPage',1
	);*/
	if(isset($_GET['tab'])){							//Header section
		if($_GET['tab'] =="header-option"){
		add_settings_section(
		'tp_pluginName_section',
		__('NAME','wordpress'),
		'tp_settings_Name_callback',
		'pluginPage'
		);
		add_settings_section(
		'tp_pluginEmail_section',
		__('Email','wordpress'),
		'tp_settings_email_callback',
		'pluginPage'
		);
		
		add_settings_field( 
		'tp_text_field_0', 
		__( 'Name', 'wordpress' ), 
		'tp_text_field_0_render', 
		'pluginPage', 
		'tp_pluginName_section' 
	);
			add_settings_field( 
		'tp_text_field_1', 
		__( 'Email', 'wordpress' ), 
		'tp_text_field_1_render', 
		'pluginPage', 
		'tp_pluginEmail_section' 
	);

	
		register_setting('pluginPage','tp_Name');
		register_setting('pluginPage','tp_Email');
			
	}else{ 												 //body section
		add_settings_section(
		'tp_pluginPhone_section',
		__('Phone','wordpress'),
		'tp_settings_phone_callback',
		'pluginPage'
		);
		add_settings_field( 
		'tp_text_field_2', 
		__( 'Phone', 'wordpress' ), 
		'tp_text_field_2_render', 
		'pluginPage', 
		'tp_pluginPhone_section' 
	);
		register_setting('pluginPage','tp_phone');

	

	}
}else{
		register_setting( 'pluginPage', 'tp_settings' );
	add_settings_section(
		'tp_pluginPage_section', 
		__( 'SETTING', 'wordpress' ), 
		'tp_settings_section_callback', 
		'pluginPage',1
	);

	
}
}
	




function tp_text_field_0_render(  ) { 

	$options = get_option( 'tp_settings' );
	$options = get_option( 'tp_Name' );
	
	?>
	<input type='text' name='tp_Name[tp_text_field_0]' value='<?php echo $options['tp_text_field_0']; ?>'>
	<?php

}


function tp_text_field_1_render(  ) { 

	$options = get_option( 'tp_Email' );
	?>
	<input type='text' name='tp_Email[tp_text_field_1]' value='<?php echo $options['tp_text_field_1']; ?>'>
	<?php

}


function tp_text_field_2_render(  ) { 

	$options = get_option( 'tp_phone' );
	?>
	<input type='text' name='tp_phone[tp_text_field_2]' value='<?php echo $options['tp_text_field_2']; ?>'>
	<?php

}


function tp_settings_section_callback(  ) { 

	echo __( 'This is a sample setting page', 'wordpress' );

}
function tp_settings_name_callback(){
	echo __('This is a username','wordpress');
}

function tp_settings_email_callback(){
	echo __('This is a email','wordpress');
}
function tp_settings_phone_callback(){
	echo __('This is a phonenumber','wordpress');

}

function tp_options_page(  ) { 

	?>
			<!--adding tabs-->

<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<?php settings_errors();?>
	<h1>Setting Page</h1>
<?php
	$active_tab='header-option';
	if(isset($_GET['tab'])){
		if($_GET['tab']=='header-option'){
			$active_tab='header-option';
		}
		else{
			$active_tab='body-option';
		}
	}


?>
<!--Tabs styling-->

<h2 class="nav-tab-wrapper">
	<!-- when we tab buttons we jump back to same page but differnet active sections-->
	<a href="?page=Plugin+Setting&tab=header-option" class="nav-tab <?php echo $active_tab == 'header-option' ? 'nav-tab-active' :''; ?>" >Header Option</a>
	<a href="?page=Plugin+Setting&tab=body-option"   class="nav-tab <?php echo $active_tab == 'body-option'   ? 'nav-tab-active' :''; ?>" >Body Option</a>
	<a>
</h2>

	<form action='options.php' method='post'>

		<h2>Plugin Setting</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	</div>
	<?php

}

?>
