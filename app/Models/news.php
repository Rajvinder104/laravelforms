<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class news extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'title',
        'news',
        // 'password'
    ];

    public function get_records($table, $where, $select, $pagination = false, $perpage = 10)
    {

        $query = DB::table($table)
            ->where($where)
            ->select($select);

        if ($pagination) {
            return $query->paginate($perpage);
        } else {
            return $query->get();
        }
    }

    public function get_single_record($table, $where, $select)
    {
        $query = DB::table($table)
            ->where($where)
            ->selectRaw($select)
            ->groupBy('name')
            ->first(); // Fetch the result directly

        return $query;
    }
    public function get_single_record2($table, $where, $select)
    {
        $query = DB::table($table)
            ->where($where)
            ->selectRaw($select)

            ->first(); // Fetch the result directly

        return $query;
    }
}
