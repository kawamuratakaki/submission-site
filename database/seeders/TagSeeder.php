<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
                'tag_name' => 'バトル・格闘',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        DB::table('tags')->insert([
                'tag_name' => 'ラブコメ・恋愛',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'スポーツ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ギャグ・コメディー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'SF・ファンタジー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ミステリー・サスペンス',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ホラー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'グルメ・料理',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ギャンブル',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ヤンキー・極道',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '歴史',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '青春・学園',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ビジネス・企業',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '動物・ペット',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '子育て・夫婦',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '医療',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ネオン',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '日常',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '旅行',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '冒険',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '転生',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'スピンオフ・外伝',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'その他',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '完結済み',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'スカッとする',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '萌え',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '笑える',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '胸キュン',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'アツい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ハッピー',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ほのぼの',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '癒される',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '泣ける',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '切ない',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '感動する',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'エモい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ドキドキハラハラ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '深い',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'カッコいい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'シュール',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'タメになる',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'アガる',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '怖い',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ドロドロ',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'ダーク',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => 'じれったい',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '憧れる',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
         DB::table('tags')->insert([
                'tag_name' => '共感する',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}