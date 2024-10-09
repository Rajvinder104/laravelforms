<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class user extends Model
{
    use HasFactory;

    public $guarded = [];
    public $timestamps = true;

    public function get_records($table, $where, $select)
    {

        $query = DB::table($table)
            ->where($where)
            ->select($select);

        return $query->get();
    }

    public function get_limit_records($table, $where, $select, $perpage)
    {

        $query = DB::table($table)
            ->where($where)
            ->select($select)
            ->paginate($perpage);
        return $query;
    }

    // public function get_limit_records($table, $where, $select, $perpage)
    // {
    //     $query = DB::table($table)->select($select);
    //     if (is_array($where)) {
    //         if (count($where) === 3) {
    //             $query->where($where[0], $where[1], $where[2]);
    //         } elseif (count($where) === 2) {
    //             $query->where($where[0], $where[1]);
    //         } else {
    //         }
    //     }


    //         return $query->paginate($perpage);

    // }

    public function get_single_record($table, $where, $select)
    {
        $query = DB::table($table)
            ->where($where)
            ->selectRaw($select)
            ->first();

        return $query;
    }

    public function add($table, $data)
    {

        $query = DB::table($table)
            ->insert($data);
        return $query;
    }
}
