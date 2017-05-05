<?php
$current_module = $this->modules[$_GET['tab']];
$s = $current_module->settings;
$current_module->check_filesystem();
?>
<?php if ( $errors = $current_module->get_errors() ) : ?>
	<div id="message" class="error">
		<?php foreach ( $errors as $error ) : ?>
			<p><?php echo $error; ?></p>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
<h3><?php _e( 'Automatic Updates', 'wp-kusanagi' ); ?></h3>
<table class="form-table">
	<tr>
		<th><?php _ex( 'Translations', 'automatic updates', 'wp-kusanagi' ); ?></th>
		<td>
			<select name="translation">
				<option value="disable" <?php selected( $s['translation'], 'disable' ); ?>><?php _ex( 'Disable', 'automatic updates', 'wp-kusanagi' ); ?></option>
				<option value="enable" <?php selected( $s['translation'], 'enable' ); ?>><?php _ex( 'Enable - Default', 'automatic updates', 'wp-kusanagi' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<th><?php _ex( 'Plugins', 'automatic updates', 'wp-kusanagi' ); ?></th>
		<td>
			<select name="plugin">
				<option value="disable" <?php selected( $s['plugin'], 'disable' ); ?>><?php _ex( 'Disable - Default', 'automatic updates', 'wp-kusanagi' ); ?></option>
				<option value="enable" <?php selected( $s['plugin'], 'enable' ); ?>><?php _ex( 'Enable', 'automatic updates', 'wp-kusanagi' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<th><?php _ex( 'Themes', 'automatic updates', 'wp-kusanagi' ); ?></th>
		<td>
			<select name="theme">
				<option value="disable" <?php selected( $s['theme'], 'disable' ); ?>><?php _ex( 'Disable - Default', 'automatic updates', 'wp-kusanagi' ); ?></option>
				<option value="enable" <?php selected( $s['theme'], 'enable' ); ?>><?php _ex( 'Enable', 'automatic updates', 'wp-kusanagi' ); ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<th><?php _ex( 'WordPress core', 'automatic updates', 'wp-kusanagi' ); ?></th>
		<td>
			<select name="core">
				<option value="disable" <?php selected( $s['core'], 'disable' ); ?>><?php _ex( 'Disable all core updates', 'automatic updates', 'wp-kusanagi' ); ?></option>
				<option value="minor" <?php selected( $s['core'], 'minor' ); ?>><?php _ex( 'Enable only core minor updates - Default', 'automatic updates', 'wp-kusanagi' ); ?></option>
				<option value="enable" <?php selected( $s['core'], 'enable' ); ?>><?php _ex( 'Enable all core updates', 'automatic updates', 'wp-kusanagi' ); ?></option>
			</select>
		</td>
	</tr>

</table>
