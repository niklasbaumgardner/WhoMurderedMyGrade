<?php


namespace Game;


class View
{

    /**
     * Create the HTML for the page footer
     * @return string HTML for the standard page footer
     */
    public function footer()
    {
        return <<<HTML
<footer><p>Copyright © 2019 Felis Investigations, Inc. All rights reserved.</p></footer>
HTML;
    }

    /**
     * Set the page title
     * @param $title New page title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Create the HTML for the contents of the head tag
     * @return string HTML for the page head
     */
    public function head() {
        return <<<HTML
<meta charset="utf-8">
<title>$this->title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="lib/game.css">
HTML;
    }

    /**
     * Create the HTML for the page header
     * @return string HTML for the standard page header
     */
    /**
     * Create the HTML for the page header
     * @return string HTML for the standard page header
     */
    public function header() {
        $html = <<<HTML
HTML;
        if(count($this->links) > 0) {
//            $html .= '<ul class="right">';
            foreach($this->links as $link) {
                $html .= '<a href="' .
                    $link['href'] . '">' .
                    $link['text'] . '</a>';
            }
//            $html .= '</ul>';
        }
        $additional = $this->headerAdditional();

        $html .= <<<HTML
<!--</nav>-->
HTML;
        return $html;
    }

    /**
     * Add a link that will appear on the nav bar
     * @param $href What to link to
     * @param $text
     */
    public function addLink($href, $text) {
        $this->links[] = ["href" => $href, "text" => $text];
    }

    protected function headerAdditional() {
        return "";
    }


    /**
     * Protect a page for staff only access
     *
     * If access is denied, call getProtectRedirect
     * for the redirect page
     * @param $site The Site object
     * @param $user The current User object
     * @return bool true if page is accessible
     */
    public function protect($site, $user) {
//        if($user->isStaff()) {
//            return true;
//        }

        if($user) {
            return true;
        }

        $this->protectRedirect = $site->getRoot() . "/";
        return false;
    }

    /**
     * Get any redirect page
     */
    public function getProtectRedirect() {
        return $this->protectRedirect;
    }


    /// Page protection redirect
    private $protectRedirect = null;
    private $title = "";	// The page title
    private $links = [];	// Links to add to the nav bar
}