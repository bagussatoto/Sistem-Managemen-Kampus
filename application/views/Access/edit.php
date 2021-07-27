<form class="form-horizontal form-label-left" id="akses_form"  action="<?php echo base_url(); ?>akses/update" method="POST">
	<input type="hidden" name="id" value="<?php echo $access['id']; ?>" >
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<select class="form-control" name="level" id="level">
					<option value="">Choose Level</option>
					<?php 
						foreach($lv as $l){
					?>
						<option <?php if($access['level'] == $l->levels){ echo "selected"; } ?> value="<?php echo $l->levels; ?>"><?php echo $l->levels; ?></option>
					<?php 
						}
					?>
				</select>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $access['id_menu'];?>" class="form-control has-feedback-left" name ="id_menu" id="id_menu" placeholder="ID Menu" >
				<span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
			</div>
			
		</div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button class="btn btn-primary" type="submit">Save changes</button>
	</div>
</form>