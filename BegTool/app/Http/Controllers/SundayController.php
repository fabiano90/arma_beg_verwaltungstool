<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use App\Models\Member;
use App\Models\Song;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Validator;
use DB;
use Mail;

class SundayController extends Controller {

	public function getIndex($filter=1) {
		$user=Auth::user();
		$newMessages = $user->newMessages($user);
		
		
		$sundayservicesFromDate=Sundayservice::sundayservicesFromDate($filter);

		return view ( 'sundays.index' )->with('newMessages', $newMessages)->with ( 'sundayservices', $sundayservicesFromDate)->with ( 'user', $user )->with ( 'filter', $filter );
	}

	
	public function getEditsunday($sundayId) {
		$user=Auth::user();
		$newMessages = $user->newMessages($user);

		$sunday=Sundayservice::find($sundayId);

		$kigos_list = User::getKigoslist();
		$preachers_list = Member::getPreacherslist();
		$lectors_list = User::getLectorslist();



		$kigo = $sunday->kigos;
		return view ( 'sundays.editsunday' )->with('newMessages', $newMessages)->with ( 'sunday', $sunday )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with('kigo', $kigo);
	}

	public function postEditsunday($actualSunday) {
		$sundayservice = Sundayservice::find($actualSunday);
		$kigo = Kigo::find($sundayservice->kigo_id);
		$sermon = Sermon::find($sundayservice->sermon_id);
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {
			/**
			 *** Benachrichtigunen ***
			 */
			$old_kleader=User::find($kigo->user_id);
			$new_kleader=User::find(Request::input ( 'kigos_list' ));
			if($old_kleader->id!=$new_kleader->id){

				$this->sendMessage($old_kleader,$new_kleader,$sermon->date,'Kigo');

			}

			
			$old_lleader=User::find($sundayservice->user_id);
			$new_lleader=User::find(Request::input ( 'lectors_list' ));
			

			if($old_lleader->id!=$new_lleader->id){
				$this->sendMessage($old_lleader,$new_lleader,$sermon->date,'Leitungs');
				
			}

			$old_sleader=Member::find($sermon->preacher_id);
			$new_sleader=Member::find(Request::input ( 'preachers_list'));
			if($old_sleader->id!=$new_sleader->id){
				$post = new Message();
		    	$post->sender_id = 0;
				$post->receiver_id = $old_sleader->id;
				if($new_sleader->id != 0){
					$post->content = date('d.m.Y',$sermon->date).'<h4>Kein Predigtdienst</h4>'.$new_sleader->onlinename.' hat für dich übernommen.';

					$data = [
								'date'			=> date('d.m.Y',$sermon->date),
								'title'			=> 'Kein Predigtdienst',
								'content'		=> $new_sleader->onlinename.' hat für dich übernommen.',
								'email_receiver'=> $new_sleader->email,
								'receiver' 		=> $new_sleader, 
								'sender' 		=> $old_sleader, 
								'subject' 		=> 'Änderung bei den Diensten'
							];
					
					$this->sendEmail($data);
				}
				else{
					$post->content = date('d.m.Y',$sermon->date).'<h4>Kein Predigtdienst</h4>, denn du wurdest ausgetragen.';
					$data = [
								'date'			=> date('d.m.Y',$sermon->date),
								'title'			=> 'Kein Predigtdienst',
								'content'		=> 'Dein Predigtdienst für den'.date('d.m.Y',$sermon->date).'entfällt.',
								'email_receiver'=> $new_sleader->email,
								'receiver' 		=> $new_sleader, 
								'sender' 		=> $old_sleader, 
								'subject' 		=> 'Änderung bei den Diensten'
							];

					$this->sendEmail($data);
				}
				$post->visited=1;
				$post->save();

				$post = new Message();
		    	$post->sender_id = $new_sleader->id;
				$post->receiver_id = 0;
				if($old_sleader->id != 0){
					$post->content = date('d.m.Y',$sermon->date).'<h4>Neuer Predigtdienst</h4>'.$old_sleader->onlinename.' hat mit dir getauscht.';
			
					$data = [
								'date'			=> date('d.m.Y',$sermon->date),
								'title'			=> 'Neuer Predigtdienst',
								'content'		=> $old_sleader->onlinename.' hat mit dir getauscht.',
								'email_receiver'=> $old_sleader->email,
								'receiver' 		=> $old_sleader, 
								'sender' 		=> $new_sleader, 
								'subject' 		=> 'Änderung bei den Diensten'
							];
					
					$this->sendEmail($data);
					$this->sendEmail($data);
				}
				else{
					$post->content = date('d.m.Y',$sermon->date).'<h4>Neuer Predigtdienst</h4>';
					$data = [
								'date'			=> date('d.m.Y',$sermon->date),
								'title'			=> 'Neuer Predigtdienst',
								'content'		=> 'Du wurdest für den '.date('d.m.Y',$sermon->date).'als Prediger eingetragen',
								'email_receiver'=> $old_sleader->email,
								'receiver' 		=> $old_sleader, 
								'sender' 		=> $new_sleader, 
								'subject' 		=> 'Änderung bei den Diensten'
							];

					$this->sendEmail($data);
				}
				$post->visited=1;
				$post->save();
				
			}
			/**
			 *** Kigo id suchen und speichern ***
			 */
			$kigoleader_id = Request::input ( 'kigos_list' );
			$kigo->user_id = $kigoleader_id;
			$kigo->lection = Request::input ( 'lection' );
			$kigo->lection_number = Request::input ( 'lection_number' );
			
			
			$kigo->save ();
			echo $kigo->users->username;
			/**
			 * ** Preacher id + date suchen und speichern ***
			 */
			$sermon->preacher_id = Request::input ( 'preachers_list' );
			$sermon->save ();
			
			/**
			 * ** Preacher id suchen***
			 */
			$lector_id = Request::input ( 'lectors_list' );
			$sundayservice->user_id = $lector_id;
			
			/**
			 * ** Kigo und Sermon id suchen und Speichern***
			 */
			$kigo_id = Kigo::orderBy ( 'created_at', 'DESC' )->first ();
			$sermon_id = Sermon::orderBy ( 'created_at', 'DESC' )->first ();
			$sundayservice->user_id = $lector_id;
			$sundayservice->save ();


			
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays/editsunday/'.$actualSunday )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getNewsunday() {
		$user=Auth::user();
		$newMessages = $user->newMessages($user);

		$kigos_list = User::getKigoslist();
		$preachers_list = Member::getPreacherslist();
		$lectors_list = User::getLectorslist();
		
		return view ( 'sundays.newsunday' )->with('newMessages', $newMessages)->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list );
	}

