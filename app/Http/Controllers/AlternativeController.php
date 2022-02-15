<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeScore;
use App\Models\CriteriaWeight;
use App\Models\CriteriaRating;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cri = session('criteriaw');
        $title = $cri['title'];
        if ($cri) {
            $scores = AlternativeScore::select(
                'alternativescores.id as id',
                'alternatives.id as ida',
                'criteriaweights.id as idw',
                'criteriaweights.project_id as project_id',
                'criteriaratings.id as idr',
                'alternatives.name as name',
                'criteriaweights.name as criteria',
                'criteriaratings.rating as rating',
                'criteriaratings.description as description')
            ->leftJoin('alternatives', 'alternatives.id', '=', 'alternativescores.alternative_id')
            ->leftJoin('criteriaweights', 'criteriaweights.id', '=', 'alternativescores.criteria_id')
            ->leftJoin('criteriaratings', 'criteriaratings.id', '=', 'alternativescores.rating_id')
            ->where('criteriaweights.project_id','=',$cri['id'])
            ->get();

            $alternatives = Alternative::where('project_id','=',$cri['id'])->get();

            $criteriaweights = CriteriaWeight::where('project_id','=',$cri['id'])->get();
            // dd($scores);
        }else{
            return redirect('/home')->with('failed', 'Pilih atau buat dahulu perhitungan yang ingin dikelola!');
        }

        return view('alternative.index', compact('scores', 'alternatives', 'criteriaweights','title'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cri = session('criteriaw');
        $criteriaweights = CriteriaWeight::where('project_id','=',$cri['id'])->get();
        $criteriaratings = CriteriaRating::get();
        return view('alternative.create', compact('criteriaweights', 'criteriaratings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cri = session('criteriaw');
        $request->validate([
            'name' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'job' => 'required',
        ]);

        // Save the alternative
        $alt = new Alternative;
        $alt->project_id = $cri['id'];
        $alt->name = $request->name;
        $alt->birthdate = $request->birthdate;
        $alt->gender = $request->gender;
        $alt->address = $request->address;
        $alt->religion = $request->religion;
        $alt->marital_status = $request->marital_status;
        $alt->job = $request->job;
        $alt->save();

        // Save the score
        $criteriaweight = CriteriaWeight::where('project_id','=',$cri['id'])->get();
        foreach ($criteriaweight as $cw) {
            $score = new AlternativeScore();
            $score->alternative_id = $alt->id;
            $score->criteria_id = $cw->id;
            $score->rating_id = $request->input('criteria')[$cw->id];
            $score->save();
        }

        return redirect()->route('alternatives.index')
            ->with('success', 'Alternative created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternative $alternative)
    {
        $cri = session('criteriaw');
        $criteriaweights = CriteriaWeight::where('project_id','=',$cri['id'])->get();

        $criteriaratings = CriteriaRating::get();
        // dd($criteriaweights);

        $alternativescores = AlternativeScore::where('alternative_id', $alternative->id)->get();
        return view('alternative.edit', compact('alternative', 'alternativescores', 'criteriaweights', 'criteriaratings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternative $alternative)
    {
        $alternative->update($request->all());
        // Save the score
        $cri = session('criteriaw');
        $scores = AlternativeScore::where('alternative_id', $alternative->id)->get();
        $criteriaweight = CriteriaWeight::where('project_id','=',$cri['id'])->get();
        // dd($criteriaweight);
        foreach ($criteriaweight as $key => $cw) {
            $scores[$key]->rating_id = $request->get('criteria')[$cw->id];
            $scores[$key]->save();
        }

        return redirect()->route('alternatives.index')
            ->with('success', 'Alternative updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternative  $alternative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternative $alternative)
    {
        $scores = AlternativeScore::where('alternative_id', $alternative->id)->delete();
        $alternative->delete();

        return redirect()->route('alternatives.index')
            ->with('success', 'Alternative deleted successfully');
    }

    public function detail($id)
    {
        $alternatives = Alternative::where('id','=',$id)->first();
        // dd($alternatives);
        return view('alternative.detail', compact('alternatives'));
    }

}
