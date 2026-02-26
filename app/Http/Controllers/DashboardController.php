<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    /**
     * Show the help center page.
     */
    public function help()
    {
        $faqs = array_to_object(
            [
                [
                    'question' => 'How do I update my profile?',
                    'answer' => 'You can update your profile by clicking on the Profile menu on the sidebar or by clicking on your avatar on the top right corner and selecting Profile.',
                ],
                [
                    'question' => 'How do I change my password?',
                    'answer' => 'You can change your password in the same profile update page by clicking on the Update Password button.',
                ],
            ]
        );

        return view('other.help', [
            'faqs' => $faqs,
        ]);
    }

    /**
     * Show the settings page.
     */
    public function settings()
    {
        return view('other.settings');
    }
}
