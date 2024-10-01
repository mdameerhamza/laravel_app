<?php

namespace App\Http\Livewire;

use Livewire\Component;



class Api extends Component
{

    public $api;
    public $apis;
    public $name;
    public $consumer_key;
    public $consumer_secret;
    public $status;
    public $api_id;

    public $isOpen = 0;

    protected $rules = [
        'name' => 'required',
        'consumer_key' => 'required',
        'consumer_secret' => 'required',
        'status' => 'required',

    ];

    public function render()
    {
        $this->apis = \App\Models\Api::all();
        return view('livewire.api');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

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
    private function resetInputFields(){
        $this->name = '';
        $this->consumer_key = '';
        $this->consumer_secret = '';
        $this->status = '';

    }
    public function store()
    {
        $this->validate();
        if((int)$this->status === 1){
            \App\Models\Api::where('status',1)->update([
                'status' => 0
            ]);
        }
        \App\Models\Api::updateOrCreate(['id' => $this->api_id], [
            'name' => $this->name,
            'consumer_key' => $this->consumer_key,
            'consumer_secret' => $this->consumer_secret,
            'status' => (int)$this->status
        ]);

        session()->flash('message',
            $this->api_id? 'Api Updated Successfully.' : 'Api Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($id)
    {
        $this->api = \App\Models\Api::findOrFail($id);
        $this->api_id = $id;
        $this->name = $this->api->name;
        $this->consumer_key = $this->api->consumer_key;
        $this->consumer_secret = $this->api->consumer_secret;
        $this->status = $this->api->status;
        $this->isOpen = true;
    }
    public function delete($id)
    {
        \App\Models\Api::find($id)->delete();
        session()->flash('message', 'Api Deleted Successfully.');
    }
}
