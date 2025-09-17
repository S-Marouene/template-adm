<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SetLanguage extends Component
{
    protected $listeners = ['setLanguage'];

    public function setLanguage(string $locale): void
    {
        // Validate the locale
        $availableLocales = ['en', 'fr', 'es', 'ar']; // Add more as needed
        
        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
            app()->setLocale($locale);
            
            // Update HTML direction for RTL languages
            if ($locale === 'ar') {
                $this->js('document.documentElement.setAttribute("dir", "rtl")');
            } else {
                $this->js('document.documentElement.setAttribute("dir", "ltr")');
            }
            
            // Refresh the page to apply the new language
            $this->js('window.location.reload()');
        }
    }

    public function render()
    {
        return view('livewire.actions.set-language');
    }
}