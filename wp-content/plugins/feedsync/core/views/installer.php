<?php get_header(); ?>
		<div class="row">
		    <form role="form" id="installer-form" method="post">
		        <div class="col-lg-12">
		            <div class="well well-sm">
		            	<strong>
		            		<span class="glyphicon"></span>
		            		Provide Database details
	            		</strong>
            		</div>
		            <div class="form-group">
		                <label for="host_name">Enter Host</label>
		                <div class="input-group">
		                	<input type="hidden" name="action" value="installer" />
		                    <input required type="text" class="form-control" name="host_name" id="host_name" placeholder="Enter Host" required>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="db_name">Enter Database</label>
		                <div class="input-group">
		                    <input required type="text" class="form-control" id="db_name" name="db_name" placeholder="Enter Database" required>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="user_name">Enter User</label>
		                <div class="input-group">
		                    <input required type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter Username" required>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="user_pass">Enter Password</label>
		                <div class="input-group">
		                    <input required type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Enter Password" required>
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
		                </div>
		            </div>
            		<div class="row response">
            			<div class="form-group">
            			</div>
					</div>

		            <input type="button" name="test_connection" id="test_connection" value="Test Connection" class="btn btn-info pull-left">

		            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
		        </div>
		    </form>
		</div>
<?php get_footer(); ?>
