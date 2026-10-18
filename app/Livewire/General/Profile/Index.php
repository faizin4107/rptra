<?php

namespace App\Livewire\General\Profile;

use App\Livewire\Forms\General\Profile\ProfileForm;
use App\Models\Dpjp;
use App\Models\Residen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use Interactions;
    public ?ProfileForm $form = null;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new ProfileForm($this, 'form');
        }
    }

    public function update()
    {
        // dd($this->form->password_confirmation);
        $this->form->validateCreate();
        $check = false;
        $role = '';
        $id = '';
        if (Auth::guard('residen')->check()) {
            $check = true;
            $role = 'residen';
            $id = Auth::guard('residen')->user()->id;
        }else if (Auth::guard('dpjp')->check()) {
            $check = true;
            $role = 'dpjp';
            $id = Auth::guard('dpjp')->user()->id;
        }
        if(!$check){
            $this->toast()->error('Gagal!', 'Sesi tidak valid.')->send();
            return;
        }
        if($role === 'residen'){
            //  if (!Hash::check($this->form->old_password, $this->form->old_password)) {
            //     throw ValidationException::withMessages([
            //         'old_password' => 'Password lama yang Anda masukkan salah.',
            //     ]);
            // }
            if(!Auth::guard('residen')->attempt(['id' => Auth::guard('residen')->user()->id, 'password' =>$this->form->old_password])){
                $this->toast()->error('Gagal!', 'Password lama salah, masukkan password yang benar')->send();
                return;
            }
        }else if($role === 'dpjp'){
            if(!Auth::guard('dpjp')->attempt(['id' => Auth::guard('dpjp')->user()->id, 'password' =>$this->form->old_password])){
                $this->toast()->error('Gagal!', 'Password lama salah, masukkan password yang benar')->send();
                return;
            }
        }
        
        if($role === 'residen'){
            \App\Models\User::where('id', $id)->update([
                'password' => Hash::make($this->form->new_password),
            ]);
        }else if($role === 'dpjp'){
            \App\Models\User::where('id', $id)->update([
                'password' => Hash::make($this->form->new_password),
            ]);
        }

        $this->form->reset();
        $this->toast()->success('Berhasil!', 'Data berhasil diperbarui.')->send();
        

    }
    public function render()
    {
        if (Auth::guard('residen')->check()) {
            $user = Residen::where('id', Auth::guard('residen')->user()->id)->first();
        }else if(Auth::guard('dpjp')->check()){
            $user = Dpjp::where('id', Auth::guard('dpjp')->user()->id)->first();
        }
        return view('livewire.general.profile.index', compact('user'));
    }
}
