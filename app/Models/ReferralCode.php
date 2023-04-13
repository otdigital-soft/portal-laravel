<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'user_id', 'status', 'expired', 'redeemer', 'verified', 'expected_invitee'];

    protected $table = 'referral_codes';

    public static function isInValid($code)
    {
        $referralCode = self::where('code', $code)->first();

        if (!$referralCode) {
            return true;
        }

        return false;
    }

    public static function isValid($code)
    {
        $referralCode = self::where('code', $code)->first();

        //check if has expired or has been used
        if ($referralCode->expired || $referralCode->status) {
            return false;
        }

        return true;
    }

    public static function redeemCode($code, $redeemer)
    {
        $code = self::where('code', $code)->first();
        $code->status = true;
        $code->redeemer = $redeemer;
        $code->update();
    }

    public function invitee()
    {
        return $this->belongsTo(User::class, 'redeemer');
    }
}
