<!DOCTYPE html>
<html>
<head>
	<title>Employee - Signup</title>
</head>
<body>
<div>
	<h1>Registration Successful</h1>

	<h3 style="font-size:30px;font-weight:400;color:#000;">
		<span style="font-size: 13px;">Dear&nbsp;{{ $name }} ,&nbsp;<br>
			Thanks for creating your account in Demo Project.
		<br>
			Please click the below link to login.
		<br>
			{{ config('app.url') }}
		<br>
			We shall be sending periodic email alerts and messages to members to help them track their activity on the site. 
		<br>
			Your Login Name : {{$email}}
		<br>
			Password : {{ $password }}</span>
	</h3>
	<br>
	Thanks,<br>
	<strong>Demo</strong>&nbsp;</div>
</body>
</html>