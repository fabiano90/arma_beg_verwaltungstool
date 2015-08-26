<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Member;
use App\Models\Message;
use App\Models\Song;
use App\Models\Kigo;
use App\Models\Sundayservice;
use App\Models\Sermon;
use Validator;
use View;
use Request;
use Hash;
use Auth;
use DB;

class SongController extends Controller
{

	public function getIndex()
	{
		//kigo_song pivot...
		//$mysong = Song::find(1);
		//foreach ($mysong->kigos as $role) {
    	//	echo $role->pivot->song_id;
		//}

		//group by count von songs mit einem random datum
		/*$sundaysong = DB::table('sundayservices')
						->join('sermons', 'sundayservices.sermon_id', '=', 'sermons.id')
						->join('song_sundayservice', 'sundayservices.id', '=', 'song_sundayservice.service_id')
						->join('songs', 'songs.id', '=', 'song_sundayservice.song_id')
						->groupBy('song_id')					
						->select('songs.name', 'song_sundayservice.id as ssong_id', 'sermons.date', DB::raw('count(*) as song_count, song_id'))
						->get();

		foreach ($sundaysong as $a) {
			echo date('d.m.Y', $a->date) . ' ';
			echo $a->ssong_id . ' ';
			echo $a->song_count. ' ';
			echo $a->name. '<br>';
		}*/						


		/*$groupsong = DB::table('song_sundayservice')
					->groupBy('song_id')					
					->select('id', DB::raw('count(*) as song_count, song_id'))
					->get();
		
		//echo var_dump($groupsong);exit;
		foreach ($groupsong as $a) {
			echo $a->song_id . ' ';
			echo $a->song_count . '<br/>';
		}
		exit;
		*/

		$songs = Song::all();
		$sundays_of_song = collect([]);
		foreach ($songs as $song) {
			$sundays_of_song->push($song->sundayservices);
		}
		foreach ($sundays_of_song as $sunday_of_song) {

			$sunday_of_song = $sunday_of_song->transform(function ($item, $key) {						
    			return collect([ $key => $item->sermons->date, 'id'.$key => $item->pivot->song_id]);
			});
			//echo $sunday_of_song2;//4*sunday und pivot song_id [1234],[12]

		}		
		$bla2;
		$bla = [];
		foreach ($sundays_of_song->all() as $key => $value) {
			//echo $key . ': ' . $value .'<br/> ';//key song_id, value date
			//$bla2[] = $value;
			//arsort($bla2);
			$bla[] = $value[];
			asort($bla);
			
			foreach ($value as $key => $date) {
				//array_multisort($date['date'], SORT_DESC, SORT_NUMERIC,
				//		$date['song_id'], SORT_DESC, SORT_NUMERIC	);
				//echo 'key: ' . $key . ' song_id: ' . $date['song_id'] . ' date: ' . date('d.m.Y', $date['date']) . '<br/>';
				//$date->sortByDesc($date['song_id']);

			}
		}
		foreach ($bla as $blakey) {
				echo $blakey . '<br>';
			}
		//asort($bla);
		//echo $sundays_of_song;
		foreach ($sundays_of_song as $key => $value) {
			//echo $key . ': ' . $value .'<br/> ';//key song_id, value date			
			//sort($value);
			foreach ($value as $key => $date) {
				//echo 'key: ' . $key . ' song_id: ' . $date['song_id'] . ' date: ' . date('d.m.Y', $date['date']) . '<br/>';
				//echo 'key: ' . $key .' date: ' . date('d.m.Y', $date) . '<br/>';
			} 
		}
		//$songs = Sundayservice::has('songs')->has('sermons')->orderBy('date', 'DESC')->get();

		return view('songs.index')->with('songs', $songs)->with('sundays', $sundays_of_song->all());//->with('song_dates', $song_dates)->with('song_count', $song_count);
	}

//	public function getAddsong(){
	//	return view('songs.addsong');
	//}

	public function getAddsong()
	{
		$songs = Song::all();
		return view('songs.addsong')->with('songs', $songs);
	}

	public function postAddsong(){
		/*$validator = Validator::make(Request::all(), User::$rules);
		if ($validator->passes()) 
		{*/
	    	// validation has passed, save user in DB
			$song = new Song;
		    $song->name = Request::input('name');
		    $song->annotation = Request::input('annotation');
			$song->save();
		    return redirect('songs')->with('message', 'success|Student erfolgreich angelegt!');
		/*} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}*/
	}

	public function getEditsong($song_id){
		$song = Song::find($song_id);
		return view('songs.editsong')->with('song', $song);
	}

