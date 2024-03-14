<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\AuditCustom;

class AuditController extends Controller
{
    public function index()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with('user')
            ->orderBy('created_at', 'desc')->get();
        return view('layouts.audit', ['audits' => $audits]);
    }

    public function auditLog($model, $id){
        // Check if user can access audit log
        if(!auth()->user()->allowedTo('view_audit_log')) {
            return abort(401);
        }

        $audits = new \Illuminate\Database\Eloquent\Collection;
        if(isset($model::$auditsubs)){
            $foreign_key_prefix = strtolower(substr($model, strrpos($model, "\\") + 1));
            $tables_array = $model::$auditsubs;
            foreach($tables_array as $data){
                $sub_model = 'App\\Models\\' . $data;
                $records = $sub_model::where($foreign_key_prefix.'_id',$id)
                                     ->withTrashed()
                                     ->orderBy('created_at', 'desc')
                                     ->get();
                foreach($records as $row){
                    $new_data = \OwenIt\Auditing\Models\Audit::where('auditable_type',$sub_model)
                                                             ->where('auditable_id',$row->id)
                                                             ->orderBy('created_at', 'desc')->get();
                    $audits = $audits->merge($new_data);

                }
            }
        }

        $main_data = \OwenIt\Auditing\Models\Audit::where('auditable_type', $model)
                                                  ->where('auditable_id', $id)
                                                  ->orderBy('created_at', 'desc')->get();
        $audits = $audits->merge($main_data);

        $audits = $audits->sortBy([
            ['created_at', 'desc'],
        ]);

        $audits->values()->all();

        return view('layouts.audit', ['audits' => $audits]);
    }

    static function recordLog($data, $action, $old_value, $new_value){
        $data->auditEvent = $action;
        $data->isCustomEvent = true;
        $data->auditCustomOld = [
            'Removed' => $old_value
        ];
        $data->auditCustomNew = [
            'Added' => $new_value
        ];
        Event::dispatch(AuditCustom::class, [$data]);
    }
}
