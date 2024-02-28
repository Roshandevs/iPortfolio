<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/roshande/abvp.roshandevs.com/PHPMailer-master/src/Exception.php';
require '/home/roshande/abvp.roshandevs.com/PHPMailer-master/src/PHPMailer.php';
require '/home/roshande/abvp.roshandevs.com/PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['subject'];
    $message = $_POST['comments'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'SMTP SERVER ';  // Specify your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'EMAIL USERNAME';  // SMTP username
        $mail->Password   = 'PASSWORD';     // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('ENTER NAME USERNAME HERE', '');
        $mail->addAddress('ENTER YOUR GMAIL HERE TO RECIPIENT THE MAIL', ''); // Add a recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
    <html>
        <head>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
            </style>
        </head>
        <body>
            <h2>Contact Form Submission</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <td>$name</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>$email</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>$phone</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>$message</td>
                </tr>
            </table>
        </body>
    </html>
";

        // Send the email
        $mail->send();

        // Return a success response
        echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
    } catch (Exception $e) {
        // Return an error response
        echo json_encode(['success' => false, 'message' => $mail->ErrorInfo]);
    }
} else {
    // Return an error response if the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
