<?php

class CoreModule extends PortalerModule {
	function register() {
		$json = json_decode($this->app->request->getBody());

		if (json_last_error() === JSON_ERROR_NONE) {
			$dbsafe = array(
				"e-mail" => $this->db->real_escape_string($json->{'e-mail'}),
				"password" => $this->db->real_escape_string(Helpers::encodePassword($json->{'e-mail'}, $json->{'password'}))
			);
			$errors = array();

			$sql = 'SELECT id FROM ' . Settings::DB_PREFIX . 'users WHERE UCASE(email)=\'' . strtoupper($dbsafe['e-mail']) . '\' LIMIT 1';
			$res = $this->db->query($sql);
			if ($rec = $res->fetch_assoc()) {
				$errors[] = 'errUserAlreadyExists';
			}

			if (preg_match('/^[ \t\n\r]*$/i', $json->{'password'})) {
				$errors[] = 'errPasswordEmpty';
			}

			if (strlen($json->{'password'}) < Settings::MIN_PASSWORD_LENGTH) {
				$errors[] = 'errPasswordTooShort';
			}

			if (strlen($json->{'password'}) > Settings::MAX_PASSWORD_LENGTH) {
				$errors[] = 'errPasswordTooLong';
			}

			if (preg_match('/^[ \t\n\r]*$/i', $json->{'e-mail'})) {
				$errors[] = 'errEMailEmpty';
			}

			if (!Helpers::isValidEMail($json->{'e-mail'})) {
				$errors[] = 'errEMailWrongFormat';
			}

			if (count($errors)) {
				$this->error(400, 'Registration data unacceptable.', $errors);
			} else {
				$hash = $this->db->real_escape_string(Helpers::generateHash());
				$sql = 'INSERT INTO
						' . Settings::DB_PREFIX . 'users
						(
							password,
							email,
							approved,
							registration_time
						)
					VALUES
						(
							\'' . $dbsafe['password'] . '\',
							\'' . $dbsafe['e-mail'] . '\',
							\'' . $hash . '\',
							\'' . $this->output['timestamp'] . '\'
						)';
				$this->db->query($sql);
				$this->output['id'] = $this->db->insert_id;

				/*$mail = new htmlMimeMail5();
				$mail->setFrom(encodeMailHeader($_lang['registration_mail_from'], true));
				$mail->setSubject(encodeMailHeader($_lang['registration_mail_subject']));
				$mail->setText(sprintf($_lang['registration_mail_text'], $_settings['base_url'].'/?m=core&a=finishregistration&uh='.urlencode($_data_in['user_approved'])));
				$mail->setHTML(sprintf($_lang['registration_mail_html'], $_settings['base_url'].'/?m=core&amp;a=finishregistration&amp;uh='.urlencode($_data_in['user_approved'])));
				$mail->setSMTPParams($_settings['smtp_server'], $_settings['smtp_port'], '', true, $_settings['smtp_user'], $_settings['smtp_pwd']);
				$mail->setTextCharset('utf-8');
				$mail->setHTMLCharset('utf-8');
				$mail->send(array($_POST['f_user_email_1']));
				$_data_out['title'] = 'afterRegistrationTitle';
				require($_settings['templates_directory'].'/core/after_registration.php');*/
				$this->outputJSON();
			}
		} else {
			$this->error(400, 'JSON malformed.');
		}
	}

	function login() {
		$this->output->method = 'login';
		$this->outputJSON();
	}

	function logout() {
		$this->output->method = 'logout';
		$this->outputJSON();
	}
}
