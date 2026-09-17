<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Generate (or reuse) the random captcha string for this session and
     * stash it so store() can verify what the visitor typed.
     */
    public static function captchaCode(Request $request): string
    {
        if (! $request->session()->has('contact_captcha')) {
            $request->session()->put(
                'contact_captcha',
                self::randomCaptchaString()
            );
        }

        return $request->session()->get('contact_captcha');
    }

    private static function randomCaptchaString(): string
    {
        // Avoids visually ambiguous characters (0/O, 1/I/l).
        $alphabet = 'abcdefghjkmnpqrstuvwxyz23456789';

        return collect(range(1, 5))
            ->map(fn () => $alphabet[random_int(0, strlen($alphabet) - 1)])
            ->implode('');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'mobile' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
            'captcha' => ['required', 'string'],
        ], [
            'captcha.required' => 'Please type the characters shown.',
        ]);

        $expected = $request->session()->get('contact_captcha', '');
        // The captcha is consumed on every attempt (right or wrong) so a
        // stale/guessed code can't be replayed.
        $request->session()->forget('contact_captcha');

        if (! hash_equals(strtolower($expected), strtolower($validated['captcha']))) {
            return back()
                ->withInput($request->except(['captcha']))
                ->withErrors(['captcha' => 'The characters you typed did not match. Please try again.']);
        }

        ContactSubmission::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'mobile' => $validated['mobile'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        return back()->with('contact_success', true);
    }
}
