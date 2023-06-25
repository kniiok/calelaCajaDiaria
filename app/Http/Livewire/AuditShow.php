<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AuditShow extends Component
{
    use WithPagination;
    public $search;
    public $user;
    protected $paginationTheme = './bootstrap';
    

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    { 
        $user = $this->user;
        if ($user) {
            // $this->search = '';
        // $users = User::where('nombre','LIKE' ,'%'.$this->search.'%')
        // ->orWhere('email','LIKE' ,'%'.$this->search.'%')
        // ->orWhere('estadoUsuario','LIKE' ,'%'.$this->search.'%')
        // ->orWhere('created_at','LIKE' ,'%'.$this->search.'%')
        // ->paginate();
            $auditoriasDelUsuario = $user->audits;
            $rol = $user->rol->tipoRol;
            return view('livewire.audit-show', compact('auditoriasDelUsuario', 'user','rol'));
        }else{
            return redirect()->action([AuditController::class, 'index']);
        }
    }
}