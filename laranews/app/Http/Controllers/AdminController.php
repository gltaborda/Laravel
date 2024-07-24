<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    /*public function deletedNoticias(){
        
        $noticias = Noticia::onlyTrashed()->orderBy('id', 'DESC')
                ->paginate(config('pagination.noticias', 10));
        
                return view('admin.noticias.deleted', ['noticias' => $noticias]);
    }*/
    
    public function userList(){
        
        $users = User::orderBy('name', 'ASC')
            ->paginate(config('pagination.users', 10));
        
        return view('admin.users.list', ['users' => $users]);
    }
    
    public function userShow(Request $request, User $user)
    {
        $publicadas = $user->noticias()
            ->where('published_at','!=',NULL)->latest()
            ->paginate(config('pagination.noticias',10));
        
        $redactadas = $user->noticias()
            ->where('published_at',NULL)->latest()
            ->paginate(config('pagination.noticias',10));
        
        $borradas = $user->noticias()->onlyTrashed()->latest()
            ->paginate(config('pagination.noticias',10));
        
        $comentarios = $user->comentarios()->latest()
            ->paginate(config('pagination.noticias',10));
        
        return view('admin.users.show',['user' =>$user, 
            'publicadas'          =>$publicadas, 
            'redactadas'   => $redactadas,
            'borradas'         => $borradas,
            'comentarios'       => $comentarios
            
            
        ]);
    }
    
    public function userSearch(Request $request, $name = null, $email = null){
        
        $name = $name ?? $request->input('name','');
        $email = $email ?? $request->input('email','');
        
        //busca las motos con esa marca y modelo
        $users = User::where('name', 'like', '%'.$name.'%')
            ->where('email', 'like', '%'.$email.'%')
            ->orderBy('name','ASC')
            ->paginate(config('pagination.users', 5))
            ->appends(['name' => $name, 'email' => $email]);
        
        return view('admin.users.list',[
            'users' => $users,
            'name' => $name,
            'email' => $email
        ]);
    }
    
    public function setRole(Request $request)
    {
        
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));
        
        try{
            $user->roles()->attach($role->id);

        return back()->with('success',
            "Rol $role->role añadido a $user->name correctamente.");
        }catch(QueryException $e){
            return back()->withErrors("No se pudo añadir el rol $role->role 
                a $user->name. Es posible que ya lo tenga");
        }
    }
    
    public function removeRole(Request $request)
    {
        
        $role = Role::find($request->input('role_id'));
        $user = User::find($request->input('user_id'));
        
        try{
            $user->roles()->detach($role->id);
            
            return back()->with('success',
                "Rol $role->role quitado a $user->name correctamente.");
        }catch(QueryException $e){
            return back()->withErrors("No se pudo quitar el rol $role->role
                a $user->name");
        }
    }
    
}
