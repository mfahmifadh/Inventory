<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WarehouseModel;
use App\Models\SlotModel;
use App\Models\RackModel;
use App\Models\OrderModel;
use App\Models\OrderDataModel;
use App\Models\OrderDetailModel;
use App\Models\ItemCategoryModel;
use App\Models\User;

use DB;
use Auth;
use Hash;
use Str;
use PDF;
use Carbon\Carbon;


class PetugasController extends Controller
{
    public function index()
    {
        $month_now      = Carbon::now()->isoFormat('MMMM');
        $datenow        = Carbon::now()->isoFormat('Y-MM-D');
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $totentryitem   = DB::table('tbl_orders')
                            ->where(DB::raw("(DATE_FORMAT(order_dt, '%Y-%m'))"), Carbon::now()->isoFormat('Y-MM'))
                            ->where('order_category','Pengiriman')
                            ->count();
        $totexititem    = DB::table('tbl_orders')
                            ->where(DB::raw("(DATE_FORMAT(order_dt, '%Y-%m'))"), Carbon::now()->isoFormat('Y-MM'))
                            ->where('order_category','Pengambilan')
                            ->count();

        $endorders   = DB::table('tbl_orders_data')
                        ->select('id_order','workunit_name','order_dt','order_category','order_deadline',
                                DB::raw("sum(total_item) as totalitem"))
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->groupBy('id_order','workunit_name','order_dt','order_category','order_deadline')
                        ->where('order_category','Pengiriman')
                        ->where('is_delete', 'false')
                        ->whereRaw("DATEDIFF(order_deadline, '".$datenow."') <= 14")
                        ->orderby('order_dt','DESC')
                        ->get();

        $enorders   = DB::table('tbl_orders_data')
                        ->select('id_order','workunit_name','order_dt','order_category','order_deadline',
                                DB::raw("sum(total_item) as totalitem"))
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->groupBy('id_order','workunit_name','order_dt','order_category','order_deadline')
                        ->where(DB::raw("(DATE_FORMAT(order_dt, '%Y-%m'))"), Carbon::now()->isoFormat('Y-MM'))
                        ->where('order_category','Pengiriman')
                        ->orderby('order_dt','DESC')
                        ->get();

        $exorders   = DB::table('tbl_orders_data')
                        ->select('id_order','workunit_name','order_dt','order_category','order_deadline',
                                DB::raw("sum(total_item) as totalitem"))
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->groupBy('id_order','workunit_name','order_dt','order_category','order_deadline')
                        ->where('order_category','Pengambilan')
                        ->where(DB::raw("(DATE_FORMAT(order_dt, '%Y-%m'))"), Carbon::now()->isoFormat('Y-MM'))
                        ->orderby('order_dt','DESC')
                        ->get();

        $warehouse09    = DB::table('tbl_warehouses')
                            ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                            ->where('id_warehouse', 'G09')
                            ->get();

        $warehouse05B   = DB::table('tbl_warehouses')
                            ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                            ->where('id_warehouse', 'G05B')
                            ->get();

        $pallet         = DB::table('tbl_slots_names')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_slots_names.pallet_id')
                            ->get();

        $palletavail09  = DB::table('tbl_slots')->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->where('warehouse_id','G09')->where('slot_status','Tersedia')->count();

        $palletavail05b = DB::table('tbl_slots')->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->where('warehouse_id','G05B')->where('slot_status','Tersedia')->count();

        // SELECT RACK

        $rack_pallet_one_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','I')
                                ->where('rack_level','Bawah')
                                ->get();

        $rack_pallet_one_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','I')
                                ->where('rack_level','Atas')
                                ->get();

        $rack_pallet_two_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','II')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_two_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','II')
                                ->where('rack_level','Atas')
                                ->get();

