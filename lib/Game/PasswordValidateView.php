<?php


namespace Game;


class PasswordValidateView extends View
{
    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, $get) {
        $this->site = $site;
        $this->setTitle("Felis Password Entry");
        $this->validator = strip_tags($get['v']);
        if(isset($get['e'])) {
            $err = strip_tags($get['e']);
            $this->displayError = true;
            if($err == "error_validator") {
                $this->errorMes = "Invalid or unavailable validator";
            }
            else if($err == "error_user") {
                $this->errorMes = "Email address is not for a valid user";
            }
            else if($err == "error_email") {
                $this->errorMes = "Email address does not match validator";
            }
            else if($err == "error_password_match") {
                $this->errorMes = "Passwords did not match";
            }
            else if($err == "error_password_short") {
                $this->errorMes = "Password too short";
            }
        }

    }

    public function present() {
        $html = <<<HTML
<form method="post" action="post/password-validate.php">
	<fieldset>
	<input type="hidden" name="validator" value="$this->validator">
		<legend>Change Password</legend>
		<p>
			<label for="email">Email</label><br>
			<input type="email" id="email" name="email" placeholder="Email">
		</p>
		<p>
			<label for="password">Password</label><br>
			<input type="text" id="password" name="password" placeholder="password">
		</p>
		<p>
			<label for="password_again">Password (again)</label><br>
			<input type="text" id="password2" name="password2" placeholder="password">
		</p>
		<p>
			<input type="submit" name="ok" id="ok" value="OK"> <input type="submit" value="Cancel">
		</p>

	</fieldset>
</form>
HTML;

        return $html;
    }

    public function display_error() {
        $html = "";
        if($this->displayError) {
            $html .= "<p>$this->errorMes</p>";
        }
        return $html;
    }

    private $site;
    private $validator;
    private $errorMes;
    private $displayError = false;
}