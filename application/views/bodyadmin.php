<body>
	<div class="client-nav">
		<ul>
			<li>Hello, Admin!</li>
			<li><a id="admin-list" class="active">Admin List</a></li>
			<li><a id="client-list">Client List</a></li>
			<li><a id="sign-out-button">Sign out</a></li>
		</ul>
	</div>
	<div class="admin-container" id="admin-container">
		<div id="client-table">
			<div class="container-modal-admin-pass-update" id="container-modal-admin-pass-update">
				<div class="admin-pass-update">
					<button type="button" class="btn btn-danger" style="align-self: flex-end;" onclick="$('#container-modal-admin-pass-update').toggle()">X</button>
					<form id="client-change-password">
						<h3 style="text-align: center;">Change Password</h3>
						<p id="admin-change-client-error"></p>
						<input type="password" name="pass" placeholder="New password" class="form-control" style="margin-bottom: 10px;"/>
						<input type="password" name="conpass" placeholder="Confirm Password" class="form-control"/>
					</form>
					<button type="button" id="save-client-change-pass" class="btn btn-primary" style="align-self: center;">Save changes</button>
				</div>
			</div>
			<table id="userlist" class="userlist" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Action</th>
						<th>First name</th>
						<th>Middle name</th>
						<th>Last Name</th>
						<th>Birthdate</th>
						<th>Age</th>
						<th>Birthplace</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Status</th>
						<th>Last login</th>
						<th>Creation Date</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Action</th>
						<th>First name</th>
						<th>Middle name</th>
						<th>Last Name</th>
						<th>Birthdate</th>
						<th>Age</th>
						<th>Birthplace</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Status</th>
						<th>Last login</th>
						<th>Creation Date</th>
					</tr>
				</tfoot>
			</table>
		</div>
		<div id="admin-table">
			<div class="container-modal-admin-pass-update" id="container-change-admin-pass">
				<div class="admin-pass-update">
					<button type="button" class="btn btn-danger" style="align-self: flex-end;" onclick="$('#container-change-admin-pass').toggle()">X</button>
					<form id="admin-change-password">
						<h3 style="text-align: center;">Change Password</h3>
						<p id="admin-change-admin-error"></p>
						<input type="password" name="admin-pass" placeholder="New password" class="form-control" style="margin-bottom: 10px;"/>
						<input type="password" name="admin-conpass" placeholder="Confirm Password" class="form-control"/>
					</form>
					<button type="button" id="save-admin-change-pass" class="btn btn-primary" style="align-self: center;">Save changes</button>
				</div>
			</div>
			<button type="button" id="addAdmin" class="btn btn-primary" style="margin-top: 10px;">Add Admin</button>
			<div class="container-modal-add-admin" id="container-modal-add-admin">
				<div class="admin-add">
					<button type="button" class="btn btn-danger" style="align-self: flex-end;" onclick="$('#container-modal-add-admin').toggle()">X</button>
					<form id="add-admin-form">
						<h3 style="text-align: center;">Add New Admin</h3>
						<p id="admin-add-error"></p>
						<div class="three">
							<input type="text" name="admin-username" class="form-control" placeholder="Enter your Username"/>
							<input type="password" name="admin-password" class="form-control" placeholder="Enter your password"/>
						</div>
						<div class="three">
							<input type="text" name="admin-firstname" class="form-control" placeholder="Enter your First Name"/>
							<input type="text" name="admin-middlename" class="form-control" placeholder="Enter your MIddle Name"/>
							<input type="text" name="admin-lastname" class="form-control" placeholder="Enter your Last Name"/>
						</div>
						<div class="three">
							<input type="date" name="admin-birthdate" class="form-control"/>
							<input type="text" name="admin-age" class="form-control" placeholder="Your age" readonly/>
							<input type="text" name="admin-birthplace" class="form-control" placeholder="Enter your Birth Place"/>
						</div>
						<div class="three">
							<select name="admin-gender" class="form-control">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							<input type="number" name="admin-mobile" class="form-control" placeholder="(09123456789) Mobile number"/>
							<input type="email" name="admin-email" class="form-control" placeholder="Enter your Email"/>
						</div>
						<input type="text" name="admin-address" class="form-control" placeholder="Enter your Address"/>

					</form>
					<button type="button" id="add-new-admin" class="btn btn-primary" style="align-self: center;">Add</button>
				</div>
			</div>
			<table id="adminlist" class="adminlist" style="width:100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Action</th>
						<th>First name</th>
						<th>Middle name</th>
						<th>Last Name</th>
						<th>Birthdate</th>
						<th>Age</th>
						<th>Birthplace</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Status</th>
						<th>Last login</th>
						<th>Creation Date</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Action</th>
						<th>First name</th>
						<th>Middle name</th>
						<th>Last Name</th>
						<th>Birthdate</th>
						<th>Age</th>
						<th>Birthplace</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Status</th>
						<th>Last login</th>
						<th>Creation Date</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>