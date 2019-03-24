<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Ads;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    
    class AdsController extends Controller
    {
        public function deleteItem($id)
        {
            $ad = Ads ::find($id);
            if ( !is_null($ad)) {
                $ad -> delete();
                
                return redirect() -> route('index')
                                  -> with('status', 'Your ad was successfully removed');
            }
            
            return redirect() -> route('index')
                              -> with('status', 'This ad doesn`t exist!');
        }
        
        public function editItem()
        {
            return view('ads.edit');
        }
        
        public function createItem(Request $request)
        {
            $validator = $this->validator($request -> all());
            if ($validator -> fails()) {
                return redirect() -> route('edit') -> withErrors($validator)
                                  -> withInput();
            }
            $created = Ads ::create([
                  'title'       => $request -> title,
                  'author_name' => Auth ::user() -> username,
                  'description' => $request -> description,
                  'user_id'     => Auth ::user() -> id,
            ]);
            if ($created) {
                return redirect() -> route('view', ['id' => $created -> id])
                                  -> with('status', 'The ad successfully created!');
            }
        }
        
        public function viewItem($id)
        {
            $ad = Ads ::find($id);
            
            return view('ads.view', compact('ad'));
        }
        
        protected function validator(array $data)
        {
            return Validator ::make($data, [
                  'title'       => ['required', 'string', 'min:3', 'max:255',],
            //      'author_name' => ['required', 'string', 'min:3', 'max:255',],
              //    'user_id'     => ['required', 'integer',],
                  'description' => ['required', 'string', 'min:8', 'max:1200'],
            ]);
        }
    }
