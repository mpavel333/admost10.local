<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Channels;

class ChannelsController extends Controller
{


    public function channels()
    {
        return view('admin.channels.channels',['channels'=>Channels::all()]);      
    } 

    public function edit($id)
    {
        return view('admin.channels.edit',['channel'=>Channels::find($id)]);      
    } 

    public function save(Request $request,$id)
    {
        
        $channel = Channels::find($id);
        $channel->link = $request->input('link');
        $channel->name = $request->input('name');
        $channel->status = $request->input('status');
        $channel->save();
        
        return redirect()->route('admin.channels.edit',$id);
    } 


}
