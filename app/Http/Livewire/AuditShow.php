<?php

namespace App\Http\Livewire;

use App\Http\Controllers\AuditController;
use App\Models\Audit;
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
        $search = $this->search;
        if ($this->user) { 
            $auditoriasDelUsuario = Audit::where('user_id',$this->user->id)->whereHas('user', function ($query) use ($search) {
                $query->where('fecha', 'like', '%' . $search . '%')->orWhere('operacion','LIKE' ,'%'.$this->search.'%');
            })->orderBy('fecha', 'desc')->paginate(10);
            
            $rol = $this->user->rol->tipoRol;
            return view('livewire.audit-show', compact('auditoriasDelUsuario', 'user','rol'));
        }else{
            return redirect()->action([AuditController::class, 'index']);
        }
    }
}