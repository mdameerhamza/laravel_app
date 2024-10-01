<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class Tasks extends Component
{
    public $tasks, $title, $detail, $task_id, $no_of_images;
    public $isOpen = 0;

    protected $rules = [
        'title' => 'required',
        'detail' => 'required',
        'no_of_images' => 'required|integer',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->tasks = Task::all();
        return view('livewire.tasks');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        $this->title = '';
        $this->no_of_images = '';
        $this->detail = '';
        $this->task_id = '';
    }

    public function store()
    {
        $this->validate();

        Task::updateOrCreate(['id' => $this->task_id], [
            'title' => $this->title,
            'detail' => $this->detail,
            'no_of_images' => $this->no_of_images
        ]);

        session()->flash('message',
            $this->task_id ? 'Task Updated Successfully.' : 'Task Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $this->task_id = $id;
        $this->title = $task->title;
        $this->detail = $task->detail;
        $this->no_of_images = $task->no_of_images;

        $this->openModal();
    }

    public function delete($id)
    {
        Task::find($id)->delete();
        session()->flash('message', 'Task Deleted Successfully.');
    }
    public function detail($id)
    {
        return redirect('/task-detail/'.$id);
    }
}
