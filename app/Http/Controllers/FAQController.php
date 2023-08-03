<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->Category = new Category();
        $this->User = new User();
        $this->Faq = new FAQ();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_faq'] = $this->Faq->getAllFaq()->get();
        return view('sivitas_akademika.faq.index',$data);
    }

    public function indexFaqAdmin()
    {
        $data['type_menu'] = 'faq_nav';
        $data['all_faq'] = $this->Faq->getAllFaq()->paginate(20);
        $data['all_category'] = $this->Category->getAllCategory();
        return view('faq.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function stores(Request $request)
    {
        $validator = Validator::make($request->only([
            'title',
            'category',
            'content',
        ]),[
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()], 422);
        }

        $this->Faq->category_id = $request->input('category');
        $this->Faq->title = $request->input('title');
        $this->Faq->answer = $request->input('content');
        $this->Faq->technician_id = Auth()->user()->id;
        $this->Faq->created_date = round(microtime(true) * 1000);
        $this->Faq->created_at = now();
        $this->Faq->updated_at = now();
        if ($this->Faq->save()) {
            return response()->json(['success' => true, 'message' => 'FAQ berhasil dipublikasikan']);
            return redirect()->route('faq_admin_page_index');
        } else return response()->json(['success' => false, 'message' => 'Ada kesalahan']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['detail_faq'] = $this->Faq->getFaqById($id)->first();
        return view('faq.show',$data);
    }

    public function showFaqById($id)
    {
        // Sivitas Akademika's FAQ show
        $data['detail_faq'] = $this->Faq->getFaqById($id)->get();
        $data['all_faq'] = $this->Faq->getAllFaq()->get();
        return view('sivitas_akademika.faq.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['detail_faq'] = $this->Faq->getFaqById($id)->first();
        $data['all_faq'] = $this->Faq->getAllFaq()->get();
        $data['all_category'] = $this->Category->getAllCategory();
        return view('faq.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->only([
            'title',
            'category',
            'content',
        ]),[
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $faq = FAQ::findOrFail($id);
        $faq->update([
            'title' => $request->input('title'),
            'answer' => $request->input('content'),
            'category_id' => $request->input('category'),
            'technician_id' => Auth()->user()->id,
            'updated_at' => now(),
        ]);

        if ($faq->wasChanged())
        {
             // There are changes in the data
             $faq->save();
             return response()->json([
                'success' => true,
                'message' => 'FAQ berhasil diperbarui'
            ],200);
            // No changes were made
        }else return response()->json([
            'success' => true,
            'message' => 'Tidak ada yang diperbarui'
        ],200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = FAQ::findOrFail($id);
        $faq = FAQ::where('faq_id',$id)->delete();
        if($faq){
            return response()->json([
                'success' => true,
                'message' => 'FAQ telah dihapus'
            ],200);
        }else return response()->json([
            'success' => false,
            'message' => 'Ada kesalahan'
        ],400);
    }
}
