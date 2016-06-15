<?php 

	///// No Direct Access /////
	
	defined('_JEXEC') or die;

	///// Default Page Display - The Form /////
	
	echo 	"<form action='' method='POST' accept-charset='utf-8'>
				<h2>Send Us A Message:</h2>
				<label class='input-heading' for='name'>Name</label>
				<input class='required' type='text' name='name' size='22'>
				<label class='input-heading' for='email'>Email</label>
				<input class='required' type='text' name='email' size='22'>
				<label class='input-heading' for='phone'>Phone</label>
				<input type='tel' name='phone' size='22'>
				<label class='input-heading' for='formtext'>Message</label>
				<textarea class='required' name='formtext'></textarea>
				<input type='submit' name='submit' id='submit' value='Send'>
			</form>";
					
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		///// Handle the Form Data /////
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$formtext = $_POST['formtext'];
		
		///// Build the Notification Email /////
		
		//To where should the notification be sent?
		$to = 'dave@davejudd.com';
		
		// Notification Email Subjeact Line
		$subject = $name . ' | Web Inquiry';
		
		// Email Headers
		$headers = 'From: "Dave Judd" <dave@davejudd.com>' . PHP_EOL;
		$headers .= 'Reply-To: "Dave Judd" <dave@davejudd.com>' . PHP_EOL;
		$headers .= 'MIME-Version: 1.0' . PHP_EOL;
		$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . PHP_EOL;
		
		// The Notification Email
		$message = '<html><body>';
		$message .= '<p>www.davejudd.com</p>';
		$message .= '<p>You have a new message with the following information:</p>';
		$message .= '<p><strong>Name:</strong> ' . $name . '</p>';
		$message .= '<p><strong>Email:</strong> ' . $email . '</p>';
		$message .= '<p><strong>Phone:</strong> ' . $phone . '</p>';
		$message .= '<p><strong>Message:</strong><br />' . $formtext . '</p>';
		$message .= '</body></html>';
		mail($to, $subject, $message, $headers, '-fdave@davejudd.com');
		
		///// Build the Application Message /////
		JFactory::getApplication()->enqueueMessage('Thank you for contacting me! I will reply to your inquiry as soon as I can.', 'message');
	}
	
 ?>
