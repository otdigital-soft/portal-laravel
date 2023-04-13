<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class ReferralTreeService
{
    public function getReferralTree(User $user): Collection
    {
        $hierarchicalData = collect();

        if (!empty($user->referrer)) {
            $parent = $user->referral;
            $hierarchicalData->push([
                'user' => $parent,
                'children' => $this->addChildrenToHierarchy($parent),
            ]);
        } else {
            $hierarchicalData->push([
                'user' => $user,
                'children' => $this->addChildrenToHierarchy($user),
            ]);
        }

        return $hierarchicalData;
    }

    private function addChildrenToHierarchy(User $user): Collection
    {
        $children = $user->children;
        $hierarchyNodes = collect();

        foreach ($children as $child) {
            $childNode = [
                'user' => $child,
                'children' => $this->addChildrenToHierarchy($child),
            ];

            $hierarchyNodes->push($childNode);
        }

        return $hierarchyNodes;
    }
}
