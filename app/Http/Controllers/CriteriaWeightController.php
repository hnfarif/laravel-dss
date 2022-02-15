<?php

namespace App\Http\Controllers;

use App\Models\AlternativeScore;
use App\Models\CriteriaWeight;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriteriaWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datacw = $request->all();
        // ?
        // session()->forget('criteriaw');

            if(!session()->has('criteriaw')){

                session(['criteriaw' => $datacw]);

            }else{

                if ($request->has('id')) {

                    session(['criteriaw' => $datacw]);
                }
                // $request->session()->put('criteriaw', $datacw);
            }


            $cri = session('criteriaw');
            $citeriaweights = "";
            if($cri){

                $criteriaweights = CriteriaWeight::where('project_id','=', $cri['id'])->get();
                $sumw = CriteriaWeight::where('project_id','=', $cri['id'])->sum('weight');
                $title = $cri['title'];
            }else{
                return redirect('/home')->with('failed', 'Pilih atau buat dahulu perhitungan yang ingin dikelola!');
            }
        // dd(session('criteriaw'));

        // $criteriaweights = CriteriaWeight::where('project_id', '=', $id)->get();

        return view('criteriaweight.index', compact('criteriaweights','title','sumw'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('criteriaweight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'description' => 'required',
        ]);

        $cri = session('criteriaw');

        $sumw = CriteriaWeight::where('project_id','=', $cri['id'])->sum('weight');

        if($sumw + $request->weight > 1){

            return redirect()->route('criteriaweights.index')->with('failed', 'Data tidak berhasil ditambah, karena jumlah bobot melebihi 1');
        }else{

            // CriteriaWeight::create([
            //     'project_id' => $cri['id'],
            //     'name' => $request->name,
            //     'type' => $request->type,
            //     'weight' => $request->weight,
            //     'description' => $request->description
            // ]);

            $cw = new CriteriaWeight;
            $cw->project_id = $cri['id'];
            $cw->name = $request->name;
            $cw->type = $request->type;
            $cw->weight = $request->weight;
            $cw->description = $request->description;

            $cw->save();

            $cri = session('criteriaw');
            $scores = AlternativeScore::select(

            'alternatives.id as ida',

            )
            ->leftJoin('alternatives', 'alternatives.id', '=', 'alternativescores.alternative_id')
            ->leftJoin('criteriaweights', 'criteriaweights.id', '=', 'alternativescores.criteria_id')
            ->leftJoin('criteriaratings', 'criteriaratings.id', '=', 'alternativescores.rating_id')
            // ->where('project_id','=',$cri['id'])
            ->distinct('ida')
            ->get();

            if($scores){
                foreach($scores as $s){
                    AlternativeScore::create([
                        'alternative_id' => $s->ida,
                        'criteria_id' => $cw->id,
                        'rating_id' => null,

                    ]);
                }
            }


        }
        return redirect()->route('criteriaweights.index')
                        ->with('success','Criteria created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CriteriaWeight  $criteriaWeight
     * @return \Illuminate\Http\Response
     */
    public function show(CriteriaWeight $criteriaWeight)
    {
        // return view('criteriaweight.show',compact('criteriaWeight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CriteriaWeight  $criteriaWeight
     * @return \Illuminate\Http\Response
     */
    public function edit(CriteriaWeight $criteriaweight)
    {
        return view('criteriaweight.edit',compact('criteriaweight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CriteriaWeight  $criteriaWeight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CriteriaWeight $criteriaweight)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'weight' => 'required',
            'description' => 'required',
        ]);

        $cri = session('criteriaw');

        $sumw = CriteriaWeight::where('project_id','=', $cri['id'])->sum('weight');

        if($request->weight > $criteriaweight->weight){
            if(($sumw + ($request->weight - $criteriaweight->weight)) > 1){
                return redirect()->route('criteriaweights.index')->with('failed', 'Data tidak berhasil ditambah, karena jumlah bobot melebihi 1');
            }else{

                $criteriaweight->update($request->all());
            }

        }
        $criteriaweight->update($request->all());
        return redirect()->route('criteriaweights.index')
                        ->with('success','Criteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CriteriaWeight  $criteriaWeight
     * @return \Illuminate\Http\Response
     */
    public function destroy(CriteriaWeight $criteriaweight)
    {
        $criteriaweight->delete();

        DB::table('alternativescores')->where('criteria_id', '=', $criteriaweight->id)->delete();
        return redirect()->route('criteriaweights.index')
                        ->with('success','Criteria deleted successfully');
    }
}