        $rack_pallet_three_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','III')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_three_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','III')
                                ->where('rack_level','Atas')
                                ->get();  

        $rack_pallet_four_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','IV')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_four_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','IV')
                                ->where('rack_level','Atas')
                                ->get();

        return view('v_petugas.index', compact('warehouse09','warehouse05B','pallet','rack_pallet_one_lvl1',
                'rack_pallet_one_lvl2','rack_pallet_two_lvl1','rack_pallet_two_lvl2','idorderdata','order_id',
                'rack_pallet_three_lvl1','rack_pallet_three_lvl2','rack_pallet_four_lvl1','rack_pallet_four_lvl2',
                'palletavail09','palletavail05b','enorders','month_now','totentryitem','totexititem','datenow','exorders',
                'endorders'));
    }

    // ====================
    // ORDER 
    // ==================== 

    public function detailOrder($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $orders   = DB::table('tbl_orders')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->where('id_order', $id)
                        ->get();

        $items    = DB::table('tbl_orders_detail')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_warehouses', 'tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->where('id_order', $id)
                        ->get();
        return view('v_petugas.detail_order', compact('orders','items','idorderdata'));
    }

    public function createAllOrder()
    {
        $date           = date('Ymd', strtotime(now()));
        $date2           = date('ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date2."".$totalorder."".$totaldataorder)+1;
        //dd($order_id);
        $slot           = DB::table('tbl_slots')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->get();

        $petugas      = DB::table('users')->where('role_id', 2)->get();
        $satker       = DB::table('users')->join('tbl_workunits','tbl_workunits.id_workunit','users.workunit_id')
                        ->where('role_id',3)->get();
        $warehouse    = DB::table('tbl_warehouses')->where('status_id',1)->get();
        $itemcategory = DB::table('tbl_item_category')->get();
        return view('v_petugas.create_all_order', compact('slot','petugas','satker','warehouse','itemcategory',
                                                            'order_id','idorderdata'));
    }

    public function createExitOrder()
    {
        $date           = date('Ymd', strtotime(now()));
        $date2          = date('ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','PBK-%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date2."".$totalorder."".$totaldataorder)+1;
        //dd($totalorder);
        $slot           = DB::table('tbl_slots')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')->get();

        $petugas      = DB::table('users')->where('role_id', 2)->get();
        $satker       = DB::table('users')->join('tbl_workunits','tbl_workunits.id_workunit','users.workunit_id')
                        ->where('role_id',3)->get();
        $warehouse    = DB::table('tbl_warehouses')->where('status_id',1)->get();
        $itemcategory = DB::table('tbl_item_category')->get();
        return view('v_petugas.create_exit_order', compact('slot','petugas','satker','warehouse',
                                                        'itemcategory','order_id','idorderdata'));
    }

    public function addOrderAll(Request $request)
    {
        // INSERT ORDER ==================================================
        $order                  = new OrderModel();
        $order->id_order        = $request->input('id_order');
        $order->letter_num      = strtoupper($request->input('letter_num'));
        $order->adminuser_id    = $request->input('adminuser_id');
        $order->workunit_id     = $request->input('workunit_id');
        $order->order_category  = "Pengiriman";
        $order->order_deadline  = $request->input('order_deadline');
        $order->save();

        // INSERT ORDER DATA =============================================
        $orderdata              = new  OrderDataModel();
        $orderdata->order_id    = $request->input('id_order');
        $slot_ids    = $request->slot_id;
        $orderdataid = $request->order_data_id; 
        $num = 0;

        // foreach($orderdataid as $i => $total_item) {
        //     $total[] = [

        //     ];
        //     $data = ++$i;
        // }

        foreach ($slot_ids as $i => $slot_id) {
            $order_data[] = [
                'id_order_data' => $request->id_order_data[$i],
                'order_id'      => $request->id_order,
                'slot_id'       => $slot_id,
                'is_delete'     => "false"
            ];
        }
        OrderDataModel::insert($order_data);
        
        // INSERT ORDER DETAIL =============================================
        $orderdetail                    = new OrderDetailModel();
        $itemnames = $request->item_name;
        foreach ($itemnames as $i => $item_name) {
            $order_detail[] = [
                'item_code'         => Str::random(5),
                'order_data_id'     => $request->order_data_id[$i],
                'itemcategory_id'   => $request->itemcategory_id[$i],
                'item_name'         => $request->item_name[$i],
                'item_weight'       => $request->item_weight[$i],
                'item_height'       => $request->item_height[$i],
                'item_qty'          => $request->item_qty[$i],
                'description'       => $request->description[$i],
                'item_status'       => "Barang Masuk",
                'item_entry_date'   => date('Y-m-d H:i:s', strtotime(now()))
            ];
        }
        OrderDetailModel::insert($order_detail);


        // UPDATE TOTAL ITEM ================================================

        $checkitem = DB::table('tbl_orders_detail')
                    ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                    ->select('id_order_data',DB::raw("count(item_code) as totalitem"))
                    ->groupBy('id_order_data')
                    ->get();

        foreach($checkitem as $check){
            OrderDataModel::where('id_order_data', $check->id_order_data)
                                ->update([
                                        'total_item' => $check->totalitem
                                ]);
        }

        // UPDATE STATUS PALLET =============================================
        
        foreach ($slot_ids as $i => $slot_id) {
                SlotModel::where('id_slot', $slot_id)
                                ->update([
                                        'slot_status' => "Penuh",
                                        'workunit_id' => $request->workunit_id
                                ]);
        }

        return redirect('admin-user/confirm_entry_order/'. $request->id_order)->with('success','Berhasil Menambah Data Barang Masuk');

        
    }

    public function addExitOrder(Request $request)
    {
        // INSERT EXIT ORDER ==================================================
        $order                  = new OrderModel();
        $order->id_order        = $request->input('id_order');
        $order->letter_num      = strtoupper($request->input('letter_num'));
        $order->adminuser_id    = $request->input('adminuser_id');
        $order->workunit_id     = $request->input('workunit_id');
        $order->order_category  = "Pengambilan";
        $order->save();

        // INSERT ORDER DATA =============================================
        $orderdata              = new  OrderDataModel();
        $orderdata->order_id    = $request->input('id_order');
        $slot_ids               = $request->slot_id;
        $orderdataid            = $request->order_data_id; 
        $num = 0;
        // foreach($orderdataid as $i => $total_item) {
        //     $total[] = [

        //     ];
        //     $data = ++$i;
        // }

        foreach ($slot_ids as $i => $slot_id) {
            $order_data[] = [
                'id_order_data' => $request->id_order_data[$i],
                'order_id'      => $request->id_order,
                'slot_id'       => $slot_id,
                'is_delete'     => "false"
            ];
        }
        OrderDataModel::insert($order_data);

        // INSERT ORDER DETAIL BARANG KELUAR=================================
        $orderdetail    = new OrderDetailModel();
        $itemcodes      = $request->item_code;
        foreach ($itemcodes as $i => $item_code) {
            OrderDetailModel::where('item_code', $item_code)
                                ->update([
                                        'order_data_id'  => $request->order_data_id[$i],
                                        'item_status'    => "Barang Keluar",
                                        'item_exit_date' => date('Y-m-d H:i:s', strtotime(now()))
                                ]);
        }


        // UPDATE TOTAL ITEM ================================================

        $checkitem = DB::table('tbl_orders_detail')
                    ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                    ->select('id_order_data',DB::raw("count(item_status) as totalitem"))
                    ->where('item_status','Barang Keluar')
                    ->where('id_order_data', 'like', 'PBK-%')
                    ->groupBy('id_order_data')
                    ->get();
        foreach($checkitem as $check){
            OrderDataModel::where('id_order_data', $check->id_order_data)
                                ->update([
                                        'total_item' => $check->totalitem
                                ]);
        }
        
        $idorderdata = $request->getorderdataid;
        foreach ($idorderdata as $i => $orderdataid) {
                $checkstock  = DB::table('tbl_orders_detail')
                                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                                ->select('id_order_data',DB::raw("count(item_status) as totalitem"))
                                ->where('item_status','Barang Masuk')
                                ->where('id_order_data', $orderdataid)
                                ->groupBy('id_order_data')
                                ->count();
                if($checkstock == 0 ){
                        OrderDataModel::where('id_order_data', $orderdataid)
                                ->update([
                                        'is_delete' => "True"
                                ]);
                }                
        }

        foreach ($slot_ids as $i => $slotid) {
                $checkslot  = DB::table('tbl_orders_data')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                                ->select('slot_id','is_delete')
                                ->where('slot_id', $slotid)
                                ->where('is_delete','true')
                                ->where('id_order_data', $request->getorderdataid[$i])
                                ->groupBy('id_order_data')
                                ->count();

                if($checkslot == 1 ){
                        SlotModel::where('id_slot', $slotid)
                                ->update([
                                        'slot_status' => "Tersedia"
                                ]);
                }                
        } 

        return redirect('admin-user/confirm_exit_order/'.$request->input('id_order'));
    }

    // ====================
    // WAREHOUSE
    // ====================
    public function showWarehouse()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $warehouse  = DB::table('tbl_warehouses')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->orderby('status_id', 'ASC')
                        ->get();

        return view('v_petugas.show_warehouse',compact('warehouse','idorderdata'));
    }

    public function createWarehouse()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        return view('v_petugas.create_warehouse', compact('idorderdata'));   
    }    

    public function createSlot($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $slot  = DB::table('tbl_warehouses')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_warehouse',$id)
                        ->get();

        return view('v_petugas.create_slot', compact('slot','idorderdata'));   
    }

    public function detailWarehouse(Request $request, $id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $rack_id = $request->rack_id;
        $racklevel = $request->rack_level;
        
        $warehouse  = DB::table('tbl_warehouses')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_warehouse', $id)
                        ->get();
        $slot       = DB::table('tbl_slots')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_warehouse', $id)
                        ->orderby('id_slot','DESC')
                        ->get();
        $pallet     = DB::table('tbl_slots_names')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_slots_names.pallet_id')
                        ->get();

        $slot_rack  = DB::table('tbl_slots')->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->where('warehouse_category','Racking')
                        ->where('warehouse_id',$id)->get();

        // SELECT RACK

        $rack_pallet_one_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','I')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_one_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','I')
                                ->where('rack_level','Atas')
                                ->get();

        $rack_pallet_two_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','II')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_two_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','II')
                                ->where('rack_level','Atas')
                                ->get();

        $rack_pallet_three_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','III')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_three_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','III')
                                ->where('rack_level','Atas')
                                ->get();  

        $rack_pallet_four_lvl1   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','IV')
                                ->where('rack_level','Bawah')
                                ->get();
        $rack_pallet_four_lvl2   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id','IV')
                                ->where('rack_level','Atas')
                                ->get();

        $select_rack_pallet   = DB::table('tbl_rack_details')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->where('rack_id', $rack_id)
                                ->where('rack_level', $racklevel)
                                ->get();
        //dd($rack_pallet);
        return view('v_petugas.detail_warehouse', compact('warehouse','slot','slot_rack','pallet','idorderdata',
            'rack_pallet_one_lvl1','rack_pallet_one_lvl2','rack_pallet_two_lvl1','rack_pallet_two_lvl2',
            'rack_pallet_three_lvl1','rack_pallet_three_lvl2','rack_pallet_four_lvl1','rack_pallet_four_lvl2',));
    }

    public function editWarehouse($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $warehouse  = DB::table('tbl_warehouses')->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_warehouse',$id)->get();
        return view('v_petugas.edit_warehouse',compact('warehouse','idorderdata'));
    }

    public function addWarehouse(Request $request)
    {
        $add_warehouse                          = new WarehouseModel();
        $add_warehouse->id_warehouse            = $request->input('id_warehouse');
        $add_warehouse->warehouse_category      = $request->input('warehouse_category');
        $add_warehouse->warehouse_name          = $request->input('warehouse_name');
        $add_warehouse->warehouse_description   = $request->input('warehouse_description');
        $add_warehouse->status_id               = $request->input('status_id');
        $add_warehouse->save();

        return redirect('admin-user/show_warehouse')->with('success','Berhasil Menambah Data Gudang');
    }

    public function updateWarehouse(Request $request, $id)
    {
        $update_warehouse   = WarehouseModel::where('id_warehouse', $id)
                                ->update([
                                    'id_warehouse'          => $request->id_warehouse,
                                    'warehouse_category'    => $request->warehouse_category,
                                    'warehouse_name'        => $request->warehouse_name,
                                    'warehouse_description' => $request->warehouse_description,
                                    'status_id'             => $request->status_id
                                ]);
        return redirect('admin-user/show_warehouse')->with('success','Berhasil Mengubah Data Gudang');
    }

    // ====================
    // SLOT
    // ====================

    public function detailSlot($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $pallet_slot  = DB::table('tbl_slots')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_slot', $id)
                        ->get();

        $pbm_pallet_orderid  = DB::table('tbl_orders')
                                ->join('tbl_orders_data','tbl_orders_data.order_id','tbl_orders.id_order')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id', $id)
                                ->where('id_order_data','like', 'PBM-%')
                                ->where('is_delete','false')
                                ->get();

        $pbk_pallet_orderid  = DB::table('tbl_orders')
                                ->join('tbl_orders_data','tbl_orders_data.order_id','tbl_orders.id_order')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id', $id)
                                ->where('id_order_data','like', 'PBK-%')
                                ->where('is_delete','false')
                                ->get();

        $rack_slot    = DB::table('tbl_rack_details')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_slot', $id)
                        ->get();

        $pbm_entry      = DB::table('tbl_orders_detail')
                            ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_item_category.*',
                                    'users.*','tbl_roles.*','tbl_workunits.*','tbl_slots_names.*','tbl_orders_detail.*')
                            ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                            ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                            ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                            ->join('tbl_slots_names','tbl_slots_names.pallet_id','tbl_slots.id_slot')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->join('users','users.id','tbl_orders.adminuser_id')
                            ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                            ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                            ->where('slot_id',$id)
                            ->where('id_order_data','like', 'PBM-%')
                            ->where('is_delete','false')
                            ->get();

        $pbk_exit     = DB::table('tbl_orders_data')
                            ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','users.*',
                                    'tbl_roles.*','tbl_workunits.*','tbl_slots_names.*')
                            ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                            ->join('tbl_slots_names','tbl_slots_names.pallet_id','tbl_slots.id_slot')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->join('users','users.id','tbl_orders.adminuser_id')
                            ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                            ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                            ->where('slot_id',$id)
                            ->where('id_order_data','like', 'PBK-%')
                            ->where('is_delete','false')
                            ->orderby('order_dt','DESC')
                            ->get();

        $pallet_history = DB::table('tbl_orders_detail')
                            ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_item_category.*',
                                    'users.*','tbl_roles.*','tbl_workunits.*','tbl_slots_names.*','tbl_orders_detail.*')
                            ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                            ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                            ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                            ->join('tbl_slots_names','tbl_slots_names.pallet_id','tbl_slots.id_slot')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->join('users','users.id','tbl_orders.adminuser_id')
                            ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                            ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                            ->where('slot_id',$id)
                            ->orderby('order_dt','DESC')
                            ->get();

        $pbm_entryrack   = DB::table('tbl_orders_detail')
                                ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_orders_detail.*',
                                        'users.*','tbl_roles.*','tbl_workunits.*','tbl_rack_details.*','tbl_item_category.*')
                                ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                                ->join('tbl_rack_details','tbl_rack_details.id_slot_rack','tbl_orders_data.slot_id')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('users','users.id','tbl_orders.adminuser_id')
                                ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id',$id)
                                ->where('id_order_data','like', 'PBM-%')
                                ->where('is_delete','false')
                                ->get();

        $pbk_exitrack   = DB::table('tbl_orders_detail')
                                ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_orders_detail.*',
                                        'users.*','tbl_roles.*','tbl_workunits.*','tbl_rack_details.*','tbl_item_category.*')
                                ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                                ->join('tbl_rack_details','tbl_rack_details.id_slot_rack','tbl_orders_data.slot_id')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('users','users.id','tbl_orders.adminuser_id')
                                ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id',$id)
                                ->where('id_order_data','like', 'PBK-%')
                                ->where('is_delete','false')
                                ->get();

        $rack_history   = DB::table('tbl_orders_detail')
                                ->select('tbl_orders.*','tbl_orders_data.*','tbl_slots.*','tbl_warehouses.*','tbl_orders_detail.*',
                                        'users.*','tbl_roles.*','tbl_workunits.*','tbl_rack_details.*','tbl_item_category.*')
                                ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                                ->join('tbl_rack_details','tbl_rack_details.id_slot_rack','tbl_orders_data.slot_id')
                                ->join('tbl_slots','tbl_slots.id_slot','tbl_rack_details.id_slot_rack')
                                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                                ->join('users','users.id','tbl_orders.adminuser_id')
                                ->join('tbl_roles','tbl_roles.id_role','users.role_id')
                                ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                                ->where('slot_id',$id)
                                ->get();



        return view('v_petugas/detail_slot',compact('pbm_entry','pbm_pallet_orderid','pbm_entryrack','pallet_slot',
                                                    'rack_slot','idorderdata','pbk_pallet_orderid','pbk_exit','pbk_exitrack',
                                                    'pallet_history','rack_history'));
    }

    public function detailExitOrder($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $pallet_slot    = DB::table('tbl_orders_data')
                            ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                            ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                            ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                            ->where('id_order_data', $id)
                            ->get();

        $detailorder    = DB::table('tbl_orders_detail')
                            ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                            ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                            ->where('order_data_id', $id)
                            ->get();
        return view('v_petugas.detail_exit_order', compact('pallet_slot','detailorder','idorderdata'));
    }

    // ====================
    // CONFIRM ORDER
    // ====================

    public function confirmExitOrder($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $dataitem = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->where('order_id', $id)
                        ->get();

        $order     = DB::table('tbl_orders')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->join('users','users.id','tbl_orders.adminuser_id')
                        ->where('id_order', $id)
                        ->get();

        return view('v_petugas/confirm_exit_order', compact('order','dataitem','idorderdata'));
    }

    public function confirmEntryOrder($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $dataitem = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->where('order_id', $id)
                        ->get();

        $order     = DB::table('tbl_orders')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->join('users','users.id','tbl_orders.adminuser_id')
                        ->where('id_order', $id)
                        ->get();

        return view('v_petugas/confirm_entry_order', compact('order','dataitem','idorderdata'));
    }

    // ====================
    // BARANG MASUK
    // ====================

    public function showEntryItem()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $entryitem  = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->where('item_status', 'Barang Masuk')
                        ->orderby('order_dt','DESC')
                        ->get();
        return view('v_petugas/show_entry_item', compact('entryitem','idorderdata'));
    }
    // ====================
    // BARANG KELUAR
    // ====================

    public function showExitItem()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $exititem  = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->where('item_status', 'Barang Keluar')
                        ->orderby('order_dt','DESC')
                        ->get();
        $exititem2 = DB::table('tbl_orders_detail')->select('letter_num', DB::raw("count(item_code) as totalitem "))
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->groupBy('letter_num')
                        ->get();
        return view('v_petugas/show_exit_item', compact('exititem','exititem2','idorderdata'));
    }

    // ====================
    // CATEGORY ITEM 
    // ====================

    public function showCategoryItem()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $category_item  = DB::table('tbl_item_category')->get();
        $warehouse = DB::table('tbl_warehouses')->get();

        return view('v_petugas.category_item', compact('idorderdata','category_item','warehouse'));
    }

    public function addCategoryItem(Request $request)
    {
        $addctgry                       = new ItemCategoryModel();
        $addctgry->itemcategory_name    = strtoupper($request->input('itemcategory_name'));
        $addctgry->save();

        return redirect('admin-user/category_item')->with('success','Berhasil Menambah Kategori Baru');
    }

    public function editCategoryItem(Request $request, $id)
    {
        $editctgry  = ItemCategoryModel::where('id_item_category',$id)
                        ->update([
                            'itemcategory_name'    => $request->itemcategory_name
                        ]);

        return redirect('admin-user/category_item')->with('success','Berhasil Mengubah Kategori');
    }

    // ====================
    // PROFILE
    // ====================

    public function showProfile($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $satker = DB::table('users')->where('id', $id)->get();
        return view('v_petugas/show_profile', compact('satker','idorderdata'));

    }

    public function editProfile(Request $request, $id)
    {
        $editprofile    = User::where('id',$id)
                            ->update([
                                'id'            => $request->id,
                                'workunit_id'   => $request->workunit_id,
                                'email'         => $request->email,
                                'username'      => $request->username,
                                'password'      => $request->password
                            ]);
        return redirect('admin-user/dashboard')->with('success','BERHASIL MENGUBAH DATA PROFIL !');
    }

    public function editPassword(Request $request, $id)
    {
        $cekpassword    = Hash::check($request->oldpassword, $request->cekpassword);
        
        if($cekpassword == 'true')
        {
            $editpassword    = User::where('id',$id)
                                    ->update([
                                        'password'  => Hash::make($request->password)
                                    ]);
            return redirect('signout')->with('success','BERHASIL MENGUBAH PASSWORD !');
        }

        return redirect('admin-user/show_profile/'. $id)->with('failed','PASSWORD LAMA ANDA SALAH !');
    }

    // ====================
    // HISTORY
    // ====================

    public function showHistory()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $history    = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->orderby('order_dt','DESC')
                        ->get();
        return view('v_petugas.show_history', compact('history', 'idorderdata'));
    }

    // ====================
    // CETAK PDF 
    // ====================

    public function downloadPDF($id)
    {
        $letter_num = DB::table('tbl_orders')->select('letter_num')->where('id_order', $id)->get();
        $dataitem = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                        ->where('order_id', $id)
                        ->get();

        $order     = DB::table('tbl_orders')
                        ->join('tbl_workunits','tbl_workunits.id_workunit','tbl_orders.workunit_id')
                        ->join('users','users.id','tbl_orders.adminuser_id')
                        ->where('id_order', $id)
                        ->get();

        $pdf        = PDF::loadview('v_petugas/pdf_entry_order', compact('order','dataitem'));
        return $pdf->download($id.'.pdf');
    }


    // ====================
    // JSON 
    // ====================

    public function getSlotId(Request $request)
    {
        $slotid = DB::table('tbl_slots')->where('warehouse_id', $request->warehouseid)->where('slot_status','Tersedia')->pluck('id_slot','id_slot');
        return response()->json($slotid);
    }    

    public function getSlotIdNotIn(Request $request)
    {
        $slotid = DB::table('tbl_slots')->where('warehouse_id', $request->warehouseid)
                    ->where('slot_status','Tersedia')
                    ->whereNotIn('id_slot', $request->data)
                    ->pluck('id_slot','id_slot');
        return response()->json($slotid);

    }  

    public function getItemCategory(Request $request)
    {
        $itemcategory = DB::table('tbl_item_category')->pluck('id_item_category','itemcategory_name');
        return response()->json($itemcategory);
    }      

    public function getWarehouse(Request $request)
    {
        $warehouse = DB::table('tbl_warehouses')->where('status_id',1)->pluck('id_warehouse','warehouse_name');
        return response()->json($warehouse);
    }  

    public function getItem(Request $request)
    {
        $item['data'] = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->where('item_code', $request->itemcode)->get();

        return response()->json($item);
    } 

    public function getItemCode09(Request $request)
    {
        $itemcode09 = DB::table('tbl_orders_detail')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_detail.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders.slot_id')
                        ->where('slot_id',$request->id_slot)
                        ->pluck('item_name','item_code');
        return response()->json($itemcode09);
    }

    public function getWarehouseId(Request $request)
    {

        $warehouseid = DB::table('tbl_orders_data')
                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                ->where('tbl_slots.workunit_id', $request->satkerid)
                ->where('id_order_data','like','PBM-%')
                ->where('slot_status','Penuh')
                ->groupBy('id_warehouse','warehouse_name')
                ->pluck('warehouse_name','id_warehouse');
        return response()->json($warehouseid);
    }  

    public function getPalletId(Request $request)
    {
        $palletid = DB::table('tbl_orders_data')
                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                ->where('tbl_slots.workunit_id', $request->satkerid)
                ->where('tbl_slots.warehouse_id', $request->warehouseid)
                ->where('id_order_data','like','PBM-%')
                ->where('is_delete','false')
                ->pluck('slot_id','id_order_data');
        return response()->json($palletid);
    }  

    public function getPalletIdNotIn(Request $request)
    {
        $palletid = DB::table('tbl_orders_data')
                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                ->where('tbl_slots.workunit_id', $request->satkerid)
                ->where('tbl_slots.warehouse_id', $request->warehouseid)
                ->where('id_order_data','like','PBM-%')
                ->where('is_delete','false')
                ->whereNotIn('id_slot', $request->data)
                ->pluck('slot_id','id_order_data');
        return response()->json($palletid);
    }

    public function getItemId(Request $request)
    {
        $itemcode = DB::table('tbl_orders_detail')
                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                ->where('slot_id', $request->slotid)
                ->where('item_status','Barang Masuk')
                ->pluck('item_name','item_code');
        return response()->json($itemcode);
    }

    public function getItemIdNotIn(Request $request)
    {
        $itemcode = DB::table('tbl_orders_detail')
                ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                ->join('tbl_warehouses','tbl_warehouses.id_warehouse','tbl_slots.warehouse_id')
                ->where('slot_id', $request->slotid)
                ->where('item_status','Barang Masuk')
                ->whereNotIn('item_code', $request->data)
                ->pluck('item_name','item_code');
        return response()->json($itemcode);
    }  

    public function getOrderDataId(Request $request)
    {
        $slotid = DB::table('tbl_orders_data')
                        ->select('id_order_data')
                        ->where('slot_id',$request->slotid)
                        ->where('is_delete','false')
                        ->where('id_order_data','like','PBM-%')
                        ->pluck('id_order_data','id_order_data');
        return response()->json($slotid);
    }  

}
