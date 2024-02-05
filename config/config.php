<?php

return [
    'gateway' => env('KUDISMS_GATEWAY', 2),
    'api_key' => env('KUDISMS_API_KEY', ''),
    'sender_id' => env('KUDISMS_SENDER_ID'),
    'caller_id' => env('KUDISMS_CALLER_ID', env('KUDISMS_SENDER_ID')),
    'test_numbers' => env('KUDISMS_TEST_NUMBERS', ''),
];
