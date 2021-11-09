<?php
return [
    "/auth/login" => [
        "post" => [
            "tags" => [
                "Auth"
            ],
            "security" => [],
            "parameters" => [],
            "summary" => "Login",
            "operationId" => "postAuthLogin",
            "parameters" => [
                [
                    "name" => "email",
                    "in" => "query",
                    "required" => true,
                    "description" => "Email",
                    "schema" => [
                        "type" => "string",
                    ]
                ],
                [
                    "name" => "password",
                    "in" => "query",
                    "required" => true,
                    "description" => "Password",
                    "schema" => [
                        "type" => "string",
                    ]
                ],
            ],
            "responses" => [
                "200" => [
                    "description" => "[ 'status'=>true, 'message'=>null, 'data'=>[] ]"
                ],
                "401" => [
                    "description" => "[ 'status'=>false, 'message'=>'Invalid token', 'data'=>[] ]"
                ]
            ]
        ]
    ],
    "/auth" => [
        "get" => [
            "tags" => [
                "Auth"
            ],
            "security" => [
                [
                    "bearerAuth" => []
                ]
            ],
            "parameters" => [],
            "summary" => "Get user login",
            "operationId" => "getAuth",
            "responses" => [
                "200" => [
                    "description" => "[ 'status'=>true, 'message'=>null, 'data'=>[] ]"
                ],
                "401" => [
                    "description" => "[ 'status'=>false, 'message'=>'Invalid token', 'data'=>[] ]"
                ]
            ],
        ]
    ],
    "/user" => [
        "get" => [
            "tags" => [
                "Users"
            ],
            "security" => [
                [
                    "bearerAuth" => []
                ]
            ],
            "parameters" => [],
            "summary" => "Get list user",
            "operationId" => "getUserList",
            "responses" => [
                "200" => [
                    "description" => "[ 'status'=>true, 'message'=>null, 'data'=>[] ]"
                ],
                "401" => [
                    "description" => "[ 'status'=>false, 'message'=>'Invalid token', 'data'=>[] ]"
                ]
            ],
        ]
    ],
    "/user/{userId}" => [
        "get" => [
            "tags" => [
                "Users"
            ],
            "security" => [
                [
                    "bearerAuth" => []
                ]
            ],
            "summary" => "Find user by ID",
            "operationId" => "getUserById",
            "parameters" => [
                [
                    "name" => "userId",
                    "in" => "path",
                    "required" => true,
                    "description" => "ID of user to return",
                    "schema" => [
                        "type" => "integer",
                        "format" => "int64"
                    ]
                ]
            ],
            "responses" => [
                "200" => [
                    "description" => "[ 'status'=>true, 'message'=>null, 'data'=>[] ]"
                ],
                "401" => [
                    "description" => "[ 'status'=>false, 'message'=>'Invalid token', 'data'=>[] ]"
                ]
            ],
        ]
    ],
];
