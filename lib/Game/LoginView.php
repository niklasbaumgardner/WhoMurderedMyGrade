<?php


namespace Game;


class LoginView extends View
{

    /**
     * Constructor
     * Sets the page title and any other settings.
     */
    public function __construct()
    {
        $this->setTitle("Game Login");
    }

    public function presentForm()
    {
        $wasError = isset($_GET["e"]);

        $html = <<<HTML
<form method="post" action="post/login.php">
    <fieldset>
        <legend>Login</legend>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="Email">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" placeholder="Password">
        </p>
        <p>
HTML;
        if ($wasError) {
            $html .= <<<HTML
THERE WAS AN ERROR<br>
HTML;
        }
        $html .= <<<HTML
            <input type="submit" value="Log in">
        </p>
        <p><a href="new_user.php">Create Account</a></p>
        <p><a href="./project2.html">Instructions</a></p>

    </fieldset>
</form>
HTML;

        return $html;
    }


}
