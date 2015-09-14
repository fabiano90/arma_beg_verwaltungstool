<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Sundayservice;
use App\Models\User;
use App\Models\Kigo;
use App\Models\Sermon;
use App\Models\Member;
use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use Validator;
use DB;
use App;
use Auth;

class SundayserviceController extends Controller {

	
	public function getIndex() {
		$sundayservices = Sundayservice::all();
		//$order = DB::table('sundayservices')->has('song_sundayservice')
		return view ( 'sundayservices.index' )->with( 'sundayservices', $sundayservices );
	}

	public function getEditservice($sundayId) {
		$auth_user = Auth::user();
		if($auth_user->permission <= 1){
			$sunday = Sundayservice::find($sundayId);
			$songs = Song::all();
			$songsOrder=Song::songsOrder($songs,$sunday);
			return view ( 'sundayservices.editservice' )->with ( 'user', $auth_user )->with ( 'sunday', $sunday )->with('songs', $songs)->with('songsOrder', $songsOrder);
		}
		return redirect('sundayservices');
	}
	
	public function getPdf($sundayservie_id){

		$sundayservice=Sundayservice::find($sundayservie_id);
		$songs = Song::all();
		$songsOrder=Song::songsOrder($songs,$sundayservice);

		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML('Gottesdienstzettel für den '.date('d.m.Y',$sundayservice->sermons->date).'
							<style>
								table, th, td {
								   border: 1px solid black;
								   border-spacing: 0px; 
								   vertical-align:top;
								   
								}
								th, td {
								    padding-left: 5px;
								}
								th {
								    text-align: left;
								}
							</style>
							<table> 
								<tr> 
									<th>Was</th>
									<th>Anmerkung </th>  
								</tr>
								<tr> 
									<td>Vorspiel</td>
									<td>beginnt nach Signal durch den Lektor um 10.15 Uhr </td>  
								</tr>
								<tr> 
									<td>Begrüßung</td>
									 <td><!--Lektor steht auf, geht hinter das Pult, begrüßt die Gemeinde und Gäste zum Gottesdienst =>  Eröffnung des Gottesdienstes: <br/>
										<ul>
											<li><b>Aufforderung an die Gemeinde aufzustehen</b></li>
											<li>-->„Wir feiern diesen Gottesdienst im Namen des dreieinigen Gottes, im Namen des Vaters, des Sohnes und des Heiligen Geistes. Unsere Hilfe steht im Namen des HERRN, der Himmel und Erde gemacht hat.“<!--</li>
											<li>Ankündigung des ersten Liedes (die Gemeinde setzt sich wieder).</li>
										</ul>-->
									</td>  
								</tr>
								<tr>
									<td>1. Lied</td>
									<td><b>'.$songsOrder[1].'</b></td>
								</tr> 
								<tr>
									<td>Psalm, Gebet</td>
									<td><b>Psalm '.$sundayservice->psalm.'</b></td>
								</tr>
								<tr>
									<td>2. Lied</td>
									<td><b>'.$songsOrder[2].'</b></td>
								</tr>  
								<tr>
									<td>Schriftlesung<br/><b> Glaubensbekenntnis</b></td>
									<td><b>'.$sundayservice->biblereading.'</b>
									<br><!-- Ich glaube an Gott, den Vater,den Allmächtigen, den Schöpfer des Himmels und der Erde. Und an Jesus Christus, seinen eingeborenen Sohn, unsern Herrn, empfangen durch den Heiligen Geist, geboren von der Jungfrau Maria, gelitten unter Pontius Pilatus, gekreuzigt, gestorben und begraben, hinabgestiegen in das Reich des Todes, am dritten Tage auferstanden von den Toten, aufgefahren in den Himmel; er sitzt zur Rechten Gottes, des allmächtigen Vaters; von dort wird er kommen, zu richten die Lebenden und die Toten. Ich glaube an den Heiligen Geist, die heilige christliche Kirche, Gemeinschaft der Heiligen, Vergebung der Sünden, Auferstehung der Totenund das ewige Leben. Amen. </td>
									-->Wir glauben an den einen Gott,den Vater,den Allmächtigen,der alles geschaffen hat,Himmel und Erde,die sichtbare und die unsichtbare Welt.Und an den einen Herrn Jesus Christus,Gottes eingeborenen Sohn,aus dem Vater geboren vor aller Zeit:Gott von Gott,Licht vom Licht,wahrer Gott vom wahren Gott,gezeugt, nicht geschaffen,eines Wesens mit dem Vater;durch ihn ist alles geschaffen.Für uns Menschen und zu unserm Heil ist er vom Himmel gekommen,hat Fleisch angenommen durch den Heiligen Geistvon der Jungfrau Maria und ist Mensch geworden.Er wurde für uns gekreuzigt unter Pontius Pilatus,hat gelitten und ist begraben worden,ist am dritten Tage auferstanden nach der Schriftund aufgefahren in den Himmel.Er sitzt zur Rechten des Vatersund wird wiederkommen in Herrlichkeit,zu richten die Lebenden und die Toten;seiner Herrschaft wird kein Ende sein.Wir glauben an den Heiligen Geist,der Herr ist und lebendig macht,der aus dem Vater und dem Sohn hervorgeht,der mit dem Vater und dem Sohn angebetet und verherrlicht wird,der gesprochen hat durch die Propheten,und die eine, heilige, christliche und apostolische Kirche.Wir bekennen die eine Taufe zur Vergebung der Sünden.Wir erwarten die Auferstehung der Totenund das Leben der kommenden Welt.
								</tr>
								<tr>
									<td>3. Lied</td>
									<td><b>'.$songsOrder[3].'</b></td>
								</tr>
								<tr>
									<td>Lernvers </td>
									<td></td>
								</tr>
								<tr>
									<td>Predigt</td>
									<td>Der Prediger sollte nach der Predigt das nächste Lied ansagen.
									<br/>
									<br/>
									<b>!! Aufnahmegerät ausschalten !!</b>
									</td>
								</tr>
								<tr>
									<td>4. Lied</td>
									<td><b>'.$songsOrder[4].'</b></td>
								</tr>
								<tr>
									<td>Abkündigungen</td>
									<td>
										<ul>
											<li> Dank für Kollekte und Zweck der heutigen Kollekte</li>
											<li>Bibelstunde oder Gebetskreis – Mittwoch, 20.30 Uhr (vor dem Gottesdienst klären, wo der Abend stattfinden wird) </li>
											<li> Junge Erwachsene am Donnerstag um 19.30 Uhr bei Brammers, Parkstraße </li>
											<li>Einladung zum nächsten Gottesdienst u. Katechismus 9.30 h
											<li><b>'.$sundayservice->comments.'</b></li>
										</ul>
									</td>
								</tr>
								<tr>
									<td>Gemeinsames Gebet</td>
									<td>Vater unser im Himmel Geheiligt werde dein Name. Dein Reich komme. Dein Wille geschehe, wie im Himmel, so auf Erden. Unser tägliches Brot gib uns heute.
									Und vergib uns unsere Schuld, wie auch wir vergeben unsern Schuldigern. Und führe uns nicht in Versuchung, sondern erlöse uns von dem Bösen. Denn dein ist das Reich und die Kraft und die Herrlichkeit in Ewigkeit. Amen. </td>
								</tr>
								<tr>
									<td>Aaronitischer Segen</td>
									<td>„Der Herr segne und behüte dich, er lasse sein Angesicht leuchten über dir  und sei dir gnädig.  Der Herr erhebe sein Angesicht auf dich und schenke dir seinen Frieden. Amen.“  
									 <b>(Gemeinde setzt sich wieder)</b> </td>
								</tr>
								<tr>
									<td>5. Lied</td>
									<td><b>'.$songsOrder[5].'</b></td>
								</tr>
								<tr>
									<td>Nachspiel</td>
									<td></td>
								</tr>

							</table>
						');
		return $pdf->stream();
	}

	public function postEditservice($service_id){
		$auth_user = Auth::user();		
		if($auth_user->permission <= 1){
			/*$validator = Validator::make(Request::all(), User::$rules);
			if ($validator->passes()) 
			{*/
		    	// validation has passed, save user in DB
				$service = Sundayservice::find($service_id);
			    $service->psalm = Request::input('psalm');
			    $service->biblereading = Request::input('biblereading');
			    $service->comments = Request::input('comments');
			    $service->sacrament = Request::input('sacrament');
			    $song1 = Request::input('song1');
			    $song2 = Request::input('song2');
			    $song3 = Request::input('song3');
			    $song4 = Request::input('song4');
			    $song5 = Request::input('song5');
			    $song6 = Request::input('song6');		   
			   
				if($song1){
					$aktSong=0;
					foreach ($service->songs as $song) {
						if($song->pivot->order==1)	
						$aktSong= $song->pivot->song_id;
					}
					$service->songs()->detach($aktSong);
					$service->songs()->attach($song1,['order' => '1']);
				}
				if($song2){
					$aktSong=0;
					foreach ($service->songs as $song) {
						if($song->pivot->order==2)	
						$aktSong= $song->pivot->song_id;
					}
					$service->songs()->detach($aktSong);
					$service->songs()->attach($song2,['order' => '2']);
				}
				if($song3){
					$aktSong=0;
					foreach ($service->songs as $song) {
						if($song->pivot->order==3)	
						$aktSong= $song->pivot->song_id;
					}
					$service->songs()->detach($aktSong);
					$service->songs()->attach($song3,['order' => '3']);
				}
				if($song4){
					$aktSong=0;
					foreach ($service->songs as $song) {
						if($song->pivot->order==4)	
						$aktSong= $song->pivot->song_id;
					}
					$service->songs()->detach($aktSong);
					$service->songs()->attach($song4,['order' => '4']);
				}
				if($song5){
					$aktSong=0;
					foreach ($service->songs as $song) {
						if($song->pivot->order==5)	
						$aktSong= $song->pivot->song_id;
					}
					$service->songs()->detach($aktSong);				
					$service->songs()->attach($song5,['order' => '5']);
				}
				if($song6){
					
					$aktSong=0;
					foreach ($service->songs as $song) {
						if($song->pivot->order==6)	
						$aktSong= $song->pivot->song_id;
					}
					$service->songs()->detach($aktSong);
					$service->songs()->attach($song6,['order' => '6']);
				}

				$service->save();
			    return redirect('sundayservices')->with('message', 'success|Leitung wurde erfolgreich bearbeitet!');

		}
	}

	public function getAddsong($service_id){
		$sunday = Sundayservice::find($service_id);
		$songs = Song::all();
		return view('sundayservices.addsongtosunday')->with('songs', $songs)->with('sunday', $sunday);
	}

	public function postAddsongtosunday($service_id){
		$service = Sundayservice::find($service_id);
		$songs = Song::all();
		foreach ($songs as $song) {
			$service->songs()->attach(Request::input('id'.$song->id));
		}
		$service->save();
		return redirect('sundayservices')->with('message', 'success|Leitung wurde erfolgreich bearbeitet!');		
	}	

	public function getDeleteservice($service_id){
		$auth_user = Auth::user();
		if($auth_user->permission <= 1){
			$service = Sundayservice::find($service_id);	
			$service->songs()->detach();
		    $service->psalm = null;
		    $service->biblereading = null;
		    $service->comments = null;
		    $service->sacrament = null;
		    $service->sermons->save();
		    $service->save();
		    return redirect('sundayservices')->with('message', 'success|Leitung wurde erfolgreich geleert!');		
		}
	}
}
