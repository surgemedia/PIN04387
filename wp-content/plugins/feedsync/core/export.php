<?php
require_once('../config.php');
require_once('functions.php');

global $feedsync_db;
get_header('export'); ?>

<div class="jumbotron">
	<form class="form-horizontal" id="exporter-form" method="post">
		<fieldset>

		<!-- Form Name -->
		<legend>Export Listings</legend>

		<!-- Select listing type -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="listingtype">Select Listing type</label>
		  <div class="controls col-md-8">
			<select id="listingtype" name="listingtype" class="form-control">
			 <option value="">All</option>
			  <option value="rental">Rental</option>
			  <option value="residential">Residential</option>
			  <option value="rural">Rural</option>
			  <option value="land">Land</option>
			  <option value="business">Business</option>
			  <option value="commercial">Commercial</option>
			  <option value="commercialLand">Commercial Land</option>
			  <option value="holidayRental">Holiday Rental</option>
			</select>
		  </div>
		</div>

		<!-- Select status -->
		<div class="form-group">
		  <label class="control-label col-md-4" for="listingstatus">Select Status</label>
		  <div class="controls col-md-8">
			<select id="listingstatus" name="listingstatus" class="form-control">
			  <option value="">All</option>
			  <option>current</option>
			  <option>withdrawn</option>
			  <option>leased</option>
			  <option>sold</option>
			</select>
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="exportlisting"></label>
		  <div class="col-md-4">
		  	<input type="hidden" name="action" value="exporter" />
			<input type="submit" id="exportlisting" name="exportlisting" class="btn btn-success" value="Export" />
		  </div>
		</div>
		
		</fieldset>
	</form>

</div>
<div class="jumbotron">
	<form class="form-horizontal" id="exporter-form" method="post">
		<fieldset>

		<!-- Form Name -->
		<legend>Export Listings Agents</legend>


		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="exportlisting"></label>
		  <div class="col-md-4">
		  	<input type="hidden" name="action" value="export_agents" />
			<input type="submit" id="exportlisting" name="exportlistingagents" class="btn btn-success" value="Export Agents" />
		  </div>
		</div>
		
		</fieldset>
	</form>

</div>


<?php echo get_footer(); ?>
