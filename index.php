<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="style.css" />

	<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

</head>
<body>

	<div id="wrapper">
		<center><h1>Welcome <?php session_start(); echo $_SESSION['username']; ?> to my website</h1></center>	

	
		
		<div class="chat_wrapper">
			
			<div id="abc"></div>
			<div id="chat"></div>

			<form method="POST" id="messageFrm">
				<textarea name="message" cols="30" rows="7" class="textarea" placeholder="Please Type a message to send"></textarea>
			</form>

		</div>


	</div>


	<script>

		LoadChat();


		setInterval(function(){
		
				LoadChat();
		
		}, 1000);


		function LoadChat()
		{
			$.post('handlers/messages.php?action=getMessages', function(response){
				
				var scrollpos = $('#chat').scrollTop();
				var scrollpos = parseInt(scrollpos) + 520;
				var scrollHeight = $('#chat').prop('scrollHeight');

				$('#chat').html(response);

				if( scrollpos < scrollHeight ){
					
				}else{
					$('#chat').scrollTop( $('#chat').prop('scrollHeight') );
				}

			});
		}
		
		$('.textarea').keyup(function(e){
			if( e.which == 13 ){
				$('form').submit();
			}
		});


		$('form').submit(function(){

			var message = $('.textarea').val();

			$.post('handlers/messages.php?action=sendMessage&message='+message, function(response){

				if( response==1 ){
					LoadChat();
					document.getElementById('messageFrm').reset();
				}

			});

			return false;

		});


	</script>


</body>
</html>