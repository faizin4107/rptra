<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class Captcha extends Component
{
    public $captchaUrl;

    public function mount()
    {
        $this->refreshCaptcha();
    }

    #[On('reset-captcha')] 
    public function refreshCaptcha()
    {
        $captcha_code = rand(1000, 9999);
        Session::put('captcha_code', $captcha_code);

        // Jika menggunakan metode Base64 (Saran sebelumnya agar tidak error 500)
        $this->captchaUrl = $this->generateBase64Image($captcha_code);
        
        // Jika tetap menggunakan Route:
        // $this->captchaUrl = route('captcha.image') . '?t=' . time();
    }

    private function generateBase64Image($code)
    {
        $width = 120;
        $height = 50;
        $image = \imagecreatetruecolor($width, $height);
        
        $white = \imagecolorallocate($image, 255, 255, 255);
        $indigo = imagecolorallocate($image, 79, 70, 229);
        $slate = imagecolorallocate($image, 241, 245, 249);
        
        imagefilledrectangle($image, 0, 0, $width, $height, $slate);
        
        for ($i = 0; $i < 3; $i++) {
            imageline($image, 0, rand(0, 50), 120, rand(0, 50), $white);
        }
        
        // Pastikan font tersedia atau gunakan imagestring
        imagestring($image, 5, 40, 18, $code, $indigo);

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        // Return format base64 untuk src <img>
        return 'data:image/png;base64,' . base64_encode($imageData);
    }

    public function render()
    {
        return view('livewire.utils.captcha');
    }
}