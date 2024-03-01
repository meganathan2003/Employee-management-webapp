<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

}
