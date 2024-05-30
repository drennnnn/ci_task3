<body>
    <div class="parent">
        <form class="registeration-container containers" id="form">
			<h1>Register</h1>
            <span id="error-message"></span>
			<input type="text" name="username" class="form-control" placeholder="Enter your Username"/>
			<div class="three">
				<input type="text" name="firstname" class="form-control" placeholder="Enter your First Name"/>
				<input type="text" name="middlename" class="form-control" placeholder="Enter your MIddle Name"/>
				<input type="text" name="lastname" class="form-control" placeholder="Enter your Last Name"/>
			</div>
			<div class="three">
				<input type="date" name="birthdate" class="form-control"/>
				<input type="text" name="age" class="form-control" placeholder="Your age" readonly/>
				<input type="text" name="birthplace" class="form-control" placeholder="Enter your Birth Place"/>
			</div>
			<div class="three">
				<select name="gender" class="form-control">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				<input type="number" name="mobile" class="form-control" placeholder="(09123456789) Mobile number"/>
                <input type="email" name="email" class="form-control" placeholder="Enter your Email"/>
			</div>
			<input type="text" name="address" class="form-control" placeholder="Enter your Address"/>
			
            <button type="button" id="signup-button" class="buttons">Sign Up</button>
			<p>Already have an account? <button type="button" id="gotologin" class="links">Login</button></p>
		</form>
    </div>
</body>