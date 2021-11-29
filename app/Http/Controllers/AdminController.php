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


class AdminController extends Controller
{
    public function index()
    {
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

        return view('v_admin_master.index', compact('warehouse09','warehouse05B','pallet','rack_pallet_one_lvl1',
                'rack_pallet_one_lvl2','rack_pallet_two_lvl1','rack_pallet_two_lvl2','rack_pallet_three_lvl1',
                'rack_pallet_three_lvl2','rack_pallet_four_lvl1','rack_pallet_four_lvl2','palletavail09','palletavail05b'));
    }

    // ====================
    // USER
    // ====================

    public function showUser()
    {
        $petugas = DB::table('users')->join('tbl_roles','.tbl_roles.id_role','users.role_id')->orderby('role_name','ASC')
                ->where('role_id',2)->get();

        $satker = DB::table('users')->join('tbl_roles','.tbl_roles.id_role','users.role_id')
                ->join('tbl_workunits','tbl_workunits.id_workunit','users.workunit_id')->orderby('role_name','ASC')
                ->where('role_id',3)->get();
        return view('v_admin_master.show_user', compact('petugas','satker'));
    }

    public function createUser()
    {
        $workunit = DB::table('tbl_workunits')->get();
        return view('v_admin_master.create_user', compact('workunit'));
    }

    public function addUser(Request $request)
    {
        if ($request->role_id == 'null' || $request->workunit_id == 'null') {
                return redirect("create_user")->with('Failder', 'Silahkan Lengkapi Data !');
        }else{
                $add_user              = new User();
                $add_user->id          = $request->input('id');
                $add_user->role_id     = $request->input('role_id');
                $add_user->workunit_id = $request->input('workunit_id');
                $add_user->full_name   = $request->input('full_name');
                $add_user->username    = $request->input('username');
                $add_user->password    = Hash::make($request->input('password'));
                $add_user->status_id   = $request->input('status_id');
                $add_user->save();

                return redirect('admin-master/create_user')->with('success','Berhasil Menambah Data User');
        }
    }


    // ====================
    // WAREHOUSE
    // ====================
    public function showWarehouse()
    {
        $warehouse  = DB::table('tbl_warehouses')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->orderby('status_id', 'ASC')
                        ->get();

        return view('v_admin_master.show_warehouse',compact('warehouse'));
    }

    public function createWarehouse()
    {
        return view('v_admin_master.create_warehouse');   
    }    

    public function createSlot($id)
    {
        $slot  = DB::table('tbl_warehouses')
                        ->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_warehouse',$id)
                        ->get();

        return view('v_admin_master.create_slot', compact('slot'));   
    }

    public function detailWarehouse(Request $request, $id)
    {
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
        return view('v_admin_master.detail_warehouse', compact('warehouse','slot','slot_rack','pallet',
            'rack_pallet_one_lvl1','rack_pallet_one_lvl2','rack_pallet_two_lvl1','rack_pallet_two_lvl2',
            'rack_pallet_three_lvl1','rack_pallet_three_lvl2','rack_pallet_four_lvl1','rack_pallet_four_lvl2',));
    }

    public function editWarehouse($id)
    {
        $warehouse  = DB::table('tbl_warehouses')->join('tbl_status','tbl_status.id_status','tbl_warehouses.status_id')
                        ->where('id_warehouse',$id)->get();
        return view('v_admin_master.edit_warehouse',compact('warehouse','idorderdata'));
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

        return redirect('admin-master/show_warehouse')->with('success','Berhasil Menambah Data Gudang');
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
        return redirect('admin-master/show_warehouse')->with('success','Berhasil Mengubah Data Gudang');
    }


    // ====================
    // SLOT
    // ====================

    public function detailSlot($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
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



        return view('v_admin_master/detail_slot',compact('pbm_entry','pbm_pallet_orderid','pbm_entryrack','pallet_slot',
                                                    'rack_slot','idorderdata','pbk_pallet_orderid','pbk_exit','pbk_exitrack',
                                                    'pallet_history','rack_history'));
    }

    public function detailExitOrder($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
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
        return view('v_admin_master.detail_exit_order', compact('pallet_slot','detailorder','idorderdata'));
    }

