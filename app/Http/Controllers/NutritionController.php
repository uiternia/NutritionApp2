<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNutritionRequest;
use App\Http\Requests\UpdateNutritionRequest;
use App\Models\Nutrition;
use App\Models\User;
use App\Models\Type;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class NutritionController extends Controller
{

    public function index()
    {
        $userInfo = User::findOrFail(Auth::id());
        $user = Auth::id();
        $nutritions = Nutrition::where('user_id', $user)->get();
        return Inertia::render(
            'Nutrition/Index',
            [
                'nutritions' => $nutritions,
                'user' => $userInfo,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Nutrition/Create',['types' => Type::all()]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNutritionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNutritionRequest $request)
    {
        
        //XMLHTTPリクエスト使用
        $user = Auth::id();

        Nutrition::create([
            'user_id' => $user,
            'type_id' => $request->type,
            'cooking' => $request->cooking,
            'mycalorie' => $request->calorie,
            'myfat' => $request->fat,
            'mycarbon' => $request->carbon,
            'myprotein' => $request->protein,
        ]);

        return redirect()->route('nutritions.index', $parameters = [], $status = 303, $header = []);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function show(Nutrition $nutrition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function edit(Nutrition $nutrition)
    {
        $id = $nutrition->user_id;
        if(!is_null($id)){
            $user_id = Auth::id();
            if($user_id !== $id){
                abort(404);
            }
        }
        return Inertia::render('Nutrition/Edit',[
            'nutrition' => $nutrition,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNutritionRequest  $request
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNutritionRequest $request, Nutrition $nutrition)
    {
        $validate = $request->validate([
            'cooking' => 'required',
            'mycalorie' => 'required',
            'myfat' => 'required',
            'mycarbon' => 'required',
            'myprotein' => 'required',
        ]);
        $nutrition->update($validate);
        return redirect()->route('nutritions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nutrition  $nutrition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nutrition $nutrition)
    {
        $nutrition->delete();
        return redirect()->route('nutritions.index');
    }
}
