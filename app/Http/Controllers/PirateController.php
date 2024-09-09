<?php
namespace App\Http\Controllers;

use App\Models\Pirate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PirateController extends Controller
{
    // 1. Display a list of all pirates
    public function index()
    {
        // Get all pirates from the database
        $pirates = Pirate::all();

        // Return the index view with the list of pirates
        return view('pirates.index', compact('pirates'));
    }

    // 2. Show the form to create a new pirate
    public function create()
    {
        // Return the create view
        return view('pirates.create');
    }

    // 3. Store the newly created pirate in the database
    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bounty' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        // Create and save the new pirate
        $pirate = new Pirate();
        $pirate->name = $request->input('name');
        $pirate->role = $request->input('role');
        $pirate->bounty = $request->input('bounty');

        if ($request->hasFile('image')) {
            // $image = $request->file('image');
            // $imageExtension = $image->getClientOriginalExtension(); // Get the file extension
            // $imageName = $pirate->id . '.' . $imageExtension; // Set file name as Pirate ID with extension
            // $imagePath = $image->storeAs('/image', $imageName); // Save to 'storage/app/public/image'
            // $pirate->image = $imagePath; // Store the relative path in the database
            // $pirate->image = str_replace('public/', '', $imagePath); // Remove 'public/' from path
            $image = $request->file('image');
            $imageName = $pirate->id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image', $imageName); // Stores the image in 'storage/app/public/image'
            $pirate->image = str_replace('public/', '', $imagePath); // Save the path 'image/5.png'
        }
        $pirate->save();
        

        // Redirect to the pirate list with a success message
        return redirect()->route('pirates.index')->with('success', 'New pirate recruited successfully!');
    }

    // 4. Display the details of a specific pirate
    public function show(Pirate $pirate)
    {
        // Return the show view with the pirate's details
        return view('pirates.show', compact('pirate'));
    }

    // 5. Show the form to edit an existing pirate
    public function edit(Pirate $pirate)
    {
        // Return the edit view with the pirate's current details
        return view('pirates.edit', compact('pirate'));
    }

    // 6. Update the pirate's details in the database
    public function update(Request $request, Pirate $pirate)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bounty' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'image.image' => 'The image field must be an image.',
            'image.mimes' => 'The image field must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);
        // Update the pirate's details
        $pirate->name = $request->input('name');
        $pirate->role = $request->input('role');
        $pirate->bounty = $request->input('bounty');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($pirate->image) {
                Storage::disk('public')->delete($pirate->image);
            }

            // $image = $request->file('image');
            // $imageExtension = $image->getClientOriginalExtension(); // Get the file extension
            // $imageName = $pirate->id . '.' . $imageExtension; // Set file name as Pirate ID with extension
            // $imagePath = $image->storeAs('public/image', $imageName); // Save to 'storage/app/public/image'
            // $pirate->image = $imagePath; // Store the relative path in the database
            // $pirate->image = str_replace('public/', '', $imagePath); // Remove 'public/' from path
            $image = $request->file('image');
            $imageName = $pirate->id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/image', $imageName); // Stores the image in 'storage/app/public/image'
            $pirate->image = str_replace('public/', '', $imagePath); // Save the path 'image/5.png'
        }
        $pirate->save();

        // Redirect back to the pirate list with a success message
        return redirect()->route('pirates.index')->with('success', 'Pirate details updated successfully!');
    }

    // 7. Delete a pirate from the database
    public function destroy(Pirate $pirate)
    {
        // Delete the pirate
        $pirate->delete();

        // Redirect to the pirate list with a success message
        return redirect()->route('pirates.index')->with('success', 'Pirate removed successfully!');
    }
}