	public function postNewsunday() {
		$sundayservice = new Sundayservice ();
		$kigo = new Kigo ();
		$sermon = new Sermon ();
		$validator = Validator::make ( Request::all (), Sundayservice::$rules );
		
		if ($validator->passes ()) {
			$date=['date' => strtotime(Request::input ( 'date' ))];
			$datevalidator = Validator::make ($date , Sundayservice::$rulesdate );
			if($datevalidator->passes ()){
			/**
			 * ** Kigo id suchen und speichern ***
			 */
			$kigoleader_id = Request::input ( 'kigos_list' );
			$kigo->user_id = $kigoleader_id;
			$kigo->lection = Request::input ( 'lection' );
			$kigo->lection_number = Request::input ( 'lection_number' );
			$kigo->save ();
			
			/**
			 * ** Preacher id + date suchen und speichern ***
			 */
			$sermon->preacher_id = Request::input ( 'preachers_list' );
			$sermon->date = strtotime(Request::input ( 'date' ));
			$sermon->save ();
			
			/**
			 * ** Preacher id suchen***
			 */
			$lector_id = Request::input ( 'lectors_list' );
			$sundayservice->user_id = $lector_id;
			
			/**
			 * ** Kigo und Sermon id suchen und Speichern***
			 */
			$kigo_id = Kigo::orderBy ( 'created_at', 'DESC' )->first ();
			$sermon_id = Sermon::orderBy ( 'created_at', 'DESC' )->first ();
			$sundayservice->user_id = $lector_id;
			$sundayservice->kigo_id = $kigo_id->id;
			$sundayservice->sermon_id = $sermon_id->id;
			$sundayservice->save ();
			
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Sonntag erfolgreich angelegt!' );
		}else {
			// validation has failed, display error messages
			return redirect ( 'sundays/newsunday' )->with ( 'message', 'danger|Sonntag schon vorhanden' )->withErrors ( $validator )->withInput ();
		}
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays/newsunday' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getEdityear($year) {
		$user=Auth::user();
		$newMessages = $user->newMessages($user);
		
		$sundays=Sundayservice::sundaysOfYear($year);

		$kigos_list = User::getKigoslist();
		$preachers_list = Member::getPreacherslist();
		$lectors_list = User::getLectorslist();

		return view ( 'sundays.editYear' )->with('newMessages', $newMessages)->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with ( 'year', $year );
	}

	public function postEdityear() {
		
			
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {
			
				
			$sundays=Sundayservice::all();
			foreach ($sundays as $sunday) {
				
				$sundayservice = Sundayservice::find($sunday->id);
				$kigo = Kigo::find($sunday->kigo_id);
				$sermon = Sermon::find($sunday->sermon_id);
						
				/**
				 * ** Kigo suchen und speichern ***
				 */
				$kigo->user_id = Request::input ( 'kigos_list' . $sunday->id );
				$kigo->lection = Request::input ( 'lection' . $sunday->id);
				$kigo->lection_number = Request::input ( 'lection_number' . $sunday->id );
				$kigo->save ();
				/**
				 * ** Preacher id + date suchen und speichern ***
				 */
				$sermon->preacher_id = Request::input ( 'preachers_list' . $sunday->id );
				$sermon->save ();
				
				
				/**
				 * ** Lector id suchen***
				 */
				$sundayservice->user_id = Request::input ( 'lectors_list' . $sunday->id );
				$sundayservice->save ();
				
				
			}
			return redirect ( 'sundays/index' )->with ( 'message', 'success|Jahr erfolgreich bearbeitet!');
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays.edityear/2015' )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function getNewyear($year) {
		$user=Auth::user();
		$newMessages = $user->newMessages($user);
		$sundays = $this->sundaysYear ( $year );

		$kigos_list = User::getKigoslist();
		$preachers_list = Member::getPreacherslist();
		$lectors_list = User::getLectorslist();

		return view ( 'sundays.newYear' )->with('newMessages', $newMessages)->with ( 'sundays', $sundays )->with ( 'kigos_list', $kigos_list )->with ( 'preachers_list', $preachers_list )->with ( 'lectors_list', $lectors_list )->with ( 'year', $year );
	}

	public function postNewyear() {
		$year = Request::input ( 'year' );
		$sundays = $this->sundaysYear ( $year );
		$count=0;
		$validator = Validator::make ( Request::all (), Sundayservice::$rulesedit );
		if ($validator->passes ()) {
			
			for($i = 0; $i < 52; $i ++) {
				$date=['date' => strtotime(Request::input ( 'date' . $sundays [$i] ))];
				$datevalidator = Validator::make ($date , Sundayservice::$rulesdate );
				if($datevalidator->passes ()){
					$sundayservice = new Sundayservice ();
					$kigo = new Kigo ();
					$sermon = new Sermon ();
					
					/**
					 * ** Kigo suchen und speichern ***
					 */
					$kigoleader_id = Request::input ( 'kigos_list' . $sundays [$i] );
					$kigo->user_id = $kigoleader_id;
					$kigo->lection = Request::input ( 'lection' . $sundays [$i] );
					$kigo->lection_number = Request::input ( 'lection_number' . $sundays [$i] );
					
					/**
					 * ** Preacher id + date suchen und speichern ***
					 */
					$preacher_id = Request::input ( 'preachers_list' . $sundays [$i] );
					$sermon->preacher_id = $preacher_id;
					$date = Request::input ( 'date' . $sundays [$i] );
					$sermon->date=strtotime($date);
					echo $sermon->date;
					/**
					 * ** Lector id suchen***
					 */
					$lector_id = Request::input ( 'lectors_list' . $sundays [$i] );
					$sundayservice->user_id = $lector_id;
					
					$sermon->save ();
					$kigo->save ();
					/**
					 * ** Kigo und Sermon id suchen und Speichern***
					 */
					$kigo_id = Kigo::orderBy ( 'id', 'DESC' )->first ();
					$sermon_id = Sermon::orderBy ( 'id', 'DESC' )->first ();
					$sundayservice->user_id = $lector_id;
					$sundayservice->kigo_id = $kigo_id->id;
					$sundayservice->sermon_id = $sermon_id->id;
					$sundayservice->save ();
				} else{
					$count++;
				}
			}
			if($count==0){
				return redirect ( 'sundays/index' )->with ( 'message', 'success|Jahr erfolgreich angelegt!(');
			}else{
				return redirect ( 'sundays/index' )->with ( 'message', 'success|Jahr nur teilweise angelegt! <br/>'.$count.' doppelte Sonntage wurden nicht gespeichert. ');
			}
		} else {
			// validation has failed, display error messages
			return redirect ( 'sundays/newyear/' . $year )->with ( 'message', 'danger|Die folgenden Fehler sind aufgetreten:' )->withErrors ( $validator )->withInput ();
		}
	}

	public function sundaysYear($year) {
		$startDate = strtotime ( $year . '-01-01 23:59:59' );
		$sundays [] = null;
		$ids [] = null;
		$nextYear = $year + 1;
		
		for($i = 0; strcmp ( date ( 'd.m.Y', $startDate ), '01.01.' . $nextYear ) != 0;) {
			
			if (strcmp ( date ( 'D', $startDate ), 'Sun' ) == 0) {
				$sundays [$i] = $startDate;
				$i ++;
			}
			$startDate = strtotime ( '+1 day', $startDate );
		}
		return $sundays;
	}

	public function getDeletesunday($sundays_id){
		$sunday = Sundayservice::find($sundays_id);
		$sunday->songs()->detach();
		$kigo = $sunday->kigos;
		$kigo->songs()->detach();
		$kigo->delete();
		Sermon::destroy($sunday->sermon_id);
		$sunday->delete();
		return redirect('sundays')->with('message', 'success|Gottesdienst wurde erfolgreich gelöscht!');
	}

	public function sendMessage($old,$new,$date,$task){
				$post = new Message();
		    	$post->sender_id = 0;
				$post->receiver_id = $old->id;
				if($new->id != 0){
					$post->content = date('d.m.Y', $date).'<h4>Kein '.$task.'dienst</h4>'.$new->username.' hat für dich übernommen.';
				
					
					$data = [
								'date'			=> date('d.m.Y',$date),
								'title'			=> 'Kein '.$task.'dienst',
								'content'		=> $new->username.' hat für dich übernommen.',
								'email_receiver'=> $old->members->email,
								'receiver' 		=> $old, 
								'sender' 		=> $new, 
								'subject' 		=> 'Änderung bei den Diensten'
							];

					$this->sendEmail($data);
				}
				else{
					$post->content = date('d.m.Y', $date).'<h4>Kein '.$task.'dienst</h4>, denn du wurdest ausgetragen.';
					$data = [
								'date'			=> date('d.m.Y',$date),
								'title'			=> 'Kein '.$task.'dienst',
								'content'		=> 'Dein '.$task.'dienst für den'.date('d.m.Y',$date).'entfällt.',
								'email_receiver'=> $old->members->email,
								'receiver' 		=> $old, 
								'subject' 		=> 'Änderung bei den Diensten'
							];

				
					$this->sendEmail($data);
				}
				$post->visited=1;
				$post->save();

				$post = new Message();
		    	$post->sender_id = $new->id;
				$post->receiver_id = 0;
				if($old->id != 0){
					$post->content = date('d.m.Y', $date).'<h4>Neuer '.$task.'dienst</h4>'.$old->username.' hat mit dir getauscht.';
					$data = ['content'=> $post->content, 'receiver' => $new, 'sender' => $new,'subject' => 'Änderung bei den Diensten'];
					$data = [
								'date'			=> date('d.m.Y',$date),
								'title'			=> 'Neuer '.$task.'dienst',
								'content'		=> $old->onlinename.' hat mit dir getauscht.',
								'email_receiver'=> $new->members->email,
								'receiver' 		=> $new, 
								'sender' 		=> $old, 
								'subject' 		=> 'Änderung bei den Diensten'
							];
					$this->sendEmail($data);
				}
				else{
					$post->content = date('d.m.Y', $date).'<h4>Neuer '.$task.'dienst</h4>';
					$data = [
								'date'			=> date('d.m.Y',$date),
								'title'			=> 'Neuer '.$task.'dienst',
								'content'		=> 'Du wurdest für den'.date('d.m.Y',$date).' für '.$task.' eingetragen.',
								'email_receiver'=> $new->members->email,
								'receiver' 		=> $new,  
								'subject' 		=> 'Änderung bei den Diensten'
							];
					$this->sendEmail($data);
				}


				$post->visited=1;
				$post->save();



				
				

	}
	public function sendEmail($data){
			Mail::send('messages.email',$data, function($message) use ($data)
				{
					if($data['email_receiver']){
				    	$message->to($data['email_receiver'], $data['receiver']->username)->subject($data['subject']);
				    }
				});
return redirect ( 'messages/email' )->with('data',$data);
	}


}
