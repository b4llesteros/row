<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Http\Requests\Admin\UserRequest;
use Debugbar;


class UserController extends Controller
{ 

    protected $user; 

    public function __construct(User $user)
    {
        $this->user = $user;    
    }
    
    public function index() 
    {      
        $view = View::make('admin.pages.users.index') 
                ->with('user', $this->user) 
                ->with('users', $this->user->get());              

        if(request()->ajax()) { 
            
            $sections = $view->renderSections();
    
            return response()->json([
                'table' => $sections['table'], 
                'form' => $sections['form'], 
            ]); 
        }

        return $view; 
    }

    public function create() 
    {

       $view = View::make('admin.pages.users.index')
        ->with('user', $this->user) 
        ->renderSections();
        Debugbar::info($view['form']); 
       

        return response()->json([
            'form' => $view['form']
        ]);
    }
  
    public function store(UserRequest $request) 
    {                   
        $user = $this->user->updateOrCreate([
                
                'id' => request('id')],[                   
                'name' => request('name'),
                'email' => request('email'),
                'email_verified_at' => request('email_verified_at'),
                'password' => request('password'),
                'password_confirmation' => request('password_confirmation'),
                'visible' => 1,                
        ]);      
        $view = View::make('admin.pages.users.index')
      
        ->with('users', $this->user->get())      
        ->with('user', $user)     
        ->renderSections();        

        return response()->json([
            'table' => $view['table'],
            'form' => $view['form'],
            'id' => $user->id,
        ]);
    }

    public function edit(User $user)                           
    {
        debugbar::info($user);
        $view = View::make('admin.pages.users.index')
        ->with('user', $user)
        ->with('users', $this->user->get());   
        
        if(request()->ajax()) {

            $sections = $view->renderSections(); 
    
            return response()->json([
                'form' => $sections['form'],
            ]); 
        }
                
        return $view;
    }

    public function show(User $user){

    }

    public function destroy(User $user)
    {

        $user->active = 0;
        $user->save();

        $view = View::make('admin.pages.users.index')
            ->with('user', $this->user)
            ->with('users', $this->user->get())
            ->renderSections();
        
        return response()->json([
            'table' => $view['table'],
            'form' => $view['form']
        ]);
    }
}