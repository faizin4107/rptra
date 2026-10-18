<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\RegisterForm;
use App\Models\Dpjp;
use App\Models\Residen;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use TallStackUi\Traits\Interactions;
// use TallStackUi\Traits\InteractsWithDialog;

#[Layout('layouts.guest')] 
class Register extends Component
{
    use Interactions;
    public ?RegisterForm $form = null;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new RegisterForm($this, 'form');
        }
    }

    public function register()
    {
        if($this->form->role === ''){
            $this->form->setData('residen');
        }else{
            $this->form->setData($this->form->role);
        }

        try {
            
            $this->form->validateCreate($this->form->role);
            // dd($this->fullname);

            // 2. Buat User Baru di Database
            if($this->form->role === 'residen'){
                Residen::create([
                    'fullname' => $this->form->fullname,
                    'username' => $this->form->username,
                    'email' => $this->form->email,
                    'password' => Hash::make($this->form->password),
                    'role' => $this->form->role, // Otomatis mendaftar sebagai siswa
                    'id_identitas' => $this->form->id_identitas,
                    'status' => 'Pending',
                ]);
            }else if($this->form->role === 'dpjp'){
                Dpjp::create([
                    'fullname' => $this->form->fullname,
                    'username' => $this->form->username,
                    'email' => $this->form->email,
                    'password' => Hash::make($this->form->password),
                    'role' => $this->form->role, // Otomatis mendaftar sebagai siswa
                    'id_identitas' => $this->form->id_identitas,
                    'status' => 'Pending',
                ]);
            }
            

            // 3. Otomatis Login setelah berhasil mendaftar
            // Auth::login($user);

            // 4. Redirect ke dashboard siswa
            // return redirect()->route('siswa.dashboard');
            $this->dialog()
            ->success(
                title: 'Berhasil!',
                description: 'Registrasi berhasil, silahkan tunggu konfirmasi dari admin.'
            )
            ->send();

            // 4. Reset/Kosongkan form input agar bersih kembali (PENTING!)
            $this->form->reset();

        } catch (ValidationException $e) {
            
            // Ambil kumpulan pesan error dari exception
            $errors = $e->validator->errors()->all();

            // Looping dan tembakkan masing-masing error sebagai Toast dari TallStackUi
            foreach ($errors as $error) {
                $this->toast()->error('Validasi Gagal!', $error)->send();
            }
            // $this->errorBagExcept($errors);
            // $this->setErrorBag($errors);
             // Teruskan kembali error bag internal agar form input ikut berwarna merah
            throw $e;
        }
        // 1. Jalankan Validasi
        
    }

    public function confirmDelete($userId)
    {
        // $this->dialog()->confirm(
        //     title: 'Apakah Anda Yakin?',
        //     description: 'Data user ini akan dihapus secara permanen dari sistem.',
        //     options: [
        //         'confirm' => [
        //             'text' => 'Ya, Hapus!',
        //             'method' => 'delete', // Menuju ke method delete() di bawah
        //             'params' => $userId,  // Mengirimkan ID user sebagai parameter
        //         ],
        //         'cancel' => [
        //             'text' => 'Batal',
        //         ],
        //     ]
        // );
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $user->delete();

            // Tampilkan alert sukses setelah berhasil menghapus
            $this->dialog()->success(
                title: 'Berhasil!',
                description: 'Data user telah sukses dihapus dari database.'
            );
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
