<?php

require __DIR__ . '/lib/game.inc.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Who Murdered My Grade?</title>
    <link href="lib/game.css" rel="stylesheet" />
</head>
<body>

    <form method="post" action="player_selector.php">
        <p><input type="submit" name="ng" value="Back to Game"></p>
    </form>

    <header>
        <h1>Who Murdered My Grade?</h1>
    </header>

    <h4>Instructions on how to play the game!</h4>
    <br>
    <div class="paragraph">
        <div class="p">
            <p>Who Murdered my Grade is a game for two to six players. The game will be played on a single computer. The First step will be to choose at Least 2 Players. There are 21 cards: 6 suspect cards, 6 weapon cards, and 9 location cards. The system selects one of each as the murderer, weapon, and location. The remaining cards are dealt to the players, with a maximum of 6 cards per player. If there are two players, each player gets 6 cards and the computer holds 6.</p>
        </div>
        <div class="p1">
            <p>Following the Player selection, the next few pages will represent each player and their cards. The top cards are the ones that have been dealt to this player. The other cards are the secret cards, the ones held by other players, and any held by the computer. Each of these cards is assigned a word. The words are different for each player. The player keeps their printed card sheet secret. The computer will use your code word to communicate a card to you in response to a suggestion. The process repeats for each player. Each player prints their cards sheet. Then the game board is presented.</p>
        </div>
        <div class="p2">
            <p>For Example: It is Prof. Owen's turn. Two dice has been rolled and are showing a 7. The Prof. Owen playing piece is in the board location labeled "Start Prof. Owen." Prof has two options at that point: The piece can be moved exactly 7 squares. The rules for movement are that a path must only move horizontally or vertically from each square. You cannot move diagonally. You cannot move through the same square more than once in a turn. You cannot land or move through a square occupied by another piece. An exact count is not required to move into a room and special rules apply for moving into and out of a room. The game should indicate all possible places the piece can be moved. I have highlighed them with green in the game prototype. Clicking on any of these squares moves the piece to that square.</p>
        </div>
        <div class="p3">
            <p>Now on Prof. Plum turn: Not only does that 10 yield a large number of possible moves, it can reach the Engineering Building. Pieces can only enter a room though the openings, as seen on the game board. An exact count is not required to enter a room. By clicking in the Engineering Building, Prof. Plum moves into the building. Once a player enters a room, they have three choices: Pass, ending the turn. Make a suggestion. Make an accusation. Making a suggestion and an accusation are the same process, just different outcomes. If Prof Plum chooses to make a suggestion, he is presented with the possible suspects.</p>
        </div>
        <div class="p4">
            <p>Select one suspect. Suppose Prof. Plum selects Prof. McCullen and clicks Go. This is saying "I think the murderer was Prof. McCullen". The suspect is moved into the room. In this case Prof. McCullen's piece is moved into the Engineering Building. It does not matter if someone is playing Prof. McCullen or not. The piece is moved. Then the player must choose a weapon from the six possible options. Suppose he chooses Project. Prof. Plum has just made an accusation that Prof. McMullen did it in the Engineering Building (the building they are in) using the Project. The Prof. Plum player looks at their sheet. They see the word 'blowhole' is under the card for Engineering Building. That player now knows that the crime could not have taken place in the Engineering building.</p>
        </div>
        <div class="p5">
            <p>The word that is shown is for some one of the three parts of the suggestion that are being held by another player or the computer and are not part of the secret. If no such card exists, the system says "I got nothing". Note that this does not imply that the player has found the secret! It could be that Prof. Plum is holding the Project and/or Prof. McCullen cards. Of course, other players have no way of knowing that. When Go is clicked, we move to the next player's turn. An accusation gets one of two responses: if the player got the accusation right, the player wins and the game is over. If the player got it wrong, that player continues to play, but can no longer make accusations, only suggestions! Effectively, that player has lost.</p>
        </div>
        <div class="p6">
            <p>Special Rules when in Rooms: When a player is in a room, they can do any of these options when the die is thrown and it is their turn: They can exit (one step) and move to a new square or another room. They can stay in the room they are in by clicking on the room. There are secret passages on the board. If the player is in the Wharton Center, there is a secret passage to Beaumont Tower. The player can click on Beaumont tower to jump directly to it. Multiple players can be in a room. Staying in a room is just like entering the room. The player can make another suggestion or accusation.</p>
        </div>
        <div class="p7">
            <p>Have Fun!</p>
        </div>


    </div>

</body>
</html>
