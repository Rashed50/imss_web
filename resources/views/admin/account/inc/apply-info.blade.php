 @php
 $mid= Auth::user()->id;
 $allAwardApply=App\Models\ApplyAward::where('apply_award_status',1)->where('member_id',$mid)->count();
 $allWinner=App\Models\Winner::where('winner_status',1)->where('member_id',$mid)->count();
 $allCards=App\Models\ApplyCard::where('apply_card_activity',1)->where('apply_card_status',1)->where('member_id',$mid)->count();
 @endphp