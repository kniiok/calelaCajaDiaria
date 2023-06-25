<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AuditIndex extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = './bootstrap';

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    { 
        $this->search = '';
        $users = User::where('nombre','LIKE' ,'%'.$this->search.'%')
        ->orWhere('email','LIKE' ,'%'.$this->search.'%')
        ->orWhere('estadoUsuario','LIKE' ,'%'.$this->search.'%')
        ->orWhere('created_at','LIKE' ,'%'.$this->search.'%')
        ->paginate();
        return view('livewire.audit-index', compact('users'));
    }
}
