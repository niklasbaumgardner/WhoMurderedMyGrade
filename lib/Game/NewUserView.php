<?php


namespace Game;


class NewUserView extends View
{

    const NO_EMAIL = 1;
    const EMAIL_EXISTS = 2;

    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct(Site $site, array $get)
    {
        $this->setTitle("New Account Setup");

        if (array_key_exists('e', $get)) {
            switch(strip_tags($get['e'])) {
                case self::NO_EMAIL:
                    $this->error = "Email address not entered.";
                    break;

                case self::EMAIL_EXISTS:
                    $this->error = "Email already exists. Choose a new email or login.";
                    break;
            }
        }
    }

    public function presentForm()
    {
        $err = $this->error;

        $html = <<<HTML
<form method="post" action="post/newuser.php">
    <fieldset>
        <legend>Create Account</legend>
        <p>Enter your name and email address and we will send you a link to confirm your account and setup your password.</p>
        <p style="color:red">$err</p>
        <p>
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" placeholder="Name"><br><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email"><br><br>
            <input type="submit" id="ok" name="ok" value="Create">
        </p>
        <p><a href="login.php">Login</a></p>
    </fieldset>
</form>
HTML;

        return $html;
    }

    private $error = "";
}