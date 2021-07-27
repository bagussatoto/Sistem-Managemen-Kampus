
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Access<small>Data Access</small></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a></li>
							<li><a href="#">Settings 2</a></li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			
			<div class="x_content">
				<a href="#" class="btn btn-sm btn-success" onclick="add()"><i class="fa fa-plus"></i> Add<a>
				<table class="table table-bordered table-striped table-hover jambo_table"  id="tableaccess">
					<thead class="bg-cyan" >
						<tr>
							<th>No.</th>
							<th>Level</th>
							<th>ID Menu</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<!----------------------------- MODAL ----------------------------------------->
 <div class="modal fade bs-example" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">

		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
		  </button>
		  <h4 class="modal-title" id="myModalLabel">FORM ACCESS</h4>
		</div>
		<form class="form-horizontal form-label-left" id="akses_form"  action="<?php echo base_url(); ?>akses/save" method="POST">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<select class="form-control" name="level" id="level">
							<option value="">Choose Level</option>
							<?php 
								foreach($lv as $l){
							?>
								<option value="<?php echo $l->levels; ?>"><?php echo $l->levels; ?></option>
							<?php 
								}
							?>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
						<input type="text" class="form-control has-feedback-left" name ="id_menu" id="id_menu" placeholder="ID Menu" >
						<span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <button class="btn btn-primary" type="submit">Save changes</button>
			</div>
		</form>
	  </div>
	</div>
  </div>
  
  <!----------------------------- MODAL EDIT ----------------------------------------->
 <div class="modal fade bs-example" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">FORM ACCESS</h4>
			</div>
			<div id="modal-body">
				
			</div>
		</div>
	</div>
  </div>
			