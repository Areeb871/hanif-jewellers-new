<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $dubaiNames = [
            'classic' => 'Dubai Classic Jewellery',
            'fine' => 'Dubai Fine Jewellery',
            'high-end' => 'Dubai High End Jewellery',
            'exclusive' => 'Dubai Exclusive Jewellery',
            'hand-crafted' => 'Dubai Hand Crafted Jewellery',
        ];

        foreach ($dubaiNames as $slug => $name) {
            DB::table('gold_service_settings')
                ->where('market', 'uae')
                ->where('slug', $slug)
                ->update([
                    'name' => $name,
                    'updated_at' => now(),
                ]);
        }

        // Remap product UAE service FKs that still point at Pakistan service rows
        // to the matching Dubai service (same slug, market=uae).
        $pkServices = DB::table('gold_service_settings')->where('market', 'pk')->get()->keyBy('id');
        $uaeServices = DB::table('gold_service_settings')->where('market', 'uae')->get()->keyBy('slug');

        foreach ($pkServices as $pkId => $pkService) {
            $uaeService = $uaeServices->get($pkService->slug);
            if (! $uaeService) {
                continue;
            }

            DB::table('products')
                ->where('uae_gold_service_id', $pkId)
                ->update(['uae_gold_service_id' => $uaeService->id]);

            DB::table('products')
                ->where('uae_online_store_gold_service_id', $pkId)
                ->update(['uae_online_store_gold_service_id' => $uaeService->id]);
        }
    }

    public function down(): void
    {
        $pkNames = [
            'classic' => 'Classic',
            'fine' => 'Fine',
            'high-end' => 'High End',
            'exclusive' => 'Exclusive',
            'hand-crafted' => 'Hand Crafted',
        ];

        foreach ($pkNames as $slug => $name) {
            DB::table('gold_service_settings')
                ->where('market', 'uae')
                ->where('slug', $slug)
                ->update([
                    'name' => $name,
                    'updated_at' => now(),
                ]);
        }
    }
};
