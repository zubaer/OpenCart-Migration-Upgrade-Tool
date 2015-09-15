<?php echo $header; ?>
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  
<div id="container">
	<div class="content">
<div class="msg round">
    <div class="heading">
      <h1><img src="view/image/user.png" alt="" /> <?php echo $heading_title; ?></h1>   

    </div>
</div>
<div class="note round<?php echo $simulate ? ' bg-green' : ' bg-red'; ?>">
<?php echo $text_simulation; ?> <span class="<?php echo $simulate ? 'green">' . $text_on : 'red">' . $text_off; ?></span>
</div>

   <?php if( isset( $add_modules ) ) { echo $add_modules; } ?>
</div>

		<div id="column-left">
<div class="msg round">

		<h2><?php echo $header_step_module; ?></h2>
		<div class="step round"><?php echo $text_step; ?></div>

		<div class="clr"></div>

      <h1><img src="view/image/user.png" alt="" /> <?php echo $text_setting_info; ?></h1>

		<div class="clr"></div>
		<div class="block">
			<form action="<?php echo $action; ?>" method="post">
				<input type="hidden" name="lang" value="<?php echo $langCur; ?>" />
				<input type="hidden" name="step" value="<?php echo $step;?>" />
				<input type="hidden" name="steps" value="<?php echo $steps;?>" />
				<input type="hidden" name="simulate" value="<?php echo $simulate; ?>" />
				<input type="hidden" name="dirOld" value="<?php echo $dirOld; ?>" />
				<input type="hidden" name="showOps" value="<?php echo $showOps; ?>" />
				<input type="hidden" name="dirImage" value="<?php echo $images; ?>" />
				<input type="hidden" name="upgrade" value="<?php echo $upgrade; ?>" />
				<div class="block">
					<label><?php echo $text_update_theme;?>
					<select name="theme">
                                              <option><?php echo $text_skip_theme;?></option> 
                                           <?php foreach($themes as $theme){?>
                                            <?php if($theme['name'] == $config_theme){?>
                                              <option value="<?php echo $theme['name'];?>" selected="selected"><?php echo $theme['name'];?></option> 
                                            <?php } else{?>
                                              <option value="<?php echo $theme['name'];?>"><?php echo $theme['name'];?></option> 
                                            <?php } ?>
                                            <?php } ?>
                                          </select>
					</label>
				</div>
				<div class="buttons">
					<input type="submit" name="submit" value="<?php echo $btn_setting; ?>" class="submit round green" />
					<input type="submit" name="skip" value="<?php echo $btn_skip; ?>" class="submit round" />
				</div>
			</form>
		</div>
		<div class="clr"></div>
	</div>
</div>
    <div id="column-right">
      <ul class="list-group">
        <li class="list-group-item"><?php echo $step_start; ?></li>
        <li class="list-group-item"><?php echo $step_collate; ?></li>
        <li class="list-group-item"><?php echo $step_column; ?></li>
        <li class="list-group-item"><?php echo $step_data; ?></li>
        <li class="list-group-item"><?php echo $step_module; ?></li>
        <li class="list-group-item"><b><?php echo $step_setting; ?></b></li>
        <li class="list-group-item"><?php echo $step_images; ?></li>
        <li class="list-group-item"><?php echo $step_clean_module; ?></li>
        <li class="list-group-item"><?php echo $step_configuration; ?></li>
        <li class="list-group-item"><?php echo $step_clean_table; ?></li>
      </ul>
    </div>
</div>
<?php echo $footer; ?>
