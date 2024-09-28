<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIRequestLog extends Model
{
    use HasFactory;
    protected $table = 'api_request_logs';
    protected $fillable = [
        'method', 'controller_action', 'middleware', 'path', 'status', 
        'duration', 'ip_address', 'request_headers', 'response_headers', 
        'response_json', 'memory_usage', 'created_at'
    ];
    public $timestamps = 'false';
}
