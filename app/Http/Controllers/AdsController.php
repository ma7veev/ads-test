<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Ads;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    
    class AdsController extends Controller
    {
        public function deleteHandler($id)
        {
            $ad = Ads ::find($id);
            if ( !is_null($ad)) {
                if (Auth ::user() -> id !== $ad -> user_id) {
                    return redirect() -> route('index')
                                      -> with('status', 'Sorry, you cannot delete this ad!');
                }
                $ad -> delete();
                
                return redirect() -> route('index')
                                  -> with('status', 'Your ad was successfully removed');
            }
            
            return redirect() -> route('index')
                              -> with('status', 'This ad doesn`t exist!');
        }
        
        public function editItem($id)
        {
            $ad = Ads ::find($id);
    
            if (is_null($ad)||$ad->isEmpty()) {
                abort(404);
            }
            if (Auth ::user() -> id !== $ad -> user_id) {
                return redirect() -> route('index')
                                  -> with('status', 'Sorry, you cannot edit this ad!');
            }
            $data = collect(['handler' => 'edit-handler', 'button' => 'Save']);
            
            return view('ads.form', compact('data', 'ad'));
        }
        
        public function createItem()
        {
            
            $data = collect(['handler' => 'create-handler', 'button' => 'Create']);
            
            return view('ads.form', compact('data'));
        }
        
        public function viewItem($id)
        {
            $ad = Ads ::find($id);
            
            return view('ads.view', compact('ad'));
        }
        
        public function editHandler(Request $request)
        {
            $adQuery = Ads ::where(['id' => $request -> id]);
            $ad = $adQuery->get();
            if ($ad->isEmpty()) {
                return redirect() -> route('index')
                                  -> with('status', 'Ad is not found!');
            }
            if (Auth ::user() -> id !== $ad-> first() -> user_id) {
                return redirect() -> route('index')
                                  -> with('status', 'Sorry, you cannot edit this ad!');
            }
            $validator = $this -> validator($request -> all());
            if ($validator -> fails()) {
                return redirect() -> route('edit', ['id' => $ad -> id])
                                  -> withErrors($validator) -> withInput();
            }
            $updated = $adQuery -> update([
                  'title'       => $request -> title,
                  'author_name' => Auth ::user() -> username,
                  'description' => $request -> description,
                  'user_id'     => Auth ::user() -> id,
            ]);
            if ($updated) {
                return redirect() -> route('view', ['id' => $ad ->first() -> id])
                                  -> with('status', 'The ad was successfully updated!');
            }
        }
        
        public function createHandler(Request $request)
        {
            $validator = $this -> validator($request -> all());
            if ($validator -> fails()) {
                return redirect() -> route('create') -> withErrors($validator)
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
                                  -> with('status', 'The ad was successfully created!');
            }
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
