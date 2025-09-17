<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ToggleTheme extends Component
{
    protected $listeners = ['setTheme'];

    public function toggleTheme(): void
    {
        $currentTheme = Session::get('theme', 'system');
        
        $themes = ['light', 'dark', 'system'];
        $currentIndex = array_search($currentTheme, $themes);
        $nextIndex = ($currentIndex + 1) % count($themes);
        $nextTheme = $themes[$nextIndex];
        
        Session::put('theme', $nextTheme);
        
        $this->dispatch('theme-changed', theme: $nextTheme);
    }

    public function setTheme(string $theme): void
    {
        $validThemes = ['light', 'dark', 'system'];
        
        if (in_array($theme, $validThemes)) {
            Session::put('theme', $theme);
            $this->dispatch('theme-changed', theme: $theme);
            
            // Also dispatch to JavaScript for immediate UI update
            $this->js("applyTheme('$theme')");
        }
    }

    public function render()
    {
        return view('livewire.actions.toggle-theme');
    }
}