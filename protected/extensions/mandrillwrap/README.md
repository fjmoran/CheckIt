# README.md
# Yii Wrap for Mandrill

# Usage

$email = Yii::app()->mandrillwrap;
$email->html = htmlentities("Your email body");
$email->subject = "Subject";
$email->fromName = "test@test.com";
$email->fromEmail = "test@test.com";
$email->toName = "test@test.com";
$email->toEmail = "test@test.com";
$email->sendEmail();

# Installation
- Put the mandrillwrap.php file in a mandrillwrap folder under "extensions"
- Download the mandrill php folder and put it in the vendors folder
- On the mandrillwrap.php file do change the MANDRILL_API_KEY with your own key

