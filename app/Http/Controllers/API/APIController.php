<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryItem;
use App\Models\Play;
use App\Models\PlayBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class APIController extends Controller
{
    public $response = [];

    public function __construct()
    {
        $this->response['status'] = false;
    }

    /*
     * Inventories Methods
     */

    public function inventoriesList()
    {
        $this->response['inventories'] = Inventory::orderBy('id','desc')->get()->toArray();
        $this->response['status'] = true;
        return $this->sendResponse();
    }

    public function allInventoryItems()
    {
        $this->response['items'] = InventoryItem::orderBy('id','desc')->get()->toArray();
        $this->response['status'] = true;
        return $this->sendResponse();
    }

    public function inventoryItems(Inventory $inventory)
    {
        $this->response['items'] = $inventory->items()->get()->toArray();
        $this->response['status'] = true;
        return $this->sendResponse();
    }

    public function inventoryVariables(Inventory $inventory)
    {
        $this->response['items'] = $inventory->vars()->get()->toArray();
        $this->response['status'] = true;
        return $this->sendResponse();
    }

    /*
     * PlayBooks Methods
     */
    public function playbooks()
    {
        $this->response['playbooks'] = PlayBooks::orderBy('id','desc')->get()->toArray();
        $this->response['status'] = true;
        return $this->sendResponse();
    }

    /*
     * Create Methods
     */
    public function createFullPlay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'server' => 'required|ipv4',
            'playbook' => 'required|exists:App\Models\PlayBooks,name',
        ]);

        if($validator->fails()){
            $this->response['message'] = "server and playbook are required";
            return $this->sendResponse();
        }

        $inventory = new Inventory;
        $inventory->name = $request->get('playbook').'_'.Str::random(12);
        $inventory->is_active = 1;
        $inventory->save();

        $inventoryItem = new InventoryItem;
        $inventoryItem->inventory_id = $inventory->id;
        $inventoryItem->server = $request->get('server');
        $inventoryItem->save();

        $playBook = PlayBooks::where('name',$request->get('playbook'))->first();
        $newPlay = new Play;
        $newPlay->inventory_id = $inventory->id;
        $newPlay->playbook_id = $playBook->id;
        $newPlay->save();

        $this->response['status'] = true;
        $this->response['inventory'] = $inventory->name;
        $this->response['server'] = $inventoryItem->server;
        $this->response['playbook'] = $playBook->name;
        $this->response['play'] = $newPlay->id;

        return $this->sendResponse();
    }

    public function createSeriesPlay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'server' => 'required|ipv4',
            'playbooks' => 'string|required',
        ]);

        if($validator->fails()){
            $this->response['message'] = "server and playbook are required";
            return $this->sendResponse();
        }

        $playBooks = explode(",",$request->get('playbooks'));

        $queue = new Collection;
        $i = 0;
        foreach ($playBooks as $playBook){
            $pBook = PlayBooks::where('name',$playBook)->first();
            if(!$pBook){
                $this->response['message'] = "invalid playbook '{$playBook}'";
                return $this->sendResponse();
            }

            $queue->add([
                'order' => ++$i,
                'playbook' => $pBook->id,
                'title' => $pBook->name,
                'status' => 'pending',
            ]);
        }

        $inventory = new Inventory;
        $inventory->name = $request->get('server').'_'.Str::random(6);
        $inventory->is_active = 1;
        $inventory->save();

        $inventoryItem = new InventoryItem;
        $inventoryItem->inventory_id = $inventory->id;
        $inventoryItem->server = $request->get('server');
        $inventoryItem->save();



        $series = \App\Models\Series::create([
            'inventory_id' => $inventory->id,
            'series' => $queue->toJson(),
            'status' => 'created',
        ]);


        $this->response['status'] = true;
        $this->response['inventory'] = $inventory->name;
        $this->response['server'] = $inventoryItem->server;
        $this->response['series'] = $series->id;

        return $this->sendResponse();

    }



    /**
     * response to api routes by json
     * @return \Illuminate\Http\JsonResponse
     */
    private function sendResponse(){
        return response()->json($this->response);
    }
}
