<?php

class mandrillwrap extends CApplicationComponent {
	
	public $mandrillKey;
	public $fromEmail;
	public $fromName;
	public $toEmail;
	public $toName;
	public $html;
	public $subject;
	
	public function init()
	{
		Yii::import('application.vendors.mandrill.Mandrill');
		//define('MANDRILL_API_KEY','M3S8usaiNCgac4LGPEgX0A');
	}
	
	public function sendEmail() {
		
		if (!$this->mandrillKey) die("Must supply Key for Mandrill");

/*		$request_json = '{
						"type":"messages",
						"call":"send",
						"message": {
							"subject":"' . $this->subject . '",
							"to":[
								{
								"email": "' . $this->toEmail . '",
								"name": "' . $this->toName . '"
								}
							],
							"headers":
								{
									"...":"..."
							},
							"url_strip_qs":true,
							"from_email": "' . $this->fromEmail . '",
							"from_name": "' . $this->fromName . '",
							"text": "' . $this->text . '",
							"track_opens":false,
							"track_clicks":false,
							"auto_text":true,
							"tags":["fal"],
							"google_analytics_domains":["..."],
							"google_analytics_campaign":["..."],
							"metadata":["..."]
							}
						}';

		$ret = Mandrill::call((array) json_decode($request_json));*/

		$mandrill_client = new Mandrill($this->mandrillKey);
		$message = array(
			"html" => $this->html,
			"text" => strip_tags($this->html),
			"subject" => $this->subject,
			"from_email" => $this->fromEmail,
			"from_name" => $this->fromName,
			"to" => array(
				array(
					"email" => $this->toEmail,
					"name" => $this->toName,
					"type" => "to",
				),
			),
			"headers" => array(
				"Reply-To" => $this->fromEmail,
			),
			/*"important": false,
			"track_opens": null,
			"track_clicks": null,
			"auto_text": null,
			"auto_html": null,
			"inline_css": null,
			"url_strip_qs": null,
			"preserve_recipients": null,
			"view_content_link": null,
			//"bcc_address": "message.bcc_address@example.com",
			"tracking_domain": null,
			"signing_domain": null,
			"return_path_domain": null,
			"merge": true,
			"global_merge_vars": [{
					"name": "merge1",
					"content": "merge1 content"
				}],
			"merge_vars": [{
					"rcpt": "recipient.email@example.com",
					"vars": [{
							"name": "merge2",
							"content": "merge2 content"
						}]
				}],
			"tags": [
				"password-resets"
			],
			"subaccount": "customer-123",
			"google_analytics_domains": [
				"example.com"
			],
			"google_analytics_campaign": "message.from_email@example.com",
			"metadata": {
				"website": "app.getcheck.it"
			},
			"recipient_metadata": [{
					"rcpt": "recipient.email@example.com",
					"values": {
						"user_id": 123456
					}
				}],
			"attachments": [{
					"type": "text/plain",
					"name": "myfile.txt",
					"content": "ZXhhbXBsZSBmaWxl"
				}],
			"images": [{
					"type": "image/png",
					"name": "IMAGECID",
					"content": "ZXhhbXBsZSBmaWxl"
				}]*/
		);
		$async = false;
		//$ip_pool = "Main Pool";
		$ip_pool = null;
		//$send_at = "example send_at";
		$send_at = null;
		$result = $mandrill_client->messages->send($message, $async, $ip_pool, $send_at);
		//print_r($result);


	}
}
