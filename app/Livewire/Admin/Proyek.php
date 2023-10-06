<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title('Admin')]
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
        $proyek = Project::create([
            'project_name' => $this->nama_proyek,
            'deskripsi' => $this->deskripsi_proyek,
            'status' => 'to do',
        ]);

        $proyek->users()->sync(auth()->user()->id);
        session()->flash('Proyek created successfully', 'success');

        $this->reset('nama_proyek','deskripsi_proyek', 'proyekId');
        $this->closeModal();
        return $proyek;
    }
    public function edit($id)
    {
        $proyek = Project::findOrFail($id);
        $this->proyekId = $id;
        $this->nama_proyek = $proyek->project_name;
        $this->deskripsi_proyek = $proyek->deskripsi;

        $this->openModal();
    }

    public function update()
    {
        if ($this->proyekId) {
            $proyek = Project::findOrFail($this->proyekId);
            $proyek->update([
                'project_name' => $this->nama_proyek,
                'deskripsi' => $this->deskripsi_proyek,
            ]);
            session()->flash('success', 'Post updated successfully.');
            $this->closeModal();
            $this->reset('nama_proyek','deskripsi_proyek', 'proyekId');
        }
    }

    public function delete($id)
    {
        Project::find($id)->delete();
        session()->flash('success', 'Post deleted successfully.');
        $this->reset('nama_proyek','deskripsi_proyek');
    }

    public function render()
    {
        $proyeks = Project::with('users')
        ->when($this->search, function ($search)
        {
            $search->where(function ($search)
            {
                $search->where('nama_proyek', 'like', '%'.$this->search.'%');
            });
        },fn ($search) =>$search->latest())
        ->paginate($this->limit);

        return view('livewire.admin.proyek',
        [
            'proyeks' => $proyeks,
        ]);
    }
}
