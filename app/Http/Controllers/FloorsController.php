<?php

namespace App\Http\Controllers;

use App\DataTables\FloorsDatatable;
use App\DataTables\FloorsDatatableCopy;
use App\Http\Requests\StoreFloorRequest;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoomsDatatable $room
     * @return Response
     */
    public function index(FloorsDatatableCopy $floor)
    {
        

        $floors= Floor::all();
        
        return $floor->render('floors.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('floors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFloorRequest $myRequestObject)
    {
        // dd(1);
        // dd($myRequestObject);
        $data = $myRequestObject->all();
        // dd($data);
        Floor::create($data);
        return redirect()->route('floors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        // dd($id);
        // $floor = ['id' => 1, 'title' => 'Laravel', 'description' => 'Show Post Description', 'posted_by' => 'Ahmed', 'created_at' => '2021-03-13'];
        // dd($floor);

        //new commented
        $floor = Floor::find($id);
        // dd($floor);
        return view('floors.edit', [
            'floor'=> $floor,
            // 'users'=> User::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update($id, StoreFloorRequest $myRequestObject)
    {
        // dd($myRequestObject->all());
        $data = $myRequestObject->all();
        // dd($data);
        Floor::find($id)->update($data);
        return redirect()->route('floors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        
        if(Room::where('floor_id', $id)->get()->isEmpty())
        {
            return Redirect::back()->withErrors("can not delete a floor which has rooms associated to it !");
        }
        else
        {
            Floor::destroy($id);
            return redirect()->route('floors.index');
        }
    }
}