<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Api;
use App\Models\TaskImages;

use Auth;
class InProgress extends Component
{
    public $in_progress_tasks;
    public $task;
    public $img;
    public $images;
    private $client;
    public $showImages = 0;
    public $required_images = 0;
    

    protected $rules = [
        'img' => 'required',
    ];

    public function mount($id)
    {
        $this->task = Task::where('id',$id)->first();
        $this->required_images = $this->task->no_of_images;
    }
    
    public function render()
    {
        return view('livewire.in-progress');
    }
    public function submit_task($urls)
    {
        foreach ($urls as $key => $url) {
            TaskImages::create([
                'user_id'=>Auth::User()->id,
                'task_id'=>$this->task->id,
                'url' =>$url,
            ]);
        }
        
        $this->task->update([
            'status' => '2'
        ]);
        $url = env('APP_URL').'/task-list';
        return $this->emit('alert', ['type' => 'success', 'message' => 'Task submited successfully','url' => $url]);
    }

    public function search()
    {
        $api = Api::where('status',1)->first();
        $client = new \Shutterstock\Api\Client($api->consumer_key,$api->consumer_secret);
        $images = $client->get('images/search', array('query' => $this->img));
        $images = $images->getBody()->jsonSerialize()['data'];
        $this->images = $images;
        
        $this->showImages = 1;
        $this->img = '';
    }
}
