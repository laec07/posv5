<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	
    {
		// Verificar si la permisión ya existe
        if (!Permission::where('name', 'discount.access')->exists()) {
            // Agregar la permisión solo si no existe
			//Permission::create(['name' => 'discount.access']);
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
