<?php
/* old code

				<div class="control-group <?php echo !empty($opt_textError)?'error':'';?>">
					<br>
					<label class="control-label">Option Text</label>
					<div class="controls">
						<input name="opt_text" type="text" placeholder="Option Text" value="<?php echo !empty($opt_text)?$opt_text:'';?>">
						<?php if (!empty($opt_textError)): ?>
							<span class="help-inline"><?php echo $opt_textError;?></span>
						<?php endif;?>
					</div>
				</div>
*/
echo '			<div class="control-group ';
echo !empty($opt_textError)?'error':'';
echo '">';

echo '<label class="control-label">Option Text</label>';



?>