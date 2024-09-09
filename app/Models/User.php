<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'dob',
        'gender',
        'notification_enable',
        'school_id',
        'teacher_id',
        'grade_id',
        'image',
        'address',
        'fcm_token',
        'language',
        'android'

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //getImageAttribute
    public function getImageAttribute($value)
    {
        return $value ? asset('images/profile/' . $value) : asset('images/profile/default.webp');
    }
    //getUserDetail
    public function getUserDetail($id)
    {
        return User::query()->where('id', $id)->first();
    }
    //getGradeDetail
    public function getGradeDetail($id)
    {
        return Grade::query()->where('id', $id)->first();
    }
    //aboutChild
    public function aboutChild()
    {
        return $this->hasOne(AboutChild::class, 'parent_id', 'id');
    }

    //activities
    public function activities()
    {
        return $this->hasMany(ActivityForParent::class, 'parent_id', 'id');
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class, 'chat_user');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    //grade
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    //teacherPermission
    public function teacherPermission()
    {
        return $this->hasOne(TeacherPermission::class, 'teacher_id', 'id');
    }

    //parentBalance
    public static function parentBalance($user)
    {
        $finance = Finance::query()->where('parent_id', $user->id)->get();
        $totalAmount = $finance->sum('amount');
        $paidAmount = $finance->sum('pay');
        $finalBalance = $totalAmount - $paidAmount;
        return $finalBalance ?? 0;
    }

}
