<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountSettings extends Component
{
    use WithFileUploads;

    public $photo;
    public $name;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;

    
    protected $listeners = [
        'profileUpdated' => 'updateProfile',
    ];

    protected function rulesForBasicSettings()
    {
        $userId = auth()->user()->id;
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId), 'min:3'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]; 
    }

    protected function rulesForAdvancedSettings()
    {
        $userId = auth()->user()->id;
        return [
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => ['required', 'min:8'],
            'confirmPassword' => ['required', 'same:password'],
        ];
    }

    public function mount()
    {
        $user = auth()->user();
        $this->photo = $user->photo;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['name', 'username', 'photo'])) {
            $this->validateOnly($propertyName, $this->rulesForBasicSettings());
        } elseif (in_array($propertyName, ['email', 'password', 'confirmPassword'])) {
            $this->validateOnly($propertyName, $this->rulesForAdvancedSettings());
        }
    }

    
    public function removePhoto()
    {        
        $user = auth()->user();
        
        if ($user->photo) {
            Storage::disk('users_profile')->delete($user->photo);
            // $validatedData['photo'] = NULL;
            $user->photo = NULL;
        }
        
        User::where('id', $user->id)->update(['photo' => $user->photo]);
        
        $this->photo = null;

        $this->dispatch('profileUpdated');
    }
    
    public function saveBasicSettings()
    {
        $user = auth()->user();

        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id), 'min:3'],
        ]);

        if ($this->photo !== $user->photo) {

            $validatedData = $this->validate($this->rulesForBasicSettings());

            if ($user->photo) {
                Storage::disk('users_profile')->delete($user->photo);
            }
            $path = $this->photo->store('user-photos', ['disk' => 'users_profile']);
            $validatedData['photo'] = $path;

        } else {
            $validatedData['photo'] = $user->photo;
        }
        
        User::where('id', $user->id)->update($validatedData);

        session()->flash('messageBasic', 'Basic settings updated successfully.');

        $this->dispatch('profileUpdated');
    }
    
    public function saveAdvancedSettings()
    {
        $validatedData = $this->validate($this->rulesForAdvancedSettings());
        
        $user = auth()->user();
        
        if ($this->password) {
            $validatedData['password'] = Hash::make($this->password);
        }
        
        // Hapus confirmPassword dari validatedData sebelum update
        unset($validatedData['confirmPassword']);
        
        User::where('id', $user->id)->update($validatedData);
        
        session()->flash('messageAdvanced', 'Advanced settings updated successfully.');

        $this->dispatch('profileUpdated');
    }
    
    public function cropImage($croppedImage)
    {
        $validatedData = $this->validate($this->rulesForBasicSettings());
        $user = auth()->user();
        $imageName = time() . '.png';
        Storage::disk('public_uploads')->put('profile-photos/' . $imageName, base64_decode(str_replace('data:image/png;base64,', '', $croppedImage)));
        
        if ($user->photo) {
            Storage::disk('public_uploads')->delete($user->photo);
        }
        
        $user->photo = 'profile-photos/' . $imageName;
        
        $this->photo = $user->photo;
        
        User::where('id', $user->id)
        ->update($validatedData);
        
        $this->dispatch('profilePhotoUpdated');
    }
    
    protected function cleanupOldUploads()
    {
        $storage = Storage::disk('users_profile');

        foreach ($storage->allFiles('livewire-tmp') as $filePathname) {
            // On busy websites, this cleanup code can run in multiple threads causing part of the output
            // of allFiles() to have already been deleted by another thread.
            if (! $storage->exists($filePathname)) continue;

            $yesterdaysStamp = now()->subSeconds(4)->timestamp;
            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }

    public function updateProfile()
    {
        sleep(2);
    }

    public function render()
    {
        $user = auth()->user();
        return view('livewire.account-settings', [
            'user' => $user,
        ]);
    }

}
