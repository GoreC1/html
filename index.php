<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<?php
include 'config.php';


// $request = $_SERVER['REQUEST_URI'];

// switch ($request) {
//     case '/' :
//         require __DIR__ . '/index.php';
//         break;
//     case '' :
//         require __DIR__ . '/index.php';
//         break;    
//     case '/passengers' :
//         require __DIR__ . '/passengers.php';
//         break;
//     case '/soldTickets' :
//         require __DIR__ . '/soldTickets.php';
//         break;
//     case '/flights' :
//         require __DIR__ . '/flights.php';
//         break;    
//     default:
//         http_response_code(404);
//         require __DIR__ . '/views/404.php';
//         break;
// }
?>    
<a href="passengers.php">Passengers</a>
<a href="flights.php">Flights</a>
<a href="soldTickets.php">Sold tickets</a>
<a href="queries.php">Queries</a>

</body>
</html>