	public function postEditsong($song_id){
		/*$validator = Validator::make(Request::all(), User::$rules);
		if ($validator->passes()) 
		{*/
	    	// validation has passed, save user in DB
			$song = Song::find($song_id);
			$song->number = Request::input('number');
		    $song->name = Request::input('name');
		    $song->annotation = Request::input('annotation');
			$song->save();
		    return redirect('songs')->with('message', 'success|Student erfolgreich angelegt!');
		/*} 
		else
	 	{
	    	// validation has failed, display error messages   
	    	return redirect('members/register')->with('message', 'danger|Die folgenden Fehler sind aufgetreten:')->withErrors($validator)->withInput();
		}*/
	}








    public function getShow($id = 0)
    {
        $user = Song::find($id);
        return view('songs.showsong')->with('song', $song);
    }

    public function getDeletesong($id)
    {
        $song = Song::find($id);
       	//$song->deleteCascade();
        $song->delete();
        return redirect('songs/index')->with('message', 'success|Student wurde erfolgreich gelöscht!');
    }





	public function getAdduser($member_id){
		$user = Auth::user();		
		if($user->permission == 0){	//permission == 0 => admin
			/*$users = User::all();
			$containsUser = false;
			foreach ($users as $u) {
				if($u->member_id == $member_id){
					$containsUser = true;
			    	echo $u->username;
			    }
			}*/

			$model = User::where('member_id', $member_id)->first();
		//	echo var_dump($model);
			//$flights = User::where('active', 0)
               //->orderBy('name', 'desc')
               //->take(10)
            //   ->get();exit;
			//$user = User::contains();
			//var_dump($user);exit;
			//if ($user->contains($member_id)) {
			//if($containsUser){
			if($model != NULL){
			//if(User::contains($member_id)){		
				echo '<script>alert("zufügenButton nicht sichtbar, du aber üeber url...");</script>';	
				echo 'asdas';	
				return redirect('members');
			}
			else{	
				$member = Member::find($member_id);			
				return view('users.register')->with('member', $member);//->with('user', $persons);	
			}
		}
		else{
			//alert('nope kein permission! gibts was schoeneres als alert??');
		}
	}



	public function getTimeline($user_id = 0)
	{

		//$user = User::find($user_id);
		if($user_id == 0){
			$user = User::find(Auth::user()->id);
		}
		else{
			$user = User::find($user_id);
		}
		//return redirect('users/timeline/'. $user->id);
		$posts = $user->posts()->orderBy('updated_at', 'DESC')->get();
		//$posts = Post::where('user_id', '=', $user_id)->get();//ganz alt
		return view('users.timeline')->with('posts', $posts)->with('user', $user);
	}

	
	public function getSearch(){
		$user = Auth::user();
	}

	public function getFriends($friend_id = 0){
		$user = Auth::user();
		$friends = $user->friends;
		//return view('users.friends')->with('friends', $friends);

		$alreadyfriend = -1;
		$error = -1;

		return view('users.friends')
			->with('friends', $friends)
			->with('error', $error)
			->with('alreadyfriend', $alreadyfriend);
	}

	public function getAddfriend($friend_id = 0){
		$user = Auth::user();
		$alreadyfriend = -1;
		$error = -1;
		if($user->id == $friend_id){
			//echo 'Du kannst nicht mit dir selbst befreundet sein!';
			$error = 0;//freund mit sich selbst
		}
		else{
			if($user->friends->contains($friend_id)){
				//echo '<script>alert(\'swag\');</script>';
				$error = 1;//bereits befreundet
				$alreadyfriend = $user->friends->find($friend_id);
			}
			else{			
				$user->friends()->attach($friend_id);					
			}
			
			//return view('users.friends')->with('error', $error);
		}		
		return redirect('users/friends')->with('error', $error);
			//$user = Auth::user();
			//$friends = $user->friends;
			//return view('users.friends')->with('friends', $friends)->with('error', $error)->with('alreadyfriend', $alreadyfriend);
	}

	public function getRemovefriend($friend_id = 0){
		$user = Auth::user();			
		$user->friends()->detach($friend_id);
		$friends = $user->friends;		
		//return redirect('users/friends');
		$alreadyfriend = -1;
		$error = -1;

		return view('users.friends')
			->with('friends', $friends)
			->with('error', $error)
			->with('alreadyfriend', $alreadyfriend);
	}

	/*public function postIndex(){

			$message = new Message();
			$message->sender_id = 1;// Request::input('firstname');
			$message->receiver_id = 1;
			$message->content = Request::input('content');
			$message->save();

		//if succcess
			return redirect('users')->with('message', 'success|Student erfolgreich angelegt!');
		//else
	}*/
}
