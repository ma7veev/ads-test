<?php
    
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    use App\Models\Ads as AdsModel;
    
    class Ads extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema ::create('ads', function (Blueprint $table) {
                $table -> bigIncrements('id');
                $table -> string('title');
                $table -> string('author_name');
                $table -> integer('user_id')->nullable();
                $table -> mediumText('description');
                $table -> timestamps();
            });
            $i = 0;
            while ($i<=40) {
                $ads_model = new AdsModel;
                $ads_model -> title = 'Title'.$i;
                $ads_model -> author_name = 'Author'.$i;
                $ads_model -> description = $i.'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam atque delectus esse ex facilis fugiat ipsa quaerat quisquam, sed sequi ullam, unde voluptas! Dolore nam non porro ratione sed ut.';
                $ads_model -> save();
                $i++;
            }
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema ::dropIfExists('ads');
        }
    }
