<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Jobs\QueuedPasswordResetJob;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements JWTSubject
{ 
    use HasApiTokens; 
    use HasFactory;
    use Notifiable;
    use HasRoles;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function sendPasswordResetNotification($token)

    {
        $this->reset_password_token = $token;
        $this->token_expired_at = now()->addHours(24);
        $this->save();

        Log::info("this is password resset token");
        Log::info($token);
     
        
        // dispactches the job to the queue passing it this User object
        QueuedPasswordResetJob::dispatch($this,$token);
    }
   
}
