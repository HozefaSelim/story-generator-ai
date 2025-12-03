<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
    ],

    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
    ],

    'stability' => [
        'api_key' => env('STABILITY_API_KEY'),
    ],

    // AI Agents Configuration
    'ai_agents' => [
        'text' => [
            'openai_gpt4' => [
                'name' => 'OpenAI GPT-4',
                'description' => 'Best quality storytelling',
                'model' => 'gpt-4',
                'icon' => '🤖',
                'provider' => 'openai',
            ],
            'openai_gpt4o' => [
                'name' => 'OpenAI GPT-4o',
                'description' => 'Fast & multimodal',
                'model' => 'gpt-4o',
                'icon' => '🚀',
                'provider' => 'openai',
            ],
            'gemini_flash' => [
                'name' => 'Gemini 1.5 Flash',
                'description' => 'Google AI - Fast',
                'model' => 'gemini-1.5-flash',
                'icon' => '💎',
                'provider' => 'gemini',
            ],
        ],
        'image' => [
            'dalle3' => [
                'name' => 'DALL-E 3',
                'description' => 'OpenAI - Best quality',
                'model' => 'dall-e-3',
                'icon' => '🎨',
                'provider' => 'openai',
            ],
            'stability_core' => [
                'name' => 'Stable Image Core',
                'description' => 'Stability AI - Fast',
                'model' => 'core',
                'icon' => '🌟',
                'provider' => 'stability',
            ],
            'stability_sd3' => [
                'name' => 'Stable Diffusion 3',
                'description' => 'Stability AI - HD',
                'model' => 'sd3-large',
                'icon' => '✨',
                'provider' => 'stability',
            ],
        ],
        'voice' => [
            'openai_tts' => [
                'name' => 'OpenAI TTS',
                'description' => 'Standard quality',
                'model' => 'tts-1',
                'icon' => '🎙️',
                'provider' => 'openai',
            ],
            'openai_tts_hd' => [
                'name' => 'OpenAI TTS HD',
                'description' => 'Higher quality audio',
                'model' => 'tts-1-hd',
                'icon' => '🎵',
                'provider' => 'openai',
            ],
        ],
    ],

];
