<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InvitationLinks extends Component
{
    public $invitationLinks;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($invitationLinks)
    {
        $this->invitationLinks = $invitationLinks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.invitation-links', [
            'invitationLinks' => $this->invitationLinks,
        ]);
    }
}
