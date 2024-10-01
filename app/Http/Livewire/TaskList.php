<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

use Auth;

class TaskList extends Component
{
    public $tasks, $mytasks, $in_progress_tasks;
    public function render()
    {

        $this->started();
        return view('livewire.task-list');
    }

    public function starttask($id){
        Task::where('id',$id)->update([
            'status' => '1',
            'user_id' => Auth::user()->id
        ]);
        $this->started();
    }

    public function in_progress($id){
        // dd($id);

        return redirect('/in_progress/'.$id);
    }
    public function started(){
        $inprogress = Task::where('user_id',Auth::user()->id)->where('status','1')->get();
        if(count($inprogress)){
            $this->tasks = Task::where('user_id',Auth::user()->id)->where('status','1')->get();
        }else{
            $this->tasks = Task::where('status','0')->whereNull('user_id')->get();
        }

        // $this->mytasks = Task::where('user_id',Auth::user()->id)->get();
    }
}
