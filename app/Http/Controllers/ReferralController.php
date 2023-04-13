<?php

namespace App\Http\Controllers;

use App\Models\ReferralCode;
use App\Models\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use App\Services\ReferralTreeService;

class ReferralController extends Controller
{
    public function index()
    {
        //return a user referral page.
        $refCodes = auth()->user()->codes()->paginate(10);
        // $hierarchicalData = $this->getReferralTree(auth()->user());
        $hierarchicalData = (new ReferralTreeService)->getReferralTree(auth()->user());
        // dd($hierarchicalData);
        return view('users.referrals.index', compact('refCodes', 'hierarchicalData'));
    }

    private function getReferralTree($user)
    {
        // Find the starting user
        $startUser = $user;

        // Find the starting user's direct parent
        $parentUser = $startUser->referral ?? $startUser;

        // Create an empty array to store the hierarchical data
        $hierarchicalData = [];

        // Add the starting user's parent to the top level of the hierarchy
        $hierarchicalData[] = [
            'user' => $parentUser,
            'children' => [],
        ];
        // Recursively add the children of the starting user's parent
        $this->addChildrenToHierarchy($parentUser, $hierarchicalData[0]);

        return $hierarchicalData;
    }

    private function addChildrenToHierarchy($user, &$hierarchyNode)
    {
        $children = $user->children;

        foreach ($children as $child) {
            $childNode = [
                'user' => $child,
                'children' => [],
            ];

            $hierarchyNode['children'][] = $childNode;

            $this->addChildrenToHierarchy($child, $childNode);
        }
    }

    public function generateCode(Request $request)
    {
        //check if the user hasn't generated up to 12 useful referral code.
        if ($request->user()->totalGeneratedCode() == 12) {
            return redirect()->back()->with('error', 'Sorry you cannot generate more than 12 invitation codes at this time.');
        }

        $expectedUser = $request->redeemer;
        //generate a random referral code.
        $refCode = \Hashids::encode(auth()->user()->id, $request->user()->totalGeneratedCode());

        //save the code
        ReferralCode::create([
            'code' => $refCode,
            'user_id' => auth()->user()->id,
            'status' => false,
            'expired' => false,
            'verified' => false,
            'expected_invitee' => $expectedUser
        ]);

        return redirect()->back()->with('success', 'Invitation Code Generated');
    }

    public function acceptInvitation($ref_code)
    {
        $code = ReferralCode::where('code', $ref_code)->with('invitee')->first();

        $redeemer = $code->invitee;
        $redeemer->status = 'verified';
        $redeemer->update();

        $code->verified = true;
        $code->update();

        return redirect()->back()->with('success', 'Invitation Accepted');
    }
}
