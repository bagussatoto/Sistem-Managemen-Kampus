<form class="form-horizontal form-label-left" id="reg_form"  action="<?php echo base_url(); ?>level/update" method="POST">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" readonly value="<?php echo $level['levels']; ?>"  class="form-control has-feedback-left" name ="level" placeholder="Level" >
				<span class="fa fa-level-up form-control-feedback left" aria-hidden="true"></span>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
				<input type="text" value="<?php echo $level['description']; ?>"  class="form-control has-feedback-left" name ="description" id="description" placeholder="Description" >
				<span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
			</div>
			
		</div>
	</div>
	<div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  <button class="btn btn-primary" type="submit">Update</button>
	</div>
</form>