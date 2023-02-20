<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Category;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(){
        $pets = Pet::with('category')->get();
        return view('pets')->with('pets', $pets);
    }

    public function uploadImage(Request $request, $petId){
        $validatedData = $request->validate([
            'photoUrls' => ['required'],
        ]);

        $pet = Pet::where('id',$petId)->first();
        $photoUrls = $pet->photoUrls();
        array_push($photoUrls, $request->file);
        $pet->update([
            'photoUrls' => $photoUrls,
        ]);
        return response()->json('Successful operation', 200, 'Success');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => ['required'],
            'status' => ['required'],
            'category.*' => ['required'],
            'tags.*.name' => ['required'],
        ]);

        $pet = Pet::create([
            'name' => $request->name,
            'status' => $request->status,
            'photoUrls' => $request->photoUrls ?? [],
        ]);

        if($request->category != null){
            $pet->category()->create([
                'name' => $request->category['name'],
            ]);
        }

        if($request->tags){
            foreach($request->tags as $tag){
                $pet->tags()->create([
                    'name' => $tag['name'],
                ]);
            }
        }

        return response('Success operation', 200)
                ->header('Success', 'text/plain');
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
            'category.*' => ['required'],
            'tags.*' => ['required'],
        ]);

        $pet = Pet::findOrFail($request->id)->first();
        $pet->update([
            'name' => $request->name,
            'status' => $request->status,
            'photoUrls' => $request->photoUrls,
        ]);

        $pet->category()->update([
            'name' => $request->category['name'],
        ]);

        foreach($request->tags as $tag){
            if(array_key_exists('id', $tag)){
                $tagSample = $pet->tags()->where('id', $tag['id'])->update([
                    'name' => $tag['name'],
                ]);
            }
            else{
                $pet->tags()->create([
                    'name' => $tag['name'],
                ]);
            }
        }


        return response('Success', 200)->header('Success', 'text/plain');
    }

    public function findByStatus(Request $request){
        if(!$request->has('status')) {
            return redirect()->back();
        }

        $statusArr = explode(', ', $request->query('status'));
        
        $data = Pet::whereIn('status', $statusArr)->get();
        return $data;
    }

    public function findPetById($petId){
        $pet = Pet::findOrFail($petId);
        return view('single_pet')->with('pet', $pet);
    }

    public function updateFromId(){
        $pet = Pet::where('id', $request->id)->first();
        $pet->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response('Success', 200)
                  ->header('Success', 'text/plain');
    }

    public function delete($petId){
        $pet = Pet::findOrFail($petId);
        $pet->forceDelete();
        return response('Success', 200)
                  ->header('Success', 'text/plain');
    }
}