    public function addSlot(Request $request)
    {
        $id_warehouse       = $request->get('warehouse_id');
        $check_slot         = DB::table('tbl_slots')->where('id_slot',$request->get('id_slot'))->count();
        $check_total_pallet = DB::table('tbl_slots_rackings')->where('rack_id',$request->get('id_slot'))->count();
        $check_rack         = $request->get('slot_category');
        $check_id_rack      = DB::table('tbl_slots_rackings')
                                ->where('rack_id',$request->get('id_slot'))
                                ->where('rack_level',$request->get('rack_level'))
                                ->where('rack_pallet_id',$request->get('rack_pallet_id'))->count();
        $check_id_slot      = DB::table('tbl_slots')->select('id_slot')->get();

        if ($check_slot == 0 && $check_rack == 'Racking') {
            $add_slot                       = new SlotModel();
            $add_slot->id_slot              = $request->input('id_slot');
            $add_slot->warehouse_id         = $request->input('warehouse_id');
            $add_slot->total_pallet_rack    = $check_total_pallet+1;
            $add_slot->slot_status          = $request->input('slot_status');
            $add_slot->save();

            $add_rack                       = new RackModel();
            $add_rack->rack_id              = $request->input('id_slot');
            $add_rack->rack_level           = $request->input('rack_level');
            $add_rack->rack_pallet_id       = $request->input('rack_pallet_id');
            $add_rack->rack_pallet_status   = $request->input('rack_pallet_status');
            $add_rack->save();
        }elseif($check_slot == 1 && $check_id_rack == 0 && $check_rack == 'Racking'){
            $update_rack   = SlotModel::where('id_slot', $request->get('id_slot'))
                            ->update(['total_pallet_rack' => $check_total_pallet+1 ]);
            $add_rack                       = new RackModel();
            $add_rack->rack_id              = $request->input('id_slot');
            $add_rack->rack_level           = $request->input('rack_level');
            $add_rack->rack_pallet_id       = $request->input('rack_pallet_id');
            $add_rack->rack_pallet_status   = $request->input('rack_pallet_status');
            $add_rack->save();
        }elseif($check_id_rack == 1){
            return redirect('admin-master/detail_warehouse/'.$id_warehouse)->with('failed','Kode Pallet Sudah Terdaftar'); 
        }elseif($check_slot == 0){
            $add_slot                       = new SlotModel();
            $add_slot->id_slot              = $request->input('id_slot');
            $add_slot->warehouse_id         = $request->input('warehouse_id');
            $add_slot->total_pallet_rack    = $request->input('total_pallet_rack');
            $add_slot->slot_status          = $request->input('slot_status');
            $add_slot->save();
        }elseif($check_slot == 1){
            return redirect('admin-master/detail_warehouse/'.$id_warehouse)->with('failed','Kode Pallet Sudah Terdaftar');
        }
        return redirect('admin-master/detail_warehouse/'.$id_warehouse)->with('success','Berhasil Menambah Data Slot');
    }

    // ====================
    // WAREHOUSE
    // ====================

    public function showOrderIncoming()
    {
        $orderincoming  = DB::table('tbl_orders')->where('id_order', 'like', 'PBM-%')->get();
        return view('v_admin_master/show_order_incoming', compact('orderincoming'));
    }
    // ====================
    // BARANG MASUK
    // ====================

    public function showEntryItem()
    {
        $entryitem  = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->where('item_status', 'Barang Masuk')
                        ->orderby('order_dt','DESC')
                        ->get();
        return view('v_admin_master/show_entry_item', compact('entryitem'));
    }
    // ====================
    // BARANG KELUAR
    // ====================

    public function showExitItem()
    {
        $exititem  = DB::table('tbl_orders_detail')
                        ->join('tbl_item_category','tbl_item_category.id_item_category','tbl_orders_detail.itemcategory_id')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->join('tbl_slots','tbl_slots.id_slot','tbl_orders_data.slot_id')
                        ->where('item_status', 'Barang Keluar')
                        ->orderby('order_dt','DESC')
                        ->get();
        $exititem2 = DB::table('tbl_orders_detail')->select('letter_num', DB::raw("count(item_code) as totalitem "))
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->groupBy('letter_num')
                        ->get();
        return view('v_admin_master/show_exit_item', compact('exititem','exititem2'));
    }

    // ====================
    // CATEGORY ITEM 
    // ====================

    public function showCategoryItem()
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $category_item  = DB::table('tbl_item_category')->get();
        $warehouse = DB::table('tbl_warehouses')->get();

        return view('v_admin_master.category_item', compact('idorderdata','category_item','warehouse'));
    }

    public function addCategoryItem(Request $request)
    {
        $addctgry                       = new ItemCategoryModel();
        $addctgry->itemcategory_name    = strtoupper($request->input('itemcategory_name'));
        $addctgry->save();

        return redirect('admin-master/category_item')->with('success','Berhasil Menambah Kategori Baru');
    }

    public function editCategoryItem(Request $request, $id)
    {
        $editctgry  = ItemCategoryModel::where('id_item_category',$id)
                        ->update([
                            'itemcategory_name'    => strtoupper($request->itemcategory_name)
                        ]);

        return redirect('admin-master/category_item')->with('success','Berhasil Mengubah Kategori');
    }

    public function deleteCategory()
    {
        $deletectgry = ItemCategoryModel::find($ID)
    }

    // ====================
    // PROFILE
    // ====================

    public function showProfile($id)
    {
        $date           = date('Ymd', strtotime(now()));
        $totalorder     = DB::table('tbl_orders')->where('id_order','like','%'.$date.'%')->count();
        $totaldataorder = DB::table('tbl_orders_data')->count();
        $order_id       = ($date."".$totalorder)+1;
        $idorderdata    = ($date."".$totalorder."".$totaldataorder)+1;

        $satker = DB::table('users')->where('id', $id)->get();
        return view('v_admin_master/show_profile', compact('satker','idorderdata'));

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
        return redirect('admin-master/dashboard')->with('success','BERHASIL MENGUBAH DATA PROFIL !');
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

        return redirect('admin-master/show_profile/'. $id)->with('failed','PASSWORD LAMA ANDA SALAH !');
    }

    // ================
    // Bar Chart 
    // ================

    public function getChartTotalOrder()
    {
        $month_now  = date('m', strtotime(now()));
        $result     = DB::table('tbl_orders_detail')
                        ->join('tbl_orders_data','tbl_orders_data.id_order_data','tbl_orders_detail.order_data_id')
                        ->join('tbl_orders','tbl_orders.id_order','tbl_orders_data.order_id')
                        ->select(DB::raw("(DATE_FORMAT(order_dt, '%M')) as month"), DB::raw("count(item_code) as totalscore "))
                        ->orderBy('order_dt','ASC')
                        ->groupBy(DB::raw("(DATE_FORMAT(order_dt, '%M'))"))->limit(5)
                        ->get();      

        return response()->json($result);
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
        return view('v_admin_master.show_history', compact('history', 'idorderdata'));
    }

}
