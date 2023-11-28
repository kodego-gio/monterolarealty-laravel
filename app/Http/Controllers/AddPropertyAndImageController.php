<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddPropertyAndImageController extends Controller
{
    // app/Http/Controllers/ImageController.php

public function addpropertyandimage(Request $request)
{
    $request->validate([
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'property_name' => 'required|string',
        'property_address' => 'required|string',
        'property_type' => 'required|in:For Sale,For Rent,For Closure,Project Selling',
        'bedrooms' => 'required|integer',
        'bathrooms' => 'required|integer',
        'price' => 'required|numeric',
        'lot_area' => 'required|numeric',
        'floor_area' => 'required|numeric',
    ]);
     if($request->fails()){
            return response(['error' => $request->errors()->all()],500);
        }

    // Save property details to the database
    $property = Property::create($request->only([
        'property_name'=> $request->property_name,
        'property_address'=> $request->property_address,
        'property_type'=> $request->property_type,
        'bedrooms'=> $request->bedrooms,
        'bathrooms'=> $request->bathrooms,
        'price'=> $request->price,
        'lot_area'=> $request->lot_area,
        'floor_area'=> $request->floor_area,
    ]));

    $images = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $images[] = $imageName;
        }

        $property->images()->createMany([
            'filename' => json_encode($images),
        ]);

        return response()->json(['message' => 'Property details and images uploaded successfully']);
    }

    return response()->json(['message' => 'No images were uploaded'], 400);
}

}
