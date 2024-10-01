<?php
namespace App\Http\Livewire;
use Illuminate\Support\Facades\Hash;


use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users;
    public $user;
    public $name;
    public $email;
    public $role;
    public $password;
    public $user_id;
    public $isOpen = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required',

    ];

    public function render()
    {
        $this->users = User::where('email' ,'!=', 'admin@gmail.com')->get();
        return view('livewire.users');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password)
        ]);


        session()->flash('message',
            $this->user_id? 'User Updated Successfully.' : 'User Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->user_id = '';
        $this->password = '';

    }

    public function edit($id)
    {
        $this->user = User::findOrFail($id);
        $this->user_id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
        // $this->password = $this->user->role;
        $this->isOpen = true;
        // $this->create();


    }
    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
