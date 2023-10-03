<?php

namespace App\Livewire\Owner;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class Proyek extends Component
{

    #[Rule('required|min:3')]
    public $nama_proyek;

    #[Rule('required|min:3')]
    public $deskripsi_proyek;

    use \Livewire\WithPagination;

    public string $search='';

    public $isOpen = 0;

    public $proyekId;

    public int $limit = 10;

    public function create()
    {
        $this->openModal();
    }
    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();
        $proyek = Auth::user()->projects()->create([
            'project_name' => $this->nama_proyek,
            'deskripsi' => $this->deskripsi_proyek,
        ]);

        session()->flash('Proyek created successfully', 'success');

        $this->reset('nama_proyek','deskripsi_proyek', 'proyekId');
        $this->closeModal();
        return $proyek;
    }
    public function edit($id)
    {
        $proyek = Project::findOrFail($id);
        $this->proyekId = $id;
        $this->nama_proyek = $proyek->nama_proyek;
        $this->deskripsi_proyek = $proyek->deskripsi_proyek;

        $this->openModal();
    }

    public function update()
    {
        if ($this->proyekId) {
            $proyek = Project::findOrFail($this->proyekId);
            $proyek->update([
                'title' => $this->title,
                'body' => $this->body,
            ]);
            session()->flash('success', 'Post updated successfully.');
            $this->closeModal();
            $this->reset('title', 'body', 'postId');
        }
    }

    public function delete($id)
    {
        Project::find($id)->delete();
        session()->flash('success', 'Post deleted successfully.');
        $this->reset('title','body');
    }

    public function render()
    {
        $proyeks = Project::where('user_id', '=', Auth::id())
        ->when($this->search, function ($search)
        {
            $search->where(function ($search)
            {
                $search->where('title', 'like', '%'.$this->search.'%');
            })
            ->orWhereHas('user', function ($search)
            {
                $search->where('id', auth()->id(),'name', 'like', '%'.$this->search.'%');
            });
        },fn ($search) =>$search->latest())
        ->paginate($this->limit);

        return view('livewire.admin.proyek',
        [
            'proyeks' => $proyeks,
        ]);
    }
}
