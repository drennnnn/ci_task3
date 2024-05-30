<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <style>
		* {
			box-sizing: border-box;
			padding: 0px;
			margin: 0px;
		}
		.parent {
			width: 100%;
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			background-color: rgb(242, 240, 233, .5);
			overflow-y: auto;
		}
		.containers {
			background-color: white;
			width: 650px;
			border: none;
			border-radius: 10px;
			box-shadow: 0px 0px 10px 10px rgb(242, 240, 233);
			padding: 10px;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		.buttons {
			background-color: blueviolet;
			border: none;
			font-weight: bold;
			padding: 5px 20px;
			color: white;
			border-radius: 10px;
		}
		.buttons:hover {
			background-color: blue;
		}
		.buttons:active {
			transform: scale(.95);
			background-color: blueviolet;

		}
		.links {
			color: blue;
			text-decoration: underline;
			border: none;
			background-color: transparent;
		}
		.links:hover {
			color: blueviolet;
		}
		.links:active {
			color: blue;
		}
		.containers > * 
		{
			margin-bottom: 20px;
		}
		.three{
			display: flex;
			gap: 10px;
			width: 100%;
		}
		#error-message, #login-error, #change-error, #admin-change-client-error, #admin-add-error, #admin-change-admin-error{
			display: block;
			color: red;
		}	
		.client-nav {
			width: 100%;
			height: 8vh;
			background-color: #2a3d4d;
			display: flex;
		}
		.client-nav ul {
			width: 100%;
			height: 100%;
			padding: 10px 100px 10px 20px;
			list-style-type: none;
			display: flex;
			justify-content: space-between;
		}
		.client-nav ul li {
			align-self: center;
			text-decoration: none;
			color: white;
			padding: 5px 10px;
			cursor: pointer;
		}
		.client-nav ul li a,  .client-nav ul li a:link,  .client-nav ul li a:visited {
			padding: 5px 10px;
			border-radius: 5px;
			text-decoration: none;
			color: white;
		}
		.client-settings {
			border-radius: 5px;
			position: relative;
			display: inline-block;
		}
		.client-settings:hover, .client-nav ul li a:hover, .client-nav ul li .active{
			background-color: rgb(242, 240, 233, .5);
		}
		.client-dropdown {
			display: none;
		}
		.client-settings:hover .client-dropdown {
			display: flex;
			flex-direction: column;
			position: absolute;
			background-color: white;
			color: black;
			padding: 10px;
			gap: 10px;
			text-align: center;
			border-radius: 10px;
		}
		.client-settings:hover .client-dropdown a, .client-settings:hover .client-dropdown a:link, .client-settings:hover .client-dropdown a:visited {
			background-color: gray;
			padding: 10px;
			font-size: 15px;
			color: white;
		}
		.client-settings:hover .client-dropdown a:hover {
			background-color: rgb(171, 149, 147, .99);
		}
		.client-container {
			width: 100%;
			height: 92vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.client-information {
			box-shadow: 0px 0px 20px 1px gray;
			width: 700px;
			border: none;
			border-radius: 20px;
			padding: 10px 30px;
		}
		.three-client {
			display: flex;
			width: 100%;
		}
		.client-information > .three-client {
			padding-block: 10px;
			width: 100%;	
			gap: 10px;
		}
		.three-client div {
			display: flex;
			flex-direction: column;
			width: 100%;
		}
		.three-client div input, .two-client input
		{
			text-align: center;
		}
		.two-client {
			display: flex;
			flex-direction: column;
			width: 100%;
		}
		.admin-container {
			width: 100%;
			height: 92vh;
		}
		#client-table {
			display: none;
		}
		.client-change-password {
			display: flex;
			flex-direction: column;
		}
		.container-modal-admin-pass-update, .container-modal-add-admin{
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100vh;
			background-color: rgb(242, 240, 233, .1);
			z-index: 1;
			display: none;
		}
		.admin-pass-update, .admin-add {
			margin: auto;
			margin-top: 100px;
			width: 400px;
			background-color: white;
			padding: 20px;
			box-shadow: 0px 0px 20px 1px black;
			border-radius: 10px;
			display: flex;
			flex-direction: column;
			gap: 10px;
		}
		.admin-add {
			width: 600px;
		}
		#admin-table {
			width: 100%;
			height: 100%;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		#add-admin-form > * {
			margin-bottom: 10px;
		}
	</style>
</head>