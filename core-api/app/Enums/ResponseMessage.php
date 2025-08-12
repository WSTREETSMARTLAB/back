<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum ResponseMessage: string
{
    use BaseEnum;

    // error
    case HTTP_NOT_FOUND = 'Route not found';
    case UNAUTHORIZED = 'Unauthorized';
    case FORBIDDEN = 'Forbidden';
    case VALIDATION_ERROR = 'The given data was invalid';
    case NOT_FOUND = 'Resource not found';
    case METHOD_NOT_ALLOWED = 'Method not allowed';
    case TOO_MANY_REQUESTS = 'Too many requests';
    case QUERY_EXCEPTION = 'Database query error';
    case SERVER_ERROR = 'Internal server error';

    // success

    case LOGIN_SUCCESS = 'Login successful';
    case REGISTER_SUCCESS = 'Registration successful';
    case LOGOUT_SUCCESS = 'Logout successful';
    case AUTH_SUCCESS = 'Authorization success';
    case STORE_SUCCESS = 'Data successfully stored';
    case UPDATE_SUCCESS = 'Data successfully updated';
    case DELETE_SUCCESS = 'Data successfully deleted';
    case VERIFICATION_SUCCESS = 'Verification successful';
    case CODE_SENT_TO_EMAIL = 'Verification code sent to email';
}
