<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AnimesFormRequest;
use App\Models\Anime;
use App\Models\Season;
use App\Models\Episode;

class AnimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
//         $animes =  DB::select('SELECT name FROM animes order by name asc');
            $animes = Anime::all();
//             ->sortBy('name');
            $mensagemSucesso = $request->session()->get('mensagem.sucesso');
            $mensagemErro = $request->session()->get('mensagem.erro');
//          $request->session()->forget('mensagem.sucesso'); Utilizada quando a mensagem da sessao é colocada com put
//         return view("list-animes",compact('animes')); -> OPCIONAL funcçao compact
//         return view("list-animes")->with('animes',$animes);
        return view("animes.index", [
            'animes' => $animes,
            'mensagemSucesso' => $mensagemSucesso,
            'mensagemErro' => $mensagemErro
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("animes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimesFormRequest $request)
    {
//        $animeName = $request->name;
//         $request->validate([          criei o AnimesFormRequest com php artisan make:request AnimesFormRequest e adicionei a validaçao na classe
//             'name' => ['required', 'min:3']
//         ]);

        DB::beginTransaction();
        try{
            $anime = Anime::create($request->all());
            $seasons = [];
            
            for($i = 1; $i<=$request->seasons; $i++){
                $seasons[] = [
                    'anime_id' =>$anime->id,
                    'number' => $i,
                    'created_at' => date("Y-m-d h:i:s"),
                    'updated_at' => date("Y-m-d h:i:s")
                    
                ];
            }
              Season::insert($seasons);  
              $episodes = [];
              
              foreach ($anime->seasons as $season){
                  
                  for($j = 1; $j <= $request->episodes; $j++){
                      $episodes[] = [
                          'season_id' => $season->id,
                          'number' => $i
                      ];
                  }
              }
              Episode::insert($episodes);
           
            DB::commit();
            $request->session()->flash('mensagem.sucesso', 'Anime adicionado com sucesso.');
        }catch (\Exception $e){
            DB::rollback();
            $request->session()->flash('mensagem.erro', 'Aconteceu algum erro inesperado.');
            
        }

//         session(['mensagem.sucesso' => 'Anime adicionado com sucesso.']);
       // não tao interessante
      // retorna um boolean => DB::insert('INSERT INTO animes (name) values (?)',[$animeName]);
          
       
       // Metodo utilizado quando se tem apenas um campo para ser preenchido
//        $anime = new Anime();
//        $anime->name = $animeName;
//        $anime->save();
       
      return redirect('/animes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//     $animes =  DB::select('SELECT name FROM animes order by name asc');
        $anime = Anime::find($id);
        
//         dd($request->id);
        
        return view("animes.edit", [
            'anime' => $anime          
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, AnimesFormRequest $request)
    {
        $anime = Anime::find($id);
        $anime->fill($request->all());
        $anime->save();
        
        return redirect('/animes')->with('mensagem.sucesso', 'Anime atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        Anime::destroy($request->id);
//         $request->session()->flash('mensagem.sucesso', 'Anime removido com sucesso.');
        return redirect('/animes')->with('mensagem.sucesso', 'Anime removido com sucesso.');
    }
}
