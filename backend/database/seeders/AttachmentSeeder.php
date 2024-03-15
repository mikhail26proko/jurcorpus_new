<?php

namespace Database\Seeders;

use Orchid\Attachment\Models\Attachment;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $empty = Attachment::find(1);

        if (empty($empty)){
            Attachment::create([
                "name"=> "JurCorpusDefault",
                "original_name"=> "JurCorpusDefault.png",
                "mime"=> "image/png",
                "extension"=> "png",
                "size"=> "12171",
                "sort"=> "0",
                "path"=> "employees/",
                "description"=> null,
                "alt"=> null,
                "hash"=> "e8481512f331902717f22d11f85b79c7413844e2",
                "disk"=> "public",
                "user_id"=> null,
                "group"=> null,
                "created_at"=> "2023-12-01 00:00:00",
                "updated_at"=> "2023-12-01 00:00:00"
            ]);
        }
    }
}
