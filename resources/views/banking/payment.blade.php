<!DOCTYPE HTML>
<html>
<head>
	<title>S. Thomas' College - Admissions</title>
	<script type='text/javascript' src='https://sampath.paycorp.lk/webinterface/qw/paycorp_payments.js'></script>
	<script type='text/javascript'>
		function startPayment(){
			loadPaycorpPayment(buildPayment());
		}

		function buildPayment(){
			return { 
				clientId: 'xxx', 
				paymentAmount: 150000, 
				currency: 'LKR', 
				returnUrl: 'https://admissions.stcmount.com/response', 
				clientRef: '{{$clientRef}}' 
			};
		}
	</script>
</head>
<body onload='startPayment()'>
	<p>Redirecting... please wait </p>
</body>
</html>