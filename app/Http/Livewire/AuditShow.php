<?php

namespace App\Http\Livewire;

use App\Http\Controllers\AuditController;
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
            $auditoriasDelUsuario = User::find($this->user->id)->audits()->where('fecha', 'LIKE','%'.$this->search.'%')
            ->orWhere('operacion','LIKE' ,'%'.$this->search.'%')
            ->paginate(10);
            $rol = $user->rol->tipoRol;
            return view('livewire.audit-show', compact('auditoriasDelUsuario', 'user','rol'));
        }else{
            return redirect()->action([AuditController::class, 'index']);
        }
    }
}