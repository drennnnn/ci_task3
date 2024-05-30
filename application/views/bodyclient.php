<body>
	<div class="client-nav">
		<ul>
			<li>Hello, <?=$this->session->userdata('firstname');?>!</li>

			<li class="client-settings">Settings
				<div class="client-dropdown">
					<a id="update-password">Change Password</a>
					<a id="sign-out-button">Sign out</a>
				</div>
			</li>
			
		</ul>
	</div>
	<div class="client-container">
		<div class="client-information">
			<div class="three-client">
				<div>
					<label>Id</label><input type="text" readonly value="<?=$this->session->userdata('id')?>" class="form control"/>
				</div>
				<div>
					<label>Type </label><input type="text" readonly value="<?=$this->session->userdata('type')?>" class="form control"/>
				</div>
				<div>
					<label>Username </label><input type="text" readonly value="<?=$this->session->userdata('username')?>" class="form control"/>
				</div>

			</div>
			<div class="three-client">
				<div>
					<label>Firstname </label><input type="text" readonly value="<?=$this->session->userdata('firstname')?>" class="form control"/>
				</div>
				<div>
					<label>Middlename </label><input type="text" readonly value="<?=$this->session->userdata('middlename')?>" class="form control"/>
				</div>
				<div>
					<label>Lastname </label><input type="text" readonly value="<?=$this->session->userdata('lastname')?>" class="form control"/>
				</div>			
			</div>
			<div class="three-client">
				<div>
					<label>Birthdate </label><input type="text" readonly value="<?=$this->session->userdata('birthdate')?>" class="form control"/>
				</div>
				<div>
					<label>Age </label><input type="text" readonly value="<?=$this->session->userdata('age')?>" class="form control"/>
				</div>
				<div>
					<label>Birth Place </label><input type="text" readonly value="<?=$this->session->userdata('birthplace')?>" class="form control"/>
				</div>
			</div>
			<div class="two-client">
				<label>Address </label><input type="text" readonly value="<?=$this->session->userdata('address')?>" class="form control"/>
			</div>
			<div class="three-client">
				<div>
					<label>Gender </label><input type="text" readonly value="<?=$this->session->userdata('gender')?>" class="form control"/>
				</div>
				<div>
					<label>Email </label><input type="text" readonly value="<?=$this->session->userdata('email')?>" class="form control"/>
				</div>
				<div>
					<label>Mobile </label><input type="text" readonly value="<?=$this->session->userdata('mobile')?>" class="form control"/>
				</div>
			</div>
			<div class="three-client">
				<div>
					<label>Status </label><input type="text" readonly value="<?=$this->session->userdata('status')?>" class="form control"/>
				</div>
				<div>
					<label>Last Login </label><input type="text" readonly value="<?=$this->session->userdata('lastlogin')?>" class="form control"/>
				</div>
				<div>
					<label>Date Created </label><input type="text" readonly value="<?=$this->session->userdata('creationdate')?>" class="form control"/>
				</div>
			</div>

		</div>
	</div>
</body>