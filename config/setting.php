<?php
return[
    'pages'=>10,

    'passport' => [
        'client_id' => env('CLIENT_ID', 4),
        'client_secret' => env('CLIENT_SECRET', ' pvPIXdqIUss3Fi9P8FjuD7I7gHv56V0jDg4h1NTO'),
        'scope' => env('SCOPE', '*'),
        'grant_type' => env('GRANT_TYPE', 'password'),
    ]
];