<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\Ads;
    
    class AdsController extends Controller
    {
        public function deleteItem($id)
        {
            $ad = Ads ::find($id);
            if ( !is_null($ad)) {
                $ad -> delete();
                
                return redirect()
                      -> route('index')
                      -> with('status', 'Your ad was successfully removed');
            } else {
                return redirect()
                      -> route('index')
                      -> with('status', 'This ad doesn`t exist!');
            }
        }
    }
