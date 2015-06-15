<?php

class CoreModule extends PortalerModule {
	function register() {
	
		/*global $_settings, $_lang, $_data_in, $_data_out;
		$_data_in['user_name'] = mysql_real_escape_string($_POST['f_user_name']);
		$_data_in['user_pwd'] = mysql_real_escape_string(makePassword($_POST['f_user_name'], $_POST['f_user_pwd_1']));
		$_data_in['user_email'] = mysql_real_escape_string($_POST['f_user_email_1']);
		if (preg_match('/^[ \t\n\r]*$/i', $_POST['f_user_name'])) {
			$_data_out['error'][] = 'errNameEmpty';
		}
		if (strlen($_POST['f_user_name']) < $_settings['min_nick_length']) {
			$_data_out['error'][] = 'errNameTooShort';
		}
		if (strlen($_POST['f_user_name']) > $_settings['max_nick_length']) {
			$_data_out['error'][] = 'errNameTooLong';
		}
		if (!preg_match($_settings['valid_nickname'], $_POST['f_user_name'])) {
			$_data_out['error'][] = 'errNameWrongChars';
		}
		$sql = 'SELECT
				id
			FROM
				'.$_settings['db_prefix'].'users
			WHERE
				UCASE(nick)=\''.strtoupper($_data_in['user_name']).'\'
			LIMIT 1';
		$res = mysql_query($sql);
		if ($rec = mysql_fetch_assoc($res)) {
			$_data_out['error'][] = 'errNameAlreadyExists';
		}
		if ($_POST['f_user_pwd_1'] == $_POST['f_user_name']) {
			$_data_out['error'][] = 'errPasswordSameAsName';
		}
		if ($_POST['f_user_pwd_1'] != $_POST['f_user_pwd_2']) {
			$_data_out['error'][] = 'errPasswordMismatch';
		}
		if (preg_match('/^[ \t\n\r]*$/i', $_POST['f_user_pwd_1'])) {
			$_data_out['error'][] = 'errPasswordEmpty';
		}
		if (strlen($_POST['f_user_pwd_1']) < $_settings['min_password_length']) {
			$_data_out['error'][] = 'errPasswordTooShort';
		}
		if (strlen($_POST['f_user_pwd_1']) > $_settings['max_password_length']) {
			$_data_out['error'][] = 'errPasswordTooLong';
		}
		if (preg_match('/^[ \t\n\r]*$/i', $_POST['f_user_email_1'])) {
			$_data_out['error'][] = 'errEMailEmpty';
		}
		if ($_POST['f_user_email_1'] != $_POST['f_user_email_2']) {
			$_data_out['error'][] = 'errEMailMismatch';
		}
		if (!isValidEMail($_POST['f_user_email_1'])) {
			$_data_out['error'][] = 'errEMailWrongFormat';
		}
		$sql = 'SELECT
				id
			FROM
				'.$_settings['db_prefix'].'users
			WHERE
				UCASE(email)=\''.strtoupper($_data_in['user_email']).'\'
			LIMIT 1';
		$res = mysql_query($sql);
		if ($rec = mysql_fetch_assoc($res)) {
			$_data_out['error'][] = 'errEMailAlreadyExists';
		}
		if (!useToken($_POST['token'])) {
			$_data_out['error'][] = 'errInvalidToken';
		}
		if (!isset($_data_out['error'])) {
			$_data_in['user_approved'] = mysql_real_escape_string(generateHash());
			$sql = 'INSERT INTO
					'.$_settings['db_prefix'].'users
					(
						nick,
						pwd,
						email,
						approved,
						registration_time
					)
				VALUES
					(
						\''.$_data_in['user_name'].'\',
						\''.$_data_in['user_pwd'].'\',
						\''.$_data_in['user_email'].'\',
						\''.$_data_in['user_approved'].'\',
						\''.$_settings['time'].'\'
					)';
			mysql_query($sql);
			$mail = new htmlMimeMail5();
			$mail->setFrom(encodeMailHeader($_lang['registration_mail_from'], true));
			$mail->setSubject(encodeMailHeader($_lang['registration_mail_subject']));
			$mail->setText(sprintf($_lang['registration_mail_text'], $_settings['base_url'].'/?m=core&a=finishregistration&uh='.urlencode($_data_in['user_approved'])));
			$mail->setHTML(sprintf($_lang['registration_mail_html'], $_settings['base_url'].'/?m=core&amp;a=finishregistration&amp;uh='.urlencode($_data_in['user_approved'])));
			$mail->setSMTPParams($_settings['smtp_server'], $_settings['smtp_port'], '', true, $_settings['smtp_user'], $_settings['smtp_pwd']);
			$mail->setTextCharset('utf-8');
			$mail->setHTMLCharset('utf-8');
			$mail->send(array($_POST['f_user_email_1']));
			$_data_out['title'] = 'afterRegistrationTitle';
			require($_settings['templates_directory'].'/core/after_registration.php');
		} else {
			coreRegistrationForm();
		}
		*/
		$this->output->method = 'register';
		$this->outputJSON();
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
