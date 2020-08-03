<?php


namespace Game;


class UsersView extends View
{
    public function __construct($site)
    {
        $this->site = $site;

    }

    public function present() {
        $html = <<<HTML
<form class="table" action="post/users.php" method="post">
	<p>
	<input type="submit" name="add" id="add" value="Add">
	<input type="submit" name="edit" id="edit" value="Edit">
	<input type="submit" name="delete" id="delete" value="Delete">
	</p>

	<table>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
HTML;
        $users = new Users($this->site);
        $all = $users->getUsers();
        foreach($all as $user) {
            $name = $user['name'];
            $email = $user['email'];
            $role = $user['role'];
            $id = $user['id'];

            if ($role == User::ADMIN) {
                $role = "Admin";
            }
            if ($role == User::STAFF) {
                $role = "Staff";
            }
            if ($role == User::CLIENT) {
                $role = "Client";
            }

            $html .= <<<HTML
		<tr>
			<td><input type="radio" id="user" name="user" value="$id"></td>
			<td>$name</td>
			<td>$email</td>
			<td>$role</td>
		</tr>
HTML;
        }
        $html .= <<<HTML
	</table>
</form>
HTML;

        return $html;
    }

    private $site;




}