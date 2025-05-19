<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../Assets/Images/LogoSmall.png">
  <title>Chess Platform</title>

  <link rel="stylesheet" href="../Style/output.css">
  <script type="module" src="../src/js/game/Main.js"></script>
</head>

<body class="bg-[#302E2B] min-h-screen" mode="local">
  <!-- Chess.com-like Navbar -->
  <nav class="w-full bg-[#262522] px-4 py-3 flex justify-between items-center top-0 left-0">
    <div class="flex items-center">
      <!-- Logo -->
      <div class="flex items-center ml">
        <img src="../Assets/Images/LogoSmall.png" alt="Logo" class="h-8 w-auto">
      </div>
      <!-- Navigation Links (Chess.com style) -->
      <div class=" hidden md:flex ml-6 space-x-4">
        <p class="text-white text-sm font-medium">Skibidichess - SinglePlayer</p>
      </div>
      <div class=" flex md:hidden ml-6 space-x-4">
        <p class="text-white text-sm font-medium">SinglePlayer</p>
      </div>
    </div>

    <!-- Right Side Controls -->
    <div class="flex items-center space-x-3">
      <!-- User Profile -->
      <div class="flex items-center mr-2">
        <p class="text-white">
          <?php

          use Skibidi\SessionChecker;

          require '../Backend/SessionChecker.php';
          $sessionChecker = new SessionChecker();
          if ($sessionChecker->checkSession()) {
            $username = $_SESSION['user']['username'];
            $admin = $sessionChecker->checkAdmin();
          } else {
            $username = "Guest";
            $admin = 0;
          }

          echo $username;
          ?>
        </p>
        <div class="h-8 w-8 rounded-full overflow-hidden bg-gray-700 border border-gray-600 ml-2">
          <img src="../Assets/Images/ImgPlaceholder.jpg" alt="Profile" class="h-full w-full object-cover">
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="md:px-4 lg:px-8 lg:max-w-[90%] md:max-w-[85%] max-w-[95%] mx-auto">
    <!-- Chess.com style layout with board on left, info right -->
    <div class="flex flex-col md:flex-row md:items-start gap-4 mt-2">
      <!-- Left Column - Chess Board -->
      <div class="md:w-auto md:flex-shrink-0">
        <!-- Board & Player Info -->
        <div class="bg-[#262522] rounded-md shadow-lg p-1 md:p-5">




          <!-- Top Player Info -->
          <div id="PlayerInfo" class="flex items-center h-10 m-1">
            <img src="../Assets/Images/ImgPlaceholder.jpg" id="PlayerImg" class="aspect-square w-8 rounded">
            <div class="ml-2 flex-1 h-10">

              <div class="flex justify-between items-center">
                <h2 id="PlayerName" class="text-neutral-50 font-bold text-[0.8rem]">Player SkibidiName</h2>
              </div>

              <div class="flex w-full h-[1.2rem]">
                <div class="flex flex-row h-full" id="b-captured-pieces"></div>
                <h2 id="b-Material-count" class="text-white invisible text-sm ml-2">+0</h2>
              </div>

            </div>
          </div>

          <!-- Chess Board -->
          <canvas id="ChessBoard" class="rounded shadow-md w-full mx-auto"></canvas>

          <!-- Bottom Player Info -->
          <div id="PlayerInfo" class="flex items-center h-10 mt-1">
            <img src="../Assets/Images/ImgPlaceholder.jpg" id="PlayerImg" class="aspect-square w-8 rounded">
            <div class="ml-2 flex-1 h-10 ">

              <div class="flex justify-between items-center">
                <h2 id="PlayerName" class="text-neutral-50 font-bold text-[0.8rem]">Player SkibidiName</h2>
              </div>

              <div class="flex  w-full h-[1.2rem] ">
                <div class="flex flex-row h-full" id="w-captured-pieces"></div>
                <h2 id="w-Material-count" class="text-white invisible text-sm ml-2">+0</h2>
              </div>
            </div>
          </div>

          <!-- Chess.com-like Action Buttons -->
          <div class="grid grid-cols-2 gap-2 mt-3">
            <button id="ReverseBoard" class="GreenBtn text-sm py-2 text-center" onclick="Reverseboard()">
              Flip Board
            </button>
            <button id="Suggestion" class="GreenBtn text-sm py-2 text-center" onclick="MoveSuggestion()">
              Hint
            </button>
          </div>
        </div>

        <!-- Promotion Panel -->
        <div id="Promote" class="flex flex-row border-black border-2 invisible bg-[#262522] rounded-md absolute">
          <button data-type="q"><img src="../Assets/Images/q1.svg"
              class="hover:scale-110 transition duration-150 w-12 h-12"></button>
          <button data-type="r"><img src="../Assets/Images/r1.svg"
              class="hover:scale-110 transition duration-150 w-12 h-12"></button>
          <button data-type="b"><img src="../Assets/Images/b1.svg"
              class="hover:scale-110 transition duration-150 w-12 h-12"></button>
          <button data-type="n"><img src="../Assets/Images/n1.svg"
              class="hover:scale-110 transition duration-150 w-12 h-12"></button>
        </div>
      </div>

      <!-- Right Column - Game Info & Rankings -->
      <div class="flex-1 flex flex-col space-y-4">
        <!-- Game Info and Leaderboard in Two Columns with Same Height -->
        <div class="flex flex-col md:flex-row gap-4">
          <!-- Game Info - Chess.com style -->
          <div id="GameInfo" class="bg-[#262522] rounded-md p-3 shadow-lg md:w-1/2 flex flex-col">
            <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Game Info</h2>

            <!-- Game Details -->
            <div class="space-y-2 mb-4">
              <div class="flex justify-between">
                <span class="text-[#7c776f]">Time Control:</span>
                <span class="text-white">10 min</span>
              </div>
              <div class="flex justify-between">
                <span class="text-[#7c776f]">Game Type:</span>
                <span class="text-white">Player VS Stockfish AI (Rapid)</span>
              </div>
            </div>

            <!-- Move History in Chess.com style -->
            <h3 class="text-white font-medium text-sm mb-2">Moves</h3>
            <div class="bg-[#1e1d1b] p-2 rounded flex-grow overflow-y-auto mb-3">
              <table class="w-full text-sm">
                <tbody>
                  <tr>
                    <td class="text-white pr-2">1.</td>
                    <td class="text-white pr-3">e4</td>
                    <td class="text-white">e5</td>
                  </tr>
                  <tr>
                    <td class="text-white pr-2">2.</td>
                    <td class="text-white pr-3">Nf3</td>
                    <td class="text-white">Nc6</td>
                  </tr>
                  <tr>
                    <td class="text-white pr-2">3.</td>
                    <td class="text-white pr-3">Bc4</td>
                    <td class="text-white">Nf6</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Additional Game Controls -->
            <div class="grid grid-cols-2 gap-2">
              <a href="./SinglePlayerSettings.html">
                <button class="GreenBtn text-sm py-2 w-full text-center">
                  New Game
                </button>
              </a>
              <a href="./index.php">
                <button class="GreenBtn text-sm py-2 w-full text-center">
                  Exit
                </button>
              </a>
            </div>
          </div>


        </div>


        <!-- Advertisement Space - Full width -->
        <div class="bg-[#262522] rounded-md p-3 shadow-lg mb-5">
          <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Sponsors</h2>
          <div class=" h-32 bg-[#1e1d1b] rounded-md flex items-center justify-center">
            <div class="text-center">
              <p class="text-[#7c776f]">Advertisement Space</p>
              <p class="text-[#7c776f] text-sm">Become a sponsor of Skibidichess</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>