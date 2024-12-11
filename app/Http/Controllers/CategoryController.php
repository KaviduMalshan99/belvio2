<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('subcategories.subSubcategories')->get();
        return view('AdminDashboard.categories', compact('categories'));
    }



    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'categoryName' => 'required|string|max:255', 
            'subcategories' => 'nullable|array',
            'subcategories.*.name' => 'sometimes|nullable|string|max:255',
            'subcategories.*.sub_subcategories' => 'sometimes|array', 
            'subcategories.*.sub_subcategories.*.name' => 'sometimes|required|string|max:255',
        ]);
    

        $category = Category::create(['name' => $request->categoryName]);
    
        // Process subcategories if they exist
        if ($request->has('subcategories')) {
            foreach ($request->subcategories as $subcatData) {
                if (isset($subcatData['name'])) {
                    $subcategory = Subcategory::create(['name' => $subcatData['name'], 'category_id' => $category->id]);
    
                    if (isset($subcatData['sub_subcategories'])) {
                        foreach ($subcatData['sub_subcategories'] as $subSubcatData) {
                            if (isset($subSubcatData['name'])) {
                                SubSubcategory::create(['name' => $subSubcatData['name'], 'subcategory_id' => $subcategory->id]);
                            }
                        }
                    }
                }
            }
        }
        
    session()->flash('success', 'Category created successfully!');
    return redirect()->back();
    }
    


    public function edit($id)
    {
        $category = Category::with('subcategories.subSubcategories')->findOrFail($id);

        return view('AdminDashboard.edit_category', compact('category'));
    }



    public function update(Request $request, $id)
    {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subcategories' => 'nullable|array',
            'subcategories.*.id' => 'sometimes|nullable|exists:subcategories,id',
            'subcategories.*.name' => 'required|string|max:255',
            'subcategories.*.sub_subcategories' => 'array',
            'subcategories.*.sub_subcategories.*.id' => 'sometimes|nullable|exists:sub_subcategories,id', 
            'subcategories.*.sub_subcategories.*.name' => 'required|string|max:255',
        ]);


        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];
        $category->save();

        foreach ($validatedData['subcategories'] as $subcategoryData) {
            if (isset($subcategoryData['id'])) {
                $subcategory = Subcategory::findOrFail($subcategoryData['id']);
                $subcategory->name = $subcategoryData['name'];
                $subcategory->save();
            } else {
                $subcategory = new Subcategory();
                $subcategory->name = $subcategoryData['name'];
                $subcategory->category_id = $category->id;
                $subcategory->save();
            }

            if (isset($subcategoryData['sub_subcategories'])) {
                foreach ($subcategoryData['sub_subcategories'] as $subSubcategoryData) {
                    if (isset($subSubcategoryData['id'])) {
                        $subSubcategory = SubSubcategory::findOrFail($subSubcategoryData['id']);
                        $subSubcategory->name = $subSubcategoryData['name'];
                        $subSubcategory->save();
                    } else {
                        $subSubcategory = new SubSubcategory();
                        $subSubcategory->name = $subSubcategoryData['name'];
                        $subSubcategory->subcategory_id = $subcategory->id;
                        $subSubcategory->save();
                    }
                }
            }
        }

        return redirect()->route('categories')->with('success', 'Category updated successfully.');
    }



    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }


}
